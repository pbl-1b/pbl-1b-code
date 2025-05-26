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
                    <h2 class="text-2xl font-bold text-gray-800">Login</h2>
                    <p class="text-gray-500 mt-1">Enter your credentials to access your account</p>
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

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <div class="relative">
                            <div class="absolute left-3 top-3 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" class="w-full px-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#39AA80] focus:border-[#39AA80]" placeholder="name@example.com" required autofocus>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-[#39AA80] hover:text-[#2d8463] hover:underline">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <div class="absolute left-3 top-3 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock-keyhole"><circle cx="12" cy="16" r="1"/><rect x="3" y="10" width="18" height="12" rx="2"/><path d="M7 10V7a5 5 0 0 1 10 0v3"/></svg>
                            </div>
                            <input id="password" type="password" name="password" class="w-full px-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#39AA80] focus:border-[#39AA80]" required>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-[#39AA80] focus:ring-[#39AA80]">
                        <label for="remember" class="text-sm font-normal">
                            Remember me
                        </label>
                    </div>
                    
                    <button type="submit" class="w-full py-2 px-4 bg-[#39AA80] hover:bg-[#2d8463] text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#39AA80] transition-colors duration-200">
                        Login
                    </button>
                </form>
            </div>
            
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 text-center">
                <p class="text-sm">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-[#39AA80] hover:text-[#2d8463] hover:underline">
                        Register
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
