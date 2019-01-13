<template>
   <div>
      <div class="row">
         <div class="col-md-4" v-for="(folder,index) in folders" :key="index" @click="routerPush({ name: 'folder',params:{id:folder.id}})">
            <folder :folder="folder"/>
         </div>
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
      routerPush(params){
         this.$router.push(params);
      },
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
