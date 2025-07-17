<template>
  <div class="min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <button 
        @click="$router.back()"
        class="mb-6 flex items-center gap-2 text-blue-600 hover:text-blue-800 transition-colors"
      >
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L4.414 9H17a1 1 0 110 2H4.414l5.293 5.293a1 1 0 010 1.414z" clip-rule="evenodd" />
        </svg>
        Back to Recipes
      </button>

      <div v-if="pending" class="text-center py-12">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
        <p class="mt-2 text-gray-600">Loading recipe...</p>
      </div>

      <div v-else-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        Recipe not found or failed to load.
      </div>

      <div v-else-if="recipe" class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-8 border-b border-gray-200">
          <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ recipe.name }}</h1>
          <p class="text-gray-600 text-lg mb-4">{{ recipe.description }}</p>
          <div class="flex items-center gap-4 text-sm text-gray-500">
            <span>By: {{ recipe.author_email }}</span>
            <span>•</span>
            <span>Created: {{ formatDate(recipe.created_at) }}</span>
          </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
          <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center gap-2">
              <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
              </svg>
              Ingredients
            </h2>
            <ul class="space-y-2">
              <li 
                v-for="(ingredient, index) in recipe.ingredients" 
                :key="index"
                class="flex items-start gap-3 p-3 rounded-lg bg-gray-50"
              >
                <span class="w-2 h-2 bg-green-500 rounded-full mt-2 flex-shrink-0"></span>
                <span class="text-gray-700 text-sm">{{ ingredient }}</span>
              </li>
            </ul>
          </div>

          <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center gap-2">
              <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
              Instructions
            </h2>
            <ol class="space-y-4">
              <li 
                v-for="(step, index) in recipe.steps" 
                :key="index"
                class="flex gap-4 p-4 rounded-lg bg-gray-50 text-sm"
              >
                <span class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-semibold">
                  {{ index + 1 }}
                </span>
                <span class="text-gray-700 leading-relaxed">{{ step }}</span>
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import type { RecipeDetail } from '~/types/recipe'

const route = useRoute()
const { getRecipe } = useRecipeApi()

const { data: recipe, pending, error } = await useLazyAsyncData(
  `recipe-${route.params.slug}`,
  () => getRecipe(route.params.slug as string)
)

const formatDate = (dateString: string) => {
  return new Date(dateString).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })
}

// SEO
useSeoMeta({
  title: () => recipe.value ? `${recipe.value.name} - Recipe Search` : 'Recipe Not Found',
  description: () => recipe.value?.description || 'Recipe not found'
})
</script>