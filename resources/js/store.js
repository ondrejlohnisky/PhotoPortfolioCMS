import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);
export default new Vuex.Store({
   state:{
      ApiToken: 'undefined',
      uploadModal:false,
      settingModal:false,
      folderPassword:'',
      showSlider:false,
      user:{}
   },
   mutations:{
      setFolderPassword(state,password){
         state.folderPassword=password;
      },
      setApiToken(state,token){ // nastavit administrátorký api token pro CRUD  (bezpečnost)
         state.ApiToken=token;
      },
      setUser(state,user){
         state.user=user;
      },
      //upload Modal-otevření/zavření upload modalu
      uploadModal(state){
         state.uploadModal=!state.uploadModal;
      },
      settingModal(state){
         state.settingModal=!state.settingModal;
      },
      //slider zavřít
      toggleSlider(state){
         state.showSlider=!state.showSlider;
      }
   }

});