@props([
    'label' => '',
    'name',
    'placeholder' => 'mm/dd/yyyy',
    'value' => '',
    'error' => false,
    'class' => '',
    'labelClass' => '',
])

<div class="{{ $class }}">
    @if ($label)
        <label for="{{ $name }}"
            {{ $attributes->merge(['class' => 'block ml-1 text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 ' . $labelClass]) }}>
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        <input
            {{-- Initialize Flatpickr via Alpine.js --}}
            x-data
            x-init="flatpickr($el, {
                dateFormat: 'm/d/Y',
                altInput: true,
                altFormat: 'F j, Y',
            })"
            id="{{ $name }}"
            name="{{ $name }}"
            type="text"
            placeholder="{{ $placeholder }}"
            value="{{ $value }}"
            {{-- Merge classes for styling --}}
            {{ $attributes->merge([
                'class' => 'w-full pl-4 pr-10 py-1.5 rounded-lg text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent'
            ]) }}
        >

        {{-- Calendar Icon --}}
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18M-4.5 12h22.5" />
            </svg>
        </div>
    </div>

    @error($name)
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>
