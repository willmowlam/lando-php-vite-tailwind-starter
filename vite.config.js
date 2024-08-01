import { defineConfig } from "vite";
import tailwindcss from "tailwindcss";
import autoprefixer from "autoprefixer";

export default defineConfig({
  root: "src",
  build: {
    outDir: "../public/dist",
    emptyOutDir: true,
    rollupOptions: {
      input: {
        main: "./src/main.js",
      },
    },
    manifest: "manifest.json",
  },

  // server: {
  //   https: false,
  //    host: true,
  //   port: 3009,
  //    hmr: { host: "localhost", protocol: "ws" },
  //  },
  css: {
    postcss: {
      plugins: [tailwindcss, autoprefixer],
    },
  },
});
