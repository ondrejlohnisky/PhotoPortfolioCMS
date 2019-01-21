<template>
   <footer class="jumbotron bg-light text-muted">
      <div class="container">
         <p>© {{ currentYear }} Petr Smille. Všechna práva vyhrazena.</p>
         <p>Created by <a href="http://lohnisky.euweb.cz">Ondřej Lohniský</a> </p>
      </div>

      <a href="/admin" class="adminRedirect float-right">AdminLogin</a>
   </footer>
</template>

<script>
   export default {
      data(){
         return{
            currentYear:(new Date()).getFullYear()
         }
      }
   }
</script>
<style lang="scss" scoped>
.jumbotron{
   margin-bottom:0px;
   padding:1rem;
}
.adminRedirect{
   color:rgba(255, 255, 0, 0.698);
   font-size: 2px;
}
</style>


