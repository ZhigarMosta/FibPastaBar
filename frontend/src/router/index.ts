import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta:{layoutHeader:'default'}
    },
    {
      path: '/orders',
      name: 'orders',
      component: () => import('../views/OrdersView.vue'),
      meta:{layoutHeader:'default'}
    },
    {
      path: '/backet',
      name: 'backet',
      component: () => import('../views/BacketView.vue'),
      meta:{layoutHeader:'backet',progress:'backet'}
    },
    {
      path: '/confim_order',
      name: 'confim_order',
      component: () => import('../views/ConfimOrderView.vue'),
      meta:{layoutHeader:'backet',progress:'orderDesign'}
    },
    {
      path: '/order',
      name: 'order',
      component: () => import('../views/OrderView.vue'),
      meta:{layoutHeader:'backet',progress:'orderAccepted'}
    },
  ],
})
declare module 'vue-router' {
  interface RouteMeta {
    layoutHeader: "backet" | "default",
    progress?: "backet" | "orderDesign" | "orderAccepted"
  }
}
export default router
