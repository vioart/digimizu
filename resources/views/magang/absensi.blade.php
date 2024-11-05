<x-magang-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Absensi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="mt-8 text-2xl text-gray-800 dark:text-gray-200">
                        Absensi {{ Auth::user()->name }}
                    </div>

                    <div class="mt-6 text-gray-500 dark:text-gray-400">
                        Ini adalah form untuk melakukan absensi
                    </div>

                    <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <div class="mb-4">
                            <x-label for="tanggal" value="{{ __('Tanggal') }}" />
                            <x-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal" value="{{ now()->toDateString() }}" required readonly />
                        </div>
                        <div class="mb-4">
                            <x-label for="waktu" value="{{ __('Waktu') }}" />
                            <x-input id="waktu" class="block mt-1 w-full" type="time" name="waktu" value="{{ now()->toTimeString() }}" required readonly />
                        </div>
                        <div class="mb-4">
                            <x-label for="status_absen" value="{{ __('Status Absen') }}" />
                            <select id="status_absen" name="status_absen" class="block mt-1 w-full">
                                <option value="absen">Absen</option>
                                <option value="izin">Izin</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <x-label for="keterangan" value="{{ __('Keterangan') }}" />
                            <x-text-input id="keterangan" class="block mt-1 w-full" name="keterangan" placeholder="Masukkan keterangan absensi (opsional)"></x-text-input>
                        </div>
                        <div class="mb-4">
                            <x-label for="foto" value="{{ __('Foto Absensi') }}" />
                            <x-input id="foto" class="block mt-1 w-full" type="file" name="foto" required />
                        </div>
                        <x-button type="submit">
                            {{ __('Submit Absensi') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-magang-layout>
