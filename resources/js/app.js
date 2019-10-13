import Vue from 'vue';
import VueMeta from 'vue-meta';
import ExampleComponent from './components/ExampleComponent';

Vue.use(VueMeta, {
    tagIDKeyName: 'hid',
    debounceWait: 0,
});

const app = new Vue({
    render: h => h(ExampleComponent),
});

const { set } = app.$meta().addApp('custom');

set({
    bodyAttrs: { class: 'custom-app' },
    meta: [{ charset: 'utf-8' }]
});

export default app;
