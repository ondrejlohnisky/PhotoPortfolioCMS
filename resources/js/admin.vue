<template>
   <div class="admin">
      <uploadModal v-if="$store.state.uploadModal"/>
      <adminSideNavigation :username="user.name" class="sideNavigation"/>
      <adminNavigation class="navigation"/>
      <div class="content">
         <div class="container-fluid">
            <router-view/>
         </div>
      </div>
   </div>
</template>

<script>
import adminNavigation from './components/adminNavigation'
import adminSideNavigation from './components/adminSideNavigation'
import uploadModal from './components/uploadModal'
import {EventBus} from './event-bus.js'
   export default {
      props:{
         userdata: {
            type: String,
            required: true
         }
      },
      data(){
         return{
            uploadModal:false
         }
      },
      computed:{
         user(){
            return JSON.parse(this.userdata);
         }
      },
      components:{
         adminSideNavigation,
         adminNavigation,
         uploadModal
      },
      mounted() {
         this.$store.commit('setApiToken',this.user.api_token);
      }
   }
var counter=0;
EventBus.$on('actionSideNav',function(){
   if(counter%2==0){
      if (window.matchMedia('(max-width: 365px)').matches) {

         $(".content").animate({ 'margin-left': '40px'},500);
         $(".sideNavigation").animate({ left: '-120px'},500);
         $(".navigation").animate({ 'margin-left': '30px'},500);
      } else if (window.matchMedia('(max-width: 991px)').matches) {

         $(".content").animate({ 'margin-left': '45px'},500);
         $(".sideNavigation").animate({ left: '-175px'},500);
         $(".navigation").animate({ 'margin-left': '25px'},500);
      } else {
         $(".content").animate({ 'margin-left': '50px'},500);
         $(".sideNavigation").animate({ left: '-270px'},500);
         $(".navigation").animate({ 'margin-left': '30px'},500);
      };
      counter++;
   }else{
      if (window.matchMedia('(max-width: 365px)').matches) {

         $(".content").animate({ 'margin-left': '160px'},500);
         $(".sideNavigation").animate({ left: '0px'},500);
         $(".navigation").animate({ 'margin-left': '150px'},500);
      } else if (window.matchMedia('(max-width: 991px)').matches) {

         $(".content").animate({ 'margin-left': '225px'},500);
         $(".sideNavigation").animate({ left: '0px'},500);
         $(".navigation").animate({ 'margin-left': '200px'},500);
      } else {
         $(".content").animate({ 'margin-left': '325px'},500);
         $(".sideNavigation").animate({ left: '0px'},500);
         $(".navigation").animate({ 'margin-left': '300px'},500);
      };
      counter++;
   }
});
</script>

<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css?family=Roboto:500');
   *{
      font-family: 'Roboto', sans-serif;
   }
   .admin{
      position:absolute;
      height:100%;
      width:100%;
      background-color: rgb(238, 238, 238);
   }
   .content{
      position:relative;
      z-index: 1000;
      margin-top:25px;
      margin-left:325px;
   }
   .sideNavigation{
      width:300px;
      z-index:15000;
   }
   .navigation{
      z-index:10000;
      margin-left:300px;
   }

   @media (max-width: 991px){
      .content{
         margin-left:225px;
      }
      .sideNavigation{
         width:200px;
      }
      .navigation{
         margin-left:200px;
      }
   }

   @media (max-width: 365px){
      .content{
         margin-left:160px;
      }
      .sideNavigation{
         width:150px;
      }
      .navigation{
         margin-left:150px;
      }
   }

</style>
