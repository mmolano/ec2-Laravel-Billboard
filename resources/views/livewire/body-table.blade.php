<div wire:id="body-table">
    <div class="p-3 mt-5">
        <div class="overflow-x-auto">
            <div class="max-w-6xl m-auto">
                <x-search :inputSearch="$inputSearch" />
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
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-sm font-bold">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div
                    class="col-span-full xl:col-span-6 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                    <header class="flex justify-between px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                        <h2 class="font-semibold text-slate-800 dark:text-slate-100">掲示版のリスト</h2>
                        <x-modal-new />
                    </header>
                    <div class="p-3">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead
                                    class="text-xs font-semibold uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">タイトル</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-center">登録日時</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">登録者</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">コメント</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-center">アクション</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-slate-100 dark:divide-slate-700">
                                    @if ($posts->isEmpty())
                                        <tr>
                                            <td colspan="5"
                                                class="text-center font-bold text-xl p-4 dark:text-color-white">
                                                メッセージが見つかりませんでした。
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($posts as $post)
                                            <x-table-row :post="$post" />
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-3 sm:m-10">
                {{ $posts->withQueryString()->links('livewire::tailwind') }}
            </div>
        </div>
    </div>
</div>
