
require('./bootstrap');

import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

const opts = {}

export default new Vuetify(opts)

import VueVideoPlayer from 'vue-video-player'

// require videojs style
import 'video.js/dist/video-js.css'
// import 'vue-video-player/src/custom-theme.css'

Vue.use(VueVideoPlayer, /* {
  options: global default options,
  events: global videojs events
} */)

// import store from 'store'


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('empleado-component', require('./components/EmpleadoComponent').default);
Vue.component('cliente-component', require('./components/ClienteComponent').default);


const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
});
