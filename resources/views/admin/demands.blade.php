<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900">
            Forum Access Requests
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-5xl mx-auto px-4">
            @forelse ($usersWithRequests as $user)
                <div class="bg-white border-2 border-gray-200 shadow-lg rounded-2xl p-6 mb-8 transition hover:shadow-xl">
                    <div class="flex justify-between items-center">
                        <div class="text-lg space-y-2">
                            <p><span class="font-bold text-gray-800 text-xl">Name:</span> {{ $user->name }}</p>
                            <p><span class="font-bold text-gray-800 text-xl">Email:</span> {{ $user->email }}</p>
                            <p><span class="font-bold text-gray-800 text-xl">Requested Forum:</span> 
                                <span class="text-blue-600 font-semibold">{{ $user->requestedForum->title ?? 'Unknown Forum' }}</span>
                            </p>
                            <p><span class="font-bold text-gray-800 text-xl">Account Created:</span> {{ $user->created_at->format('Y-m-d') }}</p>
                        </div>

                        <div class="flex flex-col gap-4 text-center">
                            <div class="bg-green-100 border border-green-300 p-3 rounded-xl shadow-md">
                                <button class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-semibold">
                                    Accept
                                </button>
                            </div>

                            <div class="bg-red-100 border border-red-300 p-3 rounded-xl shadow-md">
                                <button class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg font-semibold">
                                    Reject
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 mt-10">
                    <p class="text-xl font-semibold">No forum access requests found.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
