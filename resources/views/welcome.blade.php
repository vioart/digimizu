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
                    <a href="#faq" class="text-gray-300 hover:text-blue-400 transition duration-300">FAQ</a>
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
    <section id="about" class="relative bg-gray-900 text-white" style="height: 100vh;">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2784&q=80" alt="Background" class="w-full h-full object-cover opacity-10">
        </div>
        <div class="relative container mx-auto px-6 py-32 flex flex-col justify-center items-center text-center h-full">
            <h1 class="text-5xl md:text-6xl font-bold mb-4 leading-tight">Sistem Informasi <span class="text-blue-400">Magang</span></h1>
            <p class="text-xl mb-8 max-w-3xl">Tingkatkan pengalaman magang Anda dengan platform manajemen yang efisien dan modern. Kami menyediakan solusi terbaik untuk mahasiswa dan perusahaan.</p>
            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-blue-700 transition duration-300 transform hover:scale-105">Daftar Sekarang</a>
        </div>
    </section>

    <section id="faq" class="py-20 bg-gray-700">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12 text-blue-400">Langkah-langkah Pendaftaran Magang</h2>
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-semibold mb-4 text-white">1. Daftar</h3>
                    <p class="text-gray-300 mb-6">Isi formulir pendaftaran untuk memulai proses magang. Anda dapat mendaftar langsung melalui sistem kami.</p>
                    <h3 class="text-2xl font-semibold mb-4 text-white">2. Ikuti Tes</h3>
                    <p class="text-gray-300 mb-6">Setelah mendaftar, Anda akan mengikuti tes untuk mengukur kemampuan Anda sesuai dengan program magang yang dipilih.</p>
                    <h3 class="text-2xl font-semibold mb-4 text-white">3. Konfirmasi Admin via WhatsApp</h3>
                    <p class="text-gray-300 mb-6">Setelah tes selesai, Anda akan menerima instruksi lebih lanjut dan konfirmasi dari admin melalui WhatsApp. 
                        <a href="https://wa.me/6282140917491?text=Halo%20Admin%2C%20Saya%20ingin%20konfirmasi%20untuk%20program%20magang" 
                           class="text-blue-400 hover:text-blue-600">Klik di sini untuk menghubungi admin via WhatsApp.</a>
                    </p>
                    <h3 class="text-2xl font-semibold mb-4 text-white">4. Pemberitahuan Hasil</h3>
                    <p class="text-gray-300 mb-6">Kami akan memberitahukan apakah Anda diterima atau tidak untuk mengikuti program magang melalui WhatsApp atau email.</p>
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

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gray-800">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12 text-blue-400">Hubungi Kami</h2>
            <div class="max-w-md mx-auto">
                <form action="https://wa.me/6282140917491?text=Halo%20Admin%2C%20Saya%20ingin%20bertanya" method="get" class="space-y-4">
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
            <div class="border-t border-gray-800 mt-8 pt-8 text-sm text-center text-gray-400">
                <p>&copy; 2024 Sistem Informasi Magang. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>