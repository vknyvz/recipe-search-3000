<template>
  <div class="bg-white rounded-lg shadow-sm">
    <!-- Page Size Selector Row -->
    <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
      <div class="flex items-center justify-start">
        <div class="text-sm text-gray-700">
          <p>
            Showing
            <span class="font-medium">{{ startItem }}</span>
            to
            <span class="font-medium">{{ endItem }}</span>
            of
            <span class="font-medium">{{ pagination.total }}</span>
            results
          </p>
        </div>
        
        <div class="flex items-center gap-3">
          <label for="pageSize" class="text-sm font-medium text-gray-700 whitespace-nowrap">
            Show:
          </label>
          <select
            id="pageSize"
            :value="pagination.per_page"
            @change="handlePageSizeChange"
            class="px-3 py-1 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white"
          >
            <option v-for="size in pageSizeOptions" :key="size" :value="size">
              {{ size }} per page
            </option>
          </select>
        </div> 
      </div>

      <div class="sm:flex sm:flex-1 sm:items-center sm:justify-end">
        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
          <button
            @click="goToPrevious"
            :disabled="!hasPrevious"
            class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <span class="sr-only">Previous</span>
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
            </svg>
          </button>

          <button
            v-for="page in visiblePages"
            :key="page"
            @click="$emit('pageChange', page)"
            :class="[
              'relative inline-flex items-center px-4 py-2 text-sm font-semibold ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0',
              page === pagination.current_page
                ? 'z-10 bg-blue-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600'
                : 'text-gray-900'
            ]"
          >
            {{ page }}
          </button>

          <button
            @click="goToNext"
            :disabled="!hasNext"
            class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <span class="sr-only">Next</span>
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
            </svg>
          </button>
        </nav>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import type { PaginatedResponse } from '~/types/recipe'

interface Props {
  pagination: PaginatedResponse<any>['meta']
  pageSizeOptions?: number[]
}

const props = withDefaults(defineProps<Props>(), {
  pageSizeOptions: () => [6, 12, 24, 48, 96]
})

const emit = defineEmits<{
  pageChange: [page: number]
  pageSizeChange: [pageSize: number]
}>()

const startItem = computed(() => {
  return (props.pagination.current_page - 1) * props.pagination.per_page + 1
})

const endItem = computed(() => {
  return Math.min(
    props.pagination.current_page * props.pagination.per_page,
    props.pagination.total
  )
})

const hasPrevious = computed(() => props.pagination.current_page > 1)
const hasNext = computed(() => props.pagination.current_page < props.pagination.last_page)

const visiblePages = computed(() => {
  const current = props.pagination.current_page
  const last = props.pagination.last_page
  const pages: number[] = []

  // Always show first page
  if (current > 3) {
    pages.push(1)
    if (current > 4) pages.push(-1) // Ellipsis placeholder
  }

  // Show pages around current page
  for (let i = Math.max(1, current - 2); i <= Math.min(last, current + 2); i++) {
    pages.push(i)
  }

  // Always show last page
  if (current < last - 2) {
    if (current < last - 3) pages.push(-1) // Ellipsis placeholder
    pages.push(last)
  }

  return pages.filter(page => page !== -1) // Remove ellipsis for now, can be enhanced
})

const goToPrevious = () => {
  if (hasPrevious.value) {
    emit('pageChange', props.pagination.current_page - 1)
  }
}

const goToNext = () => {
  if (hasNext.value) {
    emit('pageChange', props.pagination.current_page + 1)
  }
}

const handlePageSizeChange = (event: Event) => {
  const target = event.target as HTMLSelectElement
  const newPageSize = Number(target.value)
  emit('pageSizeChange', newPageSize)
}
</script>