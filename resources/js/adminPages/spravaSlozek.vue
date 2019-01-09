<template>
   <div class="disabledByModal">
      <div>
         <h2>Správa složek</h2>
         <br/>
         <button @click="openUploadModal()" class="btn btn-success rounded btn-md">
            <font-awesome-icon size="lg" :icon="['fas','plus-circle']"/> new         
         </button>
         <br/>
         <br/>
         <div class="row">
            <folder class="col-md-3" v-for="(folder,index) in folders" :key="index" :folder="folder"/>
         </div>
      </div>
   </div>
</template>

<style lang="scss" scoped>

</style>



<script>
import folder from '../components/folder'
   export default {
      components:{
         folder
      },
      data(){
         return{
            folders:[],
            uploadModal:false,
            folderUpload:{}
         }
      },
      methods:{
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
            this.$store.commit('openUploadModal');
         }
      },
      mounted(){
         this.getFolders();
         console.log(this.$store.state.ApiToken);
      }
   }
</script>