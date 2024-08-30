<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div>

    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex-col justify-center">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-wrap text-center">
                     <div class=" p-6 font-bold">{{ __("welcome!  ") }}   {{ Auth::user()->name }}</div>
                    <div class="flex justify-center">
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo" class="w-40 h-40 object-cover rounded-full">
                    </div>     
                    <div>
                        <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:text-blue-700">{{ __('Edit Profile') }}</a>
                    </div>
                    <div class=" p-6 mr-4">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
