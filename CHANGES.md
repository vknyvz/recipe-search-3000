## Added/Modified Files;

###

[![Index Thumbnail](https://github.com/vknyvz/recipe-search-3000/index.png?raw=true)](https://github.com/vknyvz/recipe-search-3000/index.png)

[![Detail Thumbnail](https://github.com/vknyvz/recipe-search-3000/detail.png?raw=true)](https://github.com/vknyvz/recipe-search-3000/detail.png)


### Pre-requisites
app
	/Console/Commands/CreateRecipeCommand.php
	/Http/RecipeController.php
	/Requests
		/CreateRecipeRequest.php
		/RecipeSearchRequest.php
	/Resources
		/RecipeDetailResource.php
		/RecipeSource.php
	/Models
		/Ingredient.php
		/Recipe.php
		/Step.php
	/Services
		/RecipeCreationService.php
		/RecipeSearchService.php

database
	/factories/RecipeFactory.php
	/migrations/2025_07_16_215932_create_table_recipes.php
	/migrations/2025_07_16_215932_create_ingredients_table.php
	/migrations/2025_07_16_215932_create_steps_table.php

seeders
	/IngredientSeeder.php
	/RecipeSeeder.php
	/StepSeeder.php

frontend
	/assets/css/main.css
	/components
		/RecipePagination.vue
	/composables
		/useRecipeApi.ts
		/useRecipeSearch.ts
	/pages
		/recipes
			[slug].vue
		/index.vue
		/RecipeCard.vue
	nuxt.config.ts

/tests (15 assertions should succeed)
	/Feature/RecipeSearchTest.php
