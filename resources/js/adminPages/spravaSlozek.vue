<template>
   <div class="disabledByModal">
      <div>
         <transition name="slide-fade">
            <div v-if="message" class="alert alert-success" role="alert">
               <div v-html="message"></div>
            </div>
         </transition>
         <h2>Správa složek</h2>
         <br/>
         <button @click="openUploadModal()" class="btn btn-success rounded btn-md">
            <font-awesome-icon size="lg" :icon="['fas','plus-circle']"/> new         
         </button>
         <hr>
         <div class="row">
            <div @click="routerPush({ name: 'adminfolder',params:{id:folder.id}})" class="col-md-3" v-for="(folder,index) in folders" :key="index">
               <folder :folder="folder"/>
            </div>
         </div>
      </div>
   </div>
</template>

<style lang="scss" scoped>
.slide-fade-enter-active {
  transition: all .5s ease-in;
}
.slide-fade-leave-active {
  transition: all .8s ease-out;
}
.slide-fade-enter, .slide-fade-leave-to{
   margin-top:-65px;
   opacity:0;
}
</style>



<script>
import folder from '../components/folder'
import {EventBus} from '../event-bus.js'
   export default {
      components:{
         folder
      },
      data(){
         return{
            folders:[],
            uploadModal:false,
            message:''
         }
      },
      methods:{
         routerPush(params){
            this.$router.push(params);
         },
         getFolders(){
            axios.get('/api/folders').then((response) =>{
               this.folders=response.data.data;
            })
         },
         uploadFolder(){
            axios.post('/api/folders',)
         },
         openUploadModal(){
            var top = $(window).scrollTop();
            var left = $(window).scrollLeft();
            $('body').css('overflow', 'hidden');
            $(window).scroll(function(){
               $(this).scrollTop(top).scrollLeft(left);
            });
            this.$store.commit('uploadModal');
         }
      },
      mounted(){
         var that = this;
         this.getFolders();
         EventBus.$on("folderUploaded",(title)=>{
            this.getFolders();
            this.message="Složka <strong>"+title+"</strong> byla vytvořena.";
            setTimeout(()=>{
               this.message='';
            },4000)
         });
         console.log(this.$store.state.ApiToken);
      }
   }
</script>