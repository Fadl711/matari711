{{-- Global Loading Indicator Component --}}
{{-- Add this to any page that needs a loading state --}}

<div id="globalLoadingIndicator" style="display: none;"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md mx-4 text-center">
        {{-- Animated Spinner --}}
        <div class="flex justify-center mb-6">
            <svg class="animate-spin h-16 w-16 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
        </div>

        {{-- Loading Text --}}
        <h3 class="text-xl font-bold text-gray-800 mb-2">جاري المعالجة...</h3>
        <p class="text-gray-600 text-sm">يرجى الانتظار، لا تغلق الصفحة</p>

        {{-- Progress Dots --}}
        <div class="flex justify-center gap-2 mt-4">
            <div class="w-2 h-2 bg-blue-600 rounded-full animate-bounce" style="animation-delay: 0s"></div>
            <div class="w-2 h-2 bg-blue-600 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
            <div class="w-2 h-2 bg-blue-600 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
        </div>
    </div>
</div>

<script>
    // Global Loading Indicator Helper Functions
    window.showLoading = function(message = 'جاري المعالجة...') {
        const indicator = document.getElementById('globalLoadingIndicator');
        if (indicator) {
            const messageElement = indicator.querySelector('h3');
            if (messageElement) {
                messageElement.textContent = message;
            }
            indicator.style.display = 'flex';
        }
    };

    window.hideLoading = function() {
        const indicator = document.getElementById('globalLoadingIndicator');
        if (indicator) {
            indicator.style.display = 'none';
        }
    };

    // Auto-show on form submit (optional)
    document.addEventListener('DOMContentLoaded', function() {
        // Show loading for any form that doesn't have custom upload handling
        const forms = document.querySelectorAll('form:not([id="uploadForm"])');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                // Only show loading if it's not an async operation
                if (!this.hasAttribute('data-no-loading')) {
                    showLoading('جاري الإرسال...');
                }
            });
        });
    });
</script>

<style>
    /* Smooth entrance animation */
    #globalLoadingIndicator {
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
</style>
