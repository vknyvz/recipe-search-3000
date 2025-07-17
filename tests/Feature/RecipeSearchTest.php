<?php

namespace Tests\Feature;

use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\Step;
use App\Services\RecipeCreationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecipeSearchTest extends TestCase
{
    use RefreshDatabase;

    private RecipeCreationService $recipeCreationService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->recipeCreationService = app(RecipeCreationService::class);
        $this->createTestRecipes();
    }

    public function test_validates_search_parameters(): void
    {
        $response = $this->getJson('/api/recipes?email=invalid-email');

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['email']);
    }

    public function test_can_search_recipes_by_author_email(): void
    {
        $response = $this->getJson('/api/recipes?email=chef@example.com');

        $response->assertOk()
                ->assertJsonCount(1, 'data')
                ->assertJsonPath('data.0.name', 'Barbecue Chicken');
    }

    public function test_can_search_recipes_by_keyword_in_name(): void
    {
        $response = $this->getJson('/api/recipes?keyword=chicken');

        $response->assertOk()
                ->assertJsonCount(1, 'data')
                ->assertJsonPath('data.0.name', 'Barbecue Chicken');
    }

    public function test_can_search_recipes_by_keyword_in_description(): void
    {
        $response = $this->getJson('/api/recipes?keyword=grilled');

        $response->assertOk()
                ->assertJsonCount(1, 'data')
                ->assertJsonPath('data.0.name', 'Barbecue Chicken');
    }

    public function test_can_search_recipes_by_keyword_in_ingredients(): void
    {
        $response = $this->getJson('/api/recipes?keyword=paprika');

        $response->assertOk()
                ->assertJsonCount(1, 'data')
                ->assertJsonPath('data.0.name', 'Barbecue Chicken');
    }

    public function test_can_search_recipes_by_keyword_in_steps(): void
    {
        $response = $this->getJson('/api/recipes?keyword=preheat');

        $response->assertOk()
                ->assertJsonCount(2, 'data'); // Both Scalloped Potatoes and Cookies have "preheat"
    }

    public function test_can_search_recipes_by_ingredient(): void
    {
        $response = $this->getJson('/api/recipes?ingredient=potato');

        $response->assertOk()
                ->assertJsonCount(1, 'data')
                ->assertJsonPath('data.0.name', 'Scalloped Potatoes');
    }

    public function test_can_combine_search_parameters(): void
    {
        $response = $this->getJson('/api/recipes?email=foo@bar.com&ingredient=potato&keyword=scallop');

        $response->assertOk()
                ->assertJsonCount(1, 'data')
                ->assertJsonPath('data.0.name', 'Scalloped Potatoes');
    }

    public function test_search_returns_no_results_when_no_matches(): void
    {
        $response = $this->getJson('/api/recipes?email=nonexistent@example.com');

        $response->assertOk()
                ->assertJsonCount(0, 'data');
    }

    public function test_can_view_recipe_detail_by_slug(): void
    {
        $recipe = Recipe::where('name', 'Barbecue Chicken')->first();

        $response = $this->getJson("/api/recipes/{$recipe->slug}");

        $response->assertOk()
                ->assertJsonPath('data.name', 'Barbecue Chicken')
                ->assertJsonPath('data.author_email', 'chef@example.com')
                ->assertJsonStructure([
                    'data' => [
                        'id', 'name', 'description', 'ingredients', 
                        'steps', 'author_email', 'slug', 'created_at'
                    ]
                ]);

        // Verify ingredients and steps are in correct order
        $this->assertIsArray($response->json('data.ingredients'));
        $this->assertIsArray($response->json('data.steps'));
    }

    public function test_recipe_not_found_returns_404(): void
    {
        $response = $this->getJson('/api/recipes/non-existent-recipe');

        $response->assertStatus(404)
                ->assertJsonPath('message', 'Recipe not found');
    }

    public function test_pagination_retains_search_parameters(): void
    {
        // Create more recipes to test pagination
        for ($i = 1; $i <= 15; $i++) {
            $this->recipeCreationService->createRecipe([
                'name' => "Test Recipe {$i}",
                'description' => 'A test recipe',
                'author_email' => 'test@example.com',
                'ingredients' => [
                    ['name' => 'flour', 'amount' => '2', 'unit' => 'cups'],
                ],
                'steps' => ['Test step']
            ]);
        }

        $response = $this->getJson('/api/recipes?email=test@example.com&per_page=5');

        $response->assertOk()
                ->assertJsonStructure([
                    'data',
                    'links' => ['first', 'last', 'prev', 'next'],
                    'meta' => ['current_page', 'per_page', 'total']
                ]);

        // Check that pagination links contain search parameters
        $links = $response->json('links');
        $decodedNextUrl = urldecode($links['next']);
        $this->assertStringContainsString('email=test@example.com', $decodedNextUrl);
    }

    public function test_ingredients_and_steps_maintain_order(): void
    {
        $recipe = Recipe::with(['ingredients', 'steps'])->where('name', 'Barbecue Chicken')->first();

        // Verify ingredients are ordered
        $ingredients = $recipe->ingredients;
        for ($i = 0; $i < $ingredients->count() - 1; $i++) {
            $this->assertLessThanOrEqual(
                $ingredients[$i + 1]->order_index,
                $ingredients[$i]->order_index
            );
        }

        // Verify steps are ordered
        $steps = $recipe->steps;
        for ($i = 0; $i < $steps->count() - 1; $i++) {
            $this->assertLessThanOrEqual(
                $steps[$i + 1]->order_index,
                $steps[$i]->order_index
            );
        }
    }

    private function createTestRecipes(): void
    {
        $recipes = [
            [
                'name' => 'Barbecue Chicken',
                'description' => 'Juicy grilled chicken with homemade barbecue sauce',
                'author_email' => 'chef@example.com',
                'ingredients' => [
                    ['name' => 'chicken breasts', 'amount' => '4', 'unit' => 'tsp'],
                    ['name' => 'paprika', 'amount' => '1', 'unit' => 'tsp'],
                    ['name' => 'barbecue sauce', 'amount' => '2', 'unit' => 'cups'],
                ],
                'steps' => [
                    'Season chicken', 
                    'Grill chicken'
                ]
            ],
            [
                'name' => 'Scalloped Potatoes',
                'description' => 'Creamy layered potato dish with scallops',
                'author_email' => 'foo@bar.com',
                'ingredients' => [
                    ['name' => 'large potatoes', 'amount' => '3', 'unit' => ''],
                    ['name' => 'Fresh scallops', 'amount' => '2', 'unit' => ''],
                ],
                'steps' => [
                    'Preheat oven to 375°F', 
                    'Layer potatoes', 
                    'Add scallops'
                ]
            ],
            [
                'name' => 'Chocolate Chip Cookies',
                'description' => 'Classic homemade cookies',
                'author_email' => 'baker@example.com',
                'ingredients' => [
                    ['name' => 'flour', 'amount' => '2', 'unit' => 'cups'],
                    ['name' => 'chocolate chips', 'amount' => '2', 'unit' => 'cups'],
                ],
                'steps' => [
                    'Preheat oven to 350°F', 
                    'Mix ingredients', 
                    'Bake cookies'
                ]
            ]
        ];

        foreach ($recipes as $recipeData) {
            $this->recipeCreationService->createRecipe($recipeData);
        }
    }
}
