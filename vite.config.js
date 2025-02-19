import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.ts",
                "resources/js/main.js",
                tailwindcss(),
            ],
            refresh: true,
        }),
    ],
    resolve: {
        extensions: [".js", ".ts"],
    },
});
