
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
import 'es6-promise/auto'
import Vuex from 'vuex'
import store from  './store'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faFacebook,faInstagram,faFlickr,faYoutube } from '@fortawesome/free-brands-svg-icons'
import { faAngleLeft,faAngleRight,faDotCircle,faCircle,faEllipsisH,faAngleDoubleLeft,faCog,faSignOutAlt,faDesktop,faPlusCircle,faImages,faImage,faLock,faTrashAlt,faCheckCircle, faSave, faEdit} from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// veřejné stránky
import Bts from './pages/bts'
import Contact from './pages/contact'
import Portfolio from './pages/portfolio'
import Review from './pages/review'
import Home from './pages/home'
import Folder from './pages/folder'

// admin stránky

import SpravaSlozek from './adminPages/spravaSlozek'
import Dashboard from './adminPages/dashboard'
import AdminFolder from './adminPages/adminfolder'
import AdminReview from './adminPages/AdminReview'
import Administratori from './adminPages/administratori'

//rozdělovací komponenty mezi veřejnými a administrátorkými stránky
import page from './page'
import admin from './admin'

library.add(faFacebook,faInstagram,faFlickr,faYoutube,faAngleLeft,faAngleRight,faDotCircle,faCircle,faEllipsisH,faAngleDoubleLeft,faDesktop,faCog,faSignOutAlt,faPlusCircle,faImage,faImages,faLock,faTrashAlt,faCheckCircle,faSave,faEdit)

Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.use(VueRouter)
Vue.use(Vuex)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'default',
            component: Home,
        },
        {
            path: '/home',
            name: 'home',
            component: Home,
        },
        {
            path: '/portfolio',
            name: 'portfolio',
            component: Portfolio,
        },
        {
            path: '/bts',
            name: 'bts',
            component: Bts
        },
        {
            path: '/kontakt',
            name: 'contact',
            component: Contact
        },
        {
            path: '/review',
            name: 'review',
            component: Review
        },
        {
            path: '/folder/:id',
            name: 'folder',
            component: Folder
        },
        {
            path: '/admin/sprava_slozek',
            name: 'spravaSlozek',
            component: SpravaSlozek
        },
        {
            path: '/admin/dashboard',
            name: 'dashboard',
            component: Dashboard
        },
        {
            path: '/admin/folder/:id',
            name: 'adminfolder',
            component: AdminFolder
        },{
            path: '/admin/review',
            name: 'adminreview',
            component: AdminReview
        },{
            path: '/admin/administratori',
            name: 'administratori',
            component: Administratori
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: {page,admin},
    store,
    router
});