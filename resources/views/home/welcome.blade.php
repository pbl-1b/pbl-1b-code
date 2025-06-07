<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-[#39AA80] to-[#2C8A68] text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0 bg-repeat opacity-5"></div>
        @for ($i = 0; $i < 5; $i++)
            <div class="absolute rounded-full bg-white/10 animate-float"
                style="width: {{ rand(100, 400) }}px; height: {{ rand(100, 400) }}px; top: {{ rand(0, 100) }}%; left: {{ rand(0, 100) }}%; animation-duration: {{ rand(20, 30) }}s;">
            </div>
        @endfor
    </div>

    <div class="container mx-auto px-4 py-20 md:py-32 relative z-10">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0 -mt-40 ml-10">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                Optimize Your Business, Minimize Your Carbon Footprint
                </h1>
                <p class="text-xl mb-8 text-white/90 max-w-lg">
                We provide smart carbon emission analysis to help companies grow sustainably, meet compliance, and drive environmental impact
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" class="inline-flex justify-center items-center px-6 py-3 bg-white text-[#39AA80] font-medium rounded-md hover:bg-white/90 transition-colors">
                        Get Started
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </a>
                    <a href="#services" class="inline-flex justify-center items-center px-6 py-3 border border-white text-white font-medium rounded-md hover:bg-white/10 transition-colors">
                        Learn More
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <div class="relative w-full max-w-md aspect-square">
                    <div class="absolute inset-0 bg-white/10 rounded-full animate-pulse"></div>
                    <img src="{{ asset('images/home_image.jpg') }}" alt="Hero Image" class="relative z-10 drop-shadow-2xl rounded-lg">
                </div>
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</section>

<!-- Services Section -->
<section class="py-20 bg-white" id="services">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Our Services</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                We offer a comprehensive range of services to help your business thrive in the digital landscape.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
            $services = [
                [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#39AA80]" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path></svg>',
                    'title' => 'Fast Performance',
                    'description' => 'Optimize your digital presence with lightning-fast loading times and smooth user experiences.'
                ],
                [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#39AA80]" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>',
                    'title' => 'Secure Solutions',
                    'description' => 'Protect your data and users with our enterprise-grade security implementations.'
                ],
                [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#39AA80]" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"></path><path d="m19 9-5 5-4-4-3 3"></path></svg>',
                    'title' => 'Data Analytics',
                    'description' => 'Gain valuable insights with our comprehensive data analysis and reporting tools.'
                ],
                [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#39AA80]" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
                    'title' => 'User Experience',
                    'description' => 'Create memorable experiences that keep your customers coming back for more.'
                ],
                [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#39AA80]" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>',
                    'title' => 'Quality Assurance',
                    'description' => 'Ensure your products meet the highest standards with our rigorous testing processes.'
                ],
                [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#39AA80]" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>',
                    'title' => 'Continuous Support',
                    'description' => 'Get ongoing assistance and maintenance to keep your systems running smoothly.'
                ]
            ];
            @endphp

            @foreach($services as $service)
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100 hover:border-[#39AA80]/30 group">
                <div class="mb-4 p-3 bg-[#39AA80]/10 inline-block rounded-lg group-hover:bg-[#39AA80]/20 transition-colors duration-300">
                    {!! $service['icon'] !!}
                </div>
                <h3 class="text-xl font-bold mb-3">{{ $service['title'] }}</h3>
                <p class="text-gray-600">{{ $service['description'] }}</p>
                <div class="mt-6">
                    <a href="" class="inline-flex items-center text-[#39AA80] font-medium hover:underline">
                        Learn more
                        <!-- {{ route('services') }} -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Information Section -->
<section class="py-20 bg-gray-50" id="about">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Why Choose Us</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Discover the advantages that set us apart from the competition and make us the ideal partner for your business.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
            $infoCards = [
                [
                    'image' => 'images/placeholder.jpg',
                    'title' => 'Innovative Solutions',
                    'description' => 'We leverage cutting-edge technologies to create innovative solutions that drive business growth.'
                ],
                [
                    'image' => 'images/home_image.jpg',
                    'title' => 'Expert Team',
                    'description' => 'Our team of experienced professionals is dedicated to delivering exceptional results for every project.'
                ],
                [
                    'image' => 'images/placeholder.jpg',
                    'title' => 'Customer Satisfaction',
                    'description' => 'We prioritize customer satisfaction and work closely with you to ensure your needs are met.'
                ],
                [
                    'image' => 'images/placeholder.jpg',
                    'title' => 'Proven Track Record',
                    'description' => 'With a history of successful projects, we have the experience to tackle any challenge.'
                ],
                [
                    'image' => 'images/placeholder.jpg',
                    'title' => 'Scalable Solutions',
                    'description' => 'Our solutions are designed to grow with your business, adapting to your changing needs.'
                ],
                [
                    'image' => 'images/placeholder.jpg',
                    'title' => 'Continuous Innovation',
                    'description' => 'We stay at the forefront of technology to provide you with the most advanced solutions.'
                ]
            ];
            @endphp

            @foreach($infoCards as $card)
            <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow duration-300 group">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset($card['image']) }}" alt="{{ $card['title'] }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#39AA80]/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-3 group-hover:text-[#39AA80] transition-colors duration-300">
                        {{ $card['title'] }}
                    </h3>
                    <p class="text-gray-600">{{ $card['description'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-[#39AA80]" id="contact">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 text-white">Ready to Get Started?</h2>
        <p class="text-white/90 max-w-2xl mx-auto mb-8 text-lg">
            Join thousands of satisfied customers who have transformed their businesses with our solutions.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('contact') }}" class="inline-flex justify-center items-center px-6 py-3 bg-white text-[#39AA80] font-medium rounded-md hover:bg-white/90 transition-colors">
                Contact Us Today
            </a>
        </div>
    </div>
</section>
