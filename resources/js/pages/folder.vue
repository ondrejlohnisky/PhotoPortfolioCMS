<template>
   <div class="jumbotron">
      <div class="row">
         <div class="col-md-3 public-image"><img class="rounded-circle" :src="public_image" :alt="title"></div>
         <div class="col-md-9"><h3>{{ title }}</h3><p>{{ description }}</p></div>
      </div><hr/><br/>
      <div class="row">
         <div class="col-md-4" v-for="(image,index) in images" :key="index">
            <img @click="slideIndex=index" :src="image.src" :alt="image.title" width="100%">
         </div>
      </div>
   <vue-gallery :images="images.map(image=>image.src)" :index="slideIndex" @close="slideIndex=null"/>
   </div>
</template>

<script>
   import VueGallery from 'vue-gallery'
   export default {
      components:{
         VueGallery
      },
      data(){
         return {
            slideIndex:null,
            id: 1,
            title: "Složka 1",
            description: "folderdeskripcefolderdeskripcefolderdeskripcefolderdeskripcefolderdeskripcefolderdeskripce",
            public_image: "https://www.boxmotions.com/blog/wp-content/uploads/2017/06/1458593290-timbercraft-tiny-home-2.jpg",
            created_at: "2018-12-09 14:17:27",
            updated_at: "2018-12-09 14:17:27",
            images: [
               {
                  id: 1,
                  title: "fotka 1",
                  description: "deskripcedeskripcedeskripcedeskripce !deskripce!",
                  src: "https://www.boxmotions.com/blog/wp-content/uploads/2017/06/1458593290-timbercraft-tiny-home-2.jpg",
                  folder_id: 1,
                  created_at: "2018-12-09 14:17:27",
                  updated_at: "2018-12-09 14:17:27"
               },
               {
                  id: 2,
                  title: "fotka 2",
                  description: "deskripcedeskripcedeskripcedeskripce !deskripce!",
                  src: "https://www.boxmotions.com/blog/wp-content/uploads/2017/06/1458593290-timbercraft-tiny-home-2.jpg",
                  folder_id: 1,
                  created_at: "2018-12-09 14:17:27",
                  updated_at: "2018-12-09 14:17:27"
               },
               {
                  id: 3,
                  title: "fotka 3",
                  description: "deskripcedeskripcedeskripcedeskripce !deskripce!",
                  src: "https://www.boxmotions.com/blog/wp-content/uploads/2017/06/1458593290-timbercraft-tiny-home-2.jpg",
                  folder_id: 1,
                  created_at: "2018-12-09 14:17:27",
                  updated_at: "2018-12-09 14:17:27"
               },
               {
                  id: 4,
                  title: "fotka 1",
                  description: "deskripcedeskripcedeskripcedeskripce !deskripce!",
                  src: "https://www.boxmotions.com/blog/wp-content/uploads/2017/06/1458593290-timbercraft-tiny-home-2.jpg",
                  folder_id: 1,
                  created_at: "2018-12-09 14:17:27",
                  updated_at: "2018-12-09 14:17:27"
               },
               {
                  id: 5,
                  title: "fotka 3",
                  description: "deskripcedeskripcedeskripcedeskripce !deskripce!",
                  src: "https://www.boxmotions.com/blog/wp-content/uploads/2017/06/1458593290-timbercraft-tiny-home-2.jpg",
                  folder_id: 1,
                  created_at: "2018-12-09 14:17:27",
                  updated_at: "2018-12-09 14:17:27"
               },
               {
                  id: 6,
                  title: "fotka 1",
                  description: "deskripcedeskripcedeskripcedeskripce !deskripce!",
                  src: "https://www.boxmotions.com/blog/wp-content/uploads/2017/06/1458593290-timbercraft-tiny-home-2.jpg",
                  folder_id: 1,
                  created_at: "2018-12-09 14:17:27",
                  updated_at: "2018-12-09 14:17:27"
               }
            ]
         }
      },
      methods:{
         getFolder(id){
            axios.get('/api/folders/'+id).then((response)=>{
               this.images=response.data[0].images;
               this.id=response.data[0].id;
               this.title=response.data[0].title;
               this.description=response.data[0].description;
               this.public_image=response.data[0].public_image;
               this.created_at=response.data[0].created_at;
               this.updated_at=response.data[0].updated_at;
            })
         }
      },
      mounted(){
         this.getFolder(this.$route.params.id);
      }
   }
</script>

<style lang="scss" scoped>
.row{
   .col-md-4{
      margin-bottom:1.5em;
   }
   .col-md-4:last-child{
      margin-bottom:0em;
   }
   .public-image{
      display:inline-block;
      text-align: center;
   }
   .col-md-9{
      p{
         word-wrap: break-word;
      }
   }
   .rounded-circle{
      width:150px;
      height:135px;
      border:3px solid darkgrey;
   }
}
</style>

