
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
        component: ()=> import('pages/blogsPage.vue')
      },
      {
        path:'/singlePost',
        component: ()=> import('pages/singlePost-page.vue')
      },
      {
        path:'/writeBlog',
        component: ()=> import('pages/BlogWritting-page.vue')
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
