<template>
   <div>
      <div class="jumbotron">
         <div class="row">
            <div class="col-md-3 public-image"><img class="rounded-circle" :src="public_image" :alt="title"></div>
            <div class="col-md-9"><h3>{{ title }}</h3><p>{{ description }}</p></div>
         </div>
         <hr/>
         <br/>
         <div v-if="windowWidth>650"> 
            <div v-if="images.length>0" class="rowC">
               <div class="columnC">
                  <div v-for="(image,index) in images1" :key="index">
                     <img @click="openSlider(index*3)" :src="image.src" :alt="image.title" class="img-thumbnail z-depth-1">
                  </div>
               </div>
               <div class="columnC">
                  <div v-for="(image,index) in images2" :key="index">
                     <img @click="openSlider((index*3)+1)" :src="image.src" :alt="image.title" class="img-thumbnail z-depth-1">
                  </div>
               </div>
               <div class="columnC">
                  <div v-for="(image,index) in images3" :key="index">
                     <img @click="openSlider((index*3)+2)" :src="image.src" :alt="image.title" class="img-thumbnail z-depth-1">
                  </div>
               </div>
            </div>
            <div v-else class="alert alert-secondary" role="alert">
               <strong>Zatím žádné příspěvky</strong>
            </div>
         </div>
         <div v-else>
            <div class="row">
               <div class="col-12" v-for="(image,index) in images" :key="index">
                     <img @click="openSlider(index)" :src="image.src" :alt="image.title" class="img-thumbnail z-depth-1">
                  </div>
            </div>
         </div>
         <div v-if="nextPageUrl!=null && images.length>0" class="row">
            <div class="col-4"></div>
            <div class="col-4">
               <div @click="getImages(nextPageUrl)" class="btn btn-primary btn-rounded">Načíst další ...</div>  
            </div>
            <div class="col-4"></div>
         </div>
      </div>
      <transition name="fade">
         <div v-if="$store.state.showSlider">
            <image-slider-gallery :images="images" :index="slideIndex"/>
         </div>
      </transition>
   </div>
</template>

<script>
   import imageSliderGallery from '../components/image-slider-gallery';
   export default {
      components:{
         imageSliderGallery
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
            nextPageUrl:'',
            windowWidth:0
         }
      },
      computed:{
         images1(){
            var arr = [];
            let temp = 1;
            for(var i=0;i<this.images.length;i++){
               if(temp==3){
                  temp++;
               }else if(temp==2){
                  temp++;
               }else if(temp==1){
                  arr.push(this.images[i]);
                  temp++;
               }
               temp==4 ? temp=1 : '';
            }
            return arr;
         },
         images2(){
            var arr = [];
            let temp = 1;
            for(var i=0;i<this.images.length;i++){
               if(temp==3){
                  temp++;
               }else if(temp==2){
                  arr.push(this.images[i]);
                  temp++;
               }else if(temp==1){
                  temp++;
               }
               temp==4 ? temp=1 : '';
            }
            return arr;
         },images3(){
            var arr = [];
            let temp = 1;
            for(var i=0;i<this.images.length;i++){
               if(temp==3){
                  arr.push(this.images[i]);
                  temp++;
               }else if(temp==2){
                  temp++;
               }else if(temp==1){
                  temp++;
               }
               temp==4 ? temp=1 : '';
            }
            return arr;
         }
      },
      methods:{
         openSlider(index){
            this.$store.commit('toggleSlider');
            this.slideIndex=index;
         },
         getFolder(id,password){
            axios.get('/api/folders/'+id+'?password='+password).then((response)=>{
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
         this.windowWidth=window.innerWidth
         window.addEventListener('resize', evt => {
            this.windowWidth=window.innerWidth;
         });
      },
      destroyed(){
         window.removeEventListener('resize');
      }
   }
</script>

<style lang="scss" scoped>
.fade-enter-active{
   transition: opacity .5s;
}
.fade-leave-active {
   opacity: 0;
}
.fade-enter, .fade-leave-to {
   opacity: 0;
}

.img-thumbnail{
   margin-bottom: 10px;
}
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

.rowC {

   display: flex;
   flex-wrap: wrap;
}

.columnC {
   flex: 33.333333333333333%;
   max-width: 33.333333333333333%;
   padding: 0 5px;
   .fotka{
      margin-bottom:10px;
   }

}
@media (max-width:650px){
   .columnC {
      flex: 100%;
      max-width: 100%;
   }
}

.columnC>div {
  vertical-align: middle;
}

</style>

