<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($project) ? 'Edit a project' : 'Create a new project' }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="POST" action="{{ isset($project) ? route('update', ['id'=>$project->id]) : route('store') }}">
                @csrf
                @isset($project)
                    @method('PUT')
                @endisset

                <!-- Project Name -->
                <div>
                    <x-label for="name" :value="__('Name')" />

                    <x-input id="name" class="block mt-1 w-full" type="text"
                             :disabled="isset($isLeader) && !$isLeader"
                             name="name" required autofocus
                             value="{{ isset($project->name) ? $project->name : old('name') }}"/>

                </div>

                <!-- Price -->
                <div class="mt-4">
                    <x-label for="price" :value="__('Price')" />

                    <x-input id="price" class="block mt-1 w-full" type="number" min="0.00" max="10000000" step="any"
                             :disabled="isset($isLeader) && !$isLeader" required
                             name="price" value="{{ isset($project->price) ? $project->price : old('price') }}"  />
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <x-label for="description" :value="__('Description')" />

                    <x-textarea id="description" name="description" class="block mt-1 w-full"  rows="4" required
                                :disabled="isset($isLeader) && !$isLeader">
                        {{ isset($project->description) ? $project->description : null }}
                    </x-textarea>

                </div>

                <!-- Tasks Done -->
                <div class="mt-4">
                    <x-label for="tasks_done" :value="__('Tasks Done')" />

                    <x-textarea id="tasks_done" name="tasks_done" class="block mt-1 w-full"  rows="2">
                        {{ isset($project->tasks_done) ? $project->tasks_done : null }}
                    </x-textarea>

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
