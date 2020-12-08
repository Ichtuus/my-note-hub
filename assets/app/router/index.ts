import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router);
const router = new Router({
    mode: "hash",
    routes : [
        {
            path: '/',
            name: 'Home',
            component: () => import('../public/Home.vue'),
        }
    ]
})

export default router;
