<template>
   <div class="page">
      <Navigation/>
      <div class="container my-4">
         <router-view/>
      </div>
      <Footer/>
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


div.page{
   position:absolute;
   height:100%;
   width:100%;
   overflow: auto;
}
.row > a{
   padding:0;
}

::-webkit-scrollbar {
   position:absolute;
   right:0px !important;
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
