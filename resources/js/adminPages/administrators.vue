<template>
   <div>
      
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