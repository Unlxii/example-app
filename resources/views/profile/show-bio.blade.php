<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Bio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Form to edit bio -->
                    <form method="post" action="{{ route('profile.update-bio') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <!-- Bio Input -->
                        <div>
                            <x-input-label for="bio" :value="__('Bio')" />
                            <textarea id="bio" name="bio" rows="5"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100"
                                required>{{ old('bio', $user->bio ?? '') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                        </div>

                        <!-- Personality Type Input -->
                        <div>
                            <x-input-label for="personality_type" :value="__('Personality Type')" />
                            <select id="personality_type" name="personality_type"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100"
                                required>
                                <option value="">{{ __('Select Personality Type') }}</option>
                                @foreach($personalityTypes as $personalityType)
                                <option value="{{ $personalityType->id }}"
                                    {{ old('personality_type', $user->personality_type_id ?? '') == $personalityType->id ? 'selected' : '' }}>
                                    {{ $personalityType->name }}
                                </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('personality_type')" />
                        </div>

                        <!-- Personality Type Description -->
                        @if($user->personalityType)
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <p id="description"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100">
                                {{ $user->personalityType->description }}
                            </p>
                        </div>
                        @endif

                        <!-- Submit Button -->
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update Bio') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('status'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('
            status ') }}',
            confirmButtonText: 'OK'
        });
        @endif
    });
    </script>
</x-app-layout>