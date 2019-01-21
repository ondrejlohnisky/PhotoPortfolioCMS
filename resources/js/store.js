import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);
export default new Vuex.Store({
   state:{
      ApiToken: 'undefined',
      uploadModal:false,
      folderPassword:''

   },
   mutations:{
      setFolderPassword(state,password){
         state.folderPassword=password;
      },
      setApiToken(state,token){ // nastavit administrátorký api token pro CRUD  (bezpečnost)
         state.ApiToken=token;
      },
      //upload Modal-otevření/zavření upload modalu
      openUploadModal(state){
         state.uploadModal=true;
      },
      closeUploadModal(state){
         state.uploadModal=false;
      }
   }

});