<div class="bg-white rounded-md shadow-sm shadow-blue-100 border border-gray-300 p-6 mb-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
        <h2 class="text-xl font-semibold text-gray-800">Recent Activity</h2>
        <div class="flex flex-wrap gap-2">
            <!-- Filter Dropdown -->
            <div class="relative" x-data="{ isOpen: false }">
                <button 
                    @click="isOpen = !isOpen"
                    class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-md bg-white hover:bg-gray-50"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div 
                    x-show="isOpen" 
                    @click.outside="isOpen = false"
                    x-transition
                    class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg border border-gray-300 z-10"
                    x-cloak
                >
                    <div class="px-4 py-2 border-b border-gray-100">
                        <p class="text-sm font-medium">Filter by Status</p>
                    </div>
                    <div class="p-2">
                        <div class="flex items-center px-2 py-1">
                            <input 
                                type="checkbox" 
                                id="filter-completed" 
                                class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500"
                                @click="toggleStatusFilter('Completed')"
                                :checked="statusFilter.includes('Completed')"
                            >
                            <label for="filter-completed" class="ml-2 text-sm text-gray-700">Completed</label>
                        </div>
                        <div class="flex items-center px-2 py-1">
                            <input 
                                type="checkbox" 
                                id="filter-pending" 
                                class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500"
                                @click="toggleStatusFilter('Pending')"
                                :checked="statusFilter.includes('Pending')"
                            >
                            <label for="filter-pending" class="ml-2 text-sm text-gray-700">Pending</label>
                        </div>
                        <div class="flex items-center px-2 py-1">
                            <input 
                                type="checkbox" 
                                id="filter-processing" 
                                class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500"
                                @click="toggleStatusFilter('Processing')"
                                :checked="statusFilter.includes('Processing')"
                            >
                            <label for="filter-processing" class="ml-2 text-sm text-gray-700">Processing</label>
                        </div>
                        <div class="flex items-center px-2 py-1">
                            <input 
                                type="checkbox" 
                                id="filter-cancelled" 
                                class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500"
                                @click="toggleStatusFilter('Cancelled')"
                                :checked="statusFilter.includes('Cancelled')"
                            >
                            <label for="filter-cancelled" class="ml-2 text-sm text-gray-700">Cancelled</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Data Button -->
            <button 
                @click="showAddForm = true" 
                class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 border border-green-600"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Data
            </button>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <template x-for="(row, index) in filteredData" :key="index">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" x-text="row.id"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.name"></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span 
                                class="px-2 py-1 text-xs rounded-md border"
                                :class="{
                                    'bg-green-100 text-green-700 border-green-200': row.status === 'Completed',
                                    'bg-yellow-100 text-yellow-700 border-yellow-200': row.status === 'Pending',
                                    'bg-blue-100 text-blue-700 border-blue-200': row.status === 'Processing',
                                    'bg-red-100 text-red-700 border-red-200': row.status === 'Cancelled'
                                }"
                                x-text="row.status"
                            ></span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.date"></td>
                        <td class="px-6 py  x-text="row.date"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="row.amount"></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="flex items-center justify-between mt-4 border-t border-gray-200 pt-4">
        <div class="text-sm text-gray-500">
            Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">25</span> results
        </div>
        <div class="flex gap-1">
            <button 
                class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50"
                :disabled="currentPage === 1"
                @click="currentPage = Math.max(currentPage - 1, 1)"
            >
                Previous
            </button>
            <template x-for="page in 5" :key="page">
                <button 
                    class="min-w-[40px] px-3 py-1 border rounded-md text-sm"
                    :class="currentPage === page ? 'bg-green-600 text-white border-green-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
                    @click="currentPage = page"
                    x-text="page"
                ></button>
            </template>
            <button 
                class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50"
                :disabled="currentPage === 5"
                @click="currentPage = Math.min(currentPage + 1, 5)"
            >
                Next
            </button>
        </div>
    </div>
</div>