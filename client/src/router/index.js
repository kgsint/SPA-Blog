import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import SinglePost from '../views/SinglePost.vue'
import Login from '../views/Login.vue'
import AdminPosts from '../views/Admin/Posts.vue'
import AdminEditPost from '../views/Admin/PostEdit.vue'

import { useStore } from '../stores/useStore'


const authCheck = (to, from, next) => {
  const store = useStore()

  store.authenticate().then()
}

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/posts/:slug',
      name: 'post',
      component: SinglePost,
      props: true,
    },
    {
      path: '/login',
      name: 'login',
      component: Login,
    },
    {
      path: '/admin/posts',
      name: 'admin-posts',
      component: AdminPosts,
      beforeEnter: (from, to, next) => {
       const store = useStore()

       if(!store.isAuthenticated) {
        return next({ name: 'login'})
       }

       return next();
      }
    },
    {
      path: '/admin/posts/:slug/edit',
      name: 'admin-post-edit',
      component: AdminEditPost,
      props: true,
      beforeEnter: (from, to, next) => {
       const store = useStore()

       if(!store.isAuthenticated) {
        return next({ name: 'login'})
       }

       return next();
      }
    },
  ]
})

export default router