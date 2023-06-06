import { createRouter, createWebHistory } from "vue-router";
import Upload from '../views/Upload.vue'
import Workers from '../views/Workers.vue'
import SingleWorker from '../views/SingleWorker.vue'
import Shifts from '../views/Shifts.vue'

const routes = [
    {
        path: '/',
        name: 'Upload',
        component: Upload
    },
    {
        path: '/workers',
        name: 'Workers',
        component: Workers
    },
    {
        path: '/worker/:id',
        name: 'SingleWorker',
        component: SingleWorker,
    },
    {
        path: '/shifts',
        name: 'Shifts',
        component: Shifts,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
  })

export default router;