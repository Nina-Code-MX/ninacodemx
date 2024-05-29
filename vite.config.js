import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/admin.css',
                'resources/css/auth.css',
                'resources/css/app.css',
                'resources/js/admin.js',
                'resources/js/auth.js',
                'resources/js/app.js',
                'resources/js/public/index.js',
                'resources/js/public/contact.js',
                'resources/js/public/pricing.js'],
            refresh: true,
        }),
    ],
    build: {
        minify: 'terser'
    }
});
