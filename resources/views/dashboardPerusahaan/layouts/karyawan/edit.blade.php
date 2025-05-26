@extends('dashboardPerusahaan.layouts.app')

@section('title', 'Update Employees')
@section('content')

<div class="bg-white rounded-md shadow-sm shadow-blue-100 border border-gray-300 p-6 mb-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
        <h2 class="text-xl font-semibold text-gray-800">Update Data</h2>
        <a href="{{ route('karyawan.index') }}">
            <button class="flex items-center gap-2 px-4 py-2 border border-green-500 text-green-600 rounded-md hover:bg-green-50">
                Back to Dashboard
            </button>
        </a>
    </div>

    <form id="form-id" class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4" action="{{ route('karyawan.update', ['id' => $oldData->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama Karyawan -->
        <div>
            <label for="employee_name" class="block text-sm font-medium text-gray-700 mb-1">Employee Name <span class="text-red-500">*</span></label>
            <input type="text" id="employee_name" name="employee_name" value="{{ old('employee_name', $oldData->nama_karyawan) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500" />
            @error('employee_name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Jabatan -->
        <div>
            <label for="position" class="block text-sm font-medium text-gray-700 mb-1">Position<span class="text-red-500">*</span></label>
            <input type="text" id="position" name="position" value="{{ old('position', $oldData->jabatan) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500" />
            @error('position')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email', $oldData->email) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500" />
            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Jenis Kelamin -->
        <div>
            <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender<span class="text-red-500">*</span></label>
            <select id="gender" name="gender" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                <option value="L" {{ old('gender', $oldData->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('gender', $oldData->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('gender')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tanggal Lahir -->
        <div>
            <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
            <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $oldData->tanggal_lahir) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500" />
            @error('birth_date')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
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
        <a href="{{ route('karyawan.index') }}">
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
