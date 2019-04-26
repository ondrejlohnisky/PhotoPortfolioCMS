<template>
<div class="theSlider">
  <div class="slider-wrap" @click="closeSlider()">  
    <div class="closeSlider" >&times;</div>
  </div>
  <div class="slider" id="slider">
      <div class="holder">
        <div v-for="(image,index) in images" :key="index" class="slide-wrapper">
          <div class="slide">
            <img @click="changeView()" class="slide-image" :src="image.src" :alt="image.title" />
            <span @click="changeView()" v-if="showData && image.title!=null" class="title">{{ image.title }}</span>
            <span @click="changeView()" v-if="showData && image.description!=null" class="description">{{ image.description }}</span>
          </div>
        </div>
      </div>
      <div class="arrow-right">
        <font-awesome-icon size="2x" :icon="['fas','angle-right']"/>
      </div>
      <div class="arrow-left">
        <font-awesome-icon size="2x" :icon="['fas','angle-left']"/>
      </div>
  </div>
</div>
    
</template>

<script>
export default {
  props: {
    images: {
      type: Array,
      required: true
    },
    index: {
      required: true
    },
  },
  data(){
    return{
      showData:false
    }
  },
  methods:{
    changeView(){
      this.showData=!this.showData;
    },
    closeView(){
      this.showData=false;
    },
    closeSlider(){
      this.$store.commit('toggleSlider');
    }
  },
  mounted(){

    if (navigator.msMaxTouchPoints) {

    $('#slider').addClass('ms-touch');

    $('#slider').on('scroll', function() {
        $('.slide-image').css('transform','translate3d(-' + (100-$(this).scrollLeft()/6) + 'px,0,0)');
    });

    } else {
    var that=this;
    var slider = {

        el: {
        slider: $("#slider"),
        holder: $(".holder"),
        imgSlide: $(".slide-image"),
        arrowRight: $(".arrow-right"),
        arrowLeft: $(".arrow-left")
        },

        slideWidth: $('#slider').width(),
        touchstartx: undefined,
        touchmovex: undefined,
        movex: undefined,
        index: that.index,
        longTouch: undefined,
        
        init: function() {
        this.bindUIEvents();

        },

        bindUIEvents: function() {

        this.el.holder.on("touchstart", function(event) {
            slider.start(event);
        });

        this.el.holder.on("touchmove", function(event) {
            slider.move(event);
        });

        this.el.holder.on("touchend", function(event) {
            slider.end(event);
        });
        this.el.arrowRight.on("click", function(e){
          slider.moveRight();
          slider.end(e);
          that.closeView();
        });
        this.el.arrowLeft.on("click", function(e){
          slider.moveLeft();
          slider.end(e);
          that.closeView();
        });

        },

        start: function(event) {
          this.longTouch = false;
          setTimeout(function() {
            window.slider.longTouch = true;
          }, 250);

        this.touchstartx =  event.originalEvent.touches[0].pageX;
        $('.animate').removeClass('animate');
        },
      
        moveLeft: function() {
          this.movex = (this.index-1)*this.slideWidth;
          var panx = 100-this.movex/6;
          if (this.movex < this.slideWidth*(that.images.length-1)) {
              this.el.holder.css('transform','translate3d(-' + this.movex + 'px,0,0)');
          }
          if (panx < 100) {
              // this.el.imgSlide.css('transform','translate3d(-' + panx + 'px,0,0)');
          }
        },
        moveRight: function() {
          this.movex = (this.index+1)*this.slideWidth;
          var panx = 100-this.movex/6;
          if (this.movex < this.slideWidth*(that.images.length-1)) {
              this.el.holder.css('transform','translate3d(-' + this.movex + 'px,0,0)');
          }
          if (panx < 100) {
              // this.el.imgSlide.css('transform','translate3d(-' + panx + 'px,0,0)');
          }
        },
        setSlide: function(index) {
          $('.animate').removeClass('animate');
          this.movex = index*this.slideWidth;
          var panx = 100-this.movex/6;
          if (this.movex < this.slideWidth*(that.images.length-1)) {
              this.el.holder.css('transform','translate3d(-' + this.movex + 'px,0,0)');
          }
          if (panx < 100) {
              // this.el.imgSlide.css('transform','translate3d(-' + panx + 'px,0,0)');
          }
        },

        move: function(event) {
        this.touchmovex =  event.originalEvent.touches[0].pageX;
        this.movex = this.index*this.slideWidth + (this.touchstartx - this.touchmovex);
        var panx = 100-this.movex/6;
        if (this.movex < this.slideWidth*(that.images.length-1)) {
            this.el.holder.css('transform','translate3d(-' + this.movex + 'px,0,0)');
        }
        if (panx < 100) {
            // this.el.imgSlide.css('transform','translate3d(-' + panx + 'px,0,0)');
        }
        },

        end: function(event) {
        var absMove = Math.abs(this.index*this.slideWidth - this.movex);
        if (absMove > this.slideWidth/2 || this.longTouch === false) {
            if (this.movex > this.index*this.slideWidth && this.index < (that.images.length-1)) {
            this.index++;
            } else if (this.movex < this.index*this.slideWidth && this.index > 0) {
            this.index--;
            }
        }
        this.el.holder.addClass('animate').css('transform', 'translate3d(-' + this.index*this.slideWidth + 'px,0,0)');
        // this.el.imgSlide.addClass('animate').css('transform', 'translate3d(-' + 100-this.index*50 + 'px,0,0)');

        }

    };

    slider.init();
    }
    setTimeout(() => {
      $('.holder').css('width',this.images.length*100+'%');
      $('.slide-wrapper').css('width',(100/this.images.length)+'%');
      slider.setSlide(that.index);
    }, 0);
  }
    
}
</script>

<style lang="scss">
@import url(https://fonts.googleapis.com/css?family=Josefin+Slab:100);

.closeSlider{
  position:absolute;
  top:0;
  right:0;
  padding:35px;
  text-align: center;
  color:white;
  font-size: 30px;
  -webkit-user-select: none;
  cursor: zoom-out;
  transition: font-size 0.2s ease-in;
  &:hover{
    font-size: 40px;
  }
}

.animate {
  transition: transform 0.45s ease-out;
}

html,
body {
  height: 100%;
}

body {
  margin: 0;
  padding: 0;
  overflow: hidden;
}

.slider-wrap {
  position: fixed;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  background-color:rgba(0, 0, 0, 0.80);
}
.theSlider{
  position:fixed;
  left:0;
  top:0;
  width:100%;
  height:100%;
}

.slider {
  position:absolute;
  width: 75%;
  height: 100%;
  top:50%;
  left:50%;
  transform:translate(-50%,-50%);
  overflow: hidden;
}


.ms-touch.slider {
  overflow-x: scroll;
  overflow-y: hidden;
  
  -ms-overflow-style: none;
  
  -ms-scroll-chaining: none;
  
  -ms-scroll-snap-type: mandatory;
  
  -ms-scroll-snap-points-x: snapInterval(0%, 100%);
}

.holder {
  height: 100%;
  overflow-y: hidden;
}

.slide-wrapper {
  height: 100%;
  float: left;
  position: relative;
  overflow: hidden;
}

.slide {
  position: relative;
  height: 100%;
  width:100%;
}
.title {
  position: absolute;
  z-index: 1;
  color: white;
  font-size: 40px;
  top: 0;
  left:50%;
  width:fit-content;
  height:fit-content;
  transform:translateX(-50%);
  border-radius: 10px;
  font-family: 'Josefin Slab', serif;
  background-color: rgba(0, 0, 0, 0.85);
  padding:5px;
  font-weight: 100;
}

.description {
  position: absolute;
  z-index: 1;
  color: white;
  font-size: 25px;
  bottom: 0;
  left:50%;
  text-align: center;
  overflow:auto;
  width:75%;
  height:fit-content;
  transform:translateX(-50%);
  border-radius: 10px;
  font-family: 'Josefin Slab', serif;
  background-color: rgba(0, 0, 0, 0.85);
  padding:5px;
  word-wrap: break-word;
}

.slide img {
  position: absolute;
  width:auto;
  height: 100%;
  left:50%;
  transform:translateX(-50%);
  z-index: 0;
}

.arrow-right,.arrow-left{
  position:absolute;
  top:50%;
  transform: translate(0,-50%);
  color:white;
  z-index: 10000;
}
.arrow-right{
  right:0;
  :hover{
      font-size:2.15em;
  }
}
.arrow-left{
  left:0;
  :hover{
      font-size:2.15em;
  }
}

</style>
