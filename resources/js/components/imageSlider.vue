<template>
   <div class="view">
      <div class="arrow-right" v-if="arrows" >
         <font-awesome-icon size="2x" :icon="['fas','angle-right']" @click="nextSlide('left');"/>
      </div>
      <div class="arrow-left" v-if="arrows" >
         <font-awesome-icon size="2x" :icon="['fas','angle-left']"  @click="nextSlide('right');"/>
      </div>
      <ul class="control" v-if="controls" >
         <li v-for="(image,index) in images" :key="index" >
            <font-awesome-icon size="xs" :icon="['fas',index+1==actualSlide ? 'dot-circle': 'circle']" @click="setSlide(index+1);"/>
         </li>
      </ul>
      <div class="imgContainer">
         <img v-for="(image,index) in images" :key="index" :src="image.src" :alt="image.description">
      </div>
   </div>
</template>

<script>
   var myInterval;
   //
   // endingType: continue/rollback   =====>  jak je vyřešený konec slajdů  (rollback se pretočí na začátek-animace,continue bude pokračovat akorát od začátku)

   export default {
      props:{
         arrows:{
            type:Boolean,
            default:true
         },
         controls:{
            type:Boolean,
            default:true
         },
         images: {
            type: Array,
            required: true
         },
         interval: {
            type: Number,
            default: 5000
         },
         speed: {
            type: Number,
            default: 1000
         },
         endingType: {
            type: String,
            default: 'continue'
         },
         stopOnHover: {
            type: Boolean,
            default: true
         }
      },
      data (){
         return{
            actualSlide:this.endingType=="continue" ? 1 : 0,   
            animationCompleted:true,
            width:0
         }
      },
      methods:{
         initialize(){
               this.width=this.$el.clientWidth;
               this.initCss();
               this.goToStartFast();
               this.resetInterval();
         },
         setSlide(index){
            var that=this;
            this.resetInterval();
            this.animationCompleted=false;
            $(".imgContainer").animate({
               'margin-left': -this.width*index
            }, this.speed, function() {
               that.animationCompleted=true;
               that.actualSlide=index;
            });
         },
         goToStart (){
            var that=this;
            this.animationCompleted=false;
            $(".imgContainer").animate({
               'margin-left': '0'
            }, this.speed, function() {
               that.animationCompleted=true;
               that.actualSlide=0;
            });
         },
         goToEnd (){
            var that=this;
            this.animationCompleted=false;
            $(".imgContainer").animate({
               'margin-left': '-='+this.width*(this.images.length-1)
            }, this.speed, function() {
               that.animationCompleted=true;
               that.actualSlide=that.images.length-1;
            });
         },
         goToStartFast (){
            if(this.endingType=="rollback"){
               $(".imgContainer").css({
                  'margin-left': '0'
               });
            }else{
               $(".imgContainer").css({
                  'margin-left': (this.width)*(-1)
               });
            }
         },
         goToEndFast (){
            $(".imgContainer").css({
               'margin-left': (this.width*(this.images.length))*(-1)
            });
         },
         slideLeft (){
            var that=this;
            this.animationCompleted=false;
            $(".imgContainer").animate({
               'margin-left': '-='+this.width
            }, this.speed,function(){
               that.actualSlide++;
               that.animationCompleted=true;
            });
         },
         slideRight (){
            var that=this;
            this.animationCompleted=false;
            $(".imgContainer").animate({
               'margin-left': '+='+this.width
            }, this.speed,function(){
               that.actualSlide--;
               that.animationCompleted=true;
            });
         },
         slideLeft1 (){
            var that=this;
            this.animationCompleted=false;
            $(".imgContainer").animate({
               'margin-left': '-='+this.width
            }, this.speed, function() {
               that.goToStartFast();
               that.actualSlide=1;
               that.animationCompleted=true;
            });
         },
         slideRight1 (){
            var that=this;
            this.animationCompleted=false;
            $(".imgContainer").animate({
               'margin-left': '+='+this.width
            }, this.speed, function() {
               that.goToEndFast();
               that.actualSlide=that.images.length;
               that.animationCompleted=true;
            });
         },
         nextSlide (side){
            this.resetInterval();
            //continue bude pokračovat akorát od začátku
            if(this.endingType=='continue' && this.animationCompleted){
               if(side=="right" && this.actualSlide>1){//kliknul sipku doleva
                  this.slideRight();
               }else if(side=="left" && this.actualSlide<this.images.length){//kliknul sipku doprava
                  this.slideLeft();
               }else if(side=="right" && this.actualSlide==1){//kliknul na sipku doleva na začátku ->na konec
                  this.slideRight1();
               }else if(side=="left" && this.actualSlide==this.images.length){//kliknul na sipku doleva na konci ->na začátek
                  this.slideLeft1();
               }
            }
            //rollback se pretočí na začátek-animace
            if(this.endingType=='rollback' && this.animationCompleted){
               if(side=="right" && this.actualSlide>0){//kliknul sipku doleva
                  this.slideRight();
               }else if(side=="left" && this.actualSlide<this.images.length-1){//kliknul sipku doprava
                  this.slideLeft();
               }else if(side=="right" && this.actualSlide==0){//kliknul na sipku doleva na začátku ->na konec
                  this.goToEnd();
               }else if(side=="left" && this.actualSlide==this.images.length-1){//kliknul na sipku doleva na konci ->na začátek
                  this.goToStart();
               }
            } 
         },
         resetInterval (){
            window.clearInterval(myInterval);
            this.mountInterval();
         },
         addPhotoOnStartAndEnd(){
            const lastPic = $(".imgContainer > img:last-child").clone();
            const firstPic = $(".imgContainer > img:first-child").clone();
            $(".imgContainer").prepend(lastPic);
            $(".imgContainer").append(firstPic);

         },
         initCss(){
            //css            

            if(this.endingType=="continue"){

               $(".imgContainer").css({
                  'height':(this.width*3)/4+'px',
                  'width': (this.width*(this.images.length+2))+'px'
               });
               $(".imgContainer").css({
                  'margin-left': '-='+this.width
               });
               
            }else{
               $(".imgContainer").css({
                  'height':(this.width*3)/4+'px',
                  'width': (this.width*(this.images.length))+'px'
               });
            }

            $(".imgContainer img,.view").css({
               'width':this.width+'px',
               'height':(this.width*3)/4+'px'
            });
         },
         mountInterval() {
            var that=this;
            myInterval=window.setInterval(function(){
               if (that.stopOnHover) {
                  //když na to zamýřím myší tak to nebude pokračovat
                  if(!($(".view").is(":hover"))){
                     that.nextSlide("left"); 
                  }
               }else{
                  that.nextSlide("left");
               }
               
            },this.interval);
         }
      },
      mounted (){
         if(this.endingType=="continue"){
            this.addPhotoOnStartAndEnd();
         }
         this.initialize();
         this.$nextTick(function() {
            window.addEventListener('resize', this.initialize);
         });

      },
      beforeDestroy() {
         window.clearInterval(myInterval);
         window.removeEventListener('resize', this.initialize);
      }

   }
</script>

<style lang="scss" scoped>

.col-md-6{
      padding:0;
}
.imgContainer img{
   display:inline;
}
.view{
   -webkit-user-select:none;
   -khtml-user-select:none;
   -moz-user-select:none;
   -ms-user-select:none;
   -o-user-select:none;
   user-select:none;
   position:relative;
   overflow: hidden;
   ul.control{
      z-index: 10000;
      position: absolute;
      left: 50%;
      bottom:0px;
      width: auto;
      transform: translateX(-50%);
      list-style-type: none;
      li{
         display:inline;
         margin-left:0.45em;
         color:white;
         -webkit-transition: color 1s, font-size 5s;
         -moz-transition: color 1s, font-size 5s;
         -o-transition: color 1s, font-size 5s;
         transition: color 1s, font-size 5s;
         :hover{
            font-size:0.83em;
         }
      }
   }
   .arrow-right,.arrow-left{
      position:absolute;
      top:50%;
      transform: translate(0,-50%);
      color:white;
      z-index: 10000;
   }
   .arrow-right{
      right:5px;
      :hover{
         font-size:2.15em;
      }
   }
   .arrow-left{
      left:5px;
      :hover{
         font-size:2.15em;
      }
   }
}

</style>
