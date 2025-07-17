<?php

namespace App\Services;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Interfaces\RecipeSearchServiceInterface;

class RecipeSearchService implements RecipeSearchServiceInterface
{
    public function search(array $filters, int $page = 0, int $perPage = 12): LengthAwarePaginator
    {
        $query = Recipe::query()
            ->with(['ingredients', 'steps'])->orderBy('id');

        $this->applyFilters($query, $filters);

        return $query->orderBy('created_at', 'desc')
                    ->paginate($perPage, ['*'], 'page', $page)
                    ->withQueryString();
    }

    public function applyFilters(Builder $query, array $filters): void
    {
        // Author email filter (exact match)
        if (!empty($filters['email'])) {
            $query->withAuthorEmail($filters['email']);
        }

        // Keyword filter (matches name, description, ingredients, steps)
        if (!empty($filters['keyword'])) {
            $query->withKeyword($filters['keyword']);
        }

        // Ingredient filter (partial match in ingredients)
        if (!empty($filters['ingredient'])) {
            $query->withIngredient($filters['ingredient']);
        }
    }

    public function findBySlug(string $slug): ?Recipe
    {
        return Recipe::with(['ingredients', 'steps'])->where('slug', $slug)->first();
    }
}
