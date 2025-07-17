import type { SearchFilters, Recipe, PaginatedResponse } from '~/types/recipe'

export const useRecipeSearch = () => {
  const route = useRoute()
  const router = useRouter()
  const { searchRecipes } = useRecipeApi()

  const filters = ref<SearchFilters>({
    email: '',
    keyword: '',
    ingredient: '',
    page: 1,
    per_page: 5
  })

  const recipes = ref<Recipe[]>([])
  const pagination = ref<PaginatedResponse<Recipe>['meta'] | null>(null)
  const loading = ref(false)
  const error = ref<string | null>(null)

  // Initialize filters from URL query parameters
  const initializeFilters = () => {
    filters.value = {
      email: route.query.email as string || '',
      keyword: route.query.keyword as string || '',
      ingredient: route.query.ingredient as string || '',
      page: Number(route.query.page) || 1,
      per_page: Number(route.query.per_page) || 5
    }
  }

  const updateURL = () => {
    const query: Record<string, string> = {}
    
    Object.entries(filters.value).forEach(([key, value]) => {
      if (value && value !== '') {
        query[key] = value.toString()
      }
    })

    router.push({ query })
  }

  const search = async () => {
    loading.value = true
    error.value = null
    
    try {
      const response = await searchRecipes(filters.value)
    
      recipes.value = response.data
      pagination.value = response.meta
      updateURL();
    } catch (err) {
      error.value = 'Failed to search recipes'
      console.error(err)
    } finally {
      loading.value = false
    }
  }

  const goToPage = (page: number) => {
    filters.value.page = page
    search()
  }

  const resetFilters = () => {
    filters.value = {
      email: '',
      keyword: '',
      ingredient: '',
      page: 1,
      per_page: 5
    }
    search()
  }

  const handlePageSizeChange = (newPageSize: number) => {
    filters.value.per_page = newPageSize
    filters.value.page = 1
    search()
  }

  return {
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
  }
}