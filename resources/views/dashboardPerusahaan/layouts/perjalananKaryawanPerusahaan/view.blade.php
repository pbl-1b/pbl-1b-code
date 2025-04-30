@extends('dashboardPerusahaan.layouts.app')

@section('title', 'Company Employees Commute')

@section('content')

<div class="bg-white rounded-md shadow-sm shadow-blue-100 border border-gray-300 p-6 mb-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
        <h2 class="text-xl font-semibold text-gray-800">Perjalanan Karyawan</h2>
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
            <a href="{{ route('perjalananKaryawanPerusahaan.add') }}">
            <button 
                class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 border border-green-600"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Data
            </button>
             </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transportation</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fuel</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trip Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trip Duration (Minutes)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">TOTAL CARBON EMISSIONS (CO2e)</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th> <!-- Tambahan -->
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <template x-for="(row, index) in filteredData" :key="index">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" x-text="row.no"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.nama_karyawan"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.transportasi"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.bahan_bakar"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.alamat"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.tanggal_perjalanan"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.durasi_perjalanan"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.total_emisi_karbon"></td>
            
                        <!-- Kolom Action -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            <div class="flex justify-center gap-2">
                                <!-- Tombol Edit -->
                                <a :href="'{{ url('/dashboard/perusahaan/perjalanan/edit') }}/' + row.id" class="inline-flex items-center px-3 py-1.5 bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-medium rounded">
                                    Edit
                                </a>
            
                                <!-- Tombol Delete -->
                                <form :action="'{{ url('perjalanan-karyawan-perusahaan/delete') }}/' + row.id" method="POST" @submit.prevent="confirmDelete(row.id)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>            
        </table>
    </div>
    
    {{ $data->links('vendor.pagination.custom') }}
</div>

@endsection