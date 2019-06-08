<template>
   <div>
      <transition name="slide-fade">
         <div v-if="message" :class="['alert',error ? 'alert-danger' : 'alert-success']" role="alert">
            <div v-html="message"></div>
         </div>
      </transition>
      <div v-if="addReviewModal" @click="closeAddReviewModal()" class="modalWrapper">
      </div>
      <div v-if="addReviewModal" class="myModal">
         <div class="row my-2">
            <div class="col-6 h4">Přidat review!</div>
         </div>
         <form v-on:submit.prevent="addReview()">
            <div class="row">
               <div class="col-8">
                  <input v-on:keyup.enter="setFocus('line2')" v-model="addingReview.title" class="form-control" type="text" placeholder="Titulek">
               </div>
            </div>
            <div class="row">
               <div class="col-12">
                  <div class="form-group shadow-textarea">
                     <label for="line2"></label>
                     <textarea id="line2" v-on:keyup.enter="setFocus('line3')" required v-model="addingReview.text" class="form-control z-depth-1" rows="3" cols="5" placeholder="Obsah"></textarea>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-12">
                  <input id="line3" v-model="addingReview.author" class="form-control" type="text" placeholder="Autor">
               </div>
            </div>
            <div class="row my-2">
               <div class="col-sm-6">
                  <button @click="closeAddReviewModal()" class="btn btn-light btn-block btn-sm">Zrušit</button>
               </div>
               <div class="col-sm-6">
                  <button type="submit" class="btn btn-success btn-block btn-sm">Potvrdit</button>
               </div>
            </div>
         </form>
      </div>
      <div class="text-center">
         <button class="btn btn-success btn-rounded btn-sm" @click="openAddReviewModal()">+</button>
         <dir v-for="(review,index) in reviews" :key="index">
            <Review :title="review.title" :text="review.text" :author="review.author" />
            <hr v-if="index<reviews.length" class="reviewSplitter my-5">
         </dir>
      </div>
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
            reviews: [],
            addReviewModal:false,
            addingReview:{
               title: '',
               text: '',
               author: ''
            },
            message:'',
            error:false
         }
      },
      methods:{
         setFocus: function (element) {
            document.getElementById(element).focus();
         },
         getReviews(){
            axios.get('/api/reviews').then(response=>{
               this.reviews=response.data;
            });
         },
         openAddReviewModal(){
            var top = $(window).scrollTop();
            var left = $(window).scrollLeft();
            $('body').css('overflow', 'hidden');
            $(window).scroll(function(){
               $(this).scrollTop(top).scrollLeft(left);
            });
            this.addReviewModal=true;
         },
         closeAddReviewModal(){
            $('body').css('overflow', 'auto');
            $(window).unbind('scroll');
            this.addReviewModal=false;
         },
         addReview(){
            let fd = new FormData();
            fd.append('title',this.addingReview.title);
            fd.append('text',this.addingReview.text);
            fd.append('author',this.addingReview.author);
            axios.post('/api/reviews',fd).then(response=>{
               this.message=response.data.message;
               this.error=response.data.error;
               setTimeout(()=>{
                  this.message='';
               },4000);
               this.closeAddReviewModal();
               this.addingReview={}
               this.getReviews();
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
.myModal{
   width:40%;
}
</style>
