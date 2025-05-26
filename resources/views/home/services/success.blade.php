@extends('layouts.app')

@section('content')
    <!-- Success Message Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-8 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                    
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">Payment Successful!</h1>
                    <p class="text-lg text-gray-600 mb-8">
                        Thank you for your payment. Your service booking has been confirmed.
                    </p>
                    
                    <div class="bg-gray-50 rounded-lg p-6 mb-8 text-left">
                        <h2 class="text-xl font-semibold mb-4">Payment Details</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Payment ID:</span>
                                <span class="font-medium">{{ $payment->id ?? 'PAY-'.rand(100000, 999999) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Booking Reference:</span>
                                <span class="font-medium">{{ $payment->booking_id ?? 'BK-'.rand(10000, 99999) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Amount Paid:</span>
                                <span class="font-medium">${{ $payment->amount ?? '2,200.00' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Payment Method:</span>
                                <span class="font-medium">{{ $payment->method ?? 'Credit Card' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Date:</span>
                                <span class="font-medium">{{ $payment->date ?? date('F d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-[#39AA80]/10 rounded-lg p-6 mb-8 text-left">
                        <h2 class="text-xl font-semibold mb-4">What's Next?</h2>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#39AA80] mr-2 mt-0.5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>You will receive a confirmation email with your booking details shortly.</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#39AA80] mr-2 mt-0.5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Our team will contact you within 24-48 hours to discuss your project in detail.</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#39AA80] mr-2 mt-0.5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>We will schedule a kickoff meeting to begin the project planning process.</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('dashboard') }}" class="inline-flex justify-center items-center px-6 py-3 bg-[#39AA80] text-white font-medium rounded-md hover:bg-[#39AA80]/90 transition-colors">
                            Go to Dashboard
                        </a>
                        <a href="{{ route('home') }}" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-md hover:bg-gray-50 transition-colors">
                            Return to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Services Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl font-bold mb-8 text-center">You Might Also Be Interested In</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @php
                    $relatedServices = [
                        [
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#39AA80]" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"></path><path d="m19 9-5 5-4-4-3 3"></path></svg>',
                            'title' => 'Digital Marketing',
                            'description' => 'Boost your online presence with our comprehensive digital marketing services.',
                            'link' => '#'
                        ],
                        [
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#39AA80]" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
                            'title' => 'Maintenance Plans',
                            'description' => 'Keep your digital assets running smoothly with our maintenance and support plans.',
                            'link' => '#'
                        ],
                        [
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#39AA80]" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"></path><path d="M12 12v9"></path><path d="m8 17 4 4 4-4"></path></svg>',
                            'title' => 'Cloud Hosting',
                            'description' => 'Reliable and scalable cloud hosting solutions for your applications and websites.',
                            'link' => '#'
                        ]
                    ];
                    @endphp

                    @foreach($relatedServices as $service)
                    <div class="bg-gray-50 p-6 rounded-lg hover:shadow-md transition-shadow duration-300">
                        <div class="mb-4 p-3 bg-[#39AA80]/10 inline-block rounded-lg">
                            {!! $service['icon'] !!}
                        </div>
                        <h3 class="text-xl font-bold mb-3">{{ $service['title'] }}</h3>
                        <p class="text-gray-600 mb-4">{{ $service['description'] }}</p>
                        <a href="{{ $service['link'] }}" class="inline-flex items-center text-[#39AA80] font-medium hover:underline">
                            Learn more
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
