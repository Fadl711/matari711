<section>
    <p class="text-brown-600 mb-4">تأكد من استخدام كلمة مرور طويلة وآمنة لحماية حسابك</p>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-brown-700 mb-2">
                <i class="fas fa-key text-primary-600 ml-1"></i>
                كلمة المرور الحالية
            </label>
            <input id="update_password_current_password" name="current_password" type="password"
                class="w-full px-4 py-3 rounded-xl border-2 border-cream-300 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all"
                autocomplete="current-password" placeholder="••••••••">
            @error('current_password', 'updatePassword')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- New Password -->
        <div>
            <label for="update_password_password" class="block text-sm font-medium text-brown-700 mb-2">
                <i class="fas fa-lock text-primary-600 ml-1"></i>
                كلمة المرور الجديدة
            </label>
            <input id="update_password_password" name="password" type="password"
                class="w-full px-4 py-3 rounded-xl border-2 border-cream-300 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all"
                autocomplete="new-password" placeholder="••••••••">
            @error('password', 'updatePassword')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-brown-700 mb-2">
                <i class="fas fa-lock text-primary-600 ml-1"></i>
                تأكيد كلمة المرور
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="w-full px-4 py-3 rounded-xl border-2 border-cream-300 focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all"
                autocomplete="new-password" placeholder="••••••••">
            @error('password_confirmation', 'updatePassword')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <button type="submit"
                class="bg-primary-500 text-white px-6 py-3 rounded-xl font-bold hover:bg-primary-600 transition-colors">
                <i class="fas fa-save ml-1"></i>
                حفظ التعديلات
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600">
                    <i class="fas fa-check-circle ml-1"></i>
                    تم التحديث بنجاح
                </p>
            @endif
        </div>
    </form>
</section>
