<div>
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : ($this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1))

        <div class="flex items-center justify-center py-10 lg:px-0 sm:px-6 px-4">
            <div class="lg:w-3/5 w-full flex items-center justify-between border-t border-gray-200">
                <div class="flex items-center pt-3 text-gray-600 hover:text-indigo-700 cursor-pointer">
                    <svg class="dark:text-gray-200" width="14" height="8" viewBox="0 0 14 8" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.1665 4H12.8332" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M1.1665 4L4.49984 7.33333" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M1.1665 4.00002L4.49984 0.666687" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    @if ($paginator->onFirstPage())
                        <span class="text-sm ml-3 font-medium leading-none dark:text-gray-200">
                            前へ
                        </span>
                    @else
                        <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                            wire:loading.attr="disabled"
                            dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
                            class="text-sm ml-3 font-medium leading-none hover:text-indigo-700 dark:text-gray-200 dark:hover:text-violet-400">
                            前へ
                        </button>
                    @endif
                </div>

                <div class="sm:hidden flex">
                    <span
                        class="text-sm font-medium leading-none cursor-pointer text-indigo-700 border-t border-indigo-400 pt-3 mr-4 px-2 dark:text-indigo-500 dark:border-indigo-200">{{ $paginator->currentPage() }}</span>
                </div>

                <div class="sm:flex hidden">
                    {{-- Previous Page Link --}}

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span
                                    class="text-sm font-medium leading-none cursor-pointer border-t border-transparent pt-3 mr-4 px-2 dark:text-gray-200">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                <span
                                    wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page{{ $page }}">
                                    @if ($page == $paginator->currentPage())
                                        <span
                                            class="flex text-sm font-medium leading-none cursor-pointer text-indigo-700 border-t border-indigo-400  dark:text-indigo-500 dark:border-indigo-200 pt-3 mr-4 px-2">{{ $page }}</span>
                                    @else
                                        <button type="button"
                                            wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                            class="text-sm font-medium leading-none cursor-pointer border-t border-transparent pt-3 mr-4 px-2 dark:text-gray-200"
                                            aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                            {{ $page }}
                                        </button>
                                    @endif
                                </span>
                            @endforeach
                        @endif
                    @endforeach
                </div>

                <span class="flex items-center pt-3 text-gray-600 hover:text-indigo-700 cursor-pointer">
                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                            rel="next"
                            class="text-sm font-medium leading-none mr-3 dark:text-gray-200 dark:hover:text-violet-400"
                            aria-label="{{ __('pagination.next') }}">
                            次へ
                        </button>
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
                        <span class="text-sm font-medium leading-none mr-3 dark:text-gray-200" aria-disabled="true"
                            aria-label="{{ __('pagination.next') }}">
                            次へ
                        </span>
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
                </span>
            </div>
        </div>
</div>
@endif
</div>
