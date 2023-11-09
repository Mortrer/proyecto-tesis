require('./bootstrap');

global.$ = global.jQuery = require('jquery');

import { createApp } from 'vue';

createApp({}).mount("#app");