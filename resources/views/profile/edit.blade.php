@extends('layout')

@section('title', 'الملف الشخصي - د. محمد المطري')

@section('content')
    <div class="min-h-screen bg-cream-50 py-8">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-brown-700">الملف الشخصي</h1>
                <p class="text-brown-500 mt-2">إدارة معلومات حسابك</p>
            </div>

            <div class="grid gap-6">
                <!-- Update Profile Information -->
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                    <div class="border-b border-cream-200 pb-4 mb-6">
                        <h3 class="text-xl font-bold text-brown-700 flex items-center gap-2">
                            <i class="fas fa-user-circle text-primary-600"></i>
                            معلومات الحساب
                        </h3>
                    </div>
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Update Password -->
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                    <div class="border-b border-cream-200 pb-4 mb-6">
                        <h3 class="text-xl font-bold text-brown-700 flex items-center gap-2">
                            <i class="fas fa-lock text-primary-600"></i>
                            تحديث كلمة المرور
                        </h3>
                    </div>
                    @include('profile.partials.update-password-form')
                </div>

                <!-- Logout Section -->
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                    <div class="border-b border-cream-200 pb-4 mb-6">
                        <h3 class="text-xl font-bold text-brown-700 flex items-center gap-2">
                            <i class="fas fa-sign-out-alt text-red-600"></i>
                            تسجيل الخروج
                        </h3>
                    </div>
                    <p class="text-brown-600 mb-4">تسجيل الخروج من الحساب الحالي</p>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 text-white px-6 py-3 rounded-xl font-bold hover:bg-red-600 transition-colors flex items-center gap-2">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>تسجيل الخروج</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
