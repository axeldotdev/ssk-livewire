@props(['provider', 'classes'])

<template>
    <div class="text-neutral-800 dark:text-neutral-100">
        @if ($provider->id === 'google')
        <x-google-icon :class="$classes" />
        @endif

        @if ($provider->id === 'microsoft')
        <x-microsoft-icon :class="$classes" />
        @endif
    </div>
</template>
