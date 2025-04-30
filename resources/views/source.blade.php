<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EmpCarbon - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'outfit': ['Outfit', 'sans-serif'],
                    },
                    borderRadius: {
                        'md': '0.375rem',
                    }
                },
            },
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        
        /* Custom scrollbar - hide default but keep functionality */
        .custom-scrollbar {
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }
        
        .custom-scrollbar::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }
        
        /* Custom green scrollbar for sidebar */
        .custom-scrollbar-green {
            scrollbar-width: thin; /* Firefox */
            scrollbar-color: #10b981 #f3f4f6; /* Firefox */
        }
        
        .custom-scrollbar-green::-webkit-scrollbar {
            width: 6px; /* Width of the scrollbar */
            display: block;
        }
        
        .custom-scrollbar-green::-webkit-scrollbar-track {
            background: #f3f4f6; /* Light gray background */
            border-radius: 10px;
        }
        
        .custom-scrollbar-green::-webkit-scrollbar-thumb {
            background: #10b981; /* Green thumb */
            border-radius: 10px;
            transition: background 0.3s ease;
        }
        
        .custom-scrollbar-green::-webkit-scrollbar-thumb:hover {
            background: #059669; /* Darker green on hover */
        }
        
        body {
            font-family: 'Outfit', sans-serif;
        }

        /* Shadow with blue tint */
        .shadow-blue-100 {
            box-shadow: 0 1px 3px 0 rgba(59, 130, 246, 0.1), 0 1px 2px 0 rgba(59, 130, 246, 0.06);
        }
    </style>
</head>
<body class="bg-gray-50 font-outfit">
    <div x-data="{ 
        isSidebarCollapsed: window.innerWidth < 768,
        isMobileMenuOpen: false,
        showAddForm: false,
        currentPage: 1,
        statusFilter: [],
        chartPeriod: 'week',
        
        toggleStatusFilter(status) {
            if (this.statusFilter.includes(status)) {
                this.statusFilter = this.statusFilter.filter(s => s !== status);
            } else {
                this.statusFilter.push(status);
            }
        },
        
        get filteredData() {
            if (this.statusFilter.length === 0) return this.tableData;
            return this.tableData.filter(row => this.statusFilter.includes(row.status));
        },
        
        tableData: [
            { id: '#1234', name: 'John Smith', status: 'Completed', date: 'Today, 2:30 PM', amount: '$120.00' },
            { id: '#1235', name: 'Sarah Johnson', status: 'Pending', date: 'Today, 10:15 AM', amount: '$75.50' },
            { id: '#1236', name: 'Michael Brown', status: 'Processing', date: 'Yesterday', amount: '$54.25' },
            { id: '#1237', name: 'Emily Davis', status: 'Completed', date: 'Sep 12, 2023', amount: '$98.75' },
            { id: '#1238', name: 'David Wilson', status: 'Cancelled', date: 'Sep 10, 2023', amount: '$35.00' }
        ],
        
        // Chart data
        chartData: {
            day: {
                labels: ['12AM', '3AM', '6AM', '9AM', '12PM', '3PM', '6PM', '9PM'],
                values: [12, 19, 15, 25, 32, 38, 33, 28]
            },
            week: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                values: [28, 32, 36, 30, 25, 40, 35]
            },
            month: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                values: [85, 100, 90, 120]
            },
            year: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                values: [200, 190, 210, 240, 280, 250, 290, 300, 270, 320, 310, 350]
            }
        },
        
        drawChart() {
            this.$nextTick(() => {
                const canvas = this.$refs.chartCanvas;
                if (!canvas) return;
                
                const ctx = canvas.getContext('2d');
                if (!ctx) return;
                
                // Clear canvas
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                
                // Set canvas dimensions
                const rect = canvas.getBoundingClientRect();
                canvas.width = rect.width;
                canvas.height = rect.height;
                
                // Chart dimensions
                const padding = 40;
                const chartWidth = rect.width - padding * 2;
                const chartHeight = rect.height - padding * 2;
                
                // Get data for the selected period
                const data = this.chartData[this.chartPeriod];
                const { labels, values } = data;
                
                // Find max value for scaling
                const maxValue = Math.max(...values);
                
                // Draw axes
                ctx.beginPath();
                ctx.strokeStyle = '#e5e7eb'; // gray-200
                ctx.lineWidth = 1;
                ctx.moveTo(padding, padding);
                ctx.lineTo(padding, chartHeight + padding);
                ctx.lineTo(chartWidth + padding, chartHeight + padding);
                ctx.stroke();
                
                // Draw grid lines
                const gridLines = 5;
                ctx.beginPath();
                ctx.strokeStyle = '#f3f4f6'; // gray-100
                ctx.lineWidth = 1;
                for (let i = 1; i <= gridLines; i++) {
                    const y = padding + (chartHeight / gridLines) * i;
                    ctx.moveTo(padding, y);
                    ctx.lineTo(chartWidth + padding, y);
                }
                ctx.stroke();
                
                // Draw data points and lines
                const pointSpacing = chartWidth / (labels.length - 1);
                
                // Draw line
                ctx.beginPath();
                ctx.strokeStyle = '#10b981'; // green-500
                ctx.lineWidth = 2;
                ctx.moveTo(padding, chartHeight + padding - (values[0] / maxValue) * chartHeight);
                
                for (let i = 1; i < labels.length; i++) {
                    const x = padding + pointSpacing * i;
                    const y = chartHeight + padding - (values[i] / maxValue) * chartHeight;
                    ctx.lineTo(x, y);
                }
                ctx.stroke();
                
                // Draw points
                for (let i = 0; i < labels.length; i++) {
                    const x = padding + pointSpacing * i;
                    const y = chartHeight + padding - (values[i] / maxValue) * chartHeight;
                    
                    ctx.beginPath();
                    ctx.fillStyle = '#ffffff'; // white
                    ctx.strokeStyle = '#10b981'; // green-500
                    ctx.lineWidth = 2;
                    ctx.arc(x, y, 4, 0, Math.PI * 2);
                    ctx.fill();
                    ctx.stroke();
                }
                
                // Draw labels
                ctx.fillStyle = '#6b7280'; // gray-500
                ctx.font = '12px Outfit, sans-serif';
                ctx.textAlign = 'center';
                
                for (let i = 0; i < labels.length; i++) {
                    const x = padding + pointSpacing * i;
                    const y = chartHeight + padding + 20;
                    ctx.fillText(labels[i], x, y);
                }
                
                // Draw values on y-axis
                ctx.textAlign = 'right';
                for (let i = 0; i <= gridLines; i++) {
                    const value = Math.round((maxValue / gridLines) * (gridLines - i));
                    const y = padding + (chartHeight / gridLines) * i + 4;
                    ctx.fillText(value.toString(), padding - 10, y);
                }
            });
        }
    }"
    x-init="$watch('chartPeriod', () => drawChart()); $nextTick(() => drawChart())">

        <!-- Navbar -->
        @include('partials.navbar')
        
        <!-- Sidebar for mobile (overlay) -->
        @include('partials.sidebarMobile')

        <!-- Content area with sidebar -->
        <div class="flex pt-16 min-h-screen">
            <!-- Sidebar (desktop) -->
            @include('partials.sidebar')

            <!-- Main content -->
            <main 
                class="flex-1 p-6 transition-all duration-300" 
                :class="isSidebarCollapsed ? 'md:ml-16' : 'md:ml-64'"
            >
                {{-- Form --}}

                <template x-if="!showAddForm">
                    <!-- Dashboard content -->
                    <div>
                        <div class="mb-6">
                            <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                            <p class="text-gray-500">Welcome back, John! Here's what's happening.</p>
                        </div>

                        <!-- Stats Cards -->
                        
                        <!-- Chart Card -->
                        
                        <!-- Table -->
                        @include('partials.table')

                        <!-- Widgets -->
 
                    </div>
                </template>
            </main>
        </div>
    </div>
</body>
</html>
