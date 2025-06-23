import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { resolve } from "path";
import fs from "fs";
import path from "path";

export default defineConfig({
    server: {
        cors: true,
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        // Plugin personalizado para copiar manifest.json
        {
            name: "copy-manifest",
            writeBundle() {
                const viteManifest = path.resolve(
                    __dirname,
                    "public/build/.vite/manifest.json"
                );
                const publicManifest = path.resolve(
                    __dirname,
                    "public/build/manifest.json"
                );

                if (fs.existsSync(viteManifest)) {
                    fs.copyFileSync(viteManifest, publicManifest);
                    console.log("✅ Manifest.json copiado automaticamente");
                }
            },
        },
    ],
    build: {
        manifest: true,
        outDir: "public/build",
        rollupOptions: {
            output: {
                manualChunks: undefined,
            },
        },
    },
    resolve: {
        alias: {
            "@": resolve(__dirname, "resources"),
        },
    },
    // Configuração para copiar automaticamente o manifest.json
    define: {
        __VUE_OPTIONS_API__: true,
        __VUE_PROD_DEVTOOLS__: false,
    },
});
