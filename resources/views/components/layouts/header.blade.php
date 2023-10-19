<header class="sticky top-0 bg-white dark:bg-[#182235] border-b border-slate-200 dark:border-slate-700 z-30">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex items-center h-16 -mb-px">
            <div class="flex items-center justify-between space-x-3 w-full">
                <div class="w-fit">
                    <h2><a class="hover:text-violet-500 dark:text-gray-100" href="/dashboard">ホーム</a></h2>
                </div>
                <div class="flex flex-row gap-2.5">
                    <div>
                        <input type="checkbox" name="light-switch" id="light-switch" class="light-switch sr-only" />
                        <label
                            class="flex items-center justify-center cursor-pointer w-8 h-8 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600/80 rounded-full"
                            for="light-switch">
                            <svg class="w-4 h-4 dark:hidden" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <path class="fill-current text-slate-400"
                                    d="M7 0h2v2H7V0Zm5.88 1.637 1.414 1.415-1.415 1.413-1.414-1.414 1.415-1.414ZM14 7h2v2h-2V7Zm-1.05 7.433-1.415-1.414 1.414-1.414 1.415 1.413-1.414 1.415ZM7 14h2v2H7v-2Zm-4.02.363L1.566 12.95l1.415-1.414 1.414 1.415-1.415 1.413ZM0 7h2v2H0V7Zm3.05-5.293L4.465 3.12 3.05 4.535 1.636 3.121 3.05 1.707Z" />
                                <path class="fill-current text-slate-500"
                                    d="M8 4C5.8 4 4 5.8 4 8s1.8 4 4 4 4-1.8 4-4-1.8-4-4-4Z" />
                            </svg>
                            <svg class="w-4 h-4 hidden dark:block" viewBox="0 0 16 16"
                                xmlns="http://www.w3.org/2000/svg">
                                <path class="fill-current text-slate-400"
                                    d="M6.2 2C3.2 2.8 1 5.6 1 8.9 1 12.8 4.2 16 8.1 16c3.3 0 6-2.2 6.9-5.2C9.7 12.2 4.8 7.3 6.2 2Z" />
                                <path class="fill-current text-slate-500"
                                    d="M12.5 6a.625.625 0 0 1-.625-.625 1.252 1.252 0 0 0-1.25-1.25.625.625 0 1 1 0-1.25 1.252 1.252 0 0 0 1.25-1.25.625.625 0 1 1 1.25 0c.001.69.56 1.249 1.25 1.25a.625.625 0 1 1 0 1.25c-.69.001-1.249.56-1.25 1.25A.625.625 0 0 1 12.5 6Z" />
                            </svg>
                            <span class="sr-only">Switch to light / dark version</span>
                        </label>
                    </div>
                    <!-- Divider -->
                    <hr class="w-px h-6 bg-slate-200 dark:bg-slate-700 border-none">
                    <!-- User button -->
                    <div class="relative inline-flex" x-data="{ open: false }">
                        <button class="inline-flex justify-center items-center group" aria-haspopup="true"
                            @click.prevent="open = !open" :aria-expanded="open" aria-expanded="false">
                            <img class="w-8 h-8 rounded-full"
                                src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&amp;color=7F9CF5&amp;background=EBF4FF"
                                width="32" height="32" alt="user name pic">
                            <div class="flex items-center truncate">
                                <span
                                    class="truncate ml-2 text-sm font-medium dark:text-slate-300 group-hover:text-slate-800 dark:group-hover:text-slate-200">{{ ucfirst(Auth::user()->name) }}</span>
                                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" viewBox="0 0 12 12">
                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="origin-top-right z-10 absolute top-full min-w-44 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 py-1.5 rounded shadow-lg overflow-hidden mt-1 right-0"
                            @click.outside="open = false" @keydown.escape.window="open = false" x-show="open"
                            x-transition:enter="transition ease-out duration-200 transform"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" style="display: none;">
                            <div class="pt-0.5 pb-2 px-3 mb-1 border-b border-slate-200 dark:border-slate-700">
                                <div class="font-medium text-slate-800 dark:text-slate-100">
                                    {{ ucfirst(Auth::user()->name) }}
                                </div>
                                <div class="text-xs text-slate-500 dark:text-slate-400 italic">ユーザー</div>
                            </div>
                            <ul>
                                <li>
                                    <form method="POST" action="/logout" x-data="">
                                        @csrf
                                        <a class="font-medium text-sm text-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400 flex items-center py-1 px-3"
                                            href="/logout" @focus="open = true" @focusout="open = false">
                                            ログアウト
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>
