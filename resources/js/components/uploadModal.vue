<template>
<div>
   <div class="pageModalWrapper" @click="closeUploadModal()">
   </div>
   <div class="pageModal">
      <transition name="slide-fade">
         <div v-if="message" class="alert alert-danger" role="alert">
            <div v-html="message"></div>
         </div>
      </transition>
      <div class="pageModalHeader mb-4 h5">
         Přidat složku
      </div>
      <div class="pageModalBody">
         <p class="h6 mb-4">Základní informace</p>
         <div class="form-row">
            <div class="col-sm-6 mb-2">
               <input v-model="title" type="text" class="form-control" placeholder="Název" max="25"> 
            </div>
            <div class="col-sm-6 mb-2">
               <textarea v-model="description" type="text" class="form-control" placeholder="Popis"></textarea>
            </div>
         </div>
         <div class="form-row">
            <div :class="[imageSrc ? 'col-8' : 'col','mb-2']">
               <div class="file-field">
                  <div class="myInputButton btn btn-light btn-sm">
                     <span>
                        <font-awesome-icon size="lg" :icon="['fas','image']" />
                        Vybrat titulní fotku
                     </span>
                     <input type="file" id="titleImageInput" class="myInputFile" accept="image/*" ref="imageInput">
                  </div>
                  <input type="text" id="fileNamePreview" class="file-path" placeholder="Soubor nevybrán" onkeypress="return false;">
                  <label id="titleImageSize" for="fileNamePreview"></label>
               </div>
            </div>
            <div v-if="imageSrc" class="col-4 mb-2">
               <img :src="imageSrc" id="imagePreview" alt="Image Not Found">
            </div>
         </div>
         <!-- <p class="h6 mb-4 mt-2">Zabezpečení</p>
         <div class="form-row">
            <div class="col-sm-6 mb-2">
               <div class="custom-control custom-checkbox">
                  <input v-model="locked" type="checkbox" class="custom-control-input" id="locked">
                  <label class="custom-control-label" for="locked">Zaheslovat složku</label>
               </div>
            </div>
         </div>
         <div v-if="locked" class="form-row">
            <div class="col-sm-8">
               <label for="count">Počet použití hesla <span class="text-danger font-weight-bold">{{ count }}</span></label>
               <input v-model="count" type="range" class="custom-range" min="1" max="100" id="count">
               
            </div>
         </div> -->
         <button class="btn btn-success btn-block my-4" type="submit" @click="createFolder()">Vytvořit</button>
      </div>
   </div>
</div>
</template>
<script>
import {EventBus} from '../event-bus.js';
export default {
   data(){
      return{
         title:'',
         description:'',
         imageSrc:null,
         message:''
      }
   },
   methods:{
      closeUploadModal(){
         $('body').css('overflow', 'auto');
         $(window).unbind('scroll');
         this.$store.commit('uploadModal')
      },
      createFolder(){
         if(this.title==''){
            this.message='Název je povinný!';
         }else{
            let config={headers: {'Content-Type':'multipart/form-data'}};
            let fd=new FormData();
            fd.append("title",this.title);
            fd.append("description",this.description);
            fd.append("public_image",this.$refs.imageInput.files[0]);

            axios.post("/api/folders",fd,config).then((response)=>{
               this.closeUploadModal();
               EventBus.$emit("folderUploaded",response.data.title);
            });
         }
      }
   },
   mounted(){
      var that=this;
      function readURL(input) {
         if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = (e)=>{
               that.imageSrc=e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
         }
      }
      function bytesToSize(bytes) {
         var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
         if (bytes == 0) return '0 Byte';
         var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
         return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
      };
      $(function(){
         // input File 
         function detectValue(){
            if($("#fileNamePreview").val()!==''){
               $("#fileNamePreview").removeClass("validate");
               $("#fileNamePreview").addClass("validated");
            }else{
               $("#fileNamePreview").removeClass("validated");
               $("#fileNamePreview").addClass("validate");
            }
         }
         $("#titleImageInput").change(function(){
            $("#fileNamePreview").val($("#titleImageInput").val().split('\\').pop());
            $("#titleImageSize").text(bytesToSize($("#titleImageInput")[0].files[0].size));
            readURL(this);
            detectValue();
         }); 
         $("#fileNamePreview").on('focus',function(){
            detectValue();
         });
         $("#fileNamePreview").on('input',function(){
            detectValue();
         });

         $(".form-control").on('input',function(){
            if($(this).val().length>=1){
               $(this).addClass("validated");
            }else{
               $(this).removeClass("validated");
            }
         });
      });
   }
}
</script>
<style lang="scss" scoped>
#imagePreview{
   width:100%;
   border-radius: calc(.25rem - 1px);
}
#titleImageSize{
   font-style: italic;
}
.file-field{
   position:relative;
}

.file-path{
   -webkit-transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
   transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
   -o-transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
   transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
   transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
   outline: 0;
   -webkit-box-shadow: none;
   box-shadow: none;
   border: none;
   border-bottom: 2px solid #ced4da;
   -webkit-border-radius: 0;
   border-radius: 0;
   -webkit-box-sizing: content-box;
   box-sizing: content-box;
   background-color: transparent;
   &.validate{
      border-color:  #4d86e2;
   }
   &.validated{
      border-color: #28a745;
   }
}
.form-control{
   &.validated{
      background-color: #fff;
      border-color: #28a745;
      outline: 0;
      box-shadow: 0 0 0 0.05rem rgba(0, 255, 0, 0.25);
   }
}
.myInputButton{
   position:relative;
}
.myInputFile{
   position: absolute;
   top: 0;
   right: 0;
   left: 0;
   bottom: 0;
   width: 100%;
   margin: 0;
   padding: 0;
   cursor: pointer;
   opacity: 0;
}
.myInputFileLabel {
   width: 100%;
   height: calc(2.25rem + 2px);
   padding: 0.375rem 0.75rem;
   font-size: 1rem;
   line-height: 1.5;
   color: #6c757d;
   opacity: 1;
   background-color: #fff;
   background-clip: padding-box;
   border: 1px solid #ced4da;
   border-radius: 0.25rem;
   transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.myInputFileLabelSpan{
   height:100%;
   width:40%;
   background-color: rgb(207, 207, 207)
}
.pageModal{
   position:fixed;
   overflow: auto;
   left:50%;
   top:35%;
   height:auto;
   max-height:65%;
   width:50%;
   transform: translate(-50%, -50%);
   background-color: white;
   border-radius: 5px;
   z-index:60000;
   box-shadow: 0px 0px 10px gray;
   padding:15px;
}
@media (max-width: 686px) {
   .pageModal{
      width:80%;
   }
}
.pageModalHeader{
   text-align:center;
   padding:5px;
   width:100%;
   height:auto;
}
.pageModalWrapper{
   position:fixed;
   z-index: 50000;
   top:0;   
   left:0;
   width:100%;
   height:100%;
   background-color: rgba(199, 199, 199, 0.4)
}
.slide-fade-enter-active {
  transition: all .5s ease-in;
}
.slide-fade-leave-active {
  transition: all .8s ease-out;
}
.slide-fade-enter, .slide-fade-leave-to{
   margin-top:-65px;
   opacity:0;
}
</style>