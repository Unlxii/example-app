<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Conflicting Emotions
        </h2>
    </x-slot>

    <div class="container mx-auto p-6"></div>
    <h1 class="text-2xl font-bold mb-4">Conflicting Emotions: Sad but Mentioned Happy</h1>
    @if(count($entries) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($entries as $entry)
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-bold">{{ $entry->date }}</h2>
                    <p class="mt-4">{{ $entry->content }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p>No conflicting diary entries found.</p>
    @endif
    </div>
    </x-gri-layout>