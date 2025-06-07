<!-- Alpine.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<header class="fixed top-0 z-40 w-full bg-white border-b border-gray-300 shadow-sm" 
        x-data="{ isModalOpen: false, result: '', loading: false, copied: false }">
    <div class="flex items-center justify-between h-16 px-4">
        <div class="flex items-center">
            <!-- Mobile menu button -->
            <button @click="isMobileMenuOpen = !isMobileMenuOpen" 
                    class="mr-2 p-2 rounded-md text-gray-600 hover:bg-[#2F7B63] md:hidden transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Sidebar toggle (desktop) -->
            <button @click="isSidebarCollapsed = !isSidebarCollapsed" 
                    class="hidden mr-2 p-2 rounded-md text-gray-600 hover:bg-[#2F7B63] md:flex transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="h-5 w-5 transition-transform" 
                     :class="isSidebarCollapsed ? 'rotate-180' : ''"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Logo -->
            <div class="flex items-center">
                <div class="h-10 w-10 rounded-md flex items-center justify-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-full w-full object-cover rounded-md">
                </div>
                <div class="ml-3 flex flex-col leading-tight">
                    <span class="text-xl font-bold" style="color: #39AA80;">CompCarbon</span>
                    <span class="text-sm font-semibold -mt-2" style="color: #39AA80;">Naima Sustainability</span>
                </div>
            </div>
        </div>

        <!-- Right Side -->
        <div class="flex items-center gap-2">
            <!-- Generate Code Button -->
            <button 
                @click="isModalOpen = true"
                class="px-3 py-2 bg-[#39AA80] text-white text-sm rounded-md hover:bg-[#2F7B63] transition-colors"
            >
                Generate code for staff
            </button>

            <!-- Profile -->
            <div class="relative" x-data="{ isOpen: false }">
                <button 
                    @click="isOpen = !isOpen"
                    class="flex items-center gap-2 p-2 rounded-md hover:bg-[#2F7B63] transition-colors"
                >
                    <img 
                        src="{{ asset('images/profile.jpg') }}" 
                        alt="Profile Picture"
                        class="h-8 w-8 rounded-full object-cover"
                    >
                    <span class="hidden md:inline font-medium text-sm">John Doe</span>
                </button>

                <!-- Dropdown -->
                <div 
                    x-show="isOpen" 
                    @click.outside="isOpen = false"
                    x-transition
                    class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg border border-gray-300 z-50"
                    x-cloak
                >
                    <div class="px-4 py-2 border-b border-gray-100">
                        <p class="text-sm font-medium">John Doe</p>
                        <p class="text-xs text-gray-500">admin@example.com</p>
                    </div>
                    <div class="py-1">
                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-[#2F7B63] rounded-sm transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>My Profile</span>
                        </a>
                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-[#2F7B63] rounded-sm transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2s-3 1.343-3 3 1.343 3 3 3zM12 14c-4.418 0-8 1.79-8 4v2h16v-2c0-2.21-3.582-4-8-4z" />
                            </svg>
                            <span>Settings</span>
                        </a>
                        <div class="border-t border-gray-100 my-1"></div>
                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-[#2F7B63] rounded-sm transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                            </svg>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Generate Code -->
    <div 
        x-show="isModalOpen"
        x-cloak
        class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50"
    >
        <div class="bg-white p-6 rounded-md shadow-md w-96" @click.away="isModalOpen = false">
            <h2 class="text-lg font-semibold mb-4">Confirmation generate code?</h2>

            <!-- Buttons -->
            <template x-if="!loading && !result">
                <div class="flex justify-end gap-2">
                    <button class="px-3 py-1 text-gray-600 hover:text-gray-800 transition-colors" @click="isModalOpen = false">Cancel</button>
                    <button 
                        class="px-3 py-1 bg-[#39AA80] text-white rounded hover:bg-[#2F7B63] transition-colors"
                        @click="
                            loading = true;
                            fetch('{{ route('code.generate') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({})
                            })
                            .then(response => response.json())
                            .then(data => {
                                result = JSON.stringify(data);
                                loading = false;
                            })
                            .catch(error => {
                                result = JSON.stringify({ error: error.message });
                                loading = false;
                            });
                        "
                    >
                        Confirm
                    </button>
                </div>
            </template>

            <!-- Loading -->
            <template x-if="loading">
                <div class="text-center text-sm text-gray-500">Processing...</div>
            </template>

            <!-- Result -->
            <template x-if="result">
                <div class="mt-4">
                    <div class="text-sm text-gray-600 mb-2">Generated Staff Code:</div>
                    <div class="flex items-center justify-between bg-gray-100 px-3 py-2 rounded-md">
                        <span class="font-mono font-semibold text-green-700" x-text="JSON.parse(result).staff_code"></span>
                        <button 
                            class="text-sm text-blue-600 hover:text-blue-800"
                            @click="navigator.clipboard.writeText(JSON.parse(result).staff_code); copied = true; setTimeout(() => copied = false, 2000)"
                        >
                            Copy
                        </button>
                    </div>
                    <div 
                        x-show="copied" 
                        x-transition 
                        class="text-green-600 text-xs mt-2"
                    >
                        Code copied to clipboard!
                    </div>
                </div>
            </template>
        </div>
    </div>
</header>
