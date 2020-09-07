import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router);

function PageComponent(name) {
    return {
        metaInfo: {
            title: `${name}`,
        },
        render: h => h('h3', `Hello from the ${name} page`),
    };
}

export default new Router({
    mode: 'history',
    routes: [
        { path: '/', component: PageComponent('Home'), name: 'home' },
        { path: '/about', component: PageComponent('About'), name: 'about' },
        { path: '/contact', component: PageComponent('Contact'), name: 'contact' }
    ],
});
