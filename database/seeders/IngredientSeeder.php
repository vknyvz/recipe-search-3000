<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    public function run()
    {
        $recipes = Recipe::all();

        foreach ($recipes as $recipe) {
            switch ($recipe->name) {
                case 'Classic Burger':
                    $ingredients = $this->getRecipeIngredients();
                    $this->saveIngredients($recipe, $ingredients);
                    break;
                case 'Halibut Bahn Mi Burger':
                    $ingredients = $this->getRecipeIngredients();
                    $this->saveIngredients($recipe, $ingredients);
                    break;
                case 'Mediterranean Halibut Pita Pockets':
                    $ingredients = $this->getRecipeIngredients();
                    $this->saveIngredients($recipe, $ingredients);
                    break;
                case 'Crunchy Salad Featuring Halibut':
                    $ingredients = $this->getRecipeIngredients();
                    $this->saveIngredients($recipe, $ingredients);
                    break;
                case 'Burger Melt':
                    $ingredients = $this->getRecipeIngredients();
                    $this->saveIngredients($recipe, $ingredients);
                    break;
                case 'Citrus Halibut Burger Stack with Fennel Slaw':
                    $ingredients = $this->getRecipeIngredients();
                    $this->saveIngredients($recipe, $ingredients);
                    break;
                case 'Burger Lettuce Wraps':
                    $ingredients = $this->getRecipeIngredients();
                    $this->saveIngredients($recipe, $ingredients);
                    break;
                case 'Burger Bowl':
                    $ingredients = $this->getRecipeIngredients();
                    $this->saveIngredients($recipe, $ingredients);
                    break;
                case 'Burger Benny':
                    $ingredients = $this->getRecipeIngredients();
                    $this->saveIngredients($recipe, $ingredients);
                    break;
                case 'Burger Shakshuka':
                    $ingredients = $this->getRecipeIngredients();
                    $this->saveIngredients($recipe, $ingredients);
                    break;
                case 'Savory Burger Waffles':
                    $ingredients = $this->getRecipeIngredients();
                    $this->saveIngredients($recipe, $ingredients);
                    break;
                case 'Gluten-Free Breakfast Burrito':
                    $ingredients = $this->getRecipeIngredients();
                    $this->saveIngredients($recipe, $ingredients);
                    break;
                case 'Patty and Greens Breakfast Plate':
                    $ingredients = $this->getRecipeIngredients();
                    $this->saveIngredients($recipe, $ingredients);
                    break;
            }
        }
    }

    private function ingredients() 
    {
        return [
            ['name' => 'Pizza dough', 'amount' => '1', 'unit' => 'ball'],
            ['name' => 'Tomato sauce', 'amount' => '1/2', 'unit' => 'cup'],
            ['name' => 'Fresh mozzarella', 'amount' => '8', 'unit' => 'oz'],
            ['name' => 'Fresh basil leaves', 'amount' => '10-12', 'unit' => ''],
            ['name' => 'Olive oil', 'amount' => '2', 'unit' => 'tbsp'],
            ['name' => 'Salt', 'amount' => '1/2', 'unit' => 'tsp'],
            ['name' => 'All-purpose flour', 'amount' => '2 1/4', 'unit' => 'cups'],
            ['name' => 'Butter', 'amount' => '1', 'unit' => 'cup'],
            ['name' => 'Mayonnaise', 'amount' => '3', 'unit' => 'tbsp'],
            ['name' => 'Brown sugar', 'amount' => '3/4', 'unit' => 'cup'],
            ['name' => 'White sugar', 'amount' => '3/4', 'unit' => 'cup'],
            ['name' => 'Snow peas', 'amount' => '2', 'unit' => 'large'],
            ['name' => 'Chocolate chips', 'amount' => '2', 'unit' => 'cups'],
        ];
    }

    private function commonIngredients()
    {
        $allIngredients = $this->ingredients();
        
        shuffle($allIngredients);
        
        $randomIngredients = array_slice($allIngredients, 0, 5);
        
        return $randomIngredients;
    }

    private function uniqueIngredients()
    {
        $allIngredients = $this->ingredients();
        $commonIngredients = $this->commonIngredients();
        
        $uniqueIngredients = array_filter($allIngredients, function ($ingredient) use($commonIngredients) {
            return !in_array($ingredient['name'], array_column($commonIngredients, 'name'));
        });
    
        $uniqueIngredients = array_values($uniqueIngredients);
        
        return $uniqueIngredients;
    }

    private function getRecipeIngredients()
    {
        return collect($this->commonIngredients())
            ->concat($this->uniqueIngredients())
            ->unique('name')
            ->shuffle()
            ->values()
            ->toArray();
    }

    private function saveIngredients($recipe, $ingredients)
    {
        $recipe->ingredients()->createMany(
            array_map(function ($ingredient) {
                return [
                    'name' => $ingredient['name'],
                    'amount' => $ingredient['amount'],
                    'unit' => $ingredient['unit'],
                ];
            }, $ingredients, array_keys($ingredients))
        );
    }
}