<x-magang-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Izin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="mt-8 text-2xl text-gray-800 dark:text-gray-200">
                        Izin {{ Auth::user()->name }}
                    </div>

                    <div class="mt-6 text-gray-500 dark:text-gray-400">
                        Ini adalah form untuk melakukan Izin
                    </div>

                    <form action="{{ route('izin.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <div class="mb-4">
                            <x-label for="dari_tanggal" value="{{ __('Dari Tanggal') }}" />
                            <x-input id="dari_tanggal" class="block mt-1 w-full" type="date" name="dari_tanggal" required />
                        </div>
                        <div class="mb-4">
                            <x-label for="sampai_tanggal" value="{{ __('Sampai Tanggal') }}" />
                            <x-input id="sampai_tanggal" class="block mt-1 w-full" type="date" name="sampai_tanggal" required />
                        </div>
                        <div class="mb-4">
                            <x-label for="status_absen" value="{{ __('Status Absen') }}" />
                            <x-input id="status_absen" class="block mt-1 w-full" type="text" name="status_absen" value="Izin" required readonly />
                        </div>
                        <div class="mb-4">
                            <x-label for="keterangan" value="{{ __('Keterangan') }}" />
                            <x-text-input id="keterangan" class="block mt-1 w-full" name="keterangan" placeholder="Masukkan keterangan absensi (opsional)"></x-text-input>
                        </div>
                        <div class="mb-4">
                            <x-label for="foto" value="{{ __('Foto Izin') }}" />
                            <x-input id="foto" class="block mt-1 w-full" type="file" name="foto" required />
                        </div>
                        <x-button type="submit">
                            {{ __('Submit Izin') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-magang-layout>
