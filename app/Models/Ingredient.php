<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'name',
        'amount',
        'unit'
    ];

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }

    // Helper method to get formatted ingredient display
    public function getFormattedAttribute(): string
    {
        $formatted = $this->amount;
        
        if ($this->unit) {
            $formatted .= ' ' . $this->unit;
        }
        
        $formatted .= ' ' . $this->name;
        
        return $formatted;
    }
}
