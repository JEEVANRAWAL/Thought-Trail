<template>
  <div class="ArticlePreview-card">
    <router-link class="link" to="/singlePost">
      <q-card clickable bordered class="Article-card my-font3 cursor-pointer">
          <div class="imageBox">
            <img :src="imgUrl" alt="image">
          </div>
          <q-card-section class="card-section">
              <div class="topic"><span>technology</span></div>
              <h5 class="title">{{ title }}</h5>
              <div class="articlePublishDetail-Wrapper">
                  <q-avatar class="publisherProfile-icon"><img src="src/assets/images/profile_images/jeevan.jpg" alt=""></q-avatar>
                  <div class="publisher-name"><span>{{ publisher }}</span></div>
                  <div class="published-date">{{ blogPublishedDate }}</div>
              </div>
          </q-card-section>
      </q-card>
    </router-link>
  </div>
</template>

<script setup>
import { defineProps, ref } from 'vue';

const blogPublishedDate=ref('');
const props= defineProps(['title', 'imgUrl', 'publishedDateTime', 'publisher']);
const dateTimeString=ref(props.publishedDateTime);

function extractDate() {
    // Create a new Date object with the given date and time string
    var dateTime = new Date(dateTimeString.value);

    // Extract the date components
    var year = dateTime.getFullYear();
    var month = dateTime.getMonth() + 1; // Note: January is 0, so we add 1
    var day = dateTime.getDate();

    // Return the date components as a formatted string
    return year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}

blogPublishedDate.value= extractDate()
</script>

<style scoped>
.ArticlePreview-card{
  width: 22vw;
  padding: 12px;
  margin-left: 1vw;
}

.ArticlePreview-card .link{
  text-decoration: none;
}

.Article-card{
  border-radius: 12px;
  padding: 15px;
  box-shadow: none;
}

.Article-card .imageBox{
  width: 100%;
  height: 250px;
  border-radius: 9px;
}

.imageBox img{
  width: 100%;
  height: 100%;
  border-radius: 9px;
  object-fit: cover;
}

.card-section{
  padding: 25px 0px 0px 0px;
}

.card-section .topic{
    display: inline-block;
    background-color: #4B6BFB;
    border-radius: 5px;
    color: #ffff;
    padding: 0.5vw;
    font-size: 0.8vw;
    opacity: 0.8;
}

.card-section .title{
    color: black;
    margin-top: 1vw;
    font-size: 1.1vw;
    font-weight: bolder;
    line-height: 1.7vw;
    margin-bottom: 0px;
}

.card-section .articlePublishDetail-Wrapper{
  display: flex;
  flex-direction: row;
  width: 85%;
  /* justify-content: space-between; */
  align-items: center;
  margin-top: 25px;
  font-family: italic;
}

.publisher-name{
  margin-left: 13px;
  margin-right: 30px;
}

@media(max-width: 600px){
  .card-section .topic{
    padding: 0.8vw;
    font-size: 2.3vw;
}

.card-section .title{
    font-size: 3vw;
    line-height: 3.5vw;
    margin-top: 10px;
}

}

</style>