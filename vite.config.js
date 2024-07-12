import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

// Import path for Bootstrap(front-end framework)
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            // Add Alias for resources path
            '~resources': '/resources/',

            // Add Alias for Bootstrap(front-end framework) path
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    },
});
