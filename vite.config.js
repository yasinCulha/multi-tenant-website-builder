import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",

                "resources/css/themes/corporate-blue/app.css",
                "resources/css/themes/modern-dark/app.css",

                "resources/views/tenant/website/admin/assets/css/app.css",
                "resources/views/tenant/website/admin/assets/js/app.js",

                "resources/views/tenant/website/themes/corporate-blue/assets/css/app.css",
                "resources/views/tenant/website/themes/modern-dark/assets/css/app.css",
                "resources/views/tenant/website/themes/modern-dark/assets/js/app.js",
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "@": "/resources",
        },
    },
});
