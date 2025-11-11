import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            // refresh: true,
            refresh: [
                'resources/views/**/*.blade.php',
                'app/Http/Livewire/**/*.php',
                'resources/js/**/*.js',
                'vendor/tallstackui/tallstackui/src/resources/views/**/*.blade.php',
            ],
            // buildDirectory: 'build',
        }),
        tailwindcss(),
    ],

    build: {
        outDir: 'public/build',
        manifest: 'manifest.json',
        emptyOutDir: true,
        assetsDir: '',
    },

    server: {
        cors: true,
        hmr: {
            host: 'localhost',
        },
    },
})
