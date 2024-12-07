import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    light: '#D4EBF8',    // Biru Muda
                    DEFAULT: '#1F509A',   // Biru Medium
                    dark: '#0A3981',      // Biru Gelap
                },
                accent: '#E38E49',        // Orange
                surface: {
                    light: '#FFFFFF',
                    DEFAULT: '#F8FAFC',
                    dark: '#1E293B',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
