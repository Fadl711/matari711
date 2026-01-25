<section>
    <p class="text-brown-600 mb-4">تحديث اسم الحساب والبريد الإلكتروني</p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-brown-700 mb-2">
                <i class="fas fa-user text-primary-600 ml-1"></i>
                الاسم
            </label>
            <input id="name" name="name" type="text"
                class="w-full px-4 py-3 rounded-xl border-2 border-cream-300 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-brown-700 mb-2">
                <i class="fas fa-envelope text-primary-600 ml-1"></i>
                البريد الإلكتروني
            </label>
            <input id="email" name="email" type="email"
                class="w-full px-4 py-3 rounded-xl border-2 border-cream-300 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all"
                value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-3 p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
                    <p class="text-sm text-yellow-800 mb-2">
                        <i class="fas fa-exclamation-triangle ml-1"></i>
                        بريدك الإلكتروني غير موثق.
                    </p>

                    <button form="send-verification" class="text-sm text-primary-600 hover:text-primary-700 underline">
                        اضغط هنا لإعادة إرسال رابط التوثيق
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-600">
                            <i class="fas fa-check-circle ml-1"></i>
                            تم إرسال رابط توثيق جديد إلى بريدك الإلكتروني
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <button type="submit"
                class="bg-primary-500 text-white px-6 py-3 rounded-xl font-bold hover:bg-primary-600 transition-colors">
                <i class="fas fa-save ml-1"></i>
                حفظ التعديلات
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600">
                    <i class="fas fa-check-circle ml-1"></i>
                    تم الحفظ بنجاح
                </p>
            @endif
        </div>
    </form>
</section>
