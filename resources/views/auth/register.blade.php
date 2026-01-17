<x-guest-layout>
    <script>
        // بدء الجلسة لمدة 30 ثانية
        let sessionTimer = setTimeout(() => {
            alert('انتهت الجلسة، يرجى إعادة المحاولة.');
            window.location.reload();
        }, 30000);

        function cancelTimer() {
            clearTimeout(sessionTimer);
        }

        function validateForm(event) {
            const imgInput = document.getElementById('example1');

            if (imgInput.files.length > 0) {
                const fileSize = imgInput.files[0].size / 1024;

                if (fileSize > 800) {
                    alert('حجم الصورة كبير جدًا. الحد الأقصى المسموح به هو 800 كيلو بايت.');
                    event.preventDefault();
                    return false;
                }
            }

            return true; // إذا كان كل شيء صحيحًا
        }
    </script>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" onsubmit="return validateForm(event) && cancelTimer()">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <div class=" max-w-xs">
                <label for="example1" class="mb-1 block text-sm font-medium text-gray-700">الصورة</label>
                <input id="example1" accept="image/*" name="img" type="file" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
