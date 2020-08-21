/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('menu-component', require('./components/MenuComponent.vue').default);

// Componentes 
Vue.component('option-component',require('./components/OptionComponent.vue').default);

/** usuarios autenticado */
Vue.component('authenticated-component',require('./components/authenticated/AuthenticatedComponent.vue').default);

// Ruta Inicial home
Vue.component('home-component', require('./views/HomeViewComponent.vue').default);

// Paginacion
Vue.component('listpage-component',require('./pagination/ListPageComponent').default);
Vue.component('page-component', require('./pagination/PageComponent.vue').default);

// USER components
Vue.component('user-component', require('./components/userComp/UserComponent.vue').default);
Vue.component('userformedit-component', require('./components/userComp/UserFormEditComponent.vue').default);
Vue.component('userconfirmdelete-component', require('./components/userComp/UserConfirmDeleteComponent.vue').default);
Vue.component('users-component', require('./views/user/UsersComponent.vue').default);
Vue.component('userprofile-view', require('./views/user/UserProfileView.vue').default);

// Adverts components and views
Vue.component('advertsindex-view',require('./views/adverts/AdvertsIndexView.vue').default);
Vue.component('advertformadd-view',require('./views/adverts/AdvertFormAddView.vue').default);
Vue.component('advertshow-view',require('./views/adverts/AdvertShowView.vue').default);
Vue.component('myadverts-view',require('./views/adverts/MyAdvertsView.vue').default);
Vue.component('advertformupdate-component',require('./components/advert/AdvertFormUpdateComponent.vue').default);
Vue.component('advertform-component',require('./components/advert/AdvertFormComponent.vue').default);
Vue.component('adveraddimage-component',require('./components/advert/AdvertAddImagesComponent.vue').default);
Vue.component('advertshow-component',require('./components/advert/AdvertShowComponent.vue').default);
Vue.component('advertslist-component',require('./components/advert/AdvertsListComponent.vue').default);
Vue.component('advertimageslist-component',require('./components/advert/AdvertImagesListComponent.vue').default);

// Categories components and view
Vue.component('selectCategories-component',require('./components/category/SelectCategoryComponent.vue').default);
Vue.component('categorytable-component',require('./components/category/CategoryTableComponent.vue').default);

// Privilege component
Vue.component('privilegetable-component',require('./components/privileges/PrivilegeTableComponent.vue').default);

// vista de contacto
Vue.component('contact-view',require('./views/contact/ContactView.vue').default);

// COMMENTS components and view
Vue.component('commentary-component', require('./components/comments/CommentaryComponent.vue').default);
Vue.component('form-component', require('./components/comments/FormComponent.vue').default);
Vue.component('comments-view', require('./views/comments/allCommentsView.vue').default);


// Vista cuando no coincide la direccion
Vue.component('nofund-view',require('./views/NoFoundView.vue').default);

// componente exterior para hacer pagina infinita
Vue.component('infinite-loading', require('vue-infinite-loading').default);

// Errors component
Vue.component('errors-component', require('./components/errors/ErrorsComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
*/

import auth from './mixins/auth';
import imagesAddress from './mixins/imagesAddress';
import router from './routes';
import $ from 'jquery-validation';
import { BootstrapVue} from 'bootstrap-vue'

Vue.use(BootstrapVue)


Vue.mixin(auth);
Vue.mixin(imagesAddress);

const app = new Vue({
    el: '#app',
    router,
});
