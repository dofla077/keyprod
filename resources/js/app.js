import Vue from 'vue'
// eslint-disable-next-line no-undef
window.Vue = require('vue').default
import vuetify from 'vuetify'
import VueQRCodeComponent from 'vue-qrcode-component'

// eslint-disable-next-line no-undef
require('./bootstrap')
// eslint-disable-next-line no-undef
require('./components')

// mixin for use laravel dynamic routing
Vue.mixin({
  methods: {
    route: window.route,
  },
})
// eslint-disable-next-line
Vue.component('qr-code', VueQRCodeComponent)

Vue.use(vuetify)

new Vue({
  el: '#app',
  // eslint-disable-next-line no-undef
  vuetify: new vuetify(),
  data: {},
})

// eslint-disable-next-line no-undef
Vue.prototype.$axios = require('axios')
