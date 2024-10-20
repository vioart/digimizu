{{-- <x-magang-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="mt-8 text-2xl text-gray-800 dark:text-gray-200">
                        Selamat datang, {{ Auth::user()->name }}!
                    </div>

                    <div class="mt-6 text-gray-500 dark:text-gray-400">
                        Ini adalah dashboard anggota magang. Di sini Anda dapat melihat informasi terkait magang Anda.
                    </div>
                </div>

                <div class="bg-gray-200 dark:bg-gray-700 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Statistik Magang</h3>
                        <p class="text-gray-600 dark:text-gray-400">Hari Magang ke: {{ $dayCount }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Jumlah Hadir: {{ $presentCount }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Jumlah Tidak Hadir: {{ $absentCount }}</p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Absensi Hari Ini</h3>
                        @if($todayAttendance)
                            <p class="text-green-600 dark:text-green-400">Anda sudah absen pada {{ $todayAttendance->created_at->format('H:i') }}</p>
                        @else
                            <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <x-label for="foto" value="{{ __('Foto Absensi') }}" />
                                    <x-input-file id="foto" class="block mt-1 w-full" name="foto" required />
                                </div>
                                <x-button type="submit">
                                    {{ __('Absen Sekarang') }}
                                </x-button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-magang-layout> --}}
<x-magang-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="mt-8 text-2xl text-gray-800 dark:text-gray-200">
                        Selamat datang, {{ Auth::user()->name }}!
                    </div>

                    <div class="mt-6 text-gray-500 dark:text-gray-400">
                        Ini adalah dashboard anggota magang. Di sini Anda dapat melihat informasi terkait magang Anda.
                    </div>
                </div>

                <div class="bg-gray-200 dark:bg-gray-700 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Statistik Magang</h3>
                        <p class="text-gray-600 dark:text-gray-400">Hari Magang ke: {{ $dayCount }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Jumlah Hadir: {{ $presentCount }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Jumlah Izin: {{ $permissionCount }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Jumlah Tidak Hadir: {{ $absentCount }}</p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Absensi atau Izin Hari Ini</h3>
                        @if($todayAttendance)
                            <p class="text-green-600 dark:text-green-400">Anda sudah absen pada {{ $todayAttendance->waktu }}</p>
                        @elseif($todayPermission)
                            <p class="text-blue-600 dark:text-blue-400">Anda sudah mengajukan izin untuk hari ini</p>
                        @else
                            <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                                @csrf
                                <div class="mb-4">
                                    <x-label for="foto" value="{{ __('Foto Absensi') }}" />
                                    <x-input id="foto" class="block mt-1 w-full" type="file" name="foto" required />
                                </div>
                                <x-button type="submit">
                                    {{ __('Absen Sekarang') }}
                                </x-button>
                            </form>

                            <a href="{{ route('izin') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{ __('Ajukan Izin') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-magang-layout>