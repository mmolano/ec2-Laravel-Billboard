<x-layouts-post>
    <section>
        <article class="max-w-2xl px-6 py-24 mx-auto space-y-12 dark:bg-gray-800 dark:text-gray-50">
            <div class="flex justify-between">
                <a href="/dashboard"
                    class="w-fit flex items-center px-5 py-2 text-sm text-gray-700 gap-x-2  dark:text-gray-200">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13" />
                    </svg>
                </a>
                @if (Auth::user()->user_id === $post->user_id)
                    <div class="flex text-left font-medium text-green-500 justify-center">
                        <div x-data="{ openModal: false, openModalDelete: false }">
                            <button type="button" @click="openModal = !openModal"
                                class="text-gray-500 focus:outline-none  px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:text-gray-300 dark:hover:text-white">
                                <svg class="w-6 h-6 text-gray-800 transition-colors dark:text-gray-400 dark:hover:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M1 5h1.424a3.228 3.228 0 0 0 6.152 0H19a1 1 0 1 0 0-2H8.576a3.228 3.228 0 0 0-6.152 0H1a1 1 0 1 0 0 2Zm18 4h-1.424a3.228 3.228 0 0 0-6.152 0H1a1 1 0 1 0 0 2h10.424a3.228 3.228 0 0 0 6.152 0H19a1 1 0 0 0 0-2Zm0 6H8.576a3.228 3.228 0 0 0-6.152 0H1a1 1 0 0 0 0 2h1.424a3.228 3.228 0 0 0 6.152 0H19a1 1 0 0 0 0-2Z" />
                                </svg>
                            </button>
                            <button @click="openModalDelete = !openModalDelete" type="button"
                                class="text-red-500 focus:outline-none  px-5 py-2.5 hover:text-red-900 focus:z-10 dark:text-red-300 dark:hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6 text-red-800 transition-colors dark:text-red-400 dark:hover:text-red-200"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.4"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg></button>
                            <x-modal-post-edit :id="$post->post_id" />
                            <x-modal-delete :id="$post->post_id" :value="$post" url="post.delete"
                                title="メッセージを削除しますか？" />
                        </div>
                    </div>
                @endif
            </div>
            <div class="w-full mx-auto space-y-4 text-center">
                @if ($post->created_at->format('Y-m-d H:i:s') !== $post->updated_at->format('Y-m-d H:i:s'))
                    <p class="text-violet-700 text-sm font-bold tracki uppercase">#編集済み
                        {{ $post->updated_at->format('Y年m月d日 H時i分') }}</p>
                @endif
                <h1 class="text-4xl font-bold leadi md:text-5xl">{{ ucfirst($post->title) }}</h1>
                <div class="text-sm dark:text-gray-400">
                    <p class="text-violet-400">
                        <span itemprop="name">{{ ucfirst($post->user->name) }}</span>
                    </p>
                    <time datetime="2021-02-12 15:34:18-0200">{{ $post->created_at->format('Y年m月d日 H時i分') }}</time>
                </div>
            </div>
            <div class="dark:text-gray-100">
                <p>{{ ucfirst($post->content) }}</p>
            </div>
            <div class="pt-12 border-t dark:border-gray-700">
                <div class="flex flex-col space-y-4 md:space-y-0 md:space-x-6 md:flex-row">
                    <img src="https://ui-avatars.com/api/?name={{ $post->user->name }}&amp;color=7F9CF5&amp;background=EBF4FF"
                        alt=""
                        class="self-center flex-shrink-0 w-12 h-12 border rounded-full md:justify-self-start dark:bg-gray-500 dark:border-gray-700">
                    <div class="flex items-center">
                        <h4 class="text-lg font-semibold m-auto">{{ ucfirst($post->user->name) }}</h4>
                    </div>
                </div>
            </div>
        </article>
    </section>
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

            <!--- Comment section -->
            @foreach ($post->comments as $comment)
                <x-show-comments :comment="$comment" />
            @endforeach
        </div>
    </section>
</x-layouts-post>
