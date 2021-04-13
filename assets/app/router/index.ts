import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router);
const router = new Router({
    mode: "hash",
    routes : [
        {
            path: '/',
            name: 'Home',
            component: () => import('../public/Home.vue')
        },
        {
            path: '/hub/:id',
            name: 'hubs_show',
            component: () => import('../components/hubs/show/Hub.vue')
        },
        {
            path: '/hub/:id/settings',
            name: 'hub_show_settings',
            component: () => import('../components/settings/hub/HubSettings.vue')
        }
    ]
})

export default router;
