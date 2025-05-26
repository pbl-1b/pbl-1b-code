@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-[#39AA80] to-[#2C8A68] text-white py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">Book Our Services</h1>
                <p class="text-xl text-white/90">
                    Fill out the form below to request our services and we'll get back to you shortly.
                </p>
            </div>
        </div>
    </section>

    <!-- Booking Form Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-8">
                    <form action="{{ route('booking.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        @if(session('success'))
                            <div class="bg-green-50 text-green-700 p-4 rounded-md mb-6">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if($errors->any())
                            <div class="bg-red-50 text-red-700 p-4 rounded-md mb-6">
                                <ul class="list-disc pl-5">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Personal Information -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4 pb-2 border-b border-gray-200">Personal Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name *</label>
                                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#39AA80] focus:border-[#39AA80]" required>
                                </div>
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#39AA80] focus:border-[#39AA80]" required>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#39AA80] focus:border-[#39AA80]" required>
                                </div>
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#39AA80] focus:border-[#39AA80]" required>
                                </div>
                                <div class="md:col-span-2">
                                    <label for="company" class="block text-sm font-medium text-gray-700 mb-1">Company Name (Optional)</label>
                                    <input type="text" id="company" name="company" value="{{ old('company') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#39AA80] focus:border-[#39AA80]">
                                </div>
                            </div>
                        </div>

                        <!-- Service Details -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4 pb-2 border-b border-gray-200">Service Details</h3>
                            <div class="space-y-6">
                                <div>
                                    <label for="service_type" class="block text-sm font-medium text-gray-700 mb-1">Service Type *</label>
                                    <select id="service_type" name="service_type" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#39AA80] focus:border-[#39AA80]" required>
                                        <option value="">Select a service</option>
                                        <option value="1" {{ request('service_id') == 1 ? 'selected' : '' }}>Web Design & Development</option>
                                        <option value="2" {{ request('service_id') == 2 ? 'selected' : '' }}>Mobile App Development</option>
                                        <option value="3" {{ request('service_id') == 3 ? 'selected' : '' }}>UI/UX Design</option>
                                        <option value="4" {{ request('service_id') == 4 ? 'selected' : '' }}>E-commerce Solutions</option>
                                        <option value="5" {{ request('service_id') == 5 ? 'selected' : '' }}>Digital Marketing</option>
                                        <option value="6" {{ request('service_id') == 6 ? 'selected' : '' }}>Cloud Solutions</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="budget" class="block text-sm font-medium text-gray-700 mb-1">Budget Range *</label>
                                    <select id="budget" name="budget" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#39AA80] focus:border-[#39AA80]" required>
                                        <option value="">Select budget range</option>
                                        <option value="less_than_1000">Less than $1,000</option>
                                        <option value="1000_5000">$1,000 - $5,000</option>
                                        <option value="5000_10000">$5,000 - $10,000</option>
                                        <option value="10000_20000">$10,000 - $20,000</option>
                                        <option value="more_than_20000">More than $20,000</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="timeline" class="block text-sm font-medium text-gray-700 mb-1">Expected Timeline *</label>
                                    <select id="timeline" name="timeline" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#39AA80] focus:border-[#39AA80]" required>
                                        <option value="">Select timeline</option>
                                        <option value="less_than_1_month">Less than 1 month</option>
                                        <option value="1_3_months">1-3 months</option>
                                        <option value="3_6_months">3-6 months</option>
                                        <option value="more_than_6_months">More than 6 months</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="project_description" class="block text-sm font-medium text-gray-700 mb-1">Project Description *</label>
                                    <textarea id="project_description" name="project_description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#39AA80] focus:border-[#39AA80]" required>{{ old('project_description') }}</textarea>
                                    <p class="mt-1 text-sm text-gray-500">Please provide details about your project requirements and goals.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div>
                            <h3 class="text-xl font-semibold mb-4 pb-2 border-b border-gray-200">Additional Information</h3>
                            <div class="space-y-6">
                                <div>
                                    <label for="how_did_you_hear" class="block text-sm font-medium text-gray-700 mb-1">How did you hear about us?</label>
                                    <select id="how_did_you_hear" name="how_did_you_hear" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#39AA80] focus:border-[#39AA80]">
                                        <option value="">Select an option</option>
                                        <option value="search_engine">Search Engine</option>
                                        <option value="social_media">Social Media</option>
                                        <option value="referral">Referral</option>
                                        <option value="advertisement">Advertisement</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="terms" name="terms" type="checkbox" class="h-4 w-4 text-[#39AA80] border-gray-300 rounded focus:ring-[#39AA80]" required>
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="terms" class="font-medium text-gray-700">I agree to the <a href="#" class="text-[#39AA80] hover:underline">Terms of Service</a> and <a href="#" class="text-[#39AA80] hover:underline">Privacy Policy</a> *</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full py-3 px-4 bg-[#39AA80] hover:bg-[#39AA80]/90 text-white font-medium rounded-md transition-colors">
                                Submit Booking Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold mb-8 text-center">Frequently Asked Questions</h2>
                
                <div class="space-y-6">
                    @php
                    $faqs = [
                        [
                            'question' => 'What happens after I submit my booking request?',
                            'answer' => 'After submitting your booking request, our team will review your requirements and contact you within 24-48 hours to discuss your project in more detail and provide a customized quote.'
                        ],
                        [
                            'question' => 'Do I need to pay upfront for services?',
                            'answer' => 'We typically require a 50% deposit to begin work, with the remaining balance due upon project completion. For larger projects, we can arrange milestone-based payments.'
                        ],
                        [
                            'question' => 'How long does it take to complete a project?',
                            'answer' => 'Project timelines vary depending on the scope and complexity. A simple website might take 2-4 weeks, while a complex application could take several months. We'll provide a detailed timeline during our initial consultation.'
                        ],
                        [
                            'question' => 'Can I make changes to my project after it starts?',
                            'answer' => 'Yes, we understand that requirements can evolve. We have a change request process for modifications after the project has started. Some changes may affect the timeline or cost.'
                        ],
                        [
                            'question' => 'Do you provide ongoing support after project completion?',
                            'answer' => 'Yes, we offer various maintenance and support packages to ensure your project continues to run smoothly after launch. We can discuss these options during our consultation.'
                        ]
                    ];
                    @endphp

                    @foreach($faqs as $faq)
                    <div class="bg-gray-50 rounded-lg p-6 hover:shadow-md transition-shadow duration-300">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $faq['question'] }}</h3>
                        <p class="text-gray-600">{{ $faq['answer'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
