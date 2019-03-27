<template>
    <div>
        <div @click="closeSettingModal()" class="pageModalWrapper"></div>
        <div class="jumbotron pageModal">
            <p class="pageModalHeader h4 mb-4">Nastavení účtu</p>

            <input type="text" class="form-control mb-4" v-model="user.name" placeholder="Jméno"/>
            <input type="email" class="form-control mb-4" v-model="user.email" placeholder="E-Mail"/>
            <button class="btn btn-success btn-sm btn-block" type="submit">Uložit</button>

        </div>
    </div>
</template>

<script>
export default {
    props:{
        user:Object
    },
    methods: {
        closeSettingModal(){
            $('body').css('overflow', 'auto');
            $(window).unbind('scroll');
            this.$store.commit('settingModal')
        },
    },
    mounted(){
        console.log(this.user)
    }
}
</script>

<style lang="scss" scoped>
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
</style>
