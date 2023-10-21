<x-layouts-authenticate>
    <h1 class="text-3xl text-slate-800 dark:text-slate-100 font-bold mb-6">{{ __('ログイン') }}</h1>
    <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <div class="space-y-4">
            @if (session('success'))
                <div class="bg-green-100 text-green-600 px-3 py-2 rounded">
                    <span class="text-sm font-bold">
                        {{ session('success') }}
                    </span>
                </div>
            @elseif ($errors->has('login'))
                <div class="bg-red-100 text-red-600 px-3 py-2 rounded">
                    <span class="text-sm font-bold">
                        {{ $errors->first('login') }}
                    </span>
                </div>
            @endif
            <div>
                <label for="user_name"
                    class="text-sm font-bold text-gray-700 tracking-wide dark:text-gray-400">ユーザー名</label>
                <input id="user_name" name="user_name"
                    class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500 dark:text-white dark:bg-gray-900"
                    type="text" placeholder="Kazuma">
                @if ($errors->has('user_name'))
                    <span class="text-sm text-red-600 font-bold">{{ $errors->first('user_name') }}</span>
                @endif
            </div>
            <div class="mt-8">
                <label for="password"
                    class="text-sm font-bold text-gray-700 tracking-wide dark:text-gray-400">パスワード</label>
                <input id="password" name="password"
                    class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500 dark:text-white dark:bg-gray-900"
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
                サインイン
            </button>
        </div>
    </form>
    <div class="pt-5 mt-6 border-slate-200">
        <div class="text-sm">
            {{ __('メンバー登録をしていない方') }} <a class="font-medium text-indigo-500 hover:text-indigo-600"
                href="{{ route('register') }}">{{ __('登録') }}</a>
        </div>
    </div>
</x-layouts-authenticate>
