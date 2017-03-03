/**
 * Created by apple on 2017/1/21.
 */
require('./module-one');
require('./module-two');
import Vue from 'vue';
import Heading from './components/heading.vue';
new Vue({
    el: '#app',
    components: { Heading }
});
require('../css/style.css');