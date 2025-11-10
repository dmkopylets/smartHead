import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import tailwindcss from '@tailwindcss/vite'

// ✅ Повна підтримка TallStackUI, Livewire, Tailwind і Blade-refresh
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: [
                'resources/views/**/*.blade.php',
                'app/Http/Livewire/**/*.php',
                'resources/js/**/*.js',
            ],
        }),
        tailwindcss(),
    ],

    build: {
        outDir: 'public/build',
        manifest: true,
        emptyOutDir: true,
    },

    server: {
        cors: true,
        hmr: {
            host: 'localhost',
        },
    },
})
