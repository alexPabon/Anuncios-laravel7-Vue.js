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
            path:'/*',
            name:'no-found',
            component: ()=>import(/*webpackChunkName:"no-found"*/'./views/NoFoundView.vue')
        }        
    ],
    mode: 'history',
})