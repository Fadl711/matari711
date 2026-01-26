@extends('layout')

@section('title', 'تسجيل الدخول - د.محمد بن جميل المطري')

@section('content')
    <div
        class="min-h-screen bg-gradient-to-br from-primary-50 via-cream-50 to-primary-100 py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
        <div class="max-w-md w-full">
            <!-- Card -->
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-8 py-10 text-center">
                    <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-mosque text-4xl text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">تسجيل الدخول</h2>
                    <p class="text-primary-100">د.محمد بن جميل المطري</p>
                </div>

                <!-- Form -->
                <div class="px-8 py-8">
                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-brown-700 mb-2">
                                <i class="fas fa-envelope text-primary-600 ml-1"></i>
                                البريد الإلكتروني
                            </label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                autofocus autocomplete="username"
                                class="w-full px-4 py-3 rounded-xl border-2 border-cream-300 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all"
                                placeholder="admin@example.com">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-brown-700 mb-2">
                                <i class="fas fa-lock text-primary-600 ml-1"></i>
                                كلمة المرور
                            </label>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="w-full px-4 py-3 rounded-xl border-2 border-cream-300 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all"
                                placeholder="••••••••">
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember" checked
                                class="w-4 h-4 text-primary-600 bg-cream-100 border-cream-300 rounded focus:ring-primary-500 focus:ring-2">
                            <label for="remember_me" class="mr-2 text-sm text-brown-600">
                                تذكرني
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-primary-600 to-primary-700 text-white font-bold py-3 px-4 rounded-xl hover:from-primary-700 hover:to-primary-800 focus:ring-4 focus:ring-primary-200 transition-all transform hover:scale-[1.02] active:scale-[0.98]">
                            <i class="fas fa-sign-in-alt ml-2"></i>
                            دخول
                        </button>

                        <!-- Forgot Password Link -->
                        @if (Route::has('password.request'))
                            <div class="text-center pt-4">
                                <a href="{{ route('password.request') }}"
                                    class="text-sm text-primary-600 hover:text-primary-700 hover:underline transition-colors">
                                    نسيت كلمة المرور؟
                                </a>
                            </div>
                        @endif
                    </form>
                </div>

                <!-- Footer -->
                <div class="bg-cream-50 px-8 py-4 border-t border-cream-200">
                    <p class="text-center text-sm text-brown-500">
                        <i class="fas fa-info-circle ml-1"></i>
                        هذه الصفحة مخصصة للإدارة فقط
                    </p>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="mt-6 text-center">
                <a href="{{ route('home') }}"
                    class="inline-flex items-center gap-2 text-brown-600 hover:text-primary-600 transition-colors">
                    <i class="fas fa-arrow-right"></i>
                    <span>العودة إلى الصفحة الرئيسية</span>
                </a>
            </div>
        </div>
    </div>
@endsection
