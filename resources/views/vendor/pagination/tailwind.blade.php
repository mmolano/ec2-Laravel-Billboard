@if ($paginator->hasPages())
    <div class="flex items-center justify-center py-10 lg:px-0 sm:px-6 px-4">
        <div class="lg:w-3/5 w-full flex items-center justify-between border-t border-gray-200">
            <div class="flex items-center pt-3 text-gray-600 hover:text-indigo-700 cursor-pointer">
                <svg class="dark:text-gray-200" width="14" height="8" viewBox="0 0 14 8" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.1665 4H12.8332" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M1.1665 4L4.49984 7.33333" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M1.1665 4.00002L4.49984 0.666687" stroke="currentColor" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                @if ($paginator->onFirstPage())
                    <span class="text-sm ml-3 font-medium leading-none dark:text-gray-200">前へ</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="text-sm ml-3 font-medium leading-none hover:text-indigo-700 dark:text-gray-200 dark:hover:text-violet-400">前へ</a>
                @endif
            </div>

            <div class="sm:hidden flex">
                <span
                    class="text-sm font-medium leading-none cursor-pointer text-indigo-700 border-t border-indigo-400 pt-3 mr-4 px-2 dark:text-indigo-500 dark:border-indigo-200">{{ $paginator->currentPage() }}</span>
            </div>

            <div class="sm:flex hidden">
                @if ($paginator->onFirstPage())
                    <span
                        class="text-sm font-medium leading-none cursor-pointer text-indigo-700 border-t border-indigo-400 dark:text-indigo-500 dark:border-indigo-200 pt-3 mr-4 px-2">1</span>
                @else
                    <a href="{{ $paginator->url(1) }}"
                        class="text-sm font-medium leading-none cursor-pointer border-t border-transparent pt-3 mr-4 px-2 dark:text-gray-200">1</a>
                @endif
                @php
                    $startPage = max(1, $paginator->currentPage() - 1);
                    $endPage = min($paginator->lastPage(), $paginator->currentPage() + 1);
                @endphp
                @for ($page = 2; $page <= $paginator->lastPage(); $page++)
                    @if ($page == $paginator->currentPage())
                        <span
                            class="text-sm font-medium leading-none cursor-pointer text-indigo-700 border-t border-indigo-400  dark:text-indigo-500 dark:border-indigo-200 pt-3 mr-4 px-2">{{ $page }}</span>
                    @elseif ($page == 1 || $page == $paginator->lastPage() || ($page >= $startPage && $page <= $endPage))
                        <a href="{{ $paginator->url($page) }}"
                            class="text-sm font-medium leading-none cursor-pointer border-t border-transparent pt-3 mr-4 px-2 dark:text-gray-200">{{ $page }}</a>
                    @elseif (($page == $startPage - 1 && $startPage > 2) || ($page == $endPage + 1 && $endPage < $paginator->lastPage() - 1))
                        <span
                            class="text-sm font-medium leading-none cursor-pointer border-t border-transparent pt-3 mr-4 px-2 dark:text-gray-200">...</span>
                    @endif
                @endfor
            </div>

            <div class="flex items-center pt-3 text-gray-600 hover:text-indigo-700 cursor-pointer">
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="text-sm font-medium leading-none mr-3 dark:text-gray-200 dark:hover:text-violet-400">次へ</a>
                    <svg class="dark:text-gray-200" width="14" height="8" viewBox="0 0 14 8" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.1665 4H12.8332" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M9.5 7.33333L12.8333 4" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.5 0.666687L12.8333 4.00002" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                @else
                    <span class="text-sm font-medium leading-none mr-3 dark:text-gray-200">次へ</span>
                    <svg class="dark:text-gray-200" width="14" height="8" viewBox="0 0 14 8" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.1665 4H12.8332" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M9.5 7.33333L12.8333 4" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.5 0.666687L12.8333 4.00002" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                @endif
            </div>
        </div>
    </div>
@endif
