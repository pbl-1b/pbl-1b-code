@extends('dashboardPerusahaan.layouts.app')

@section('title', 'Company Employees Commute')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Company Dashboard</h1>
    <p class="text-gray-500">Welcome back, John! Here's what's happening.</p>
</div>

<div 
    class="bg-white rounded-md shadow-sm shadow-blue-100 border border-gray-300 p-6 mb-6"
    x-data="{ 
        showModal: false,
        selectedRow: {},
        confirmDelete: false,
    }"
   
>

    @if (session('success'))
    <div class="mb-4 p-4 rounded-md border border-green-300 bg-green-50 text-green-800 shadow-sm flex items-start gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
        <h2 class="text-xl font-semibold text-gray-800">Perjalanan Karyawan</h2>
        <div class="flex flex-wrap gap-2">
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trip Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trip Duration (Minutes)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">TOTAL CARBON EMISSIONS (CO2e)</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <template x-for="(row, index) in filteredData" :key="index">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" x-text="row.no"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.nama_karyawan"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.alamat"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.tanggal_perjalanan"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.durasi_perjalanan"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.total_emisi_karbon"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            <div class="flex justify-center gap-2">
                                <button 
                                    @click="selectedRow = row; showModal = true; confirmDelete = false"
                                    class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded"
                                >
                                    Detail
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    {{ $data->links('vendor.pagination.custom') }}

    <!-- Modal Detail + Delete -->
    <div 
        x-show="showModal" 
        x-transition 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        style="display: none;"
    >
        <div 
            @click.away="showModal = false; confirmDelete = false"
            class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-6 relative"
        >
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-4 border-b pb-2">
                <h3 class="text-2xl font-bold text-gray-800">Perjalanan Karyawan Detail</h3>
                <button @click="showModal = false; confirmDelete = false" class="text-gray-500 hover:text-gray-700 text-xl">
                    &times;
                </button>
            </div>

            <!-- Modal Content -->
            <div class="space-y-3 text-sm text-gray-700">
                <p><span class="font-semibold">Employee Name:</span> <span x-text="selectedRow.nama_karyawan"></span></p>
                <p><span class="font-semibold">Transportation:</span> <span x-text="selectedRow.transportasi"></span></p>
                <p><span class="font-semibold">Fuel:</span> <span x-text="selectedRow.bahan_bakar"></span></p>
                <p><span class="font-semibold">Address:</span> <span x-text="selectedRow.alamat"></span></p>
                <p><span class="font-semibold">Trip Date:</span> <span x-text="selectedRow.tanggal_perjalanan"></span></p>
                <p><span class="font-semibold">Trip Duration (Minutes):</span> <span x-text="selectedRow.durasi_perjalanan"></span></p>
                <p><span class="font-semibold">Total Carbon Emissions (CO2e):</span> <span x-text="selectedRow.total_emisi_karbon"></span></p>
            </div>

            <!-- Modal Actions -->
            <div class="flex justify-between items-center mt-6 pt-4 border-t">
                <!-- Edit Button -->
                <a 
                    :href="'{{ url('/dashboard/perusahaan/perjalanan/edit') }}/' + selectedRow.id"
                    class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-white text-sm font-semibold rounded-lg"
                >
                    Edit
                </a>

                <!-- Delete Button Group -->
                <div class="flex gap-2 items-center">
                    <!-- Confirm Prompt -->
                    <template x-if="confirmDelete">
                        <form :action="'{{ url('/dashboard/perusahaan/perjalanan') }}/' + selectedRow.id" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('DELETE')

                            <span class="text-sm text-red-500">Are you sure?</span>

                            <button 
                                type="submit"
                                class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-md"
                            >
                                Yes, Delete
                            </button>

                            <button 
                                type="button"
                                @click="confirmDelete = false"
                                class="px-3 py-1.5 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-semibold rounded-md"
                            >
                                Cancel
                            </button>
                        </form>
                    </template>

                    <!-- Trigger Delete -->
                    <template x-if="!confirmDelete">
                        <button 
                            @click="confirmDelete = true"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg"
                        >
                            Delete
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
