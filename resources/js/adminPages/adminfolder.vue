<template>
   <div>
      <button @click="openDeleteFolderModal()" class="btn btn-danger btn-md mb-4">
         <font-awesome-icon size="lg" :icon="['fas','trash-alt']"/> Smazat složku
      </button>
      
      <!-- zobrazení hesel ke složce -->
      <div class="jumbotron">
         <p class="h4 my-4">Zabezpečení</p>
         <h5>Hesla</h5>
         <div class="table-responsive">
            <table class="table table-striped">
               <thead>
                  <tr>
                     <th scope="col">Heslo</th>
                     <th scope="col">Počet zbývajících použití</th>
                     <th scope="col">Operace</th>
                  </tr>
               </thead>
               <tbody>
                  <tr v-for="(password,index) in passwords" :key="index">
                     <td><p class="text-muted text-monospace ">{{ password.password }}</p></td>
                     <td>
                        <div @click="password.password_count > 1 ? password.password_count-- : ''" class="circle d-inline-block">-</div>
                        <div class="md-form d-inline-block">
                           <input v-model.number="password.password_count" type="number" id="form2" class="form-control"/>
                        </div> 
                        <div @click="password.password_count++" class="circle d-inline-block">+</div></td>
                     <td>
                        <button @click="savePassword(password.id,password.password_count)" class="btn btn-primary btn-sm"><font-awesome-icon size="lg" :icon="['fas','save']"/> Uložit</button>
                        <button @click="deletePassword(password.id)" class="btn btn-danger btn-sm"><font-awesome-icon size="lg" :icon="['fas','trash-alt']"/> Smazat</button>
                     </td>
                  </tr>
               </tbody>
               <tr>
                  <td colspan="4">
                     <button @click="openAddPasswordModal()" class="btn btn-indigo btn-md btn-block btn-rounded">
                        <font-awesome-icon color="white" size="lg" :icon="['fas','plus-circle']"/>  Přidat heslo
                     </button>
                  </td>
               </tr>
            </table>
         </div>
      </div>
      <!-- zobrazení složky a obrázky -->
      <div class="jumbotron">
         <div class="row">
            <div class="col-md-3 public-image"><img class="rounded-circle" :src="public_image" :alt="title"></div>
            <div class="col-md-9"><h3>{{ title }}</h3><p>{{ description }}</p></div>
         </div><hr/>
         <button @click="openaddImagesModal()" class="btn btn-success btn-md my-4"><font-awesome-icon color="white" size="lg" :icon="['fas','plus-circle']"/>  Přidat fotky</button>
         <div v-if="images.length>0" class="rowC">
            <div class="columnC">
               <div v-for="(image,index) in images1" :key="index">
                  <div class="fotka">
                     <div class="img-options">
                        <div class="img-text">
                           <h6 class="img-title">{{ image.title }}</h6>
                           <h6 class="img-description">{{ image.description }}</h6>
                           
                        </div>
                        <button @click="openEditImageModal(image)" class="img-button btn btn-blue-grey btn-sm btn-rounded float-right mx-1"><font-awesome-icon size="lg" :icon="['fas','edit']"/></button>
                        <button @click="openDeleteImageModal(image.id)" class="img-button btn btn-danger btn-sm btn-rounded float-right mx-1"><font-awesome-icon size="lg" :icon="['fas','trash-alt']"/></button>
                     </div>
                     <img @click="slideIndex=index" :src="image.src" :alt="image.title" class="img-thumbnail">
                  </div>
               </div>
            </div>
            <div class="columnC">
               <div v-for="(image,index) in images2" :key="index">
                  <div class="fotka">
                     <div class="img-options">
                        <div class="img-text">
                           <h6 class="img-title">{{ image.title }}</h6>
                           <h6 class="img-description">{{ image.description }}</h6>
                           
                        </div>
                        <button @click="openEditImageModal(image)" class="img-button btn btn-blue-grey btn-sm btn-rounded float-right mx-1"><font-awesome-icon size="lg" :icon="['fas','edit']"/></button>
                        <button @click="openDeleteImageModal(image.id)" class="img-button btn btn-danger btn-sm btn-rounded float-right mx-1"><font-awesome-icon size="lg" :icon="['fas','trash-alt']"/></button>
                     </div>
                     <img @click="slideIndex=index" :src="image.src" :alt="image.title" class="img-thumbnail">
                  </div>
               </div>
            </div>
            <div class="columnC">
               <div v-for="(image,index) in images3" :key="index">
                  <div class="fotka">
                     <div class="img-options">
                        <div class="img-text">
                           <h6 class="img-title">{{ image.title }}</h6>
                           <h6 class="img-description">{{ image.description }}</h6>
                           
                        </div>
                        <button @click="openEditImageModal(image)" class="img-button btn btn-blue-grey btn-sm btn-rounded float-right mx-1"><font-awesome-icon size="lg" :icon="['fas','edit']"/></button>
                        <button @click="openDeleteImageModal(image.id)" class="img-button btn btn-danger btn-sm btn-rounded float-right mx-1"><font-awesome-icon size="lg" :icon="['fas','trash-alt']"/></button>
                     </div>
                     <img @click="slideIndex=index" :src="image.src" :alt="image.title" class="img-thumbnail">
                  </div>
               </div>
            </div>
         </div>
         <div v-else class="alert alert-secondary" role="alert">
            <i>Zatím žádné příspěvky</i>
         </div>
         <div v-if="nextPageUrl!=null && images.length>0" class="row">
            <div class="col-4"></div>
            <div class="col-4">
               <div @click="getNextImages(nextPageUrl)" class="btn btn-primary btn-rounded">Načíst další ...</div>
            </div>
            <div class="col-4"></div>
         </div>
      </div>

      <!-- modal na odstranění složky -->
      <div v-if="deleteModal" @click="closeDeleteModal()" class="modalWrapper">
      </div>
      <div v-if="deleteModal" class="myModal">
         <div class="row">
            <div class="col-6 h4 text-danger">Pozor!</div>
         </div>
         <div class="row">
            <div class="col-12">
               <div class="h6">Opravdu si přejete smazat složku <b>{{ title }}</b>?</div>
            </div>
         </div>
         <div class="row my-2">
            <div class="col-sm-6">
               <button @click="closeDeleteModal()" class="btn btn-light btn-block btn-sm">Zrušit</button>
            </div>
            <div class="col-sm-6">
               <button @click="deleteFolder()" class="btn btn-danger btn-block btn-sm">Potvrdit</button>
            </div>
         </div>
      </div>

      <!-- modal na odstranění fotky -->
      <div v-if="deleteImageModal" @click="closeDeleteImageModal()" class="modalWrapper">
      </div>
      <div v-if="deleteImageModal" class="myModal">
         <div class="row">
            <div class="col-6 h4 text-danger">Pozor!</div>
         </div>
         <div class="row">
            <div class="col-12">
               <div class="h6">Opravdu si přejete smazat fotku <b>{{ images.find(image => image.id==deleteImageId).title }}</b>?</div>
            </div>
         </div>
         <div class="row my-2">
            <div class="col-sm-6">
               <button @click="closeDeleteImageModal()" class="btn btn-light btn-block btn-sm">Zrušit</button>
            </div>
            <div class="col-sm-6">
               <button @click="deleteImage()" class="btn btn-danger btn-block btn-sm">Potvrdit</button>
            </div>
         </div>
      </div>

      <!-- modal na upravení fotky -->
      <div v-if="editImageModal" @click="closeEditImageModal()" class="modalWrapper">
      </div>
      <div v-if="editImageModal" class="myModal">
         <form @submit.prevent>
            <div class="row">
               <div class="col-12">
                  <div class="h4">Úprava fotky: {{ editingImage.title }}</div>
               </div>
            </div>
            <hr>
            <div class="row my-3">
               <div class="col-8">
                  <input class="form-control" v-model="editingImage.title" type="text" placeholder="Titulek" maxlength="255">
               </div>
            </div>
            <div class="row my-3">
               <div class="col-12">
                  <textarea v-model="editingImage.description" class="form-control z-depth-1" rows="3" maxlength="65535" placeholder="Popisek"></textarea>
               </div>
            </div>
            <div class="row my-2">
               <div class="col-sm-6">
                  <button @click="closeEditImageModal()" class="btn btn-light btn-block btn-sm">Zrušit</button>
               </div>
               <div class="col-sm-6">
                  <button @click="editImage()" class="btn btn-success btn-block btn-sm">Potvrdit</button>
               </div>
            </div>
         </form>
      </div>

      <!-- modal na přidání hesla -->
      <div v-if="addPasswordModal" @click="closeAddPasswordModal()" class="modalWrapper">
      </div>

      <div v-if="addPasswordModal" class="myModal">
         <div class="h5">Přidat heslo</div>
         <div @click="addPasswordCount > 1 ? addPasswordCount-- : ''" class="circle d-inline-block">-</div>  
         <div class="md-form d-inline-block">
            <input v-model="addPasswordCount" type="number" id="form1" class="form-control">
         </div> 
         <div @click="addPasswordCount++" class="circle d-inline-block">+</div>
         <button @click="addPassword()" class="btn btn-success">Add</button>
      </div>

      <!-- modal na přidání fotek -->
      <div v-if="addImagesModal" @click="closeaddImagesModal()" class="modalWrapper">
      </div>

      <div v-if="addImagesModal" class="myModal">
         <div class="form-row my-3">
            <div class="col-md-6">
               <div class="h5">Přidat fotky</div>
            </div>
            <div v-if="addImages.length>0 && uploadPercentage<=0" class="col-md-6">
               <button @click="uploadImages()" class="btn btn-success btn-sm btn-block">
                  Potvrdit
               </button>
            </div>
            <div v-else-if="uploadPercentage>0" class="col-md-6">
               <div class="progress">
                  <div class="progress-bar" role="progressbar" :style="{width: uploadPercentage+'%'}" :aria-valuenow="uploadPercentage" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
            </div>
         </div>
         <div class="form-row my-3">
            <div class="col">
               <div class="myInputButton btn btn-light btn-block">
                  <span>
                     <font-awesome-icon size="lg" :icon="['fas','images']" />  
                     Vyberte fotky
                  </span>
                  <input @change="onFileSelected($event)" type="file" class="myInputFile" accept="image/*" multiple/>
               </div>
            </div>
         </div>
         <div class="form-row">
            <div class="col">
               <ul class="list-group">
                  <li class="h5 list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">Totální velikost: <span class="text-primary">{{ bytesToSize(addImagesSizeTotal) }}</span></li>
                  <li v-for="(image,index) in addImages" :key="index" class="h6 list-group-item d-flex justify-content-between align-items-center">
                     {{ image.name }}
                     <span class="badge badge-primary badge-pill">{{ bytesToSize(image.size) }}</span>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
export default {
   data(){
      return {
         addPasswordModal:false,
         addPasswordCount:1,
         addImagesModal:false,
         addImages:[],
         uploadPercentage:0,
         deleteModal:false,
         deleteImageModal:false,
         deleteImageId:null,
         editingImage:{},
         editImageModal:false,
         //
         slideIndex:null,
         id: 1,
         title: "Název",
         description: "Popis",
         public_image: "/images/placeholder-image.jpg",
         created_at: "2018-12-09 14:17:27",
         updated_at: "2018-12-09 14:17:27",
         images: [],
         passwords:[],
         nextPageUrl:'',

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
      },
      addImagesSizeTotal(){
         let sum=0;
         this.addImages.forEach(element => {
            sum+=element.size;
         });
         return sum;
      }
   },
   methods:{
      onFileSelected(e){
         let input=e.target
         if (input.files && input.files[0]) {
            for (let i=0;i<input.files.length;i++) {
               this.addImages.push(input.files[i]);
            }
         }
      },
      bytesToSize(bytes){
         var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
         if (bytes == 0) return '0 Byte';
         var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
         return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
      },
      uploadImages(){
         let config = {
            headers: {
               'Content-Type':'multipart/form-data'
            },
            onUploadProgress: function( progressEvent ) {
               this.uploadPercentage = parseInt(Math.round((progressEvent.loaded * 100 ) / progressEvent.total));
            }.bind(this)
         };
         let fd = new FormData();
         this.addImages.forEach(image => {
            fd.append('images[]',image);
         });
         fd.append('folder_id',this.id);
         axios.post('/api/images',fd,config).then((response)=>{
            console.log(response);
            setTimeout(() => {
               this.closeaddImagesModal();
               this.getFolder(this.id);
            }, 250);
         });
      },
      getFolder(id){
         axios.get('/api/admin/folders/'+id).then((response)=>{
            this.id=response.data.id;
            this.title=response.data.title;
            this.description=response.data.description;
            this.public_image=response.data.public_image;
            this.created_at=response.data.created_at;
            this.updated_at=response.data.updated_at;
            this.getPasswords();
            this.getImages('/api/admin/folderImages/'+this.id);
         });
      },
      getImages(page){
         axios.get(page).then((response)=>{
            this.nextPageUrl=response.data.next_page_url;
            this.images=response.data.data;
         });
      },
      getNextImages(page){
         axios.get(page).then((response)=>{
            this.nextPageUrl=response.data.next_page_url;
            this.images=this.images.concat(response.data.data);
         });
      },
      getPasswords(){ 
         axios.get("/api/passwords/"+this.id).then((response)=>{
            this.passwords=response.data;
         });
      },
      savePassword(id,password_count){
         axios.put("/api/passwords/"+id,{'password_count': password_count});
      },
      addPassword(){
         let fd = new FormData;
         fd.append('password_count',this.addPasswordCount);
         fd.append('folder_id',this.id);
         axios.post('/api/passwords',fd).then((response) => {
            this.getPasswords();
            this.addPasswordModal=false;
            this.addPasswordCount=1;
         });
      },
      deletePassword(id){
         axios.delete("/api/passwords/"+id).then(()=>{
            this.getPasswords();
         });
      },
      deleteFolder(){
         axios.delete('/api/folders/'+this.id).then((response)=>{
            this.$router.push({name:'spravaSlozek'});
         });
      },
      closeAddPasswordModal(){
         $('body').css('overflow', 'auto');
         $(window).unbind('scroll');
         this.addPasswordModal=false;
      },
      openAddPasswordModal(){
         var top = $(window).scrollTop();
         var left = $(window).scrollLeft();
         $('body').css('overflow', 'hidden');
         $(window).scroll(function(){
            $(this).scrollTop(top).scrollLeft(left);
         });
         this.addPasswordModal=true;
      },
      closeaddImagesModal(){
         $('body').css('overflow', 'auto');
         $(window).unbind('scroll');
         this.addImagesModal=false;
         this.addImages=[];
         this.uploadPercentage=0;
      },
      openaddImagesModal(){
         var top = $(window).scrollTop();
         var left = $(window).scrollLeft();
         $('body').css('overflow', 'hidden');
         $(window).scroll(function(){
            $(this).scrollTop(top).scrollLeft(left);
         });
         this.addImagesModal=true;
      },
      openDeleteFolderModal(){
         var top = $(window).scrollTop();
         var left = $(window).scrollLeft();
         $('body').css('overflow', 'hidden');
         $(window).scroll(function(){
            $(this).scrollTop(top).scrollLeft(left);
         });
         this.deleteModal=true;
      },
      closeDeleteModal(){
         $('body').css('overflow', 'auto');
         $(window).unbind('scroll');
         this.deleteModal=false;
      },
      openDeleteImageModal(id){
         var top = $(window).scrollTop();
         var left = $(window).scrollLeft();
         $('body').css('overflow', 'hidden');
         $(window).scroll(function(){
            $(this).scrollTop(top).scrollLeft(left);
         });
         this.deleteImageId=id;
         this.deleteImageModal=true;
      },
      closeDeleteImageModal(){
         $('body').css('overflow', 'auto');
         $(window).unbind('scroll');
         this.deleteImageId=null;
         this.deleteImageModal=false;
      },
      deleteImage(){
         axios.delete('/api/images/'+this.deleteImageId).then((response)=>{
            this.getImages('/api/admin/folderImages/'+this.id);
            this.closeDeleteImageModal();
         });
      },
      openEditImageModal(image){
         var top = $(window).scrollTop();
         var left = $(window).scrollLeft();
         $('body').css('overflow', 'hidden');
         $(window).scroll(function(){
            $(this).scrollTop(top).scrollLeft(left);
         });
         this.editingImage=image;
         this.editImageModal=true;
      },
      closeEditImageModal(){
         $('body').css('overflow', 'auto');
         $(window).unbind('scroll');
         this.editingImage={};
         this.editImageModal=false;
      },
      editImage(){
         axios.put('/api/images/'+this.editingImage.id,this.editingImage).then((response)=>{
            this.getImages('/api/admin/folderImages/'+this.id);
            this.closeEditImageModal();
         });
      }
   },
   mounted(){
      setTimeout(() => {
         this.getFolder(this.$route.params.id);
      }, 100);
   }
}
</script>

<style lang="scss" scoped>

.fotka{
   position:relative;
   width:100%;
   height:auto;
   .img-thumbnail {
      padding: .25rem;
      background-color: #fff;
      border: 1px solid #dee2e6;
      border-radius: .25rem;
      max-width: 100%;
      height: auto;
   }
   .img-options{
      position:absolute;
      top:5px;
      bottom:5px;
      left:5px;
      right:5px;
      background-color: rgba(0,0,0,.55);
      align-items: center;
      justify-content: center;
      z-index:10000;
      visibility: hidden;
      opacity: 0;
      transition: visibility 0s, opacity 0.4s linear;
      display: flex;
      .img-text{
         position:absolute;
         top:0px;
         padding:5px;
         width:100%; height:auto;
         max-height: 100px;
         overflow: auto;
         word-wrap: none;
         color: rgb(255, 255, 255); 
         mix-blend-mode: hard-light;
      }
      .img-title{
         text-align: center;
         font-size: 20px;
      }
      .img-description{
         font-size: 15px;
      }
   }
}
.fotka:hover > .img-options{
   visibility: visible;
   opacity: 1;
}
.progress-bar{
   background-color: #00C851;
   border-bottom: 2px solid rgb(8, 148, 8);
}
.myInputButton{
   position:relative;
   width:100%;
   height:20vw;
   border:4px dashed black;
   span{
      position:absolute;
      text-align: center;
      top:50%;
      left:50%;
      transform: translate(-50%,-50%);

   }
   .myInputFile{
      top: 0;
      right: 0;
      left: 0;
      bottom: 0;
      width: 100%;
      height:100%;
      margin: 0;
      padding: 0;
      cursor: pointer;
      opacity: 0;
   }
}
// .rowC {
//    display: flex;
//    flex-wrap: wrap;
//    padding: 0 4px;

//    .columnC {
//       flex: 16.666666666666667%;
//       max-width: 16.666666666666667%;
//       padding: 0 5px;
//       .photoPreview {
//          width:100%;
//          padding: 5px 0;
//       }
//    }
//    @media (max-width:650px){
//       .columnC {
//          flex: 33.333333333333333%;
//          max-width: 33.333333333333333%;
//       }
//    }
// }

table input[type=number]{
   width:7vw;
   text-align: center;
}
.modalWrapper{
   position:fixed;
   z-index: 50000;
   top:0;   
   left:0;
   width:100%;
   height:100%;
   background-color: rgba(199, 199, 199, 0.4)
}
.myModal{
   position:fixed;
   overflow-x: hidden;
   left:50%;
   top:35%;
   height:auto;
   max-height:65%;
   width:fit-content;
   transform: translate(-50%, -50%);
   background-color: white;
   border-radius: 5px;
   z-index:60000;
   box-shadow: 0px 0px 10px gray;
   padding:25px;
   vertical-align:center;
}
.btn-rounded{
  border-radius: 45px;
}
.jumbotron{
   overflow-wrap: break-word;
}
.circle{
   margin-right:4px;
   margin-left:4px;
   border:1px solid black;
   border-radius: 50%;
   background-color: rgb(53, 53, 53);
   text-align:center;
   font-size: 12px;
   cursor: pointer;
   font-weight: 500;
   color:white;
   width:20px;
   height:20px;
   &:hover{
      background-color:rgb(50, 50, 50) 
   }
   &:active{
      border:0.5px solid white;
   }
}
.row{
   .col-md-4{
      margin-bottom:1.5em;
   }
   .col-md-4:last-child{
      margin-right:0em;
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
   @media (max-width: 880px) {
      .rounded-circle{
         width:100px;
         height:85px;;
      }
   }
}
.form-control[type=number]{
   text-align: center;
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

