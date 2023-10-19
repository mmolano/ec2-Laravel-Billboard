<x-layouts-authenticate>
    <h1 class="text-3xl text-slate-800 dark:text-slate-100 font-bold mb-6">{{ __('ログイン') }} ✨</h1>
    <!-- Form -->
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
                <label for="email" class="text-sm font-bold text-gray-700 tracking-wide">メールアドレス</label>
                <input id="email" name="email"
                    class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500"
                    type="text" placeholder="yamada@example.com">
                @if ($errors->has('email'))
                    <span class="text-sm text-red-600 font-bold">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="mt-8">
                <label for="password" class="text-sm font-bold text-gray-700 tracking-wide">パスワード</label>
                <input id="password" name="password"
                    class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500"
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
    <!-- Footer -->
    <div class="pt-5 mt-6 border-slate-200">
        <div class="text-sm">
            {{ __('メンバー登録をしていない方->') }} <a class="font-medium text-indigo-500 hover:text-indigo-600"
                href="{{ route('register') }}">{{ __('登録') }}</a>
        </div>
    </div>
</x-layouts-authenticate>
