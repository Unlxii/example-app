<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Conflicting Emotions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 rounded-md">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        {{ __('Summary') }}
                    </h2>
                    @if(count($entries) > 0)
                    <table class="min-w-full table-auto items-center ">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                @foreach(['ID', 'Date', 'Content', 'Emotion', 'Intensity'] as $header)
                                <th
                                    class="px-5 py-3  border-gray-200 dark:border-gray-600 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                    {{ $header }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($entries as $entry)
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-5 py-5 border-gray-200 dark:border-gray-700 text-sm border-[1px]">
                                    {{ $entry->id }}
                                </td>
                                <td class="px-5 py-5  border-gray-200 dark:border-gray-700 text-sm border-[1px]">
                                    {{ $entry->date }}
                                </td>
                                <td class="px-5 py-5  border-gray-200 dark:border-gray-700 text-sm border-[1px]">
                                    {{ $entry->content ?? 'No content available' }}
                                </td>
                                <td class="px-5 py-5  border-gray-200 dark:border-gray-700 text-sm border-[1px]">
                                    {{ $entry->name ?? 'Unknown emotion' }}
                                </td>
                                <td class="px-5 py-5  border-gray-200 dark:border-gray-700 text-sm border-[1px]">
                                    {{ $entry->intensity ?? 'N/A' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="flex justify-center items-center py-12">
                        <p class="text-gray-500 dark:text-gray-400 text-lg">No conflicting diary entries found.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>