<template>
    <nav class="navbar navbar-expand-lg navbar-light bg- b g rounded-bottom">
        <div class="container-fluid">
            <router-link :to="{name: 'home'}"><img draggable="false" src="/images/PodpisLogo.png" alt="PetrSmille" class="logo"></router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarID">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse flex-md-column" id="navbarID">
                <ul class="navbar-nav ml-auto">
                    <li :class="this.$route.name=='home' ? 'active nav-item' : 'nav-item'">
                        <router-link class="nav-link" data-toggle="collapse" data-target="#navbarID.show" :to="{ name: 'home' }">Domů</router-link>
                    </li>
                    <li :class="this.$route.name=='portfolio' ? 'active nav-item' : 'nav-item'">
                        <router-link class="nav-link" data-toggle="collapse" data-target="#navbarID.show" :to="{ name: 'portfolio' }">Portfolio</router-link>
                    </li>
                    <li :class="this.$route.name=='review' ? 'active nav-item' : 'nav-item'">
                        <router-link class="nav-link" data-toggle="collapse" data-target="#navbarID.show" :to="{ name: 'review' }">Review</router-link>
                    </li>
                    <li :class="this.$route.name=='bts' ? 'active nav-item' : 'nav-item'">
                        <router-link class="nav-link" data-toggle="collapse" data-target="#navbarID.show" :to="{ name: 'bts' }">BTS</router-link>
                    </li>
                    <li :class="this.$route.name=='contact' ? 'active nav-item' : 'nav-item'">
                        <router-link class="nav-link" data-toggle="collapse" data-target="#navbarID.show" :to="{ name: 'contact' }">Kontakt</router-link>
                    </li>
                </ul>
                <div class="icons ml-auto">
                    <li v-for="(link,index) in links" :key="index" :class="link.name"><a :href="link.link" target="_blank"><font-awesome-icon size="2x" :icon="['fab',link.name]" /></a></li>

                    <svg width="0px" height="0px" >
                        <linearGradient id="lgrad" x1="50%" y1="0%" x2="50%" y2="100%" > 
                            <stop offset="0%" style="stop-color:rgb(116,46,185);stop-opacity:1" />
                            <stop offset="49%" style="stop-color:rgb(199,54,95);stop-opacity:1" />
                            <stop offset="99%" style="stop-color:rgb(221,137,73);stop-opacity:1" />
                            <stop offset="100%" style="stop-color:rgb(221,137,73);stop-opacity:1" />
                        </linearGradient> 
                    </svg>
                    
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        data() {
            return {
                links:[]
            }
        },
        mounted() {
            axios.get('/api/social_links').then((response) => {
                this.links=response.data;
            });
        },
    }
</script>

<style lang="scss" scoped>
    @media (max-width: 321px) {
        img.logo{
            height:50px;
        }   
    }
    @media (min-width: 322px) {
        img.logo{
            height:55px;
        }   
    }
    @media (min-width: 577px) {
        img.logo{
            height:100px;
        }   
    }

    
    a{
        text-decoration: none;
        color:inherit;
    }
    .icons li{
        margin-right:10px;
        list-style: none;
        display: inline-block;
        
    }

    li.facebook{
        color:rgb(61, 102, 168);
    }

    li.youtube{
        color: rgb(97%, 0%, 9%);
    }

    li.instagram{
        
    }

    div.ml-auto li.instagram svg *{
        fill: url(#lgrad);
    }
    
    .nav-link{
        font-size: 24px;
    }
</style>
