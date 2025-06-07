@extends('dashboardStaff.layouts.app')

@section('title', 'Update Informations')

@section('content')

<div class="bg-white rounded-md shadow-sm shadow-blue-100 border border-gray-300 p-6 mb-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
        <h2 class="text-xl font-semibold text-gray-800">Update Data</h2>
        <a href="{{ route('informasi.index') }}">
            <button class="flex items-center gap-2 px-4 py-2 border border-green-500 text-green-600 rounded-md hover:bg-green-50">
                Back to Dashboard
            </button>
        </a>
    </div>

    <form id="form-id" method="POST" action="{{ route('informasi.update', ['id' => $oldData->id]) }}" enctype="multipart/form-data" class="grid grid-cols-1 gap-6 mb-4">
        @csrf
        @method('PUT')

        <!-- Information Name -->
        <div>
            <label for="information_name" class="block text-sm font-medium text-gray-700 mb-1">Information Name <span class="text-red-500">*</span></label>
            <input type="text" id="information_name" name="information_name" value="{{ old('information_name', $oldData->judul_informasi) }}" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                placeholder="Information Name" />
            @error('information_name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tag -->
        <div>
            <label for="tag" class="block text-sm font-medium text-gray-700 mb-1">Tag <span class="text-red-500">*</span></label>
            <input type="text" id="tag" name="tag" value="{{ old('tag', $oldData->tag) }}" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                placeholder="Tag (separate each tag with a comma)" />
            @error('tag')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Content -->
        <div class="md:col-span-2">
            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content <span class="text-red-500">*</span></label>
            <textarea id="content" name="content" required
                class="w-full h-48 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 resize-none"
                placeholder="Enter information contents">{{ old('content', $oldData->isi_informasi) }}</textarea>
            @error('content')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Upload Image -->
        <div x-data="{ isDragging: false, imageUrl: null, fileName: '' }" class="md:col-span-2 flex flex-col justify-start">
            <label for="gambar_informasi" class="block text-sm font-medium text-gray-700 mb-1">Information Image <span class="text-red-500">*</span></label>

            <div @dragover.prevent="isDragging = true"
                @dragleave.prevent="isDragging = false"
                @drop.prevent="isDragging = false"
                :class="{ 'border-green-500 ring-2 ring-green-200': isDragging }"
                class="flex-1 w-full px-3 py-6 border-2 border-dashed border-gray-300 rounded-md shadow-sm transition duration-200 bg-white text-center flex flex-col items-center justify-center gap-2">

                <template x-if="fileName">
                    <p class="text-sm text-green-600 font-medium" x-text="`Selected file: ${fileName}`"></p>
                </template>
                <template x-if="!fileName">
                    <img src="{{ asset('informasi_images/'.$oldData->gambar_informasi) }}" alt="Current Information Image" class="mx-auto max-h-40 mb-3 rounded-md border border-gray-300" />
                    <p class="text-sm text-gray-600">Drag & drop your image here or click to select</p>
                </template>

                <input type="file" accept="image/*" id="gambar_informasi" name="gambar_informasi"
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
            </div>

            @error('gambar_informasi')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>
    </form>

    @if (session('success'))
        <div class="mb-4 p-4 rounded-md border border-green-300 bg-green-50 text-green-800 shadow-sm flex items-start gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Form Actions -->
    <div class="flex justify-end gap-3 pt-6">
        <a href="{{ route('informasi.index') }}">
            <button type="button" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm text-gray-700 bg-white hover:bg-gray-50">
                Cancel
            </button>
        </a>
        <button type="submit" form="form-id" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 shadow-sm">
            Update Data
        </button>
    </div>
</div>

@endsection
