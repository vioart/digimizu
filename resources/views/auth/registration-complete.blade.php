<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Terima kasih telah mendaftar dan menyelesaikan tes.') }}
        </div>

        <div class="mb-4 text-lg font-semibold">
            <p class="text-gray-800 dark:text-gray-200">{{ __('Skor Anda:') }} <span class="text-indigo-600 dark:text-indigo-400">{{ $calonMagang->test_score }} / 10</span></p>
        </div>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Pendaftaran Anda telah disimpan. Silakan tunggu persetujuan dari admin untuk dapat login ke sistem.') }}
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('welcome') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 active:bg-gray-900 dark:active:bg-gray-300 disabled:opacity-25 transition">
                {{ __('Kembali ke Beranda') }}
            </a>
        </div>
    </x-authentication-card>
</x-guest-layout>