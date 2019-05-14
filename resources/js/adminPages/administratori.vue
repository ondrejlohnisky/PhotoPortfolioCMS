<template>
   <div>
      <transition name="slide-fade">
         <div v-if="message" class="alert alert-success" role="alert">
            <div v-html="message"></div>
         </div>
      </transition>
      <div v-if="addAdminModal" @click="closeAddAdminModal()" class="modalWrapper">
      </div>
      <div v-if="addAdminModal" class="myModal">
         <div class="row">
            <div class="col-6 h4 text-danger">Pozor!</div>
         </div>
         <div class="row">
            <div class="col-12">
               <div class="h6">Opravdu si přejete odeslat pozvánku k registraci na email <b>{{ newAdminEmail }}</b>?</div>
            </div>
         </div>
         <div class="row">
            <div class="col-8">
               <div class="font-weight-light"> * Pozvaný administrátor bude mít přístup a práva k editaci stránky.</div>
            </div>
         </div>
         <div class="row my-2">
            <div class="col-sm-6">
               <button @click="closeAddAdminModal()" class="btn btn-light btn-block btn-sm">Zrušit</button>
            </div>
            <div class="col-sm-6">
               <button @click="addAdmin()" class="btn btn-success btn-block btn-sm">Ano</button>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-md-8">
            <h2>List všech administrátorů</h2>
            
            <table class="table table-striped ">
               <thead>
                  <tr>
                     <th scope="col">ID</th>
                     <th scope="col">Jméno</th>
                     <th scope="col">Email</th>
                     <th scope="col">Pozice</th>
                     <th scope="col">Popis pozice</th>
                     <th scope="col">Akce</th>
                  </tr>
               </thead>
               <tbody>
                  <tr v-for="(admin,index) in admins" :key="index">
                     <th scope="row">{{ admin.id }}</th>
                     <td>{{ admin.name }}</td>
                     <td>{{ admin.email }}</td>
                     <td><span v-for="(role,index) in admin.roles" :key='index'>{{ role.name }} </span></td>
                     <td><span v-for="(role,index) in admin.roles" :key='index'>{{ role.description }} </span></td>
                     <td><button></button></td>
                  </tr>
                  <tr>
                     <th>Pozvat administrátora: </th>
                     <td colspan="3"><input @keyup.enter="openAddAdminModal()" v-model="newAdminEmail" placeholder="petr.novak@example.com" id="inviteEmailInput" type="text" class="form-control form-control-sm"></td>
                     <td colspan="2"><button @click="openAddAdminModal()" v-if="newAdminEmail!=''" id="inviteButton" class="btn btn-success btn-sm btn-block">Pozvat</button></td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="col-md-4">
            <h3>Informace o vás</h3>
            <ul class="list-group">
               ID:
               <li class="list-group-item">{{ loggedAdmin.id }}</li><br/>
               Vaše jméno:
               <li class="list-group-item">{{ loggedAdmin.name }}</li><br/>
               Váš email:
               <li class="list-group-item">{{ loggedAdmin.email }}</li><br/>
               Datum a čas registrace:<li class="list-group-item">{{ loggedAdmin.created_at }}</li>
            </ul><hr/>
            <h3>Vaše role</h3>
            <ul v-for="(role,index) in loggedAdmin.roles" :key="index" class="list-group">
               <li class="list-group-item">{{ role.name }}</li>
               <li class="list-group-item">{{ role.description }}</li><br/>
            </ul><br/>
         </div>
      </div>
   </div>
</template>

<script>
export default {
   data(){
      return{
         admins:[],
         addAdminModal: false,
         newAdminEmail:'',
         message:'',
         loggedAdmin:{}
      }
   },
   methods:{
      getAdmins(){
         axios.get("/api/user").then(response => {
            this.admins=response.data;
         });
      },
      closeAddAdminModal(){
         $('body').css('overflow', 'auto');
         $(window).unbind('scroll');
         this.addAdminModal=false;
         this.newAdminEmail='';
      },
      openAddAdminModal(){
         var top = $(window).scrollTop();
         var left = $(window).scrollLeft();
         $('body').css('overflow', 'hidden');
         $(window).scroll(function(){
            $(this).scrollTop(top).scrollLeft(left);
         });
         this.addAdminModal=true;
      },
      addAdmin(){
         axios.post('/api/invitation',{'email':this.newAdminEmail}).then(response => {
            console.log(response);
            this.closeAddAdminModal();
            this.message="Uživatel <strong>"+this.newAdminEmail+"</strong> byl pozván k registraci.";
            setTimeout(()=>{
               this.message='';
            },4000)
         });
      }

   },
   mounted() {
      this.getAdmins();
      this.loggedAdmin=this.$store.state.user;
   },
}
</script>

<style lang="scss" scoped>
#inviteButton{
   width:fit-content;
}
#inviteEmailInput{
   width:100%;
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
table.table{
   // border:4px solid black;
}
</style>
