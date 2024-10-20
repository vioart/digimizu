<x-magang-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pengajuan Izin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <form action="{{ route('izin.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-label for="tanggal" value="{{ __('Tanggal Izin') }}" />
                                <x-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal" :value="old('tanggal')" required />
                            </div>

                            <div>
                                <x-label for="alasan" value="{{ __('Alasan') }}" />
                                <textarea id="alasan" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="alasan" required>{{ old('alasan') }}</textarea>
                            </div>

                            <div>
                                <x-label for="bukti" value="{{ __('Bukti (File/Foto)') }}" />
                                <x-input-file id="bukti" class="block mt-1 w-full" name="bukti" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Ajukan Izin') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-magang-layout>