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
            colors: {
                primary: {
                    DEFAULT: '#1677ff',
                    50: '#e6f4ff',
                    100: '#bae0ff',
                    200: '#91caff',
                    300: '#69b1ff',
                    400: '#4096ff',
                    500: '#1677ff',
                    600: '#0958d9',
                    700: '#003eb3',
                    800: '#002c8c',
                    900: '#001d66',
                },
                'primary-container': '#1677ff',
                'primary-dark': '#0958d9',
                'primary-light': '#e6f4ff',
                'brand-bg': '#fafafb',
                'surface-low': '#fafafb',
                'surface-high': '#f5f5f5',
                'surface-highest': '#f0f0f0',
                'surface-lowest': '#ffffff',
                'text-on-surface': '#262626',
                'text-heading': '#141414',
                'text-variant': '#8c8c8c',
                'sidebar-bg': '#ffffff',
                'border-color': '#f0f0f0',
                'error-container': '#fff1f0',
                'error-dark': '#cf1322',
                'outline-variant': '#f0f0f0',
            },
            fontFamily: {
                sans: ['"Public Sans"', ...defaultTheme.fontFamily.sans],
                headline: ['"Public Sans"', ...defaultTheme.fontFamily.sans],
                body: ['"Public Sans"', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                mantis: '0 1px 2px 0 rgba(0, 0, 0, 0.03), 0 1px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px 0 rgba(0, 0, 0, 0.02)',
                'mantis-hover': '0 4px 12px 0 rgba(0, 0, 0, 0.06)',
                'mantis-dropdown': '0 6px 16px 0 rgba(0, 0, 0, 0.08), 0 3px 6px -4px rgba(0, 0, 0, 0.12), 0 9px 28px 8px rgba(0, 0, 0, 0.05)',
            },
            borderRadius: {
                mantis: '8px',
            }
        },
    },

    plugins: [forms],
};
