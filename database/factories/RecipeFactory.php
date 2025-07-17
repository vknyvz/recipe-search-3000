<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'author_email' => $this->faker->email(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Recipe $recipe) {
            // Create ingredients
            $ingredientCount = $this->faker->numberBetween(3, 6);
            for ($i = 0; $i < $ingredientCount; $i++) {
                $recipe->ingredients()->create([
                    'description' => $this->faker->sentence(3),
                    'order_index' => $i,
                ]);
            }

            // Create steps
            $stepCount = $this->faker->numberBetween(3, 8);
            for ($i = 0; $i < $stepCount; $i++) {
                $recipe->steps()->create([
                    'description' => $this->faker->sentence(8),
                    'order_index' => $i,
                ]);
            }
        });
    }
}
