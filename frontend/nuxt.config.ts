// https://nuxt.com/docs/api/configuration/nuxt-config
import { resolve } from 'path'
export default defineNuxtConfig({
  devtools: { enabled: true },
  css: ['~/assets/css/main.css'],
  modules: ['@nuxtjs/tailwindcss'],
  runtimeConfig: {
    apiBase: process.env.API_BASE_URL_SERVER || 'http://host.docker.internal:8888/api', // server-side
    public: {
      apiBase: process.env.API_BASE_URL || 'http://localhost:8888/api' // client-side
    }
  },
  ssr: true,
  alias: {
    '@': resolve(__dirname, '.'),
    '@components': resolve(__dirname, './components'),
    '@utils': resolve(__dirname, './utils')
  }
});
