<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a new project') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="POST" action="{{ route('store') }}">
            @csrf

                <!-- Project Name -->
                <div>
                    <x-label for="name" :value="__('Name')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>

                <!-- Price -->
                <div class="mt-4">
                    <x-label for="price" :value="__('Price')" />

                    <x-input id="price" class="block mt-1 w-full" type="number" min="0.00" step="any"
                             name="price" :value="old('price')" required autofocus />
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <x-label for="description" :value="__('Description')" />

                    <x-textarea id="description" name="description" class="block mt-1 w-full"  rows="4" cols="50" required autofocus></x-textarea>

                </div>

                <!-- Submit button -->
                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3">
                        {{ __('Submit') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
