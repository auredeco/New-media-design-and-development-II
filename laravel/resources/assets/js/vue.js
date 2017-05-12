import Vue from 'vue'
import VueRouter from 'vue-router'
import navigation from './components/navigation.vue'
import vuehead from './components/vuehead.vue'
import  home from './components/pages/home.vue'
import  account from './components/pages/account.vue'
import  elections from './components/pages/elections.vue'
import  referenda from './components/pages/referenda.vue'
import  groups from './components/pages/groups.vue'
import  parties from './components/pages/parties.vue'
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);
Vue.use(VueRouter);

const routes = [
    { path: '/', component: home },
    { path: '/elections', component: elections },
    { path: '/referenda', component: referenda },
    { path: '/groups', component: groups },
    { path: '/parties', component: parties },
    { path: '/account', component: account },
]
const router = new VueRouter({
    routes // short for routes: routes
})
new Vue({
    router,
    el: '#app',
    components: {navigation, vuehead}
})