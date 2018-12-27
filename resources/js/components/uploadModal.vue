<template>
<div>
   <div class="uploadModal" @click="$store.commit('closeModal')">
   </div>
   <div class="jumbotron">
      <div class="uploadHeader">
         Upload
      </div>
      <div class="uploadBody">
         sssss
      </div>
   </div>
</div>
</template>
<style lang="scss" scoped>
.uploadModal{
   position:fixed;
   z-index: 50000;
   top:0;   
   left:0;
   width:100%;
   height:100%;
   background-color: rgba(199, 199, 199, 0.5)
}
.jumbotron{
   z-index:60000;
   position:fixed;
   left:20%;
   top: 50%;
   transform: translate(-50%, -50%);

}
</style>