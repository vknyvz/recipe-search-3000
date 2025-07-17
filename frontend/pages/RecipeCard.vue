<template>
  <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
    <div class="p-6">
      <h3 class="text-xl font-semibold text-gray-900 mb-2">
        <NuxtLink 
          :to="`/recipes/${recipe.slug}`"
          class="hover:text-blue-600 transition-colors"
        >
          {{ recipe.name }} <span class="text-xs text-gray-500">ID: {{ recipe.id }}</span>
        </NuxtLink>
      </h3>
      
      <p class="text-gray-600 mb-4 shorter-text">{{ recipe.description }}</p>
      
      <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
        <span>By: {{ recipe.author_email }}</span>
        <span>{{ recipe.created_at }}</span>
      </div>
      
      <div class="flex items-center gap-4 text-sm text-gray-600">
        <div class="flex items-center gap-1">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
          </svg>
          <span>{{ recipe.ingredients_count }} ingredients</span>
        </div>
        
        <div class="flex items-center gap-1">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
          <span>{{ recipe.steps_count }} steps</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { toRefs } from 'vue'
import type { Recipe } from '~/types/recipe'

const props = defineProps<{
  recipe: Recipe
}>()

const { recipe } = toRefs(props);
</script>