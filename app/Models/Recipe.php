<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'author_email',
        'slug'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($recipe) {
            if (empty($recipe->slug)) {
                $recipe->slug = static::generateUniqueSlug($recipe->name);
            }
        });

        static::updating(function ($recipe) {
            if ($recipe->isDirty('name')) {
                $recipe->slug = static::generateUniqueSlug($recipe->name);
            }
        });
    }

    public static function generateUniqueSlug(string $name): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(Step::class)->orderBy('order');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Scope for search functionality
    public function scopeWithAuthorEmail($query, string $email)
    {
        return $email ? $query->where('author_email', $email) : $query;
    }

    public function scopeWithKeyword($query, string $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('name', 'LIKE', "%{$keyword}%")
              ->orWhere('description', 'LIKE', "%{$keyword}%")
              ->orWhereHas('ingredients', function ($ingredientQuery) use ($keyword) {
                  $ingredientQuery->where('name', 'LIKE', "%{$keyword}%");
              })
              ->orWhereHas('steps', function ($stepQuery) use ($keyword) {
                  $stepQuery->where('instruction', 'LIKE', "%{$keyword}%");
              });
        });
    }

    public function scopeWithIngredient($query, string $ingredient)
    {
        if (empty($ingredient)) {
            return $query;
        }

        return $query->whereHas('ingredients', 
            fn($q) => $q->where('name', 'LIKE', "%{$ingredient}%")
        );
    }
}
