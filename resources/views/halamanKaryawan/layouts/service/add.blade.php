@extends('dashboardStaff.layouts.app')

@section('title', 'Add Data Services')

@section('content')

<div class="bg-white rounded-md shadow-sm shadow-blue-100 border border-gray-300 p-6 mb-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
        <h2 class="text-xl font-semibold text-gray-800">Add New Data</h2>
        <a href="{{ route('service.index') }}">
            <button class="flex items-center gap-2 px-4 py-2 border border-green-500 text-green-600 rounded-md hover:bg-green-50">
                Back to Dashboard
            </button>
        </a>
    </div>

    <form id="form-id" method="POST" action="{{ route('service.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- 3 Kolom Dalam 1 Baris -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Service Name -->
            <div>
                <label for="service_name" class="block text-sm font-medium text-gray-700 mb-1">Service Name <span class="text-red-500">*</span></label>
                <input type="text" id="service_name" name="service_name" value="{{ old('service_name') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                    placeholder="Service Name" />
                @error('service_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Service Duration -->
            <div>
                <label for="service_duration" class="block text-sm font-medium text-gray-700 mb-1">Service Duration (Days) <span class="text-red-500">*</span></label>
                <input type="text" id="service_duration" name="service_duration" value="{{ old('service_duration') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                    placeholder="Service Duration (Days)" />
                @error('service_duration')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Service Price -->
            <div>
                <label for="service_price" class="block text-sm font-medium text-gray-700 mb-1">Service Price (IDR) <span class="text-red-500">*</span></label>
                <input type="number" id="service_price" name="service_price" value="{{ old('service_price') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                    placeholder="Service Price (IDR)" />
                @error('service_price')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Textarea dan Upload Gambar dalam 1 baris -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Service Description -->
            <div class="h-64">
                <label for="service_description" class="block text-sm font-medium text-gray-700 mb-1">
                    Service Description <span class="text-red-500">*</span>
                </label>
                <textarea id="service_description" name="service_description" required
                    class="w-full h-60 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 resize-none"
                    placeholder="Enter service description">{{ old('service_description') }}</textarea>
                @error('service_description')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Gambar -->
            <div x-data="{ isDragging: false, imageUrl: null, fileName: '' }" class="h-64 flex flex-col justify-start">
                <label for="service_image" class="block text-sm font-medium text-gray-700 mb-1">
                    Service Image <span class="text-red-500">*</span>
                </label>

                <div @dragover.prevent="isDragging = true"
                    @dragleave.prevent="isDragging = false"
                    @drop.prevent="isDragging = false"
                    :class="{ 'border-green-500 ring-2 ring-green-200': isDragging }"
                    class="flex-1 w-full px-3 py-6 border-2 border-dashed border-gray-300 rounded-md shadow-sm transition duration-200 bg-white text-center flex flex-col items-center justify-center gap-2">

                    <p class="text-sm text-gray-600" x-show="!fileName">Drag & drop your image here or click to select</p>
                    <p class="text-sm text-green-600 font-medium" x-show="fileName" x-text="`Selected file: ${fileName}`"></p>

                    <input type="file" accept="image/*" id="service_image" name="service_image" required
                        class="hidden"
                        @change="
                            let file = $event.target.files[0];
                            if (file) {
                                imageUrl = window.URL.createObjectURL(file);
                                fileName = file.name;
                            } else {
                                imageUrl = null;
                                fileName = '';
                            }
                        "
                        x-ref="fileInput">

                    <button type="button"
                        @click="$refs.fileInput.click()"
                        class="mt-2 px-3 py-1 text-sm bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                        Choose File
                    </button>

                    @error('service_image')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jika ingin tambah preview image bisa ditambahkan di sini -->

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
