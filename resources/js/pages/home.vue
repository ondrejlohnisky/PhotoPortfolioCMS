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
                  images:[
                  //       {
                  //             name: 'first',
                  //             description: 'description',
                  //             src: 'https://www.boxmotions.com/blog/wp-content/uploads/2017/06/1458593290-timbercraft-tiny-home-2.jpg'
                  //       },
                  //       {
                  //             name: 'second',
                  //             description: 'description',
                  //             src: 'https://photos.motorcar.com/used-2011-ford-mustang-2drcoupeshelbygt500-9871-15451644-2-640.jpg'
                  //       },
                  //       {
                  //             name: 'third',
                  //             description: 'description',
                  //             src: 'https://www.epa.gov/sites/production/files/styles/large/public/2016-10/house_off.jpg'
                  //       },
                  ]
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
