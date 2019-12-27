import webpack from 'webpack';
require('dotenv').config();

process.on('uncaughtException', function (err) {
    console.log(err);
});

export default {
    mode: 'universal',
    /*
    ** Headers of the page
    */
    head: {
        title: process.env.npm_package_name || '',
        meta: [
            {charset: 'utf-8'},
            {name: 'viewport', content: 'width=device-width, initial-scale=1'},
            {hid: 'description', name: 'description', content: process.env.npm_package_description || ''}
        ],
        link: [
            {rel: 'icon', type: 'image/x-icon', href: '/favicon.ico'}
        ]
    },
    /*
    ** Customize the progress-bar color
    */
    loading: {color: '#fff'},
    /*
    ** Global CSS
    */
    css: [
        '@/assets/scss/main.scss',
    ],
    render: {
        bundleRenderer: {
            shouldPreload: (file, type) => {
                return ['script', 'style', 'font'].includes(type)
            }
        }
    },
    /*
    ** Plugins to load before mounting the App
    */
    plugins: [],
    /*
    ** Nuxt.js dev-modules
    */
    buildModules: [],
    /*
    ** Nuxt.js modules
    */
    modules: [
        // Doc: https://axios.nuxtjs.org/usage
        '@nuxtjs/axios',
        // Doc: https://github.com/nuxt-community/dotenv-module
        '@nuxtjs/dotenv',
        'nuxt-i18n',
    ],

    i18n: {
        locales: [
            {
                name: 'Ukrainian',
                code: 'uk',
                iso: 'uk-UA',
                file: 'uk-UA.js'
            },
            {
                name: 'English',
                code: 'en',
                iso: 'en-US',
                file: 'en-US.js'
            },
            {
                name: 'Russian',
                code: 'ru',
                iso: 'ru-RU',
                file: 'ru-RU.js'
            },
        ],
        lazy: true,
        langDir: 'lang/',
        defaultLocale: 'ru',
    },

    /*
    ** Axios module configuration
    ** See https://axios.nuxtjs.org/options
    */
    axios: {
        baseURL: process.env.BASE_URL || 'http://localhost:3000',
    },

    /*
    ** Build configuration
    */
    build: {
        vendor: ["jquery"],
        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
                '_': 'lodash',
                'axios': 'axios'
            })
        ],
        /*
        ** You can extend webpack config here
        */
        extend(config, ctx) {
        }
    }
}
