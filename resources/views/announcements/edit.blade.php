<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('announcements.update',$announcement) }}">
            @csrf
            @method('PUT')
            <textarea
                name="message"
                placeholder="{{ __('What would you want your classmates to know?') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ $announcement->message ?? old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2"/>
            <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>
{{--            <x-secondary-button class="mt-4">{{ __('Cancel') }}</x-secondary-button>--}}
            <a href="{{ route('announcements.index') }}">{{ __('Cancel') }}</a>
        </form>
    </div>
</x-app-layout>
