@extends('dashboardStaff.layouts.app')

@section('title', 'Services')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Staff Dashboard</h1>
    <p class="text-gray-500">Welcome back, Staff! Here's what's happening.</p>
</div>

<div 
    class="bg-white rounded-md shadow-sm shadow-blue-100 border border-gray-300 p-6 mb-6"
    x-data="{ 
        showModal: false,
        selectedRow: {},
    }"
>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
        <h2 class="text-xl font-semibold text-gray-800">Informations</h2>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('informasi.add') }}">
                <button class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 border border-green-600">
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Information Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Publisher</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tag</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <template x-for="(row, index) in filteredData" :key="index">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" x-text="row.no"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.judul_informasi"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.nama_staff"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.tag"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            <div class="flex justify-center">
                                <button 
                                    @click="selectedRow = row; showModal = true"
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

    <!-- Modal Detail -->
    <div 
        x-show="showModal" 
        x-transition 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        style="display: none;"
    >
        <div 
            @click.away="showModal = false; confirmDelete = false"
            x-data="{ confirmDelete: false }"
            class="bg-white w-full max-w-xl max-h-[90vh] overflow-y-auto rounded-2xl shadow-2xl p-6 relative"
        >
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-4 border-b pb-3">
                <h3 class="text-xl font-bold text-gray-800">Service Detail</h3>
                <button 
                    @click="showModal = false; confirmDelete = false" 
                    class="text-gray-400 hover:text-gray-600 text-2xl font-bold focus:outline-none"
                >
                    &times;
                </button>
            </div>

            <!-- Modal Content -->
            <div class="space-y-4 text-sm text-gray-700">
                <div>
                    <span class="block font-semibold text-gray-800">Information Title:</span>
                    <span x-text="selectedRow.judul_informasi" class="block mt-1"></span>
                </div>

                <div>
                    <span class="block font-semibold text-gray-800">Publisher:</span>
                    <span x-text="selectedRow.nama_staff" class="block mt-1"></span>
                </div>

                <div>
                    <span class="block font-semibold text-gray-800">Content:</span>
                    <span x-text="selectedRow.isi_informasi" class="block mt-1 whitespace-pre-line"></span>
                </div>

                <div>
                    <span class="block font-semibold text-gray-800">Tag:</span>
                    <span x-text="selectedRow.tag" class="block mt-1"></span>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="block font-semibold text-gray-800">Created At:</span>
                        <span x-text="selectedRow.created_at" class="block mt-1"></span>
                    </div>
                    <div>
                        <span class="block font-semibold text-gray-800">Latest Update:</span>
                        <span x-text="selectedRow.updated_at" class="block mt-1"></span>
                    </div>
                </div>

                <template x-if="selectedRow.gambar_informasi">
                    <div>
                        <span class="block font-semibold text-gray-800 mb-1">Image:</span>
                        <img :src="'/informasi_images/' + selectedRow.gambar_informasi" class="w-40 h-40 object-cover rounded-lg border" alt="Image">
                    </div>
                </template>
            </div>

            <!-- Modal Actions -->
            <div class="flex justify-between items-center mt-6 pt-4 border-t">
                <!-- Edit Button -->
                <a 
                    :href="'{{ url('/dashboard/staff/informasi/edit') }}/' + selectedRow.id"
                    class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-white text-sm font-semibold rounded-md transition"
                >
                    Edit
                </a>

                <!-- Delete Button Group -->
                <div class="flex gap-2 items-center">
                    <!-- Confirm Prompt -->
                    <template x-if="confirmDelete">
                        <form 
                            :action="'{{ url('/dashboard/staff/informasi') }}/' + selectedRow.id" 
                            method="POST" 
                            class="flex items-center gap-2"
                        >
                            @csrf
                            @method('DELETE')

                            <span class="text-sm text-red-500 font-medium">Are you sure?</span>

                            <button 
                                type="submit"
                                class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-sm rounded-md transition"
                            >
                                Yes, Delete
                            </button>

                            <button 
                                type="button"
                                @click="confirmDelete = false"
                                class="px-3 py-1.5 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm rounded-md transition"
                            >
                                Cancel
                            </button>
                        </form>
                    </template>

                    <!-- Trigger Delete -->
                    <template x-if="!confirmDelete">
                        <button 
                            @click="confirmDelete = true"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-md transition"
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
