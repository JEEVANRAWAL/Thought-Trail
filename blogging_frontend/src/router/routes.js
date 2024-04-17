import { Meta } from 'quasar'

const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      // { path: '', component: () => import('pages/IndexPage.vue') }
      {
        path:'',
        component: ()=> import('pages/homePage.vue')
      },
      {
        path:'/blogs',
        component: ()=> import('pages/blogsPage.vue'),
        meta:{auth: true}
      },
      {
        path:'/singlePost',
        component: ()=> import('pages/singlePost-page.vue'),
        meta:{auth:true}
      },
      {
        path:'/writeBlog',
        component: ()=> import('pages/BlogWritting-page.vue'),
        meta:{auth:true}
      },
      {
        path:'/contact',
        component: ()=>import('pages/contactPage.vue'),
        meta:{auth:true}
      }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
