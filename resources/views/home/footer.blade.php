<!-- Footer -->
<footer class="bg-gray-900 text-white">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div>
                <div class="flex items-center mb-4">
                    <div class="h-8 w-8 rounded-md bg-[#39AA80] flex items-center justify-center mr-2">
                        <span class="text-white font-bold">G</span>
                    </div>
                    <span class="font-bold text-xl">GreenTech</span>
                </div>
                <p class="text-gray-400 mb-4">
                    Transforming businesses through innovative digital solutions and exceptional user experiences.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-[#39AA80] transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                        <span class="sr-only">Facebook</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[#39AA80] transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path></svg>
                        <span class="sr-only">Twitter</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[#39AA80] transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        <span class="sr-only">Instagram</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[#39AA80] transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                        <span class="sr-only">LinkedIn</span>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4 border-b border-gray-700 pb-2">Quick Links</h3>
                <ul class="space-y-2">
                    @foreach(['Home', 'About Us', 'Services', 'Portfolio', 'Blog', 'Contact'] as $item)
                    <li>
                        <a href="" class="text-gray-400 hover:text-[#39AA80] transition-colors duration-200">
                            {{ $item }}
                            <!-- {{ url('/#' . strtolower(str_replace(' ', '-', $item))) }} -->
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h3 class="text-lg font-semibold mb-4 border-b border-gray-700 pb-2">Our Services</h3>
                <ul class="space-y-2">
                    @foreach(['Web Development', 'Mobile Apps', 'UI/UX Design', 'E-commerce', 'Digital Marketing', 'Cloud Solutions'] as $item)
                    <li>
                        <a href="" class="text-gray-400 hover:text-[#39AA80] transition-colors duration-200">
                            {{ $item }}
                            <!-- {{ url('/services#' . strtolower(str_replace(' ', '-', $item))) }} -->
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-semibold mb-4 border-b border-gray-700 pb-2">Contact Us</h3>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#39AA80] mr-3 mt-0.5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <span class="text-gray-400">123 Innovation Street, Tech City, TC 12345</span>
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#39AA80] mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        <span class="text-gray-400">+1 (555) 123-4567</span>
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#39AA80] mr-3" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
                        <span class="text-gray-400">info@greentech.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-gray-800 text-center text-gray-400">
            <p>© {{ date('Y') }} GreenTech. All rights reserved.</p>
            <div class="mt-2 flex justify-center space-x-4 text-sm">
                <a href="" class="hover:text-[#39AA80] transition-colors duration-200">
                    Privacy Policy
                    <!-- {{ url('/privacy-policy') }} -->
                </a>
                <a href="" class="hover:text-[#39AA80] transition-colors duration-200">
                    Terms of Service
                    <!-- {{ url('/terms-of-service') }} -->
                </a>
                <a href="" class="hover:text-[#39AA80] transition-colors duration-200">
                    Cookies Policy
                    <!-- {{ url('/cookies-policy') }} -->
                </a>
            </div>
        </div>
    </div>
</footer>
