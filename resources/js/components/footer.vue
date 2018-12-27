<template>
   <footer class="text-muted">
      <div class="container">
         <p>© {{ currentYear }} Petr Smille. Všechna práva vyhrazena.</p>
         <p>Created by <a href="http://lohnisky.euweb.cz">Ondřej Lohniský</a> </p>
      </div>
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

