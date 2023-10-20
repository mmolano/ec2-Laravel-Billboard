<div wire:id="card-search">
    <form wire:submit.prevent="updatedSearchTerm">
        <div class="relative mt-2 ml-2">
            <div>
                <label for="modal-search" class="sr-only">Search</label>
                <input wire:model="search" id="modal-search"
                    class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                    type="search" name="search" placeholder="Search">
                <button type="submit">Search</button>
            </div>
            <div class="my-2">
                <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownSearchButton">
                    <li>
                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input wire:model="searchName" id="checkbox-item-13" type="checkbox" value=""
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="checkbox-item-13"
                                class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">登録者</label>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input wire:model="searchTitle" id="checkbox-item-12" type="checkbox" value=""
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="checkbox-item-12"
                                class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">タイトル</label>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input wire:model="searchComment" id="checkbox-item-14" type="checkbox" value=""
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="checkbox-item-14"
                                class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">コメント内容</label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </form>
    <x-table-body :errors="$errors" :posts="$posts" />
</div>
