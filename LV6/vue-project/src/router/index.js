import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import LoginView from "../views/auth/LoginView.vue"
import store from '../store/index'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView
    },
    {
      path: "/create",
      name: "create",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/CreateView.vue"),
    },
    {
      path: "/update/:id",
      name: "update",
      component: () => import("../views/UpdateView.vue"),
      props(route) {
        const props = { ...route.params }
        props.price = +props.price
        return props
      }
    },
    {
      path: "/login",
      name: "Login",
      component: LoginView
    },
    {
      path: "/register",
      name: "Register",
      component: () => import("../views/auth/RegisterView.vue"),
    },
  ],
});

router.beforeEach((to, from, next) => {
  if ((to.name !== 'Login' && to.name !== 'Register' ) && !store.state.auth) next({ name: 'Login' })
  else if(( to.name === 'Login' || to.name === 'Register' ) && store.state.auth) next({ name: 'home' })
  else next()
})


export default router;
