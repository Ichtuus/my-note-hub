import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router);
const router = new Router({
    mode: "hash",
    routes : [
        {
            path: '/',
            name: 'Home',
            component: () => {
                // @ts-ignore
                return import('../public/Home.vue');
            },
        },
        {
            path: '/hubs/:id',
            name: 'hubs_show',
            component: () => {
                // @ts-ignore
                return import('../components/hubs/show/Hub.vue')
            }
        }
    ]
})

export default router;
