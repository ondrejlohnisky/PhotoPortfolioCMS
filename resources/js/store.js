import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);
export default new Vuex.Store({
   state:{
      ApiToken: 'undefined',
      uploadModal:false
   },
   mutations:{
      setApiToken(state,token){ // nastavit administrátorký api token pro CRUD  (bezpečnost)
         state.ApiToken=token;
      },
      //upload Modal-otevření/zavření upload modalu
      openModal(state){
         state.uploadModal=true;
      },
      closeModal(state){
         state.uploadModal=false;
      }
   }

});