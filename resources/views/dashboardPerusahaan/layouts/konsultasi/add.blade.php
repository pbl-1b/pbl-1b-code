@extends('dashboardPerusahaan.layouts.app')

@section('title', 'Consultations')

@section('content')

<div 
    class="bg-white rounded-md shadow-sm shadow-blue-100 border border-gray-300 p-6 mb-6"
    x-data="{ 
        showModal: false,
        selectedRow: {},
        selectedId: null,
        confirmDelete: false,
        pdfModal: false,
        showDiscussionModal: false,
        discussionName: '',
        discussionMessage: '',
        confirmSendConsultation: false
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
        <h2 class="text-xl font-semibold text-gray-800">Consultations</h2>
        <div class="relative group">
            <button 
                @click="selectedId ? showDiscussionModal = true : null" 
                :disabled="!selectedId"
                class="flex items-center gap-2 px-4 py-2 bg-[#39AA80] text-white rounded-md border border-[#39AA80]
                    disabled:bg-gray-300 disabled:border-gray-300 disabled:cursor-not-allowed"
            >
                Open Discussion
            </button>

            <!-- Tooltip jika belum memilih -->
            <div 
                x-show="!selectedId"
                class="absolute left-1/2 -translate-x-1/2 mt-2 text-xs text-white bg-[#39AA80] rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200"
            >
                Select a data first
            </div>
        </div>

    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Select</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Analysis Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Analysis Date</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <template x-for="(row, index) in filteredData" :key="index">
                    <tr>
                        <td class="px-4 py-4 text-sm text-gray-700 text-center">
                            <input 
                                type="radio"
                                name="selected"
                                :value="row.id"
                                x-model="selectedId"
                                class="form-radio h-4 w-4 text-green-600 border-gray-300"
                            >
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" x-text="row.no"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.nama_analisis"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="row.tanggal_analisis"></td>
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

    <!-- Modal Detail -->
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
                <h3 class="text-2xl font-bold text-gray-800">Analysis Detail</h3>
                <button @click="showModal = false; confirmDelete = false" class="text-gray-500 hover:text-gray-700 text-xl">
                    &times;
                </button>
            </div>

            <!-- Modal Content -->
            <div class="space-y-3 text-sm text-gray-700">
                <p><span class="font-semibold">Analysis Date :</span> <span x-text="selectedRow.tanggal_analisis"></span></p>
                <p><span class="font-semibold">Message :</span> <span x-text="selectedRow.pesan_analisis"></span></p>
                <p><span class="font-semibold">Fuel:</span> <span x-text="selectedRow.tanggal_awal"></span></p>
                <p><span class="font-semibold">Address:</span> <span x-text="selectedRow.tanggal_akhir"></span></p>
            </div>

            <!-- Modal Actions -->
            <div class="flex justify-between items-center mt-6 pt-4 border-t">
                <!-- View PDF Button -->
                <button 
                    @click="pdfModal = true"
                    class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold rounded-lg"
                >
                    View PDF
                </button>

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
                    {{-- <template x-if="!confirmDelete">
                        <button 
                            @click="confirmDelete = true"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg"
                        >
                            Delete
                        </button>
                    </template> --}}
                </div>
            </div>
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

    <!-- Modal Open Discussion -->
    <div 
        x-show="showDiscussionModal"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60"
        style="display: none;"
    >
        <div 
            @click.away="showDiscussionModal = false; discussionName = ''; discussionMessage = ''; confirmSendConsultation = false"
            class="bg-white w-full max-w-lg rounded-xl shadow-lg p-6"
        >
            <!-- Header -->
            <div class="flex justify-between items-center mb-4 border-b pb-2">
                <h2 class="text-xl font-semibold text-gray-800">New Consultation</h2>
                <button 
                    @click="showDiscussionModal = false; discussionName = ''; discussionMessage = ''; confirmSendConsultation = false" 
                    class="text-gray-500 hover:text-gray-700 text-xl"
                >
                    &times;
                </button>
            </div>

            <!-- Form untuk Kirim Konsultasi -->
            <form method="POST" action="{{ route('konsultasi.upload') }}">
                @csrf
                <input type="hidden" name="selected_id" :value="selectedId">

                <!-- Form Inputs -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1" for="discussionName">Consultation Name</label>
                        <input 
                            id="discussionName"
                            type="text" 
                            maxlength="35"
                            name="discussion_name"
                            x-model="discussionName" 
                            class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-green-400 focus:outline-none"
                            placeholder="Enter consultation name..."
                            required
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1" for="discussionMessage">Consultation Message</label>
                        <textarea 
                            id="discussionMessage"
                            name="discussion_message"
                            x-model="discussionMessage" 
                            rows="4" 
                            class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-green-400 focus:outline-none"
                            placeholder="Type your message here..."
                            required
                        ></textarea>
                    </div>
                </div>

                <!-- Confirmation Prompt -->
                <template x-if="confirmSendConsultation">
                    <div class="mt-6 flex justify-end gap-3">
                        <button 
                            type="button"
                            @click="confirmSendConsultation = false"
                            class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700"
                        >
                            Confirm
                        </button>
                    </div>
                </template>

                <!-- Action Buttons -->
                <template x-if="!confirmSendConsultation">
                    <div class="flex justify-end gap-3 mt-6">
                        <button 
                            type="button"
                            @click="showDiscussionModal = false; discussionName = ''; discussionMessage = ''; confirmSendConsultation = false"
                            class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100"
                        >
                            Cancel
                        </button>

                        <button 
                            type="button"
                            :disabled="!discussionName.trim() || !discussionMessage.trim()"
                            @click="confirmSendConsultation = true"
                            class="px-4 py-2 bg-green-600 text-white rounded disabled:bg-green-300 disabled:cursor-not-allowed hover:bg-green-700"
                        >
                            Send Consultation Request
                        </button>
                    </div>
                </template>
            </form>
        </div>
    </div>


</div>

@endsection
