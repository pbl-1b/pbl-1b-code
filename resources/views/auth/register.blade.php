@extends('auth.app')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-gray-50 px-4 py-12">
    <div class="w-full max-w-md">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ url('/') }}" class="inline-flex items-center text-gray-600 hover:text-[#39AA80] transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Home
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-8">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Create an account</h2>
                    <p class="text-gray-500 mt-1">Enter your information to create your account</p>
                </div>
                
                @if ($errors->any())
                    <div class="bg-red-50 text-red-500 p-3 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (request('success'))
                    <div class="bg-green-50 text-green-500 p-3 rounded mb-4">
                        <ul class="list-disc pl-5">
                            <p>{{ request('success') }}</p>
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#39AA80] focus:border-[#39AA80]" placeholder="Input your full name" required autofocus>
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#39AA80] focus:border-[#39AA80]" placeholder="Input your email" required>
                    </div>

                    <!-- Code -->
                    <div class="space-y-2">
                        <label for="code" class="block text-sm font-medium">Registration Code</label>
                        <input id="code" type="text" name="code" value="{{ old('code') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#39AA80] focus:border-[#39AA80]" placeholder="TYPE-XXXXXX" required>
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium">Password</label>
                        <input id="password" type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#39AA80] focus:border-[#39AA80]" placeholder="Input your password" required>
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-sm font-medium">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#39AA80] focus:border-[#39AA80]" placeholder="Confirm your password" required>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="w-full py-2 px-4 bg-[#39AA80] hover:bg-[#2d8463] text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#39AA80] transition-colors duration-200">
                        Create Account
                    </button>
                </form>
            </div>
            
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 text-center">
                <p class="text-sm">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-[#39AA80] hover:text-[#2d8463] hover:underline">
                        Login
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
