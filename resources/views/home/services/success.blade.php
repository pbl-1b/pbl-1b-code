<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EmpCarbon - Service Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'outfit': ['-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'],
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
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        /* Shadow with blue tint */
        .shadow-blue-100 {
            box-shadow: 0 1px 3px 0 rgba(59, 130, 246, 0.1), 0 1px 2px 0 rgba(59, 130, 246, 0.06);
        }
        
        .shadow-green-100 {
            box-shadow: 0 1px 3px 0 rgba(34, 197, 94, 0.1), 0 1px 2px 0 rgba(34, 197, 94, 0.06);
        }
    </style>
    
</head>
<body class="bg-gray-50 font-outfit">
    <div x-data="{ 
        selectedService: null,
        email: '',
        companyName: '',
        latitude: '',
        longitude: '',
        showPassword: false,
        showConfirmPassword: false,
        errors: {},
        
        selectService(serviceId) {
            this.selectedService = serviceId;
            if (this.errors.service) {
                delete this.errors.service;
            }
        },
        
        validateForm() {
            this.errors = {};
            
            if (!this.email) {
                this.errors.email = 'Email is required';
            } else if (!/\S+@\S+\.\S+/.test(this.email)) {
                this.errors.email = 'Email is invalid';
            }
            
            if (!this.selectedService) {
                this.errors.service = 'Please select a service plan';
            }
            
            return Object.keys(this.errors).length === 0;
        },
        
        {{-- submitForm() {
            if (this.validateForm()) {
                const selectedPlan = this.services.find(s => s.id === this.selectedService);
                alert(`Registration successful for ${selectedPlan.name}! Redirecting to payment...`);
            }
        }, --}}
        
        getSelectedService() {
            return this.services.find(s => s.id === this.selectedService);
        }
    }">
        <!-- Header -->
        <header class="bg-white border-b border-gray-300 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <button class="mr-2 p-2 rounded-md text-gray-600 hover:bg-gray-100">
                            <a href="{{ url('/') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                        </button>
                        <div class="flex items-center">
                            <a href="{{ url('/') }}" class="flex items-center">
                                <div class="h-8 w-8 rounded-md flex items-center justify-center mr-2">
                                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-cover">
                                </div>
                                <span class="font-bold text-xl text-[#39AA80]">ComCarbon</span>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-lg font-semibold text-gray-800">Service Registration Success</h1>
                    </div>
                    <div class="w-24"></div> <!-- Empty div for balance -->
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Registration Section -->
            <div class="bg-white rounded-md shadow-sm shadow-blue-100 border border-gray-300 p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Registration Details</h2>

                <!-- Payment Security Notice -->
                    <div class="flex items-center gap-2 p-4 bg-green-50 mb-4 rounded-md border border-green-100">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg> --}}
                        <p class="text-sm text-green-700">
                            Company Account successfully Created and Saved, The Detail of Invoice Already Been Sended To Company Email
                        </p>
                    </div>

                    <!-- Submit Button -->
                    <a href="{{ route('register')}}" class="pt-4 border-t mt-4 border-gray-200">
                        <button
                            class="w-full md:w-auto bg-[#39AA80] hover:bg-[#39AA80] text-white px-6 py-2 rounded-md border border-[#39AA80] shadow-sm shadow-blue-50 flex items-center justify-center gap-2 transition-colors"
                        >
                            <span>Sign Up Staff Account Now</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </button>
                    </a>
            </div>
        </main>
    </div>

    <div id="mapModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded shadow-lg w-[90%] h-[80%] relative">
            <div class="p-4 font-bold border-b">Tentukan Lokasi</div>
            <div id="map" class="w-full h-[80%]"></div>
            <div class="p-4 flex justify-end gap-2 border-t">
                <button onclick="closeMapModal()" class="bg-gray-400 text-white px-4 py-2 rounded">Batal</button>
                <button onclick="submitLocation()" class="bg-green-500 text-white px-4 py-2 rounded">OK</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="status-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-full max-w-md rounded-xl shadow-xl p-6 relative">
            <div class="flex justify-between items-center border-b border-gray-200 pb-3 mb-4">
                <h3 class="text-xl font-semibold text-gray-900" id="modal-title">Status</h3>
                <button id="modal-close" class="text-gray-500 hover:text-gray-700 text-2xl leading-none font-semibold">&times;</button>
            </div>
            <p class="text-sm text-gray-700" id="modal-message">Pesan akan muncul di sini.</p>
            <div class="mt-5 text-right">
                <button id="modal-ok" class="bg-[] hover:bg-green-600 text-white px-4 py-2 rounded-md transition">
                    OK
                </button>
            </div>
        </div>
    </div>

    <script>
        let map, marker;
        let selectedLat, selectedLng;

        function openMapModal() {
            document.getElementById('mapModal').classList.remove('hidden');
            setTimeout(initMap, 100); // Delay agar modal siap
        }

        function closeMapModal() {
            document.getElementById('mapModal').classList.add('hidden');
        }

        function initMap() {
            if (map) return; // Sudah pernah dibuka
            map = L.map('map').setView([-0.9471, 100.4172], 13); // Titik awal (Padang)

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            map.on('click', function(e) {
                selectedLat = e.latlng.lat;
                selectedLng = e.latlng.lng;

                if (marker) {
                    marker.setLatLng(e.latlng);
                } else {
                    marker = L.marker(e.latlng).addTo(map);
                }
            });
        }

        function submitLocation() {
            if (!selectedLat || !selectedLng) {
                alert("Silakan pilih lokasi di peta terlebih dahulu.");
                return;
            }

            document.getElementById('latitude').value = selectedLat;
            document.getElementById('longitude').value = selectedLng;

            closeMapModal();
            // document.getElementById('locationForm').submit();
        }
    </script>

    <script>
        const payButton = document.getElementById('pay-button');
        const form = document.getElementById('payment-form');

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            let savedToken = localStorage.getItem('snap_token');

            if (savedToken) {
                launchSnap(savedToken);
            } else {
                let formData = new FormData(form);

                fetch('{{ route('getSnapToken') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.token) {
                        localStorage.setItem('snap_token', data.token);
                        launchSnap(data.token);
                    } else {
                        alert("Gagal mendapatkan token pembayaran.");
                        console.error(data);
                    }
                })
                .catch(error => {
                    alert("Kesalahan saat mengambil snap token.");
                    console.error(error);
                });
            }
        });

        function launchSnap(token) {
            snap.pay(token, {
                onSuccess: function(result) {
                    showModal("Pembayaran Berhasil", "Data perusahaan akan disimpan...");

                    // Ambil data dari form
                    let formData = new FormData(document.getElementById('payment-form'));
                    formData.append('order_id', result.order_id); // Optional: kirim order_id dari Midtrans

                    fetch('/insertcompany', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(response => {
                        console.log(response);
                        showModal("Pembayaran Berhasil", "Data Perusahaan Berhasil Disimpan");
                        localStorage.removeItem('snap_token'); // Bersihkan token
                        // Optional: redirect atau reset form
                        // window.location.href = '/thanks';

                        fetch('/set-payment-success', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                            body: JSON.stringify({ order_id: result.order_id }) // bisa disesuaikan
                        }).then(() => {
                            setTimeout(() => {
                                window.location.href = "{{ route('register.success') }}";
                            }, 5000);
                        });
                    })
                    .catch(error => {
                        showModal("Sukses", "Pembayaran Sukses Namun Data Perusahaan Gagal Disimpan.");
                        console.error(error);
                    });
                },
                onPending: function(result) {
                    showModal("Pembayaran Tertunda", "Pembayaran Anda sedang diproses. Harap tunggu.");
                },
                onError: function(result) {
                    showModal("Kesalahan Pembayaran", "Terjadi kesalahan saat memproses pembayaran.");
                    console.log(result);
                    localStorage.removeItem('snap_token');
                },
                onClose: function() {
                    showModal("Dibatalkan", "Anda menutup popup pembayaran sebelum menyelesaikannya.");
                }
            });
        }

    </script>

    <script>
        function showModal(title, message) {
            const modal = document.getElementById('status-modal');
            const titleEl = document.getElementById('modal-title');
            const messageEl = document.getElementById('modal-message');

            titleEl.textContent = title;
            messageEl.textContent = message;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('status-modal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        // Attach event listeners
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('modal-close').addEventListener('click', closeModal);
            document.getElementById('modal-ok').addEventListener('click', closeModal);
        });
    </script>

</body>
</html>
