<template>
   <div>
      <div class="row">
         <div class="col-md-8">
         </div>
         <div class="col-md-4">
            <h3>Odkazy na sociální sítě</h3>
            <ul class="icons list-group list-group-flush">
               <li>
                  <div class="md-form">
                     <div class="facebook prefix"><font-awesome-icon size="sm" :icon="['fab','facebook']" /></div>
                     <input type="text" id="inputIcon1" class="form-control validate" v-model="links[0].link" @input="updateLink(links[0].id)"/>
                  </div>
               </li>
               <li>
                  <div class="md-form">
                     <div class="instagram prefix"><font-awesome-icon size="sm" :icon="['fab','instagram']" /></div>
                     <input type="text" id="inputIcon2" class="form-control validate" v-model="links[1].link" @input="updateLink(links[1].id)"/>
                  </div>
               </li>
               <li>
                  <div class="md-form">
                     <div class="youtube prefix"><font-awesome-icon size="sm" :icon="['fab','youtube']" /></div>
                     <input type="text" id="inputIcon3" class="form-control validate" v-model="links[2].link" @input="updateLink(links[2].id)"/>
                  </div>
               </li>
               <svg width="0px" height="0px" >
                  <linearGradient id="lgrad" x1="50%" y1="0%" x2="50%" y2="100%" > 
                        <stop offset="0%" style="stop-color:rgb(116,46,185);stop-opacity:1" />
                        <stop offset="49%" style="stop-color:rgb(199,54,95);stop-opacity:1" />
                        <stop offset="99%" style="stop-color:rgb(221,137,73);stop-opacity:1" />
                        <stop offset="100%" style="stop-color:rgb(221,137,73);stop-opacity:1" />
                  </linearGradient> 
               </svg>
            </ul>
         </div>
      </div>
   </div>
</template>

<script>
export default {
   data(){
      return{
         links:[]
      }
   },
   methods:{
      updateLink(id){
         console.log(this.links.filter(link=>link.id==id)[0].link);
         axios.put('/api/social_links/'+id,{
            'link':this.links.filter(link=>link.id==id)[0].link
         });
      }
   },
   mounted(){
      axios.get('/api/social_links').then((response) => {
         this.links=response.data;
      });
   }
}
</script>



<style lang="scss" scoped>
a{
   text-decoration: none;
   color:inherit;
}
.icons li{
   margin-right:10px;
   list-style: none;
   display: block;
   
}
.facebook{
   color:rgb(61, 102, 168);
}

.youtube{
   color: rgb(97%, 0%, 9%);
}

.instagram svg *{
   fill: url(#lgrad);
}


</style>
