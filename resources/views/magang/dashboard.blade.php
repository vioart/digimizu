{{-- <x-magang-layout>
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
                            <x-button id="openValidation">
                                {{ __('Absensi') }}
                            </x-button>

                            <x-button id="openIzinValidation" class="ml-2 bg-yellow-500">
                                {{ __('Ajukan Izin') }}
                            </x-button>


                            <div id="validationAbsensi" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
                                <div class="bg-white rounded-lg p-6 shadow-lg">
                                    <h2 class="text-xl font-semibold mb-4">Masukkan Token</h2>
                                    <form id="tokenFormAbsensi" method="POST" action="{{ route('absensi.validateToken') }}">
                                        @csrf
                                        <div class="mb-4">
                                            <x-label for="token" value="{{ __('Token') }}" />
                                            <x-text-input id="token" class="block mt-1 w-full" name="token" required />
                                        </div>
                                        <div class="flex space-x-4">
                                            <x-button type="submit" class="w-1/2 h-12 flex items-center justify-center">{{ __('Submit') }}</x-button>
                                            <x-button id="closeValidationAbsensi" class="w-1/2 h-12 bg-red-500 text-white flex items-center justify-center">{{ __('Tutup') }}</x-button>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>

                            <div id="validationIzin" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
                                <div class="bg-white rounded-lg p-6 shadow-lg">
                                    <h2 class="text-xl font-semibold mb-4">Masukkan Token Izin</h2>
                                    <form id="tokenFormIzin" method="POST" action="{{ route('izin.validateToken') }}">
                                        @csrf
                                        <div class="mb-4">
                                            <x-label for="token" value="{{ __('Token') }}" />
                                            <x-text-input id="token" class="block mt-1 w-full" name="token" required />
                                        </div>
                                        <div class="flex space-x-4">
                                            <x-button type="submit" class="w-1/2 h-12 flex items-center justify-center">{{ __('Submit') }}</x-button>
                                            <x-button id="closeValidationIzin" class="w-1/2 h-12 bg-red-500 text-white flex items-center justify-center">{{ __('Tutup') }}</x-button>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>

                            <script>
                                document.getElementById('openValidation').onclick = function() {
                                    document.getElementById('validationAbsensi').classList.remove('hidden');
                                    document.getElementById('tokenFormAbsensi').action = "{{ route('absensi.validateToken') }}";
                                };

                                document.getElementById('closeValidationAbsensi').onclick = function() {
                                    document.getElementById('validationAbsensi').classList.add('hidden');
                                };

                                document.getElementById('openIzinValidation').onclick = function() {
                                    document.getElementById('validationIzin').classList.remove('hidden');
                                    document.getElementById('tokenFormIzin').action = "{{ route('izin.validateToken') }}";
                                };

                                document.getElementById('closeValidationIzin').onclick = function() {
                                    document.getElementById('validationIzin').classList.add('hidden');
                                };

                                
                            </script>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-magang-layout>