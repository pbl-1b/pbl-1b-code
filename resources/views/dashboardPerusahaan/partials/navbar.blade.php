
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
                    <span class="hidden md:inline font-medium text-sm">John Doe</span>
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
                        <p class="text-sm font-medium">John Doe</p>
                        <p class="text-xs text-gray-500">admin@example.com</p>
                    </div>
                    <div class="py-1">
                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>My Profile</span>
                        </a>
                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Settings</span>
                        </a>
                        <div class="border-t border-gray-100 my-1"></div>
                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-gray-100 rounded-sm">
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
