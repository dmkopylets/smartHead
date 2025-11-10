<div class="mb-4">
    @if($label ?? false)
        <label class="block text-sm font-medium text-gray-700 mb-1" for="{{ $name }}">{{ $label }}</label>
    @endif

    <input
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes->merge([
            'class' => 'block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm'
        ]) }}
    >

    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
