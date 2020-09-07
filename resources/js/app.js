import VueMeta from 'vue-meta';
import App from './components/App.vue';
import Vue from 'vue';
import router from './router'

Vue.use(VueMeta, {
    tagIDKeyName: 'hid',
    debounceWait: 0,
});

const app = new Vue({
    router,
    render: h => h(App),
});

const { set } = app.$meta().addApp('custom');

set({
    bodyAttrs: { class: 'custom-app' },
    meta: [{ charset: 'utf-8' }]
});

export default app;
