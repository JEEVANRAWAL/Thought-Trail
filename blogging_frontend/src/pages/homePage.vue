<template>
    <q-page-container style="padding-top:30px ; padding-bottom: 20px;">
        <q-page padding>
            <div clickable v-if="fetchedData.data" @click="pinia_state.action(fetchedData.data[0].post)" class="mainCard_container cursor-pointer">
                <router-link to="/singlePost">
                    <q-card
                        class="my-card text-white"
                        style="background: radial-gradient(circle, #35a2ff 0%, #014a88 100%)"
                    >
                        <img :src="fetchedData.data[0].featuredImage" alt="image">
                        <div class="card-section">
                            <q-card-section class="details"> 
                                <div class="topic"><span>Technology</span></div>
                                <h5 class="title">{{ fetchedData.data[0].title }}</h5>
                            </q-card-section>
                        </div>
                    </q-card>
                </router-link>
            </div>

            <div class="ArticlePreview-container">
                <h5 class="articleHeader" id="letest-post">Latest Post</h5>
                <div class="articlePreviews">
                    <ArticlePostsVue @click="pinia_state.action(blog.post)" class="article" v-for="blog in fetchedData.data" :key="blog.id" :title="blog.title" :imgUrl="blog.featuredImage" />
                </div>
            </div>

            <div class="readMore-wrapper cursor-pointer">
                <router-link to="/blogs">
                    <div class="readmore"><span class="material-symbols-outlined">keyboard_tab</span><span class="seeMore">See more..</span></div>
                </router-link>
            </div>


          <!-- place QPageScroller at end of page -->
          <q-page-scroller position="bottom-right" :scroll-offset="150" :offset="[18, 18]">
            <q-btn fab icon="keyboard_arrow_up" color="accent" />
          </q-page-scroller>
        </q-page>
    </q-page-container>
</template>

<script setup>
import ArticlePostsVue from "src/components/ArticlePosts.vue";
import { onMounted, ref } from "vue";
import {blogsStorage} from 'src/stores/BlogStorage';

const fetchedData=ref('');

const pinia_state= blogsStorage();

onMounted(async ()=>{
    const page= pinia_state.page;
    fetchedData.value= await pinia_state.blogFetcher(page, 9);
});
 

// function Readmore(){
//     page.value= page.value + 1;
// }
</script>

<style scoped>
.mainCard_container{
    margin: auto;
    width: 65vw;
    height: 29vw;
}
.my-card {
    border-radius: 12px;
    height: 100%;
}

.my-card img{
    height: 100%;
    border-radius: 12px;
}

.card-section{
    position: absolute;
    top: 74%;
    left: 4%;
    background-color: #ffff;
    width: 41%;
    height: 35%;
    border-radius: 10px !important;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.details .topic{
    display: block;
    background-color: rgb(37, 37, 182);
    border-radius: 5px;
    color: #ffff;
    padding: 0.5vw;
    font-size: 0.8vw;
    width: 5.5vw;
}

.title{
    color: black;
    margin-top: 0.5vw;
    font-size: 1.5vw;
    font-weight: bolder;
    line-height: 1.5vw;
}

.details{
    display: inline-block;
    padding: 1vw;
    height: 100%;
    width: 100%;
}

.ArticlePreview-container{
    width: 70vw;
    margin: auto;
}

.articlePreviews{
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    padding: 5px;
}

.articlePreviews .article{
    margin-bottom: 45px;
}

.articleHeader{
    margin-left: 2.4vw;
    margin-bottom: 0.3vw;
    margin-top: 6vw;
    font-weight: bolder;
}

.readMore-wrapper{
    display: block;
    width: 130px;
    margin: auto;
}

.readMore-wrapper .readmore{
    display: inline-block;
    padding: 15px;
    margin-top: 30px;
    border-radius: 5px;
    background-color: #ffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.readMore-wrapper .seeMore{
    margin-left: 8px;
}


@media(max-width: 600px) {

.mainCard_container{
    width: 90vw;
    height: 48vw;
}

.details .topic{
    display: inline;
    padding: 0.8vw;
    font-size: 1.9vw;
}

.title{
    
    font-size: 2.2vw;
    line-height: 2.5vw;
}

.ArticlePreview-container{
    width: 90vw;
    
}
.articlePreviews{
    padding: 0px;
}

.articlePreviews .article{
    width: 100%;
    padding: 0;
    margin-bottom: 17px;
}

.ArticlePreview-container .articleHeader{
    margin-top: 18vw;
    font-size: 6vw;
    margin-bottom: 5px;
}


}

</style>