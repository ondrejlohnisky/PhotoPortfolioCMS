<template>
   <div>
      <nav class="mb-1 navbar navbar-expand-lg navbar-light white">
         <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
            <div class="mr-auto">
               <button @click="redirect('/')" class="btn btn-primary btn-rounded btn-sm"><b><font-awesome-icon size="lg" :icon="['fas','desktop']"/> Zpět na stránku</b></button>
            </div>
            <div class="ml-auto">
               <button @click="redirect('')" class="btn btn-blue-grey btn-md"><font-awesome-icon size="lg" :icon="['fas','cog']"/> Nastavení účtu</button>
               <button @click="logout()" class="btn btn-danger btn-md"><font-awesome-icon size="lg" :icon="['fas','sign-out-alt']"/> Odhlásit se</button>
            </div>
         </div>
      </nav>
   </div>
</template>

<script>
export default {
   methods: {
      logout(){
         axios.post('/admin/logout').then(()=>{
            window.location = "/";
         });
         this.$store.commit('unsetApiToken')
      },
      redirect(url){
         window.location = url;
      }
   }
}
</script>

<style lang="scss" scoped>
.btn-rounded{
   border-radius: 100px;
}
</style>
