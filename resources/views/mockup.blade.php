<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Conflicting Emotions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(count($entries) > 0)
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    ID
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Date
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Content
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Emotion
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Intensity
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($entries as $entry)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-black text-sm">
                                    {{ $entry->id }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-black text-sm">
                                    {{ $entry->date }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-black text-sm">
                                    {{ $entry->content }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-black text-sm">
                                    {{ $entry->name }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-black text-sm">
                                    {{ $entry->intensity }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>No conflicting diary entries found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>