import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
    routes:[
        {
            path:'/',
            name:'menu-home',
            component: ()=>import(/*webpackChunkName:"menu-home"*/'./views/HomeViewComponent.vue')
        },
        {
            path:'/users',
            name:'all-users',
            component: ()=>import(/*webpackChunkName:"all-users"*/'./views/user/UsersComponent.vue')
        },
        {
            path:'/myprofile',
            name:'my-profile',
            component: ()=>import(/*webpackChunkName:"my-profile"*/'./views/user/UserProfileView.vue')
        },
        {
            path:'/alladverts',
            name:'all-adverts',
            component: ()=>import(/*webpackChunkName:"all-adverts"*/'./views/adverts/AdvertsIndexView.vue')
        },
        {
            path:'/addadvert',
            name:'add-advert',
            component: ()=>import(/*webpackChunkName:"add-advert"*/'./views/adverts/AdvertFormAddView.vue')
        },
        {
            path:'/showadvert/:id',
            name:'show-advert',  
            props:true,          
            component: ()=>import(/*webpackChunkName:"show-advert"*/'./views/adverts/AdvertShowView.vue')
        },
        {
            path:'/myadverts',
            name:'my-adverts',
            component: ()=>import(/*webpackChunkName:"my-adverts"*/'./views/adverts/MyAdvertsView.vue')
        },
        {
            path:'/contact-page',
            name:'contact',
            component: ()=>import(/*webpackChunkName:"contact"*/'./views/contact/ContactView.vue')
        },
        {
            path:'/allcomments',
            name:'all-comments',
            component: ()=>import(/*webpackChunkName:"all-comments"*/'./views/comments/allCommentsView.vue')
        },
        {
            path:'/categories',
            name:'all-categories',
            component: ()=>import(/*webpackChunkName:"all-categories"*/'./views/categories/CategoriesView.vue')
        },
        {
            path:'/privileges',
            name:'all-privileges',
            component: ()=>import(/*webpackChunkName:"all-privileges"*/'./views/privilege/PrivilegeView.vue')
        },
        {
            path:'/visitors',
            name:'all-visitors',
            component: ()=>import(/*webpackChunkName:"all-visitors"*/'./views/visit/VisitView.vue')
        },
        {
            path:'/showip/:ip/:authenticated',
            name:'show-ip',  
            props:true,          
            component: ()=>import(/*webpackChunkName:"show-ip"*/'./views/visit/VisitShowIp.vue')
        },
        {
            path:'/porfolio',
            name:'my-porfolio',
            component: ()=>import(/*webpackChunkName:"my-porfolio"*/'./views/porfolio/PorfolioView.vue')
        },
        {
            path:'/*',
            name:'no-found',
            component: ()=>import(/*webpackChunkName:"no-found"*/'./views/NoFoundView.vue')
        }        
    ],
    mode: 'history',
})