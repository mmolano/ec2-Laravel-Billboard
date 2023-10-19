<tr>
    <td class="p-2 whitespace-nowrap">
        <div class="flex items-center">
            <div class="w-10 h-10 shrink-0 mr-2 sm:mr-3">
                <img class="rounded-full" src="https://ui-avatars.com/api/?name={{ $post->user->name }}&amp;color=7F9CF5&amp;background=EBF4FF" width="40" height="40" alt="Alex Shatov">
            </div>
            <div class="font-medium text-slate-800 dark:text-gray-100">{{ ucfirst($post->user->name) }}</div>
        </div>
    </td>
    <td class="p-2 whitespace-nowrap">
        <a class="text-blue-500 underline font-bold" href="{{ route('posts.show', ['id' => $post->post_id]) }}">
            {{ ucfirst($post->title) }}
        </a>
    </td>
    <td class="p-2 whitespace-nowrap">
        <div class="flex text-left font-medium text-green-500">
            <svg class="m-[5px] w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 20 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
            </svg>
            {{ $post->comments->count() }}
        </div>
    </td>
    <td class="p-2 whitespace-nowrap">
        <div class="text-lg text-center dark:text-gray-100">{{ $post->created_at->format('Y/m/d h:m:s') }}</div>
    </td>
</tr>
