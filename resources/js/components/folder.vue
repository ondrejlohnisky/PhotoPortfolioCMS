<template>
   <div id="folder">
      <div class="card">
         <img class="card-img" :src="folder.public_image" :alt="folder.title">
         <div class="card-block mx-3">
            <h4 class="card-title">{{ folder.title }}</h4>
         </div>
         <span class="time_stamp">Created {{ folder.created_at }}</span>
      </div>
   </div>
</template>

<script>
export default {
   props: {
      folder: {
         type: Object,
         required: true
      }
   }
   
}
</script>
d
<style lang="scss" scoped>
   #folder{
      .card{
         border-bottom-left-radius: 5px;
         border-bottom-right-radius: 5px;
         margin-bottom: 1rem;
         transition: all 0.25s;
         cursor: pointer;
         .time_stamp{
            margin-left:5px;
            color:gray;
         }
         img{
            margin:0.3rem;
            max-width:100%;
            width:auto;
         }
      }
      .card:hover{
         -ms-transform: scale(1.03, 1.03);
         -webkit-transform: scale(1.03, 1.03);
         transform: scale(1.03, 1.03);
      }
   }
</style>
