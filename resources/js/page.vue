<template>
   <div>
      <Navigation/>
      <div class="my-5 container">
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

<style lang="scss" scoped>

</style>
