<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Database\Seeder;

class StepSeeder extends Seeder
{
    public function run()
    {
        $recipes = Recipe::all();

        foreach ($recipes as $recipe) {
            switch ($recipe->name) {
                case 'Classic Burger':
                    $steps = $this->getRecipeSteps();
                    $this->saveSteps($recipe, $steps);
                    break;
                case 'Halibut Bahn Mi Burger':
                    $steps = $this->getRecipeSteps();
                    $this->saveSteps($recipe, $steps);
                    break;
                case 'Mediterranean Halibut Pita Pockets':
                    $steps = $this->getRecipeSteps();
                    $this->saveSteps($recipe, $steps);
                    break;
                case 'Crunchy Salad Featuring Halibut':
                    $steps = $this->getRecipeSteps();
                    $this->saveSteps($recipe, $steps);
                    break;
                case 'Burger Melt':
                    $steps = $this->getRecipeSteps();
                    $this->saveSteps($recipe, $steps);
                    break;
                case 'Citrus Halibut Burger Stack with Fennel Slaw':
                    $steps = $this->getRecipeSteps();
                    $this->saveSteps($recipe, $steps);
                    break;
                case 'Burger Lettuce Wraps':
                    $steps = $this->getRecipeSteps();
                    $this->saveSteps($recipe, $steps);
                    break;
                case 'Burger Bowl':
                    $steps = $this->getRecipeSteps();
                    $this->saveSteps($recipe, $steps);
                    break;
                case 'Burger Benny':
                    $steps = $this->getRecipeSteps();
                    $this->saveSteps($recipe, $steps);
                    break;
                case 'Burger Shakshuka':
                    $steps = $this->getRecipeSteps();
                    $this->saveSteps($recipe, $steps);
                    break;
                case 'Savory Burger Waffles':
                    $steps = $this->getRecipeSteps();
                    $this->saveSteps($recipe, $steps);
                    break;
                case 'Gluten-Free Breakfast Burrito':
                    $steps = $this->getRecipeSteps();
                    $this->saveSteps($recipe, $steps);
                    break;
                case 'Patty and Greens Breakfast Plate':
                    $steps = $this->getRecipeSteps();
                    $this->saveSteps($recipe, $steps);
                    break;
            }
        }
    }

    private function steps()
    {
        return [
            'Preheat oven to 475°F (245°C).',
            'Roll out the pizza dough on a floured surface.',
            'Spread tomato sauce evenly over the dough.',
            'Tear mozzarella into pieces and distribute over the sauce.',
            'Bake for 10-12 minutes until crust is golden.',
            'Remove from oven and top with fresh basil leaves.',
            'Drizzle with olive oil and sprinkle with salt before serving.',
            'Preheat oven to 375°F (190°C).',
            'Cream together butter and sugars until smooth.',
            'Beat in eggs one at a time, then stir in vanilla.',
            'Gradually add flour, mixing well after each addition.',
            'Fold in chocolate chips.',
        ];
    }

    private function commonSteps()
    {
        $allIngredients = $this->steps();
        
        shuffle($allIngredients);
        
        $randomIngredients = array_slice($allIngredients, 0, 5);
        
        return $randomIngredients;
    }

    private function uniqueSteps()
    {
        $allIngredients = $this->steps();
        
        $commonIngredients = $this->commonSteps();
        
        $uniqueIngredients = array_filter($allIngredients, function ($ingredient) use($commonIngredients) {
            return !in_array($ingredient, $commonIngredients);
        });
        
        $uniqueIngredients = array_values($uniqueIngredients);
        
        return $uniqueIngredients;
    }

    private function getRecipeSteps()
    {
        return collect($this->commonSteps())
            ->merge($this->uniqueSteps())
            ->unique()
            ->shuffle()
            ->values()
            ->toArray();
    }

    private function saveSteps($recipe, $steps)
    {
        $recipe->steps()->createMany(
            array_map(function ($step, $index) {
                return [
                    'instruction' => $step,
                    'order' => $index + 1,
                ];
            }, $steps, array_keys($steps))
        );
    }
}