<template>
   <div>
      <div class="row">
         <div class="col-md-4">
            
         </div>
         <div class="col-md-8">

         </div>
      </div>
   </div>
</template>

<script>
export default {
   data(){
      return{
         admins:[]
      }
   },
   methods:{
      getAdmins(){
         axios.get("/api/")
      }
   }
}
</script>