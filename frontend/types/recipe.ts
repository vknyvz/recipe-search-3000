export interface Recipe {
  id: number
  name: string
  description: string
  author_email: string
  slug: string
  ingredients_count: number
  steps_count: number
  created_at: string
}

export interface RecipeDetail {
  id: number
  name: string
  description: string
  ingredients: string[]
  steps: string[]
  author_email: string
  slug: string
  created_at: string
}

export interface SearchFilters {
  email?: string
  keyword?: string
  ingredient?: string
  page?: number
  per_page?: number
}

export interface PaginatedResponse<T> {
  data: T[]
  links: {
    first: string
    last: string
    prev: string | null
    next: string | null
  }
  meta: {
    current_page: number
    per_page: number
    total: number
    last_page: number
  }
}