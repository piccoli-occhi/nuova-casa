import tailwindcss from "@tailwindcss/vite"
import vue from "@vitejs/plugin-vue"
import laravel from "laravel-vite-plugin"
import path from "path"
import { defineConfig } from "vite"

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/js/app.ts"],
            ssr: "resources/js/ssr.ts",
            refresh: true,
        }),
        tailwindcss(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
                compilerOptions: {
                    isCustomElement: (tag) => tag.startsWith("p-"),
                },
            },
        }),
    ],
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "./resources/js"),
        },
    },
})
