<template>
   <footer class="text-muted">
      <div class="container">
         <p class="float-right">
            <a href="#">Back to top</a>
         </p>
         <p>Copyright © 2018–{{ currentYear }} Petr Smille. Všechna práva vyhrazena.</p>
         <p>Created by <a href="lohnisky.euweb.cz">Ondřej Lohniský</a>.</p>
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
