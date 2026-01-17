import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Tajawal', 'Noto Kufi Arabic', ...defaultTheme.fontFamily.sans],
                arabic: ['Amiri', 'serif'],
            },
            colors: {
                // الألوان الإسلامية
                primary: {
                    50: '#ecfdf5',
                    100: '#d1fae5',
                    200: '#a7f3d0',
                    300: '#6ee7b7',
                    400: '#34d399',
                    500: '#0d6f5a', // الأخضر الزمردي الرئيسي
                    600: '#0b5e4c',
                    700: '#094d3f',
                    800: '#073d32',
                    900: '#052e26',
                },
                gold: {
                    50: '#fefce8',
                    100: '#fef9c3',
                    200: '#fef08a',
                    300: '#fde047',
                    400: '#facc15',
                    500: '#d4af37', // الذهبي
                    600: '#b8960f',
                    700: '#9a7d0a',
                    800: '#7c6408',
                    900: '#5e4b06',
                },
                cream: {
                    50: '#fdfcf9',
                    100: '#f9f7f0',
                    200: '#f5f2e8', // البيج الكريمي
                    300: '#ebe5d5',
                    400: '#d9ceb8',
                    500: '#c6b69a',
                },
                brown: {
                    50: '#faf5f0',
                    100: '#f0e6d8',
                    200: '#e0ccb0',
                    300: '#cba77a',
                    400: '#b58850',
                    500: '#8b6f47',
                    600: '#6b5636',
                    700: '#4a3728', // البني الداكن للنصوص
                    800: '#3a2b1f',
                    900: '#2a1f16',
                },
            },
            backgroundImage: {
                'islamic-pattern': "url('/images/islamic-pattern.png')",
            },
        },
    },

    plugins: [forms],
};
