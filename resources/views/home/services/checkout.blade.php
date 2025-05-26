@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-[#39AA80] to-[#2C8A68] text-white py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">Payment</h1>
                <p class="text-xl text-white/90">
                    Complete your payment to proceed with your service booking.
                </p>
            </div>
        </div>
    </section>

    <!-- Payment Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="md:flex">
                        <!-- Order Summary -->
                        <div class="md:w-1/2 bg-gray-50 p-8">
                            <h2 class="text-2xl font-bold mb-6">Order Summary</h2>
                            
                            <div class="border-b border-gray-200 pb-4 mb-4">
                                <h3 class="font-semibold text-lg mb-2">{{ $booking->service_name ?? 'Web Design & Development' }}</h3>
                                <p class="text-gray-600 mb-4">Booking #{{ $booking->id ?? 'BK-'.rand(10000, 99999) }}</p>
                                
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Service Type:</span>
                                        <span class="font-medium">{{ $booking->service_name ?? 'Web Design & Development' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Timeline:</span>
                                        <span class="font-medium">{{ $booking->timeline ?? '2-4 weeks' }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="space-y-2 mb-6">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal:</span>
                                    <span>${{ $booking->subtotal ?? '2,000.00' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tax (10%):</span>
                                    <span>${{ $booking->tax ?? '200.00' }}</span>
                                </div>
                                <div class="flex justify-between font-bold text-lg pt-2 border-t border-gray-200">
                                    <span>Total:</span>
                                    <span>${{ $booking->total ?? '2,200.00' }}</span>
                                </div>
                            </div>
                            
                            <div class="bg-[#39AA80]/10 p-4 rounded-md">
                                <div class="flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#39AA80] mr-2 mt-0.5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                    <div>
                                        <p class="text-sm text-gray-700">This is a 50% deposit payment to initiate your project. The remaining balance will be due upon project completion.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payment Form -->
                        <div class="md:w-1/2 p-8">
                            <h2 class="text-2xl font-bold mb-6">Payment Details</h2>
                            
                            <form action="{{ route('payment.process') }}" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{ $booking->id ?? '12345' }}">
                                
                                <div>
                                    <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                                    <div class="grid grid-cols-3 gap-4 mb-4">
                                        <div class="border border-gray-300 rounded-md p-3 flex items-center justify-center cursor-pointer bg-white hover:border-[#39AA80] transition-colors">
                                            <input type="radio" name="payment_method" id="credit_card" value="credit_card" class="sr-only" checked>
                                            <label for="credit_card" class="cursor-pointer flex flex-col items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 mb-1" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                                <span class="text-xs">Credit Card</span>
                                            </label>
                                        </div>
                                        <div class="border border-gray-300 rounded-md p-3 flex items-center justify-center cursor-pointer bg-white hover:border-[#39AA80] transition-colors">
                                            <input type="radio" name="payment_method" id="paypal" value="paypal" class="sr-only">
                                            <label for="paypal" class="cursor-pointer flex flex-col items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 mb-1" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7.144 19.532l1.049-5.751c.11-.606.691-1.002 1.304-.948 2.155.192 6.877.1 8.818-4.002 2.554-5.397-.59-7.769-6.295-7.769H7.43a1.97 1.97 0 0 0-1.944 1.655L2.77 19.5a1.35 1.35 0 0 0 1.335 1.5h9.592a1.35 1.35 0 0 0 1.335-1.5l-.27-1.5"></path><path d="M15.5 7h2a3.5 3.5 0 0 1 0 7h-2"></path></svg>
                                                <span class="text-xs">PayPal</span>
                                            </label>
                                        </div>
                                        <div class="border border-gray-300 rounded-md p-3 flex items-center justify-center cursor-pointer bg-white hover:border-[#39AA80] transition-colors">
                                            <input type="radio" name="payment_method" id="bank_transfer" value="bank_transfer" class="sr-only">
                                            <label for="bank_transfer" class="cursor-pointer flex flex-col items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 mb-1" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                                <span class="text-xs">Bank Transfer</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Credit Card Details -->
                                <div id="credit_card_details">
                                    <div class="mb-4">
                                        <label for="card_name" class="block text-sm font-medium text-gray-700 mb-1">Name on Card</label>
                                        <input type="text" id="card_name" name="card_name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#39AA80] focus:border-[#39AA80]" required>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="card_number" class="block text-sm font-medium text-gray-700 mb-1">Card Number</label>
                                        <input type="text" id="card_number" name="card_number" placeholder="XXXX XXXX XXXX XXXX" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#39AA80] focus:border-[#39AA80]" required>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="expiry_date" class="block text-sm font-medium text-gray-700 mb-1">Expiry Date</label>
                                            <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#39AA80] focus:border-[#39AA80]" required>
                                        </div>
                                        <div>
                                            <label for="cvv" class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                                            <input type="text" id="cvv" name="cvv" placeholder="XXX" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#39AA80] focus:border-[#39AA80]" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="pt-4">
                                    <button type="submit" class="w-full py-3 px-4 bg-[#39AA80] hover:bg-[#39AA80]/90 text-white font-medium rounded-md transition-colors">
                                        Pay ${{ $booking->total ?? '2,200.00' }}
                                    </button>
                                    <p class="text-sm text-gray-500 mt-2 text-center">Your payment information is secure and encrypted.</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
        const creditCardDetails = document.getElementById('credit_card_details');
        
        paymentMethods.forEach(method => {
            method.addEventListener('change', function() {
                if (this.value === 'credit_card') {
                    creditCardDetails.style.display = 'block';
                } else {
                    creditCardDetails.style.display = 'none';
                }
                
                // Add active class to selected payment method
                document.querySelectorAll('input[name="payment_method"]').forEach(input => {
                    const parent = input.parentElement;
                    if (input.checked) {
                        parent.classList.add('border-[#39AA80]', 'bg-[#39AA80]/5');
                    } else {
                        parent.classList.remove('border-[#39AA80]', 'bg-[#39AA80]/5');
                    }
                });
            });
        });
        
        // Initialize the active state
        document.querySelector('input[name="payment_method"]:checked').parentElement.classList.add('border-[#39AA80]', 'bg-[#39AA80]/5');
    });
</script>
@endsection
