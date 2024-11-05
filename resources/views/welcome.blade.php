<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Magang</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-gray-900 text-white">
    <!-- Header -->
    <header class="fixed w-full z-50 bg-opacity-90 bg-gray-800 backdrop-filter backdrop-blur-lg">
        <nav class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold text-blue-400">DIGIMIZU</div>
                <div class="hidden md:flex space-x-4">
                    <a href="#about" class="text-gray-300 hover:text-blue-400 transition duration-300">Tentang</a>
                    <a href="#features" class="text-gray-300 hover:text-blue-400 transition duration-300">Fitur</a>
                    <a href="#contact" class="text-gray-300 hover:text-blue-400 transition duration-300">Kontak</a>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition duration-300">Login</a>
                    <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition duration-300">Daftar</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gray-900 text-white" style="height: 100vh;">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2784&q=80" alt="Background" class="w-full h-full object-cover opacity-10">
        </div>
        <div class="relative container mx-auto px-6 py-32 flex flex-col justify-center items-center text-center h-full">
            <h1 class="text-5xl md:text-6xl font-bold mb-4 leading-tight">Sistem Informasi <span class="text-blue-400">Magang</span></h1>
            <p class="text-xl mb-8 max-w-3xl">Tingkatkan pengalaman magang Anda dengan platform manajemen yang efisien dan modern. Kami menyediakan solusi terbaik untuk mahasiswa dan perusahaan.</p>
            <a href="#features" class="bg-blue-600 text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-blue-700 transition duration-300 transform hover:scale-105">Pelajari Lebih Lanjut</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-gray-800">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12 text-blue-400">Tentang Kami</h2>
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Visi Kami</h3>
                    <p class="text-gray-300 mb-6">Menjadi platform terdepan dalam memfasilitasi pengalaman magang yang bermakna dan bermanfaat bagi mahasiswa dan perusahaan di era digital.</p>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Misi Kami</h3>
                    <ul class="text-gray-300 list-disc list-inside space-y-2">
                        <li>Menyediakan sistem manajemen magang yang efisien dan user-friendly</li>
                        <li>Memfasilitasi kolaborasi antara mahasiswa dan perusahaan</li>
                        <li>Meningkatkan kualitas program magang di Indonesia</li>
                        <li>Mendukung pengembangan skill dan karir mahasiswa</li>
                    </ul>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1471&q=80" alt="Team" class="rounded-lg shadow-xl">
                    <div class="absolute -bottom-4 -right-4 bg-blue-600 text-white py-2 px-4 rounded-md">
                        Bersama Kita Bisa
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-900">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12 text-blue-400">Fitur Utama</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-800 rounded-lg shadow-md p-6 transform hover:scale-105 transition duration-300">
                    <div class="text-blue-400 text-4xl mb-4">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-white">Manajemen Absensi</h3>
                    <p class="text-gray-300">Catat dan pantau kehadiran peserta magang dengan mudah dan akurat menggunakan sistem absensi digital kami.</p>
                </div>
                <div class="bg-gray-800 rounded-lg shadow-md p-6 transform hover:scale-105 transition duration-300">
                    <div class="text-blue-400 text-4xl mb-4">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-white">Evaluasi Kinerja</h3>
                    <p class="text-gray-300">Lakukan penilaian dan evaluasi kinerja peserta magang secara berkala dengan tools evaluasi yang komprehensif.</p>
                </div>
                <div class="bg-gray-800 rounded-lg shadow-md p-6 transform hover:scale-105 transition duration-300">
                    <div class="text-blue-400 text-4xl mb-4">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-white">Laporan & Analitik</h3>
                    <p class="text-gray-300">Dapatkan insight melalui laporan dan analitik yang komprehensif untuk pengambilan keputusan yang lebih baik.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-blue-600 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Siap untuk Memulai?</h2>
            <p class="text-xl mb-8">Daftarkan diri Anda sekarang dan tingkatkan pengalaman magang Anda!</p>
            <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-3 rounded-full text-lg font-semibold hover:bg-gray-100 transition duration-300 transform hover:scale-105">Daftar Sekarang</a>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gray-800">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12 text-blue-400">Hubungi Kami</h2>
            <div class="max-w-md mx-auto">
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Nama</label>
                        <input type="text" id="name" name="name" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-300">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-300">Pesan</label>
                        <textarea id="message" name="message" rows="4" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800">Kirim Pesan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap justify-between">
                <div class="w-full md:w-1/3 mb-6 md:mb-0">
                    <h3 class="text-xl font-bold mb-2">Sistem Informasi Magang</h3>
                    <p class="text-gray-400">Platform manajemen magang terbaik untuk mahasiswa dan perusahaan.</p>
                </div>
                <div class="w-full md:w-1/3 mb-6 md:mb-0">
                    <h3 class="text-xl font-bold mb-2">Tautan Cepat</h3>
                    <ul class="text-gray-400">
                        <li><a href="#about" class="hover:text-blue-400">Tentang</a></li>
                        <li><a href="#features" class="hover:text-blue-400">Fitur</a></li>
                        <li><a href="#contact" class="hover:text-blue-400">Kontak</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/3">
                    <h3 class="text-xl font-bold mb-2">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-400">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-sm text-center text-gray-400">
                <p>&copy; 2024 Sistem Informasi Magang. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>