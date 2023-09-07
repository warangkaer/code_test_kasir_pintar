@props(['disabled' => false, 'placeholder' => ''])

<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-secondary focus:ring-secondary rounded-md shadow-sm', 'placeholder' => $placeholder]) !!}>
