@props(['disabled' => false])

<div x-data="{ fileName: '' }" class="flex items-center">
    <label for="{{ $attributes->get('id') }}" class="flex items-center justify-center px-4 py-2 bg-white text-blue-500 rounded-lg shadow-lg tracking-wide uppercase border border-blue-500 cursor-pointer hover:bg-blue-500 hover:text-white">
        <svg class="w-6 h-6 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
        </svg>
        <span class="text-base leading-normal">Pilih file</span>
    </label>
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'hidden']) !!}
           type="file" x-ref="file" @change="fileName = $refs.file.files[0].name">
    <div class="ml-3 text-gray-600 dark:text-gray-400" x-text="fileName || 'Tidak ada file dipilih'"></div>
</div>