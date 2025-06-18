
<header class="fixed top-0 z-40 w-full bg-white border-b border-gray-300 shadow-sm">
    <div class="flex items-center justify-between h-16 px-4">
        <div class="flex items-center">
            <!-- Mobile menu button -->
            <button 
                @click="isMobileMenuOpen = !isMobileMenuOpen" 
                class="mr-2 p-2 rounded-md text-gray-600 hover:bg-gray-100 md:hidden"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Sidebar toggle button (desktop) -->
            <button 
                @click="isSidebarCollapsed = !isSidebarCollapsed" 
                class="hidden mr-2 p-2 rounded-md text-gray-600 hover:bg-gray-100 md:flex"
            >
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="h-5 w-5 transition-transform" 
                    :class="isSidebarCollapsed ? 'rotate-180' : ''"
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Logo -->
            <div class="flex items-center">
                <div class="h-10 w-10 rounded-md flex items-center justify-center">
                    <img src="{{ asset('images/logo.png') }}" alt="">
                </div>
                
                <!-- Text -->
                <div class="ml-3 flex flex-col leading-tight">
                    <span class="text-xl font-bold" style="color: #39AA80;">CompCarbon</span>
                    <span class="text-sm font-semibold -mt-2" style="color: #39AA80;">Naima Sustainability</span>
                </div>
            </div>
        </div>

        <!-- Right side of navbar -->
        <div class="flex items-center gap-2">

            <!-- Notifications
            <button class="relative p-2 rounded-md text-gray-600 hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="absolute top-0 right-0 h-5 w-5 flex items-center justify-center text-xs text-white rounded-md" style="background-color: #39AA80;">
                    3
                </span>
            </button> -->

            <!-- Profile dropdown -->
            <div class="relative" x-data="{ isOpen: false }">
                <button 
                    @click="isOpen = !isOpen"
                    class="flex items-center gap-2 p-2 rounded-md hover:bg-gray-100"
                >
                    <img 
                        src="{{ asset('images/profile.jpg') }}" 
                        alt="Profile Picture"
                        class="h-8 w-8 rounded-full object-cover"
                    >
                    <span class="hidden md:inline font-medium text-sm">{{ session('name') }}</span>
                </button>

                <!-- Dropdown Menu -->
                <div 
                    x-show="isOpen" 
                    @click.outside="isOpen = false"
                    x-transition
                    class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg border border-gray-300 z-50"
                    x-cloak
                >
                    <div class="px-4 py-2 border-b border-gray-100">
                        <p class="text-sm font-medium">{{ session('name') }}</p>
                        <p class="text-xs text-gray-500">{{ session('email') }}</p>
                    </div>
                    <div class="py-1">
                        <button 
                            x-data
                            @click="$dispatch('open-modal')" 
                            class="w-full flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-sm"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>Company Profile</span>
                        </button>
                        <div class="border-t border-gray-100 my-1"></div>
                        <a href="{{ route('logout') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-gray-100 rounded-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div x-data="modal">
    <!-- Company Profile Button -->
    <div class="py-1">
        <button 
            @click="isCompanyProfileModalOpen = true"
            class="w-full flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-sm"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span>Company Profile</span>
        </button>
    </div>

    <!-- Company Profile Modal -->
    <div 
        x-data="{ 
            isCompanyProfileModalOpen: false,
            companyData: null,
            loading: false,
            error: null,
            async fetchCompanyProfile() {
                this.loading = true;
                this.error = null;
                try {
                    const response = await fetch('/api/company-profile', {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        credentials: 'same-origin'
                    });
                    
                    if (!response.ok) {
                        throw new Error('Failed to fetch company profile');
                    }
                    
                    this.companyData = await response.json();
                } catch (error) {
                    console.error('Error:', error);
                    this.error = error.message;
                } finally {
                    this.loading = false;
                }
            }
        }"
        x-init="$watch('isCompanyProfileModalOpen', value => {
            if (value) {
                fetchCompanyProfile();
            }
        })"
    >
        <!-- Modal Backdrop -->
        <div 
            x-show="isCompanyProfileModalOpen" 
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
            @click="isCompanyProfileModalOpen = false"
        ></div>

        <!-- Modal -->
        <div 
            x-show="isCompanyProfileModalOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="fixed inset-0 z-50 overflow-y-auto"
            @click.away="isCompanyProfileModalOpen = false"
        >
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <!-- Close button -->
                    <div class="absolute right-0 top-0 pr-4 pt-4">
                        <button 
                            @click="isCompanyProfileModalOpen = false"
                            class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none"
                        >
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Loading state -->
                    <div x-show="loading" class="flex justify-center items-center py-8">
                        <svg class="animate-spin h-8 w-8 text-[#39AA80]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>

                    <!-- Error state -->
                    <div x-show="error" class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Error</h3>
                        <p class="mt-1 text-sm text-gray-500" x-text="error"></p>
                    </div>

                    <!-- Content -->
                    <div x-show="!loading && !error && companyData" class="mt-3 text-center sm:mt-0 sm:text-left">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900 mb-4">
                            Company Profile
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="h-16 w-16 rounded-md flex items-center justify-center bg-gray-100">
                                    <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="h-12 w-12 object-contain">
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold" style="color: #39AA80;" x-text="companyData.nama_perusahaan"></h4>
                                    <p class="text-sm text-gray-500" x-text="'Kode: ' + companyData.kode_perusahaan"></p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-4 mt-4">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm text-gray-600" x-text="companyData.email_perusahaan"></span>
                                </div>

                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm text-gray-600" x-text="companyData.service.nama_service"></span>
                                </div>

                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm text-gray-600" x-text="'Active since: ' + companyData.tanggal_aktif_service"></span>
                                </div>

                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-sm text-gray-600" x-text="'Location: ' + companyData.latitude + ', ' + companyData.longitude"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

