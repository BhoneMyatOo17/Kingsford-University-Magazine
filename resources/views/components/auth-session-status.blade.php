@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'mb-4 p-4 rounded-md bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800']) }}>
        <p class="text-sm text-green-600 dark:text-green-400">{{ $status }}</p>
    </div>
@endif