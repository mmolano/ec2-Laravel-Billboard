<x-layouts-post>
    <section>
        <article class="max-w-2xl px-6 py-24 mx-auto space-y-12 dark:bg-gray-800 dark:text-gray-50">
            <div class="w-full mx-auto space-y-4 text-center">
                <h1 class="text-4xl font-bold leadi md:text-5xl">{{ ucfirst($post->title) }}</h1>
                <div class="text-sm dark:text-gray-400">
                    <p class="text-violet-400">
                        <span itemprop="name">{{ ucfirst($post->user->name) }}</span>
                    </p>
                    <time datetime="2021-02-12 15:34:18-0200">{{ $post->created_at->format('Y/d/m h:m') }}</time>
                </div>
            </div>
            <div class="dark:text-gray-100">
                <p>{{ ucfirst($post->content) }}</p>
            </div>
            <div class="pt-12 border-t dark:border-gray-700">
                <div class="flex flex-col space-y-4 md:space-y-0 md:space-x-6 md:flex-row">
                    <img src="/images/user.png" alt=""
                        class="self-center flex-shrink-0 w-12 h-12 border rounded-full md:justify-self-start dark:bg-gray-500 dark:border-gray-700">
                    <div class="flex items-center">
                        <h4 class="text-lg font-semibold m-auto">{{ ucfirst($post->user->name) }}</h4>
                    </div>
                </div>
            </div>
        </article>
    </section>
    <!---- Turn to compo !----->
    <section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased">
        <div class="max-w-2xl mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">コメント
                    ({{ $post->comments->count() }})</h2>
            </div>
            @if (session('success') || $errors->hasAny('custom'))
                @php
                    $bgColor = session('success') ? 'green' : 'red';
                    $textColor = session('success') ? 'green' : 'red';
                    $message = session('success') ?: $errors->first('custom');
                @endphp
                <div class="bg-{{ $bgColor }}-100 text-{{ $textColor }}-600 px-3 py-2 rounded mb-2">
                    <span class="text-sm font-bold">{{ $message }}</span>
                </div>
            @elseif ($errors->any())
                <div class="bg-red-100 text-red-600 px-3 py-2 rounded mb-2">
                    @foreach ($errors->all() as $error)
                        <span class="text-sm font-bold">{{ $error }}</span><br>
                    @endforeach
                </div>
            @endif

            <form class="mb-6" method="POST" action="{{ route('comment') }}">
                @csrf
                <div
                    class="py-2 px-4 mb-4 bg-red rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                    <label for="comment" class="sr-only">新しいコメントを書く</label>
                    <textarea id="comment" rows="6" name="comment_content"
                        class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                        placeholder="コメント..." required></textarea>
                </div>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    コメント作成
                </button>
            </form>
            @foreach ($post->comments as $comment)
                <article class="border-t p-6 text-base bg-white dark:bg-gray-900 dark:border-gray-600">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <p
                                class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                                <img class="mr-2 w-6 h-6 rounded-full"
                                    src="https://ui-avatars.com/api/?name={{ $comment->user->name }}&amp;color=7F9CF5&amp;background=EBF4FF"
                                    alt="user img">{{ ucfirst($comment->user->name) }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                                    title="February 8th, 2022">{{ $comment->created_at->format('Y/d/m h:m') }}</time>
                            </p>
                        </div>
                        @if ($comment->user_id === Auth::user()->user_id)
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open"
                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                    type="button">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 16 3">
                                        <path
                                            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                    </svg>
                                </button>

                                <!-- Dropdown menu -->
                                <div x-show="open" @click.outside="open = false"
                                    class="z-30 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 absolute">
                                    <div x-data="{ openModal: false, openModalDelete: false }">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                                            <li>
                                                <button @click="openModal = !openModal"
                                                    class="block w-full py-2 text-left px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover-text-white">
                                                    編集
                                                </button>
                                            </li>
                                            <li class="hover:bg-red-100 text-red-600">
                                                <button @click="openModalDelete = !openModalDelete"
                                                    class="block py-2 px-4 text-left w-full dark:hover:bg-gray-600 dark:hover:text-white">削除</a>
                                            </li>
                                        </ul>
                                        <x-modal-delete :id="$comment->comment_id" />
                                        <x-modal-edit :id="$comment->comment_id" />
                                    </div>
                                </div>

                            </div>
                        @endif
                    </footer>
                    <p class="text-gray-500 dark:text-gray-200">{{ ucfirst($comment->comment_content) }}</p>
                </article>
            @endforeach
        </div>
    </section>
</x-layouts-post>
