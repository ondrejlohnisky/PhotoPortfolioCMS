<template>
   <div class="jumbotron">
      <div class="row">
         <div class="col-md-3 public-image"><img class="rounded-circle" :src="public_image" :alt="title"></div>
         <div class="col-md-9"><h3>{{ title }}</h3><p>{{ description }}</p></div>
      </div>
      <hr/>
      <br/>
      <div v-if="images.length>0" class="row">
         <div class="col-md-4" v-for="(image,index) in images" :key="index">
            <img @click="slideIndex=index" :src="image.src" :alt="image.title" class="img-thumbnail z-depth-2">
         </div>
      </div>
      <div v-else class="alert alert-secondary" role="alert">
         <strong>Zatím žádné příspěvky</strong>
      </div>
      <div v-if="nextPageUrl!=null && images.length>0" class="row">
         <div class="col-4"></div>
         <div class="col-4">
            <div @click="getImages(nextPageUrl)" class="btn btn-primary btn-rounded">Načíst další ...</div>  
         </div>
         <div class="col-4"></div>
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
            title: "No title",
            description: "No description",
            public_image: "/images/placeholder-image.jpg",
            created_at: "2018-12-09 14:17:27",
            updated_at: "2018-12-09 14:17:27",
            images: [
               // {
               //    id: 1,
               //    title: "fotka 1",
               //    description: "deskripcedeskripcedeskripcedeskripce !deskripce!",
               //    src: "https://www.boxmotions.com/blog/wp-content/uploads/2017/06/1458593290-timbercraft-tiny-home-2.jpg",
               //    folder_id: 1,
               //    created_at: "2018-12-09 14:17:27",
               //    updated_at: "2018-12-09 14:17:27"
               // }
            ],
            nextPageUrl:''
         }
      },
      methods:{
         getFolder(id,password){
            axios.get('/api/folders/'+id+'?password='+password).then((response)=>{
               console.log(response)
               this.id=response.data.id;
               this.title=response.data.title;
               this.description=response.data.description;
               this.public_image=response.data.public_image;
               this.created_at=response.data.created_at;
               this.updated_at=response.data.updated_at;
               this.getImages('/api/folderImages/'+id+'?password='+password);
            })
         },
         getImages(page){
            axios.get(page+'&password='+this.$store.state.folderPassword).then((response)=>{
               this.nextPageUrl=response.data.next_page_url;
               this.images=this.images.concat(response.data.data);
               this.accessLockedImages();
            });
         },
         accessLockedImages(){
            for (let i = 0; i < this.images.length; i++) {
               this.images[i].src += '?password='+this.$store.state.folderPassword;
            }
         }
      },
      mounted(){
         this.getFolder(this.$route.params.id,this.$store.state.folderPassword);
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

