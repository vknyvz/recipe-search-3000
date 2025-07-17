import type { Recipe, RecipeDetail, SearchFilters, PaginatedResponse } from '~/types/recipe'

export const useRecipeApi = () => {
  const config = useRuntimeConfig()
  const baseURL = config.public.apiBase

  const searchRecipes = async (filters: SearchFilters): Promise<PaginatedResponse<Recipe>> => {
    const query = new URLSearchParams()
    
    Object.entries(filters).forEach(([key, value]) => {
      if (value !== undefined && value !== '') {
        query.append(key, value.toString())
      }
    })

    const response = await $fetch<PaginatedResponse<Recipe>>(`${baseURL}/recipes?${query}`)
    return response
  }

  const getRecipe = async (slug: string): Promise<RecipeDetail> => {
    const response = await $fetch<{ data: RecipeDetail }>(`${baseURL}/recipes/${slug}`)
    return response.data
  }

  return {
    searchRecipes,
    getRecipe
  }
}