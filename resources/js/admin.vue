<template>
   <div class="container-fluid">
      <h1>Admin stránka</h1>
      {{ api_token }}
      <a @click="logout()">Logout</a>
   </div>
</template>

<script>
   export default {
      props:{
         api_token: {
            type: String,
            required: true
         }
      },
      components:{
      },
      methods: {
         logout(){
            axios.post('/admin/logout').then(()=>{
               window.location = "/";
            });
            console.log("stalo");
         }
      }
   }
</script>