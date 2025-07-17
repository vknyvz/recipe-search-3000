<?php

namespace App\Services;

use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\Step;
use Illuminate\Support\Facades\DB;

class RecipeCreationService
{
    public function createRecipe(array $data): Recipe
    {
        return DB::transaction(function () use ($data) {
            // Create the recipe
            $recipe = Recipe::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'author_email' => $data['author_email'],
            ]);

            // Create ingredients
            if (!empty($data['ingredients'])) {
                $this->createIngredients($recipe, $data['ingredients']);
            }

            // Create steps  
            if (!empty($data['steps'])) {
                $this->createSteps($recipe, $data['steps']);
            }

            // Load relationships for return
            return $recipe->load(['ingredients', 'steps']);
        });
    }

    private function createIngredients(Recipe $recipe, array $ingredients): void
    {
        foreach ($ingredients as $ingredient) {
            Ingredient::create([
                'recipe_id' => $recipe->id,
                'name' => $ingredient['name'],
                'amount' => $ingredient['amount'] ?? '',
                'unit' => $ingredient['unit'] ?? '',
            ]);
        }
    }

    private function createSteps(Recipe $recipe, array $steps): void
    {
        foreach ($steps as $index => $step) {
            Step::create([
                'recipe_id' => $recipe->id,
                'order' => $index + 1,
                'instruction' => $step,
            ]);
        }
    }
}
