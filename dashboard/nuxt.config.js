module.exports = {

  css: [
    { src: '~assets/master.scss', lang: 'scss' },
  ],

//  router: {
//    middleware: ['vue-kindergarden']
//  },

  build: {
    vendor: ['axios', 'lodash' ],
    postcss: [
      require('autoprefixer')({
        browsers: ['> 5%']
      })
    ],
  },

//  modules: [
//    '@nuxtjs/auth'
//  ],

  plugins: [
    { src:'~plugins/vue-kindergarten', ssr: false },
//    { src:'~plugins/auth', ssr: false }
  ],

  env: {
    api_url: "http://localhost:4000"
  },

  head: {
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' }
    ],
    script: [
      { src: 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js', body: true },
      { src: 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js', body: true },
      { src: 'https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/js/app.min.js', body: true },
      { src: 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js', body: true },
      { src: 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/locale/ru.js', body: true },
//      { src: 'https://cdnjs.cloudflare.com/ajax/libs/localforage/1.5.0/localforage.min.js', body: true },
      { src: 'https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.1.4/js.cookie.min.js', body: true },
      { src: 'https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js', body: true },
    ]
  }

}
