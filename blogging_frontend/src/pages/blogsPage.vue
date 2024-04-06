<template>
    <div class="ArticlePreview-container">
        <h5 class="articleHeader" id="letest-post">Latest Post</h5>
        <div class="articlePreviews">
            <ArticlePostsVue @click="pinia_state.action(blog.post)" class="article" v-for="blog in fetchedData.data" :key="blog.id" :title="blog.title" :imgUrl="blog.featuredImage"/>
        </div>
    </div>

    <!-- place QPageScroller at end of page -->
    <q-page-scroller position="bottom-right" :scroll-offset="150" :offset="[18, 18]">
        <q-btn fab icon="keyboard_arrow_up" color="accent" />
    </q-page-scroller>

    <div class="q-pa-lg flex flex-center">
        <q-pagination
        v-model="current"
        color="black"
        :max="max"
        :max-pages="6"
        :boundary-numbers="false"
        @click="nextPage(current)"
        />
  </div>
</template>

<script setup>
import ArticlePostsVue from "src/components/ArticlePosts.vue";
import { onMounted, ref } from "vue";
import { blogsStorage } from "src/stores/BlogStorage";
const pinia_state= blogsStorage();
const fetchedData= ref('');
const current=ref(0);
const max=ref(0);

onMounted(async()=>{
fetchedData.value= await pinia_state.blogFetcher(pinia_state.page+1, 15);
current.value=fetchedData.value.current_page;
max.value= fetchedData.value.last_page;
})

async function nextPage(page){
    fetchedData.value= await pinia_state.blogFetcher(page, 15);
}
</script>

<style>
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

.articleHeader{
    margin-left: 2.4vw;
    margin-bottom: 0.3vw;
    margin-top: 6vw;
    font-weight: bolder;
}


@media(max-width: 600px) {

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