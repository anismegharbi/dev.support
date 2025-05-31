<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-gray-800">
            Moderators List
        </h2>
    </x-slot>

    <div class="py-8 px-6">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4">Moderators</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($moderators as $moderator)
                    <div class="border border-gray-300 rounded-lg p-4 shadow hover:shadow-lg transition">
                        <p class="text-lg font-medium text-gray-900"> {{ $moderator->name }}</p>
                        <p class="text-sm text-gray-600"> {{ $moderator->email }}</p>
                        <p class="text-sm text-gray-600"> ID: {{ $moderator->id }}</p>
                    </div>
                @endforeach
            </div>

            @if ($moderators->isEmpty())
                <p class="mt-4 text-gray-500">No moderators found.</p>
            @endif
        </div>
    </div>
</x-app-layout>
