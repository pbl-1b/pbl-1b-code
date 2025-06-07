@extends('dashboardStaff.layouts.app')

@section('title', 'Add Data Fuels')

@section('content')

<div class="bg-white rounded-md shadow-sm shadow-blue-100 border border-gray-300 p-6 mb-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
        <h2 class="text-xl font-semibold text-gray-800">Add New Data</h2>
        <a href="{{ route('bahanBakar.index') }}">
            <button class="flex items-center gap-2 px-4 py-2 border border-green-500 text-green-600 rounded-md hover:bg-green-50">
                Back to Dashboard
            </button>
        </a>
    </div>

    <form id="form-id" method="POST" action="{{ route('bahanBakar.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- 3 Kolom Dalam 1 Baris -->
        <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mb-6">

            <!-- Fuel Name -->
            <div>
                <label for="fuel_name" class="block text-sm font-medium text-gray-700 mb-1">Fuel Name <span class="text-red-500">*</span></label>
                <input type="text" id="fuel_name" name="fuel_name" value="{{ old('fuel_name') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                    placeholder="Fuel Name" />
                @error('fuel_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Emission -->
            <div>
                <label for="emission" class="block text-sm font-medium text-gray-700 mb-1">Emission per-Minute<span class="text-red-500">*</span></label>
                <input type="text" id="emission" name="emission" value="{{ old('emission') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                    placeholder="Emission per-Minute" />
                @error('emission')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Cost -->
            <div>
                <label for="cost" class="block text-sm font-medium text-gray-700 mb-1">Cost per-Liter<span class="text-red-500">*</span></label>
                <input type="text" id="cost" name="cost" value="{{ old('cost') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                    placeholder="Cost per-Liter" />
                @error('cost')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="mb-4 p-4 rounded-md border border-green-300 bg-green-50 text-green-800 shadow-sm flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Tombol Aksi -->
        <div class="flex justify-end gap-3 pt-6">
            <a href="{{ route('perjalananKaryawanPerusahaan.index') }}">
                <button type="button" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm text-gray-700 bg-white hover:bg-gray-50">
                    Cancel
                </button>
            </a>
            <button type="submit" form="form-id" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 shadow-sm">
                Add Data
            </button>
        </div>
    </form>
</div>

@endsection
