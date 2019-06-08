<template>
   <div>
      <dir v-for="review in reviews" :key="review.id">
         <Review :title="review.title" :text="review.text" :author="review.author"/>
         <hr v-if="review.id<reviews.length" class="reviewSplitter my-5">
      </dir>
   </div>
</template>

<style lang="scss" scoped>

</style>



<script>
import Review from '../components/review'
export default {
      components:{
         Review
      },
      data(){
         return {
            reviews: []
         }
      },
      methods:{
         getReviews(){
            axios.get('/api/reviews').then(response=>{
               this.reviews=response.data;
            });
         }
      },
      mounted(){
         this.getReviews();
      }
}

</script>

<style lang="scss" scoped>
hr.reviewSplitter{
    border: 1px solid darkgrey;
    border-radius: 5px;
    width:25vw;
}
</style>
