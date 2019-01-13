<template>
   <div id="folder">
      <font-awesome-icon v-if="folder.locked" class="lock" size="lg" :icon="['fas','lock']" /> 
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
      position:relative;
      transition: all 0.25s;
      margin-bottom: 1rem;
      .card{
         border-bottom-left-radius: 5px;
         border-bottom-right-radius: 5px;
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
      &:hover{
         -ms-transform: scale(1.015, 1.015);
         -webkit-transform: scale(1.015, 1.015);
         transform: scale(1.015, 1.015);
      }
   }
   .lock{
      position:absolute;
      z-index: 10000;
      right:0px;
      top:0px;
      transform: translate(-50%, -50%);
   }
</style>
