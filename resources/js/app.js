import Vue from 'vue'
// eslint-disable-next-line no-undef
window.Vue = require('vue').default
import vuetify from 'vuetify'

// eslint-disable-next-line no-undef
require('./bootstrap')
// eslint-disable-next-line no-undef
require('./components')



// mixin for use laravel dynamic routing
/*Vue.mixin({
  methods: {
    route: window.route,
  },
})*/

Vue.use(vuetify)

new Vue({
  el: '#app',
  // eslint-disable-next-line no-undef
  vuetify: new vuetify(),
  data: {},
})

// eslint-disable-next-line no-undef
Vue.prototype.$axios = require('axios')

/*import { createApp } from 'vue'

import OrderIndex from './pages/orders/Index'

let app = createApp({})
app.use()

app.component('KpOrderIndex', OrderIndex)

app.mount('#app')*/
