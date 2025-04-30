<aside class="fixed left-0 hidden md:block h-[calc(100vh-4rem)] bg-white border-r border-gray-300 transition-all duration-300 z-30 shadow-sm" :class="isSidebarCollapsed ? 'w-20' : 'w-64'">
    <nav class="p-4 h-full overflow-y-auto custom-scrollbar-green">
        <ul class="space-y-2">
            <li>
                <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md bg-green-100 text-green-700 border border-green-200 shadow-sm shadow-blue-100">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="transition-all" 
                        :class="isSidebarCollapsed ? 'h-7 w-7' : 'h-5 w-5'" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="font-medium whitespace-nowrap transition-opacity" :class="isSidebarCollapsed ? 'opacity-0 hidden' : 'opacity-100'">Dashboard</span>
                </a>
            </li>
            <!-- More menu items with larger icons when collapsed -->
            <li>
                <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-green-50 text-gray-700 border border-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="transition-all text-gray-500" 
                        :class="isSidebarCollapsed ? 'h-7 w-7' : 'h-5 w-5'" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="font-medium whitespace-nowrap transition-opacity" :class="isSidebarCollapsed ? 'opacity-0 hidden' : 'opacity-100'">Analytics</span>
                    <span class="ml-auto bg-green-500 text-white text-xs px-2 py-0.5 rounded-md whitespace-nowrap transition-opacity" :class="isSidebarCollapsed ? 'opacity-0 hidden' : 'opacity-100'">New</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-green-50 text-gray-700 border border-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="transition-all text-gray-500" 
                        :class="isSidebarCollapsed ? 'h-7 w-7' : 'h-5 w-5'" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="font-medium whitespace-nowrap transition-opacity" :class="isSidebarCollapsed ? 'opacity-0 hidden' : 'opacity-100'">Users</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-green-50 text-gray-700 border border-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="transition-all text-gray-500" 
                        :class="isSidebarCollapsed ? 'h-7 w-7' : 'h-5 w-5'" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span class="font-medium whitespace-nowrap transition-opacity" :class="isSidebarCollapsed ? 'opacity-0 hidden' : 'opacity-100'">Products</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-green-50 text-gray-700 border border-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="transition-all text-gray-500" 
                        :class="isSidebarCollapsed ? 'h-7 w-7' : 'h-5 w-5'" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="font-medium whitespace-nowrap transition-opacity" :class="isSidebarCollapsed ? 'opacity-0 hidden' : 'opacity-100'">Reports</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-green-50 text-gray-700 border border-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="transition-all text-gray-500" 
                        :class="isSidebarCollapsed ? 'h-7 w-7' : 'h-5 w-5'" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="font-medium whitespace-nowrap transition-opacity" :class="isSidebarCollapsed ? 'opacity-0 hidden' : 'opacity-100'">Schedule</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-green-50 text-gray-700 border border-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="transition-all text-gray-500" 
                        :class="isSidebarCollapsed ? 'h-7 w-7' : 'h-5 w-5'" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="font-medium whitespace-nowrap transition-opacity" :class="isSidebarCollapsed ? 'opacity-0 hidden' : 'opacity-100'">Settings</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>