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
                // Kita ganti Figtree menjadi Times New Roman
                // Gunakan tanda kutip dua di dalam tanda kutip satu karena nama font pakai spasi
                sans: ['"Times New Roman"', 'Times', 'serif', ...defaultTheme.fontFamily.serif],
            },
        },
    },

    plugins: [forms],
};