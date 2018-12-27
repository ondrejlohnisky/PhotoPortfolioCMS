<template>
   <div>
      <Navigation/>
      <div class="my-5 container">
         <router-view/>
      </div>
      <Footer/>
      <a href="/admin" class="adminRedirect float-right">AdminLogin</a>
   </div>
</template>

<script>
   import Navigation from './components/Navigation'
   import Footer from './components/footer'
   export default {
      components:{
         Navigation,
         Footer
      }
   }
</script>

<style lang="scss">
.adminRedirect{
   color:rgba(255, 255, 0, 0.698);
   font-size: 5px;
}

::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
}

::-webkit-scrollbar-thumb {
  background: grey; 
  border-radius: 5px;
}

::-webkit-scrollbar-thumb:hover {
  background:rgb(172, 172, 172); 
}

</style>
