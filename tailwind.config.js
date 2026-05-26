/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: '#0B0B0B',
                accent: '#D4AF37', // Gold
                surface: '#1A1A1A',
                surfaceLight: '#262626'
            },
            fontFamily: {
                sans: ['Inter', 'Tajawal', 'sans-serif'],
            },
        },
    },
    plugins: [],
}
