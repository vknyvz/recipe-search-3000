<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Recipe;

interface RecipeSearchServiceInterface
{
    public function search(array $filters, int $page, int $per_page): LengthAwarePaginator;

    public function applyFilters(Builder $query, array $filters): void;

    public function findBySlug(string $slug): ?Recipe;
}