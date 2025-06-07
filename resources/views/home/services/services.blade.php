@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-[#39AA80] to-[#2C8A68] text-white py-20">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-repeat opacity-5"></div>
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Our Services</h1>
                <p class="text-xl mb-8 text-white/90">
                    Discover our comprehensive range of professional services designed to help your business thrive in the digital landscape.
                </p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </section>

    <!-- Services List Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                $services = [
                    [
                        'id' => 1,
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#39AA80]" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19l7-7 3 3-7 7-3-3z"></path><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path><path d="M2 2l7.586 7.586"></path><circle cx="11" cy="11" r="2"></circle></svg>',
                        'title' => 'Web Design & Development',
                        'description' => 'Custom website design and development tailored to your business needs. We create responsive, user-friendly websites that drive results.',
                        'price' => '$1,500 - $5,000',
                        'duration' => '2-6 weeks'
                    ],
                    [
                        'id' => 2,
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#39AA80]" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>',
                        'title' => 'Mobile App Development',
                        'description' => 'Native and cross-platform mobile applications for iOS and Android. We build intuitive, high-performance apps that users love.',
                        'price' => '$5,000 - $15,000',
                        'duration' => '2-4 months'
                    ],
                    [
                        'id' => 3,
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#39AA80]" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
                        'title' => 'UI/UX Design',
                        'description' => 'User-centered design that enhances user experience and engagement. We create intuitive interfaces that delight your customers.',
                        'price' => '$2,000 - $8,000',
                        'duration' => '2-5 weeks'
                    ],
                    [
                        'id' => 4,
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#39AA80]" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 3 21 3 21 8"></polyline><line x1="4" y1="20" x2="21" y2="3"></line><polyline points="21 16 21 21 16 21"></polyline><line x1="15" y1="15" x2="21" y2="21"></line><line x1="4" y1="4" x2="9" y2="9"></line></svg>',
                        'title' => 'E-commerce Solutions',
                        'description' => 'Complete e-commerce solutions from store setup to payment integration. We help you sell your products online effectively.',
                        'price' => '$3,000 - $10,000',
                        'duration' => '1-3 months'
                    ],
                    [
                        'id' => 5,
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#39AA80]" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"></path><path d="m19 9-5 5-4-4-3 3"></path></svg>',
                        'title' => 'Digital Marketing',
                        'description' => 'Comprehensive digital marketing strategies to grow your online presence. SEO, PPC, social media, and content marketing services.',
                        'price' => '$1,000 - $5,000/month',
                        'duration' => 'Ongoing'
                    ],
                    [
                        'id' => 6,
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#39AA80]" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"></path><path d="M12 12v9"></path><path d="m8 17 4 4 4-4"></path></svg>',
                        'title' => 'Cloud Solutions',
                        'description' => 'Secure, scalable cloud infrastructure and migration services. We help you leverage the power of the cloud for your business.',
                        'price' => '$2,500 - $12,000',
                        'duration' => '2-8 weeks'
                    ],
                ];
                @endphp

                @foreach($services as $service)
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-[#39AA80]/30 group">
                    <div class="mb-6 p-4 bg-[#39AA80]/10 inline-block rounded-lg group-hover:bg-[#39AA80]/20 transition-colors duration-300">
                        {!! $service['icon'] !!}
                    </div>
                    <h3 class="text-2xl font-bold mb-3 group-hover:text-[#39AA80] transition-colors">{{ $service['title'] }}</h3>
                    <p class="text-gray-600 mb-6">{{ $service['description'] }}</p>
                    
                    <div class="flex flex-col space-y-2 mb-6">
                        <div class="flex items-center text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#39AA80]" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            <span>Duration: {{ $service['duration'] }}</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#39AA80]" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                            <span>Starting at: {{ $service['price'] }}</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('booking.form', ['service_id' => $service['id']]) }}" class="inline-block w-full py-3 px-6 bg-[#39AA80] text-white text-center font-medium rounded-md hover:bg-[#39AA80]/90 transition-colors">
                        Book This Service
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Our Process</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    We follow a structured approach to deliver exceptional results for every project.
                </p>
            </div>

            <div class="relative">
                <!-- Process line -->
                <div class="hidden md:block absolute left-1/2 top-0 bottom-0 w-1 bg-[#39AA80]/20 transform -translate-x-1/2"></div>
                
                <div class="space-y-12 relative">
                    @php
                    $processes = [
                        [
                            'number' => '01',
                            'title' => 'Discovery & Planning',
                            'description' => 'We start by understanding your business goals, target audience, and project requirements to create a detailed project plan.'
                        ],
                        [
                            'number' => '02',
                            'title' => 'Design & Prototyping',
                            'description' => 'Our designers create wireframes and prototypes to visualize the solution before development begins.'
                        ],
                        [
                            'number' => '03',
                            'title' => 'Development & Implementation',
                            'description' => 'Our development team brings the designs to life, ensuring quality code and optimal performance.'
                        ],
                        [
                            'number' => '04',
                            'title' => 'Testing & Quality Assurance',
                            'description' => 'Rigorous testing ensures your product is bug-free and works perfectly across all devices and browsers.'
                        ],
                        [
                            'number' => '05',
                            'title' => 'Deployment & Launch',
                            'description' => 'We handle the deployment process and ensure a smooth launch of your project.'
                        ],
                        [
                            'number' => '06',
                            'title' => 'Maintenance & Support',
                            'description' => 'Our relationship doesn't end at launch. We provide ongoing support and maintenance to keep your project running smoothly.'
                        ],
                    ];
                    @endphp

                    @foreach($processes as $index => $process)
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="md:w-1/2 {{ $index % 2 == 0 ? 'md:pr-12 md:text-right' : 'md:pl-12 order-first md:order-last' }}">
                            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <div class="text-4xl font-bold text-[#39AA80]/20 mb-2">{{ $process['number'] }}</div>
                                <h3 class="text-xl font-bold mb-2">{{ $process['title'] }}</h3>
                                <p class="text-gray-600">{{ $process['description'] }}</p>
                            </div>
                        </div>
                        <div class="hidden md:flex items-center justify-center w-12 h-12 rounded-full bg-[#39AA80] text-white font-bold relative z-10 my-4 md:my-0">
                            {{ $process['number'] }}
                        </div>
                        <div class="md:w-1/2"></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-[#39AA80]">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 text-white">Ready to Start Your Project?</h2>
            <p class="text-white/90 max-w-2xl mx-auto mb-8 text-lg">
                Contact us today to discuss your project requirements and get a free consultation.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('booking.form') }}" class="inline-flex justify-center items-center px-6 py-3 bg-white text-[#39AA80] font-medium rounded-md hover:bg-white/90 transition-colors">
                    Book a Service
                </a>
                <a href="#" class="inline-flex justify-center items-center px-6 py-3 border border-white text-white font-medium rounded-md hover:bg-white/10 transition-colors">
                    Contact Us
                </a>
            </div>
        </div>
    </section>
@endsection
