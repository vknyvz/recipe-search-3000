<?php

namespace App\Console\Commands;

use App\Services\RecipeCreationService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateRecipeCommand extends Command
{
    protected $signature = 'recipe:create
                           {name : The recipe name}
                           {description : The recipe description}
                           {author_email : The author email}
                           {--ingredients=* : List of ingredients in format "amount|unit|name"}
                           {--steps=* : List of step instructions}';

    protected $description = 'Create a new recipe with normalized data structure';

    public function __construct(
        private RecipeCreationService $recipeCreationService
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $ingredients = $this->parseIngredients($this->option('ingredients'));
        $steps = $this->parseSteps($this->option('steps'));

        $data = [
            'name' => $this->argument('name'),
            'description' => $this->argument('description'),
            'author_email' => $this->argument('author_email'),
            'ingredients' => $ingredients,
            'steps' => $steps,
        ];

        // Basic validation
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'author_email' => 'required|email',
            'ingredients' => 'required|array|min:1',
            'steps' => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            $this->error('Validation failed:');
            foreach ($validator->errors()->all() as $error) {
                $this->error("- {$error}");
            }
            return self::FAILURE;
        }

        try {
            $recipe = $this->recipeCreationService->createRecipe($data);

            $this->info("Recipe '{$recipe->name}' created successfully!");
            $this->info("Slug: {$recipe->slug}");
            $this->info("Ingredients: {$recipe->ingredients->count()}");
            $this->info("Steps: {$recipe->steps->count()}");

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Failed to create recipe: {$e->getMessage()}");
            return self::FAILURE;
        }
    }

    private function parseIngredients(array $ingredients): array
    {
        return array_map(function ($ingredient) {
            $parts = explode('|', $ingredient);
            return [
                'amount' => $parts[0] ?? '',
                'unit' => $parts[1] ?? null,
                'name' => $parts[2] ?? $ingredient,
            ];
        }, $ingredients);
    }

    private function parseSteps(array $steps): array
    {
        return array_map(function ($step) {
            return ['instruction' => $step];
        }, $steps);
    }
}
