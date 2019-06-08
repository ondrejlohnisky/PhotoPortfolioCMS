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
         <hr>
         <div class="row">
            <div class="col-2">
               <button @click="openUploadModal()" class="btn btn-success rounded btn-md">
                  <font-awesome-icon size="lg" :icon="['fas','plus-circle']"/> new         
               </button>
            </div>
            <div class="col-6"> 
            </div>
            <div class="col-4" id="passwordOptions">
               <h4>Nastavení hesla pro všechny složky:</h4>
               <div class="input-group mb-1">
                  <div class="row">
                     <div class="col-6">
                        <input v-model.lazy="globalPassword" max="12" type="text" class="form-control" placeholder="Heslo pro přístup ke všem zamčeným složkám." />
                     </div>
                     <div class="col-6">
                        <button @click="generatePassword()" class="btn btn-outline-secondary waves-effect btn-sm btn-block">Vygenerovat</button>
                     </div>
                  </div>
                  <br>
               </div>
               <div class="row">
                  <div class="col-12">
                     <button @click="saveGlobalPassword()" class="btn btn-primary btn-block">Uložit heslo</button>
                  </div>
               </div>
            </div>
         </div>
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
div.col-4#passwordOptions{
   border-left:5px double black;
   border-right:5px double black;
   border-radius: 10px;
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
            message:'',
            globalPassword:''
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
         openUploadModal(){
            var top = $(window).scrollTop();
            var left = $(window).scrollLeft();
            $('body').css('overflow', 'hidden');
            $(window).scroll(function(){
               $(this).scrollTop(top).scrollLeft(left);
            });
            this.$store.commit('uploadModal');
         },
         getGlobalPassword(){
            axios.get('/api/property/global-folders-password').then(response => {
               this.globalPassword=response.data.value;
            });
         },
         generatePassword(){
            this.globalPassword='';
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for (var i = 0; i < 12; i++)
               this.globalPassword += possible.charAt(Math.floor(Math.random() * possible.length));
         },
         saveGlobalPassword(){
            axios.post('/api/property/global-folders-password',{'password':this.globalPassword}).then(response => {
               console.log(response);
               this.message="Heslo pro všechny složky <strong>"+this.globalPassword+"</strong> byla uloženo.";
               setTimeout(()=>{
                  this.message='';
               },4000)
            });
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
         this.getGlobalPassword();
      }
   }
</script>