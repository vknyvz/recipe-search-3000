<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeSearchRequest;
use App\Http\Resources\RecipeResource;
use App\Http\Resources\RecipeDetailResource;
use App\Models\Recipe;
use App\Services\RecipeSearchService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class RecipeController extends Controller
{
    public function __construct(
        private RecipeSearchService $searchService
    ) {}

    public function index(RecipeSearchRequest $request): AnonymousResourceCollection
    {
        $filters = $request->getSearchFilters();
        $paginationParams = $request->getPaginationParams();

        $recipes = $this->searchService->search(
            $filters,
            $paginationParams['page'],
            $paginationParams['per_page']
        );

        return RecipeResource::collection($recipes);
    }

    public function show(string $slug): RecipeDetailResource|JsonResponse
    {
        $recipe = $this->searchService->findBySlug($slug);

        if (!$recipe) {
            return response()->json([
                'message' => 'Recipe not found'
            ], 404);
        }

        return new RecipeDetailResource($recipe);
    }
}
