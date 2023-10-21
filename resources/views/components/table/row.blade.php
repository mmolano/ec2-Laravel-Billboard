<tr wire:key="row-{{ $post->post_id }}">
    <td class="p-2 whitespace-nowrap">
        <a class="text-blue-500 underline font-bold" href="{{ route('post.show', ['id' => $post->post_id]) }}">
            {{ ucfirst($post->title) }}
        </a>
    </td>
    <td class="p-2 whitespace-nowrap">
        <div class="text-lg text-center dark:text-gray-100">{{ $post->created_at->format('Y年m月d日 H時i分') }}</div>
    </td>
    <td class="p-2 whitespace-nowrap">
        <div class="flex items-center">
            <div class="w-10 h-10 shrink-0 mr-2 sm:mr-3">
                <img class="rounded-full"
                    src="https://ui-avatars.com/api/?name={{ $post->user->name }}&amp;color=7F9CF5&amp;background=EBF4FF"
                    width="40" height="40" alt="Alex Shatov">
            </div>
            <div class="font-medium text-slate-800 dark:text-gray-100">{{ ucfirst($post->user->name) }}</div>
        </div>
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
        @if (Auth::user()->user_id === $post->user_id)
            <div class="flex text-left font-medium text-green-500 justify-center">
                <div x-data="{ openModal: false, openModalDelete: false }">
                    <button type="button" @click="openModal = !openModal"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        修正
                    </button>
                    <button @click="openModalDelete = !openModalDelete" type="button"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        削除</button>
                    <x-modal-post-edit :id="$post->post_id" />
                    <x-modal-delete :id="$post->post_id" :value="$post" url="post.delete" title="メッセージを削除しますか？" />
                </div>
            </div>
        @endif
    </td>
</tr>
