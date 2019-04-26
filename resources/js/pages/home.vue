<template>
   <div>
      <div class="row">
            <imageslider v-if="images.length>0" class="col-md-6 myImageSlider" :images="images" :speed="1000" :interval="4250" :arrows="true" :controls="false" :stopOnHover="true" endingType="continue"/>
      </div>
   </div>
</template>

<script>
import imageslider from '../components/imageSlider';
export default {
      
      components: {
            'imageslider':imageslider
      },
      data (){
            return{
                  images:[]
            }
      },
      methods:{
            getImages(){
                  axios.get('/api/images').then((response)=>{
                        this.images=response.data;
                  });
            }
      },
      mounted(){
            this.getImages();
      }
}
</script>


<style lang="scss" scoped>
      .myImageSlider{
            border-radius:4px;

      }
</style>
