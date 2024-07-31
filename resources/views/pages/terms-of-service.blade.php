<x-authenticated-layout>
    <x-slot name="title">{{ __('Terms of Service') }}</x-slot>

    <div class="flex flex-col gap-8 my-8 sm:max-w-2xl mx-auto">
        <x-application-logo class="h-16 w-auto fill-current text-neutral-800" />

        <div class="w-full prose prose-xl prose-h1:text-center prose-neutral">
            {!! $terms !!}
        </div>
    </div>
</x-authenticated-layout>
