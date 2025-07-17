<template>
  <div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Recipe Search 3000</h1>
        <p class="text-gray-600">Find delicious recipes by ingredients, keywords, or author</p>
      </div>

      <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <form @submit.prevent="handleSearch" class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                Author Email
              </label>
              <input
                id="email"
                v-model="filters.email"
                type="email"
                placeholder="exact match"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              >
            </div>
            
            <div>
              <label for="keyword" class="block text-sm font-medium text-gray-700 mb-2">
                Keyword
              </label>
              <input
                id="keyword"
                v-model="filters.keyword"
                type="text"
                placeholder="should match ANY of these fields: name, description, ingredients, or steps"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              >
            </div>
            
            <div>
              <label for="ingredient" class="block text-sm font-medium text-gray-700 mb-2">
                Ingredient
              </label>
              <input
                id="ingredient"
                v-model="filters.ingredient"
                type="text"
                placeholder="partial match from ingredients list"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              >
            </div>
          </div>
          
          <div class="flex gap-3 justify-end">
            <button
              type="submit"
              :disabled="loading"
              class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50"
            >
              {{ loading ? 'Searching...' : 'Search Recipes' }}
            </button>
            
            <button
              type="button"
              @click="resetFilters"
              class="bg-gray-300 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500"
            >
              Clear
            </button>
          </div>
        </form>
      </div>

      <div v-if="!loading || recipes.length > 0 || pagination" class="bg-white rounded-lg shadow-sm p-4 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div class="text-sm text-gray-600">
            <span v-if="pagination && pagination.total > 0">
              Showing {{ startItem }} to {{ endItem }} of {{ pagination.total }} recipes
            </span>
            <span v-else-if="!loading && recipes.length === 0">
              No recipes found
            </span>
            <span v-else-if="loading">
              Searching...
            </span>
          </div>
          
          <div class="flex items-center gap-3">
            <label for="mainPageSize" class="text-sm font-medium text-gray-700 whitespace-nowrap">
              Show:
            </label>
            <select
              id="mainPageSize"
              v-model="filters.per_page"
              @change="handlePageSizeChange(filters.per_page)"
              class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white min-w-[120px]"
            >
              <option v-for="size in pageSizeOptions" :key="size" :value="size">
                {{ size }} per page
              </option>
            </select>
          </div>
        </div>
      </div>

      <div v-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        {{ error }}
      </div>

      <div v-if="loading" class="text-center py-12">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
        <p class="mt-2 text-gray-600">Searching recipes...</p>
      </div>

      <div v-else-if="recipes.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <RecipeCard 
          v-for="recipe in recipes" 
          :key="recipe.id" 
          :recipe="recipe" 
        />
      </div>

      <div v-else-if="!loading" class="text-center py-12">
        <div class="text-gray-400 mb-4">
          <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No recipes found</h3>
        <p class="text-gray-500">Try adjusting your search criteria or browse all recipes by clearing the filters.</p>
      </div>
      
      <RecipePagination 
        v-if="pagination && pagination.total > 0"
        :pagination="pagination"
        :page-size-options="pageSizeOptions"
        @page-change="goToPage"
        @page-size-change="handlePageSizeChange"
      />
    </div>
  </div>
</template>

<script setup>
import RecipeCard from './RecipeCard';
import RecipePagination from '@components/RecipePagination';

const { 
  filters, 
  recipes, 
  pagination, 
  loading, 
  error, 
  initializeFilters, 
  search, 
  goToPage, 
  resetFilters,
  handlePageSizeChange
} = useRecipeSearch()

const pageSizeOptions = [5, 10, 20, 50, 100]

const startItem = computed(() => {
  if (!pagination.value || pagination.value.total === 0) return 0
  return (pagination.value.current_page - 1) * pagination.value.per_page + 1
})

const endItem = computed(() => {
  if (!pagination.value) return 0
  return Math.min(
    pagination.value.current_page * pagination.value.per_page,
    pagination.value.total
  )
})

const handleSearch = () => {
  filters.value.page = 1 // Reset to first page on new search
  search();
}

onMounted(() => {
  initializeFilters()
  search()
})

watch(() => useRoute().query, () => {
  initializeFilters()
  search()
})
</script>