<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Silakan jawab 10 pertanyaan berikut untuk menyelesaikan pendaftaran.') }}
        </div>

        <form method="POST" action="{{ route('registration.submit-test', ['id' => $id]) }}">
            @csrf

            @foreach($soalTest as $index => $soal)
                <div class="mt-4">
                    <x-label for="soal_{{ $soal->id }}" value="{{ $index + 1 }}. {{ $soal->pertanyaan }}" />
                    <div class="mt-2 space-y-2">
                        <label class="inline-flex items-center">
                            <input type="radio" class="form-radio" name="answers[{{ $soal->id }}]" value="a" required>
                            <span class="ml-2 text-gray-700 dark:text-gray-300">{{ $soal->pilihan_a }}</span>
                        </label>
                    </div>
                    <div class="mt-2 space-y-2">
                        <label class="inline-flex items-center">
                            <input type="radio" class="form-radio" name="answers[{{ $soal->id }}]" value="b">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">{{ $soal->pilihan_b }}</span>
                        </label>
                    </div>
                    <div class="mt-2 space-y-2">
                        <label class="inline-flex items-center">
                            <input type="radio" class="form-radio" name="answers[{{ $soal->id }}]" value="c">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">{{ $soal->pilihan_c }}</span>
                        </label>
                    </div>
                    <div class="mt-2 space-y-2">
                        <label class="inline-flex items-center">
                            <input type="radio" class="form-radio" name="answers[{{ $soal->id }}]" value="d">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">{{ $soal->pilihan_d }}</span>
                        </label>
                    </div>
                </div>
            @endforeach

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Kirim Jawaban') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>