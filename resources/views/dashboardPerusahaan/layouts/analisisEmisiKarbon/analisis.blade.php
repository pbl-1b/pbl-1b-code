@extends('dashboardPerusahaan.layouts.app')

@section('title', 'Company Employees Commute')

@section('content')

<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900">Company Dashboard</h1>
    <p class="mt-1 text-gray-600">Analysis Section</p>
</div>

<div 
    class="bg-white rounded-lg shadow-md border border-gray-200 p-8 mb-8"
    x-data="{ 
        showModal: false,
        filterModal: false,
        selectedRow: {},
        confirmDelete: false,
        confirmAnalysis: false,
        showAnalysisForm: false,
        successMessage: @json(session('analisis_berhasil') ?? false),
        showSuccessModal: false
    }"
    x-init="
        if (successMessage) { 
            showSuccessModal = true;
        }
    "
>

    @if (session('success'))
    <div class="mb-6 p-4 rounded-lg border border-green-400 bg-green-50 text-green-800 flex items-center gap-3 shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h2 class="text-2xl font-semibold text-gray-900">Perjalanan Karyawan</h2>
        <div class="flex gap-3">
            <button 
                @click="confirmAnalysis = true"
                class="inline-flex items-center gap-2 px-5 py-2 bg-[#39AA80] text-white rounded-md hover:bg-[#207e5b] border border-[#39AA80] transition"
            >
                Analysis
            </button>

            <button @click="filterModal = true" class="inline-flex items-center gap-2 px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 border border-blue-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-6.414 6.414A1 1 0 0014 13v4a1 1 0 01-1.447.894l-4-2A1 1 0 018 15V13a1 1 0 00-.293-.707L1.293 6.707A1 1 0 011 6V4z" />
                </svg>
                Filter
            </button>
        </div>
    </div>

    <div x-show="filteredData.length === 0" class="text-center text-gray-500 py-12 text-lg font-medium">
        No data have been founded
    </div>

    <div x-show="filteredData.length > 0" class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Employee Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Address</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Trip Date</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Trip Duration (Minutes)</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 tracking-wider">TOTAL CARBON EMISSIONS (CO2e)</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <template x-for="(row, index) in filteredData" :key="index">
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" x-text="row.no"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" x-text="row.nama_karyawan"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" x-text="row.alamat"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" x-text="row.tanggal_perjalanan"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" x-text="row.durasi_perjalanan"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" x-text="row.total_emisi_karbon"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 text-center">
                            <button 
                                @click="selectedRow = row; showModal = true; confirmDelete = false"
                                class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-md transition"
                            >
                                Detail
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $data->links('vendor.pagination.custom') }}
    </div>

    {{-- Modal Detail --}}
    <div 
        x-show="showModal" 
        x-transition 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        style="display: none;"
    >
        <div 
            @click.away="showModal = false; confirmDelete = false"
            class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-8 relative"
        >
            <div class="flex justify-between items-center mb-6 border-b border-gray-200 pb-3">
                <h3 class="text-3xl font-bold text-gray-900">Perjalanan Karyawan Detail</h3>
                <button @click="showModal = false; confirmDelete = false" class="text-gray-500 hover:text-gray-700 text-3xl leading-none font-semibold">
                    &times;
                </button>
            </div>
            <div class="space-y-4 text-gray-700 text-base">
                <p><span class="font-semibold">Employee Name:</span> <span x-text="selectedRow.nama_karyawan"></span></p>
                <p><span class="font-semibold">Transportation:</span> <span x-text="selectedRow.transportasi"></span></p>
                <p><span class="font-semibold">Fuel:</span> <span x-text="selectedRow.bahan_bakar"></span></p>
                <p><span class="font-semibold">Address:</span> <span x-text="selectedRow.alamat"></span></p>
                <p><span class="font-semibold">Trip Date:</span> <span x-text="selectedRow.tanggal_perjalanan"></span></p>
                <p><span class="font-semibold">Trip Duration (Minutes):</span> <span x-text="selectedRow.durasi_perjalanan"></span></p>
                <p><span class="font-semibold">Total Carbon Emissions (CO2e):</span> <span x-text="selectedRow.total_emisi_karbon"></span></p>
            </div>
        </div>
    </div>

    {{-- Modal Filter --}}
    <div 
        x-show="filterModal" 
        x-transition 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        style="display: none;"
    >
        <div @click.away="filterModal = false" class="bg-white w-full max-w-2xl rounded-2xl shadow-xl p-8 relative">
            <div class="flex justify-between items-center mb-6 border-b border-gray-200 pb-3">
                <h3 class="text-2xl font-semibold text-gray-900">Filter Data</h3>
                <button @click="filterModal = false" class="text-gray-500 hover:text-gray-700 text-2xl leading-none font-semibold">&times;</button>
            </div>

            <form method="GET" action="{{ route('analisis.viewAnalisis') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <input type="text" name="nama_karyawan" placeholder="Nama Karyawan" value="{{ request('nama_karyawan') }}" class="w-full rounded-md border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                <input type="text" name="nama_transportasi" placeholder="Transportasi" value="{{ request('nama_transportasi') }}" class="w-full rounded-md border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                <input type="text" name="nama_bahan_bakar" placeholder="Bahan Bakar" value="{{ request('nama_bahan_bakar') }}" class="w-full rounded-md border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                <input type="date" name="tanggal_perjalanan" value="{{ request('tanggal_perjalanan') }}" class="w-full rounded-md border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">

                <div class="sm:col-span-2 flex justify-end gap-3 mt-4">
                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition">Set Filter</button>
                    <a href="{{ route('analisis.viewAnalisis') }}" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md transition">Reset</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Konfirmasi Analysis --}}
    <div 
        x-show="confirmAnalysis" 
        x-transition 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        style="display: none;"
    >
        <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6 relative" @click.away="confirmAnalysis = false">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Confirm Analysis</h3>
            <p class="text-gray-600 mb-6">Are you sure you want to continue the carbon analysis process?</p>
            <div class="flex justify-end gap-3">
                <button 
                    @click="confirmAnalysis = false" 
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition"
                >Cancel</button>

                <button 
                    @click="confirmAnalysis = false; showAnalysisForm = true" 
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition"
                >Confirm</button>
            </div>
        </div>
    </div>

    {{-- Modal Input Nama Analisis --}}
    <div 
        x-show="showAnalysisForm" 
        x-transition 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        style="display: none;"
    >
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-6 relative" @click.away="showAnalysisForm = false">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Input Analysis Name</h3>
            <form method="GET" action="{{ route('analisis.analisis') }}" class="space-y-4">
                @csrf
                <input 
                    type="text" 
                    name="nama_analisis" 
                    placeholder="Enter Analysis Name" 
                    required
                    class="w-full rounded-md border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none"
                >

                <input type="hidden" name="nama_karyawan" value="{{ request('nama_karyawan') }}">
                <input type="hidden" name="nama_transportasi" value="{{ request('nama_transportasi') }}">
                <input type="hidden" name="nama_bahan_bakar" value="{{ request('nama_bahan_bakar') }}">
                <input type="hidden" name="tanggal_perjalanan" value="{{ request('tanggal_perjalanan') }}">

                <div class="flex justify-end gap-3">
                    <button 
                        type="button" 
                        @click="showAnalysisForm = false"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition"
                    >Cancel</button>

                    <button 
                        type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition"
                    >Submit Analysis</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Notifikasi Berhasil --}}
    <div 
        x-show="showSuccessModal" 
        x-transition 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        style="display: none;"
    >
        <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6 relative" @click.away="showSuccessModal = false">
            <div class="flex items-center gap-3 mb-4">
                <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <h3 class="text-xl font-bold text-gray-800">Analysis Successful</h3>
            </div>
            <p class="text-gray-600 mb-6">The carbon emission analysis has been completed successfully.</p>
            <div class="flex justify-end gap-3">
                <button 
                    @click="showSuccessModal = false" 
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition"
                >
                    OK
                </button>
                <a 
                    href="{{ route('analisis.index') }}" 
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition"
                >
                    Show Result
                </a>
            </div>
        </div>
    </div>

</div>




<script>
    function init() {
        return {
            // Data from backend (pass via props or ajax if needed)
            filteredData: @json($data->items()),

            // State managed by Alpine.js
            showModal: false,
            filterModal: false,
            selectedRow: {},
            confirmDelete: false,
            confirmAnalysis: false,
            showAnalysisForm: false,
            successMessage: @json(session('analisis_berhasil') ?? false),

            // Filter logic could be here if using Alpine filtering on frontend
        }
    }
</script>

@endsection
