<div class="px-10 m-5">
    <div class="bg-white max-w-xl rounded-2xl px-7 py-7 shadow-lg hover:shadow-2xl transition duration-500">
        <div class="mt-4">
            <h1 class="text-md text-gray-700 font-semibold hover:underline cursor-pointer">{{ $post->title }}</h1>
            <p class="mt-4 text-sm text-gray-600">{{ $post->content }}</p>
            <div class="flex justify-between items-center">
                <div class="mt-4 flex items-center space-x-4 py-6">
                    <div class="">
                        <img class="w-10 h-10 rounded-full" src="/images/user.png" alt="user default icon" />
                    </div>
                    <div class="text-sm font-semibold">{{ $post->user->name }} • <span class="font-normal">
                            {{ $post->created_at->diffForHumans() }}</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
