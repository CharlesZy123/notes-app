@extends('layouts.guest')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-5">
        <div class="px-4">
            <h3 class="text-xl font-semibold text-gray-700 mb-6 text-center">Create an Account</h3>

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

            <form action="{{ route('register') }}" method="POST">
                @csrf

                {{-- Name --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-600 mb-1">
                        Full Name
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                        autocomplete="name" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                               focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent
                               @error('name') border-red-400 @enderror" placeholder="Juan Dela Cruz">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600 mb-1">
                        Email Address
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
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
                    <input type="password" id="password" name="password" required autocomplete="new-password" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                               focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent
                               @error('password') border-red-400 @enderror" placeholder="Minimum 8 characters">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-600 mb-1">
                        Confirm Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        autocomplete="new-password" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                               focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        placeholder="Re-enter your password">
                </div>

                {{-- Submit --}}
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold
                           py-2 rounded-lg transition duration-150">
                    Create Account
                </button>
            </form>

            {{-- Login Link --}}
            <p class="text-center text-sm text-gray-500 mt-6">
                Already have an account?
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">
                    Sign in here
                </a>
            </p>
        </div>
    </div>
@endsection
