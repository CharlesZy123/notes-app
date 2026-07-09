@extends('layouts.guest')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-5">
        <div class="px-4">
            <h3 class="text-xl font-semibold text-gray-700 mb-6 text-center">Sign In to Your Account</h3>

            {{-- Session Status (e.g. after password reset) --}}
            @if (session('status'))
                <div class="bg-green-100 text-green-700 text-sm p-3 rounded mb-4">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-600 text-sm p-3 rounded mb-4">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600 mb-1">
                        Email Address
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        autocomplete="username" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                               focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent
                               @error('email') border-red-400 @enderror" placeholder="you@example.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-600 mb-1">
                        Password
                    </label>
                    <input type="password" id="password" name="password" required autocomplete="current-password" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                               focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent
                               @error('password') border-red-400 @enderror" placeholder="••••••••">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                            Forgot password?
                        </a>
                    @endif
                </div>

                {{-- Submit --}}
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold
                           py-2 rounded-lg transition duration-150">
                    Sign In
                </button>
            </form>

            {{-- Register Link --}}
            <p class="text-center text-sm text-gray-500 mt-6">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">
                    Register here
                </a>
            </p>
        </div>
    </div>
@endsection
