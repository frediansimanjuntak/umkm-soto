<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Header Image') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.header-images.update', $headerImage) }}">
                        @csrf
                        @method('PUT')
                
                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $headerImage->title)" required autofocus autocomplete="title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        
                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description', $headerImage->description)" required autofocus autocomplete="description" />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- image url -->
                        <div class="mt-4">
                            <x-input-label for="image_url" :value="__('Image Url')" />
                            <x-text-input id="image_url" class="block mt-1 w-full" type="text" name="image_url" :value="old('image_url', $headerImage->image_url)" required autofocus autocomplete="image_url" />
                            <x-input-error :messages="$errors->get('image_url')" class="mt-2" />
                        </div>

                        <!-- URL link -->
                        <div class="mt-4">
                            <x-input-label for="url_link" :value="__('Url Link')" />
                            <x-text-input id="url_link" class="block mt-1 w-full" type="text" name="url_link" :value="old('url_link', $headerImage->url_link)" required autofocus autocomplete="url_link" />
                            <x-input-error :messages="$errors->get('url_link')" class="mt-2" />
                        </div>

                        <!-- Sequence -->
                        <div class="mt-4">
                            <x-input-label for="sequence" :value="__('Sequence')" />
                            <x-text-input id="sequence" class="block mt-1 w-full" type="text" name="sequence" :value="old('sequence', $headerImage->sequence)" required autofocus autocomplete="sequence" />
                            <x-input-error :messages="$errors->get('sequence')" class="mt-2" />
                        </div>
                                       
                
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
