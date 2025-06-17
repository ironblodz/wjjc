<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>

                <!-- Backoffice Links Section -->
                <div class="p-6 border-t border-gray-200">
                    <h3 class="font-semibold text-lg mb-4">{{ __('Backoffice Administration') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('backoffice.admin.photos.index') }}"
                            class="block p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="font-medium">{{ __('Manage Events') }}</div>
                            <div class="text-sm text-gray-500">{{ __('Upload, edit and delete events') }}</div>
                        </a>
                        <a href="{{ route('backoffice.admin.categories.index') }}"
                            class="block p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="font-medium">{{ __('Manage Categories') }}</div>
                            <div class="text-sm text-gray-500">{{ __('Create, edit and delete categories') }}</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
