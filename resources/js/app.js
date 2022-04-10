// eslint-disable-next-line no-undef
require('./bootstrap')
import { createApp } from 'vue'

// eslint-disable-next-line no-undef
//require('./components')
import components from  './components'


//app.use(components)

let app=createApp(components)
app.mount('#app')

/*new Vue({
  el: '#app',
  data: {},
})*/
