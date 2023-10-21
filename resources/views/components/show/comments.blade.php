<article class="border-t p-6 text-base bg-white dark:bg-gray-900 dark:border-gray-600">
    <footer class="flex justify-between items-center mb-2">
        <div class="flex flex-wrap items-center">
            <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                <img class="mr-2 w-6 h-6 rounded-full"
                    src="https://ui-avatars.com/api/?name={{ $comment->user->name }}&amp;color=7F9CF5&amp;background=EBF4FF"
                    alt="user img">{{ ucfirst($comment->user->name) }}
            </p>
            <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                    title="February 8th, 2022">{{ $comment->created_at->format('Y年m月d日 H時i分') }}</time>
            </p>
            @if ($comment->created_at->format('Y-m-d H:i:s') !== $comment->updated_at->format('Y-m-d H:i:s'))
                <p class="text-violet-700 ml-2 text-sm font-semibold tracki uppercase">#編集済み</p>
            @endif
        </div>
        @if ($comment->user_id === Auth::user()->user_id)
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    type="button">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 16 3">
                        <path
                            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                    </svg>
                </button>

                <div x-show="open" @click.outside="open = false"
                    class="z-30 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 right-0 absolute">
                    <div x-data="{ openModal: false, openModalDelete: false }">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                            <li>
                                <button @click="openModal = !openModal"
                                    class="block w-full py-2 text-left px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover-text-white">
                                    修正
                                </button>
                            </li>
                            <li class="hover:bg-red-100 text-red-600">
                                <button @click="openModalDelete = !openModalDelete"
                                    class="block py-2 px-4 text-left w-full dark:hover:bg-gray-600 dark:hover:text-white">削除</a>
                            </li>
                        </ul>
                        <x-modal-delete :id="$comment->comment_id" :value="$comment" url="comment.delete" title="コメントを削除しますか？" />
                        <x-modal-edit :id="$comment->comment_id" />
                    </div>
                </div>

            </div>
        @endif
    </footer>
    <p class="text-gray-500 dark:text-gray-200">{{ ucfirst($comment->comment_content) }}</p>
</article>
