<template>
   <div class="sideNav">
      <font-awesome-icon v-if="loadedImg" id="close" size="lg" :icon="['fas','angle-double-left']" @click="actionSideNav()"/>
      <div class="sideNavContent">
         <div class="avatar">
            <img id="avatar" @load="loadedImg=true" src="/images/boss.png" alt="Avatar" ><br/>
            <h5 v-if="loadedImg" for="avatar"><font-awesome-icon size="xs" :icon="['fas','circle']" style="color:lightgreen"/> {{ username }}</h5><br/>
         </div>
         <div v-if="loadedImg">
            <ul class="nav">
               <li><router-link :to="{name: 'dashboard'}" :class="this.$route.name=='dashboard' ? 'active navItem' : 'navItem'">Dashboard</router-link></li>
               <li><router-link :to="{name: 'spravaSlozek'}" :class="this.$route.name=='spravaSlozek' ? 'active navItem' : 'navItem'">Správa složek</router-link></li>
               <li><router-link :to="{name: 'spravaSlozek'}" :class="this.$route.name=='spravaAdministratoru' ? 'active navItem' : 'navItem'">Správa administrátorů</router-link></li>
            </ul><br/>
            <Footer class="footer"/>
         </div>
      </div>
   </div>
</template>
<script>
import Footer from './footer'
import {EventBus} from '../event-bus.js';
window.$ = require('jquery');
   export default {
      components:{
         Footer
      },
      props:{
         username:{
            type:String
         }
      },
      data(){
         return{
            loadedImg:false,
            degree:180,
         }
      },
      methods:{
         actionSideNav(){
            EventBus.$emit('actionSideNav');
            $("#close").css({'transform' : 'rotate('+this.degree+'deg)'});
            if (this.degree==180){
               this.degree+=180;
               $(".sideNavContent").hide(600);
            } 
            else{
               this.degree-=180;
               $(".sideNavContent").show(600);

            } 
         }
      }
   }
// $(document).ready(function(){
//    var degree=180;
//    $("#close").click(function(){
//       $("#close").css({'transform' : 'rotate('+degree+'deg)'});
//       if (degree==180) degree+=180;
//       else degree -=180;
//    });
// });

</script>

<style lang="scss" scoped>
@keyframes pending {
   0% {
      right:5px;
   }
   50% {
      right:9px;
   }
   100% {
      right:5px;
   }
}
@-webkit-keyframes pending{
   0% {
      right:5px;
   }
   50% {
      right:9px;
   }
   100% {
      right:5px;
   }
}
@-moz-keyframes pending{
   0% {
      right:5px;
   }
   50% {
      right:9px;
   }
   100% {
      right:5px;
   }
}
a{
   color:unset;
}
h5{
   font-weight: bold;
}

.footer{
   position:absolute;
   bottom:0;
}

#close{
   position:absolute;
   cursor:pointer;
   right:5px;
   top:5px;
   z-index:10000;
   color:darkgrey;
   animation-play-state: running;
   -webkit-animation-play-state: running;
   -moz-animation-play-state: running;
   -webkit-transition: -webkit-transform .2s ease-in;
   -ms-transition: -ms-transform .2s ease-in;
   transition: transform .4s ease-in; 
   
   &:hover{
      color:grey;
      animation: pending .5s linear;
      animation-play-state: running;

      -moz-animation: pending .5s linear;
      -moz-animation-play-state: running;

      -webkit-animation: pending .5s linear;
      -webkit-animation-play-state: running;
   }
}
// #close:active{
//    transform:rotate(180deg);
//    -ms-transform:rotate(180deg);
//    -webkit-transform:rotate(180deg);
// }
.avatar{
   text-align:center;
   img{
      width:40%;
      display:inline-block;
   }

}
.sideNav{
   overflow-y: hidden;
   overflow-x: hidden;
   background-color:rgb(255, 255, 255);
   position:fixed;
   left:0;
   height:100%;
   // background-image: url('/images/sky.jpg');
   // background-repeat: no-repeat;
   // background-position: contain;
   box-shadow: 1px 0px 10px rgba(44, 44, 44, 0.6);
   
}
.nav{
   margin-top:10px;
   list-style-type:none;
   display: flex;
   flex-direction: column;
}
.navItem{
   text-align: left;
   font-size:3vb;
   font-weight: bolder;
   display: block;
   border-top-right-radius: 6px;
   border-bottom-right-radius: 6px;
   color: black;
   width:100%;
   padding:13px 15px;
   text-decoration: none;
   overflow: visible;
   cursor:pointer;
   &:hover{
      border-right:25px solid rgb(200, 200, 200);
      transition:background-color .2s;
      background-color: rgb(223, 223, 223);
      color:rgb(47, 47, 47);
   }
   &:active{
      color:grey;
      background-color: rgb(200, 200, 200);
   }
}
.active{
   border-right:25px solid rgba(0, 128, 0, 0.6) !important;
   background-color: rgb(223, 223, 223);
}

@media (max-width: 991px){
   .footer{
      font-size:6px;
   }
   .sideNav{
      overflow-y: auto;
      overflow-x: hidden;
   }
}


</style>
