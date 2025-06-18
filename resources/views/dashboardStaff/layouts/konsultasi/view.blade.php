@extends('dashboardStaff.layouts.app')

@section('title', 'Consultations')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Staff Dashboard</h1>
    <p class="text-gray-500">Welcome back, John! Here's what's happening.</p>
</div>

<div 
    class="bg-white rounded-md shadow-sm shadow-blue-100 border border-gray-300 p-6 mb-6"
    x-data="{ 
        showModal: false,
        selectedRow: {},
        confirmDelete: false,
        showReplyModal: false,
        pdfModal: false,
        selectedFileName: '',
        successModal: {{ json_encode(session('success') ? true : false) }},
    }"
    x-init="if (successModal) { setTimeout(() => successModal = false, 4000) }"
>


    {{-- @if (session('success'))
    <div class="mb-4 p-4 rounded-md border border-green-300 bg-green-50 text-green-800 shadow-sm flex items-start gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif --}}

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Consultation Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Consulation Date</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <template x-for="(row, index) in filteredData" :key="index">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" x-text="row.no"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.nama_perusahaan"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.nama_konsultasi"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.tanggal_konsultasi"></td>
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
            @click.stop
        >
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-4 border-b pb-2">
                <h3 class="text-2xl font-bold text-gray-800">Perjalanan Karyawan Detail</h3>
                <button @click="showModal = false; confirmDelete = false" class="text-gray-500 hover:text-gray-700 text-xl">
                    &times;
                </button>
            </div>

            <!-- Modal Content -->
            <div class="space-y-4 text-sm text-gray-700">
                <div>
                    <p class="font-semibold text-gray-900">Company Name:</p>
                    <p class="ml-2 text-gray-700" x-text="selectedRow.nama_perusahaan"></p>
                </div>

                <div>
                    <p class="font-semibold text-gray-900">Consultation Title:</p>
                    <p class="ml-2 text-gray-700" x-text="selectedRow.nama_konsultasi"></p>
                </div>

                <div>
                    <p class="font-semibold text-gray-900">Consultation Date:</p>
                    <p class="ml-2 text-gray-700" x-text="selectedRow.tanggal_konsultasi"></p>
                </div>

                <div>
                    <p class="font-semibold text-gray-900">Content:</p>
                    <p class="ml-2 text-gray-700 whitespace-pre-line" x-text="selectedRow.isi_konsultasi"></p>
                </div>

                <div>
                    <p class="font-semibold text-gray-900">Status:</p>
                    <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium"
                        :class="selectedRow.status_konsultasi === 'OPEN' 
                                ? 'bg-green-100 text-green-800' 
                                : 'bg-red-100 text-red-800'"
                        x-text="selectedRow.status_konsultasi">
                    </span>
                </div>
            </div>

            <!-- Modal Actions -->
            <div class="flex justify-between items-center mt-6 pt-4 border-t">
                <!-- View PDF Button -->
                <button 
                    @click="pdfModal = true"
                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg"
                >
                    View PDF
                </button>

                <!-- Reply Button -->
                <button 
                    @click="showModal = false; showReplyModal = true"
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg"
                >
                    Reply the Consultation
                </button>

            </div>
        </div>
    </div>

    <!-- Modal Reply -->
    <div 
        x-show="showReplyModal" 
        x-transition 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        style="display: none;"
    >
        <div 
            @click.away="showReplyModal = false"
            class="bg-white w-full max-w-xl rounded-xl shadow-lg p-6 relative space-y-4"
            @click.stop
        >
            <!-- Header -->
            <div class="flex justify-between items-center border-b pb-3 mb-3">
                <h3 class="text-lg font-semibold text-gray-800">Reply the Consultation</h3>
                <button @click="showReplyModal = false" class="text-gray-600 hover:text-red-500 text-xl">
                    &times;
                </button>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('staff.konsultasi.upload') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="consultation_id" :value="selectedRow.id">

                <div>
                    <label class="block text-sm font-medium text-gray-700">Title Message</label>
                    <input required type="text" name="title" required class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300 text-sm" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea required name="message" rows="4" required class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300 text-sm"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Attach File</label>
                    <div class="mt-1 flex items-center gap-3">
                        <label class="flex items-center px-3 py-2 bg-blue-600 text-white rounded-md cursor-pointer hover:bg-blue-700 text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Choose File
                            <input 
                                type="file" 
                                name="file" 
                                class="hidden"
                                @change="selectedFileName = $event.target.files[0]?.name || ''"
                            />
                        </label>
                        <span class="text-xs text-gray-500" x-text="selectedFileName || 'PDF, DOCX, JPG up to 5MB'"></span>
                    </div>
                </div>

                <div class="pt-3 border-t flex justify-between">
                    <button 
                        type="button" 
                        @click="showReplyModal = false; showModal = true" 
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-sm font-medium"
                    >
                        Back
                    </button>

                    <button 
                        type="submit" 
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium"
                    >
                        Send Reply
                    </button>
                </div>

            </form>
        </div>
    </div>


    <!-- Modal PDF Viewer -->
    <div 
        x-show="pdfModal" 
        x-transition 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60"
        style="display: none;"
    >
        <div 
            class="bg-white w-full max-w-4xl h-[90vh] rounded-xl shadow-xl relative overflow-hidden flex flex-col"
            @click.away="pdfModal = false"
        >
            <!-- Header -->
            <div class="flex justify-between items-center p-4 border-b bg-gray-100">
                <h2 class="text-xl font-semibold text-gray-700">View Analysis PDF</h2>
                <button @click="pdfModal = false" class="text-gray-600 hover:text-red-500 text-2xl leading-none">
                    &times;
                </button>
            </div>

            <!-- PDF Content -->
            <div class="flex-1 overflow-hidden">
                <iframe 
                    :src="'/analysis/' + selectedRow.file_pdf" 
                    type="application/pdf"
                    class="w-full h-full border-none"
                ></iframe>
            </div>
        </div>
    </div>

    <!-- Modal Success -->
    <div 
        x-show="successModal" 
        x-transition 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        style="display: none;"
    >
        <div 
            @click.away="successModal = false" 
            class="bg-white max-w-md w-full rounded-xl shadow-lg p-6 text-center relative"
            @click.stop
        >
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-green-700">Success</h3>
                <button @click="successModal = false" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
            </div>

            <!-- Content -->
            <div class="text-green-600 text-sm mb-4">
                {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg> --}}
                <p>{{ session('success') }}</p>
            </div>

            <!-- Footer -->
            <div class="mt-4">
                <button 
                    @click="successModal = false" 
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium"
                >
                    Close
                </button>
            </div>
        </div>
    </div>

</div>

@endsection
