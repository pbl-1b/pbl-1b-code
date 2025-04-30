<div class="bg-white rounded-md shadow-sm shadow-blue-100 border border-gray-300 p-6 mb-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
        <h2 class="text-xl font-semibold text-gray-800">Company Carbon Overview</h2>
        <div class="flex gap-2">
            <button 
                @click="chartPeriod = 'day'; drawChart()" 
                class="px-3 py-1 text-sm rounded-md border"
                :class="chartPeriod === 'day' ? 'bg-green-600 text-white border-green-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
            >
                Day
            </button>
            <button 
                @click="chartPeriod = 'week'; drawChart()" 
                class="px-3 py-1 text-sm rounded-md border"
                :class="chartPeriod === 'week' ? 'bg-green-600 text-white border-green-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
            >
                Week
            </button>
            <button 
                @click="chartPeriod = 'month'; drawChart()" 
                class="px-3 py-1 text-sm rounded-md border"
                :class="chartPeriod === 'month' ? 'bg-green-600 text-white border-green-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
            >
                Month
            </button>
            <button 
                @click="chartPeriod = 'year'; drawChart()" 
                class="px-3 py-1 text-sm rounded-md border"
                :class="chartPeriod === 'year' ? 'bg-green-600 text-white border-green-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
            >
                Year
            </button>
        </div>
    </div>
    <div class="w-full h-80 relative">
        <canvas x-ref="chartCanvas" class="w-full h-full"></canvas>
        <div class="absolute top-2 left-2 flex items-center gap-2 text-sm text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
            </svg>
            <span>Carbon Emissions</span>
        </div>
    </div>
</div>