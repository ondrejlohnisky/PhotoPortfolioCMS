<template>
   <div>
      <div class="rowC">
         <div class="columnC">
            <div v-for="(folder,index) in folders1" :key="index" @click="routerPush({ name: 'folder',params:{id:folder.id}},folder.locked,folder.title)">
               <folder :folder="folder"/>
            </div>
         </div>
         <div class="columnC">
            <div v-for="(folder,index) in folders2" :key="index" @click="routerPush({ name: 'folder',params:{id:folder.id}},folder.locked,folder.title)">
               <folder :folder="folder"/>
            </div>
         </div>
         <div class="columnC">
            <div v-for="(folder,index) in folders3" :key="index" @click="routerPush({ name: 'folder',params:{id:folder.id}},folder.locked,folder.title)">
               <folder :folder="folder"/>
            </div>
         </div>
      </div>
      <div v-if="passwordModal" class="passwordModalWrapper" @click="closePasswordModal()">
      </div>
      <div v-if="passwordModal" class="passwordModal">
         <div v-if="error" class="row">
            <div class="col">
               <div class="alert alert-danger" role="alert">
                  <strong>{{ errorMessage }}</strong>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col">
               <div class="h6 text-danger">Složka <span class="text-primary">{{ passwordModalName }}</span> je zamčená</div>
            </div>
         </div>
         <form>
            <div class="row">
               <div class="col-md-7">
                  <input id="passwordInput" v-model="password" type="password" class="form-control" placeholder="heslo">
               </div>
               <div class="col-md-3">
                  <button @click.prevent="enterPassword()" class="btn btn-success btn-md">Potvrdit</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</template>

<script>
import folder from '../components/folder'
export default {
   data(){
      return{
         folders1:[],
         folders2:[],
         folders3:[],
         passwordModal:false,
         password:'',
         passwordModalId:0,
         error:false,
         errorMessage:''
      }
   },
   methods:{
      closePasswordModal(){
         $('body').css('overflow', 'auto');
         $(window).unbind('scroll');
         this.passwordModal=false;
         this.password='';
         this.passwordModalId=0;
         this.error=false;
         this.errorMessage='';
      },
      openPasswordModal(){
         var top = $(window).scrollTop();
         var left = $(window).scrollLeft();
         $('body').css('overflow', 'hidden');
         $(window).scroll(function(){
            $(this).scrollTop(top).scrollLeft(left);
         });
         this.passwordModal=true;
      },
      routerPush(params,locked,title){
         if(locked){
            this.passwordModalId=params.params.id;
            this.passwordModalName=title;
            this.openPasswordModal();
         }else{
            this.$router.push(params);
         }
      },
      enterPassword(){
         axios.get('/api/folders/check/'+this.passwordModalId+'?password='+this.password).then((response) => {
            console.log(response.data);
            if(response.data.error==false){
               this.$store.commit('setFolderPassword',this.password);
               setTimeout(() => {
                  this.$router.push({ name: 'folder',params:{id:this.passwordModalId}});
                  this.closePasswordModal();
               }, 250);
            }else{
               this.error=true;
               this.errorMessage=response.data.message;
            }
         });
      },
      getFolders(){
         axios.get('/api/folders').then((response) => {

            // this.folders1.push(response.data.data[0]);
            // this.folders2.push(response.data.data[1]);
            // this.folders3.push(response.data.data[2]);

            // this.folders1.push(response.data.data[3]);
            // this.folders2.push(response.data.data[4]);
            // this.folders3.push(response.data.data[5]);
            var temp = 1;
            for(var i=0;i<response.data.data.length;i++){
               if(temp==3){
                  this.folders3.push(response.data.data[i]);
                  temp++;
               }else if(temp==2){
                  this.folders2.push(response.data.data[i]);
                  temp++;
               }else if(temp==1){
                  this.folders1.push(response.data.data[i]);
                  temp++;
               }
               temp==4 ? temp=1 : '';
            }
         })
      }
   },
   components: {
      folder
   },
   mounted(){
      this.getFolders();
   }
}
</script>

<style lang="scss" scoped>
#passwordInput{
   height:100%;
}
.passwordModalWrapper{
   position:fixed;
   z-index: 50000;
   top:0;   
   left:0;
   width:100%;
   height:100%;
   background-color: rgba(199, 199, 199, 0.4)
}
.passwordModal{
   position:fixed;
   overflow: auto;
   left:50%;
   top:35%;
   height:auto;
   width:fit-content;
   transform: translate(-50%, -50%);
   background-color: white;
   border-radius: 5px;
   z-index:60000;
   box-shadow: 0px 0px 10px gray;
   padding:15px;
}
a{
   text-decoration: none;
   color:inherit;
}
.rowC {

   display: flex;
   flex-wrap: wrap;
   padding: 0 4px;
}

.columnC {
   flex: 33.333333333333333%;
   max-width: 33.333333333333333%;
   padding: 0 10px;
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
