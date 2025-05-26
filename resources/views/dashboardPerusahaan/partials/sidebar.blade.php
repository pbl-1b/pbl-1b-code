<aside class="fixed left-0 hidden md:block h-[calc(100vh-4rem)] bg-white border-r border-gray-300 transition-all duration-300 z-30 shadow-sm" :class="isSidebarCollapsed ? 'w-20' : 'w-64'">
    <nav class="p-4 h-full overflow-y-auto custom-scrollbar-green">
        <ul class="space-y-2">
            @php
                $menus = [
                    ['name' => 'Employees', 'route' => 'karyawan.index', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                    ['name' => 'Computee', 'route' => 'perjalananKaryawanPerusahaan.index', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['name' => 'Address', 'route' => 'alamatRumah.index', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ['name' => 'Analysis', 'route' => 'analisis.index', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                    ['name' => 'Consultation', 'route' => 'konsultasi.index', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
                ];
            @endphp

            @foreach ($menus as $menu)
                <li>
                    <a href="{{ route($menu['route']) }}"
                        @class([
                            'flex items-center gap-3 px-3 py-2 rounded-md border shadow-sm transition-colors',
                            'bg-green-100 text-green-700 border-green-200 shadow-blue-100' => Route::is($menu['route']),
                            'hover:bg-green-50 text-gray-700 border-transparent' => !Route::is($menu['route']),
                        ])
                    >
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="transition-all text-gray-500"
                            :class="isSidebarCollapsed ? 'h-7 w-7' : 'h-5 w-5'"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $menu['icon'] }}" />
                        </svg>
                        <span class="font-medium whitespace-nowrap transition-opacity"
                            :class="isSidebarCollapsed ? 'opacity-0 hidden' : 'opacity-100'">
                            {{ $menu['name'] }}
                        </span>
                    </a>
                </li>
            @endforeach

        </ul>
    </nav>
</aside>
