
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuex from 'vuex';
Vue.use(Vuex);

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
Vue.component('resourcetab', require('./components/ResourceTab.vue').default);
Vue.component('wioska', require('./components/Wioska.vue').default);
Vue.component('hero', require('./components/Hero.vue').default);



Vue.component('gra', require('./components/Gra.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 const store = new Vuex.Store({
     state:{
         dane:{},
         test:'test',
         coins:null,
         log:''
     },
     actions:{
         loadData(context){
             axios.get('statdata').then(r=>r.data).then((res) => context.commit('loadData',res[0]));
         },
         updateResources(context){
             let self = this;
             axios.patch('update').then((res)=>console.log('update ukończony')).then((res)=>context.dispatch('loadData'));
         },
         // ,checkMax(){
         //     let self = this;
         //     let resources=['wood','stone','iron'];
         //     for(let i=0;i<resources.length;i++){
         //         let operand = resources[i];
         //         let max = self.dane[operand+'Store']*100+200;
         //
         //         if (self.dane[operand] > max){
         //             self.dane[operand]=max;
         //             console.log('działa');
         //         }
         //
         //     }
         // },

    },
     mutations:{
         loadData (state, coins) {
         state.dane = coins
     },
     resHack(state){
         state.dane.wood=300;
         state.dane.stone=300;
         state.dane.iron=300;
     },
   },
   updateResources(){

   }



 })

const app = new Vue({
    el: '#app',
    store,
    data:{
        test:'siemano'
    },
    created(){
        this.$store.dispatch('loadData');
    }
});
