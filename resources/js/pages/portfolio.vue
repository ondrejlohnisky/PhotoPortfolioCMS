<template>
   <div>
      <div class="row">
         <router-link class="col-md-4" :to="{ name: 'folder',params:{id:folder.id} }" v-for="(folder,index) in folders" :key="index" >
            <folder :folder="folder"/>
         </router-link>
      </div>
   </div>
</template>

<script>
import folder from '../components/folder'
export default {
   data(){
      return{
         folders:[]
      }
   },
   methods:{
      getFolders(){
         axios.get('/api/folders').then((response) => {
            this.folders=response.data.data;
         })
      }
   },
   components: {
      folder
   },
   mounted(){
      this.getFolders();
   }
}
</script>

<style lang="scss" scoped>
a{
   text-decoration: none;
   color:inherit;
}
</style>
