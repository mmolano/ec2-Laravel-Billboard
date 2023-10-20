<x-layouts-authenticate>
    <h1 class="text-3xl text-slate-800 dark:text-slate-100 font-bold mb-6">{{ __('アカウントの作成') }} ✨</h1>
    <!-- Form -->
    <form method="POST" action="{{ route('register.submit') }}">
        @csrf
        <div class="space-y-4">
            @if ($errors->has('custom'))
                <div class="bg-red-100 text-red-600 px-3 py-2 rounded">
                    <span class="text-sm font-bold">
                        {{ $errors->first('custom') }}
                    </span>
                </div>
            @endif
            <div>
                <label for="email" class="text-sm font-bold text-gray-700 tracking-wide dark:text-gray-400">メールアドレス</label>
                <input id="email" name="email"
                    class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500 dark:bg-gray-900"
                    type="text" placeholder="Titor@example.com">
                @if ($errors->has('email'))
                    <span class="text-sm text-red-600 font-bold">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="mt-8">
                <label for="user_name" class="text-sm font-bold text-gray-700 tracking-wide dark:text-gray-400">ユーザー名</label>
                <input id="user_name" name="user_name"
                    class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500 dark:bg-gray-900"
                    type="text" placeholder="Kazuma">
                @if ($errors->has('user_name'))
                    <span class="text-sm text-red-600 font-bold">{{ $errors->first('user_name') }}</span>
                @endif
            </div>
            <div class="mt-8">
                <label for="name" class="text-sm font-bold text-gray-700 tracking-wide dark:text-gray-400">名前</label>
                <input id="name" name="name"
                    class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500 dark:bg-gray-900"
                    type="text" placeholder="Yamada">
                @if ($errors->has('name'))
                    <span class="text-sm text-red-600 font-bold">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mt-8">
                <label for="password" class="text-sm font-bold text-gray-700 tracking-wide dark:text-gray-400">パスワード</label>
                <input id="password" name="password"
                    class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500 dark:bg-gray-900"
                    type="password" placeholder="******" autocomplete="on">
                @if ($errors->has('password'))
                    <span class="text-sm text-red-600 font-bold">{{ $errors->first('password') }}</span>
                @endif
            </div>
        </div>
        <div class="mt-10">
            <button
                class="bg-indigo-500 text-gray-100 p-3 tracking-wide
                                font-semibold font-display focus:outline-none focus:shadow-outline hover:bg-indigo-600
                                shadow-lg rounded-sm">
                いますぐ入会
            </button>
        </div>
    </form>
    <!-- Footer -->
    <div class="pt-5 mt-6 border-slate-200">
        <div class="text-sm">
            {{ __('すでにメンバー登録している方->') }} <a class="font-medium text-indigo-500 hover:text-indigo-600"
                href="{{ route('login') }}">{{ __('サインイン') }}</a>
        </div>
    </div>
</x-layouts-authenticate>
