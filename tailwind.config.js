/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./app/**/*.php",
        "./app/Livewire/**/*.php",
    ],
    theme: {
        extend: {
            width: {
                'md': '120px',
                'lg': '240px',
                'xl': '360px',
                '2xl': '480px',
                '3xl': '600px',
                '4xl': '720px',
                '5xl': '840px',
                '6xl': '960px',
            },
            minWidth: {
                'md': '120px',
                'lg': '240px',
                'xl': '360px',
                '2xl': '480px',
                '3xl': '600px',
                '4xl': '720px',
                '5xl': '840px',
                '6xl': '960px',
            },
            maxHeight: {
                'md': '120px',
                'lg': '240px',
                'xl': '360px',
                '2xl': '480px',
                '3xl': '600px',
                '4xl': '720px',
                '5xl': '840px',
                '6xl': '960px',
            },
            keyframes: {
                'slide-in-right': {
                  '0%': { transform: 'translateX(100%)', opacity: '0' },
                  '100%': { transform: 'translateX(0)', opacity: '1' },
                },
                'slide-out-left': {
                  '0%': { transform: 'translateX(0)', opacity: '1' },
                  '100%': { transform: 'translateX(-100%)', opacity: '0' },
                },
              },
              animation: {
                'slide-in-right': 'slide-in-right 1s ease-in-out forwards',
                'slide-out-left': 'slide-out-left 1s ease-in-out forwards',
              },
        },
    },
    plugins: [
        require('tailwindcss'),
        function ({ addUtilities }) {
            addUtilities({
                '.avoid-break': {
                    'break-inside': 'avoid',
                },
                '.btn': {
                    position: 'relative',
                    overflow: 'hidden',
                    textDecoration: 'none',
                    display: 'inline-block',
                    border: '1px solid #0a9396', // 海っぽいボーダーカラー
                    padding: '10px 30px',
                    textAlign: 'center',
                    outline: 'none',
                    transition: 'ease .2s',
                },
                '.btn span': {
                    position: 'relative',
                    zIndex: 3,
                    color: '#0a9396', // 海っぽいテキストカラー
                },
                '.btn:hover span': {
                    color: '#e9d8a6', // ホバー時のテキストカラー（ライトな海カラー）
                },
                '.bgleft:before': {
                    content: '""',
                    position: 'absolute',
                    top: 0,
                    left: 0,
                    zIndex: 2,
                    background: '#0a9396',
                    width: '100%',
                    height: '100%',
                    transition: 'transform .6s cubic-bezier(0.8, 0, 0.2, 1) 0s',
                    transform: 'scale(0, 1)',
                    transformOrigin: 'right top',
                },
                '.bgleft:hover:before': {
                    transformOrigin: 'left top',
                    transform: 'scale(1, 1)',
                },
            }, ['responsive']);
        },
    ],
}
