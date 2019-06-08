<template>
    <div>
        <div class="review">
            <h4 v-if="title!=null">{{ title }}</h4>
            <br>
            <blockquote class="blockquote">
                <p class="mb-0">{{ text }}</p>
                <footer v-if="author!=null" class="blockquote-footer text-right"> <cite title="Source Title">{{ author }}</cite></footer>
                <footer v-else class="blockquote-footer text-right"> <cite title="Source Title">{{ 'Anonym' }}</cite></footer>
            </blockquote>
        </div>
    </div>

</template>

<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css?family=Merriweather:400i&display=swap');
.review{
    position:relative;
    margin:4vw;
    padding:2.2vw;
    background-color:white;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-box-shadow: rgba(0,0,0,0.5) 0 0 10px;
    -moz-box-shadow: rgba(0,0,0,0.5) 0 0 10px;
    box-shadow: rgba(0,0,0,0.6) 0 0 10px;
    p{
        font-family: 'Merriweather', serif;
    }

}
</style>



<script>
export default {
    props:{
        title:{
            type:String,
            reqired: false
        },
        text:{
            type:String,
            reqired: true
        },
        author:{
            type:String,
            reqired: true
        }
    }
}

</script>