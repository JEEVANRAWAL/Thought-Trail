<template>
    <q-page-container class="pageContainer" style="padding-top:30px ; padding-bottom: 20px;">
        <q-page padding>
            <div class="input-div">
                <q-input outlined  v-model="data.title" label="Title" class="input-field"/>
            </div>
            <div class="input-div">
                <q-file v-model="data.featuredImage" hint="Choose Feature Image">
                    <template v-slot:prepend>
                    <span class="material-symbols-outlined">image</span>
                    </template>
                </q-file>
            </div>
            <EditorWYSIWYGComponent v-model="data.post" @update:model-value="CalculateCurrentUsedImgs" @ImageUrl="calculateUsedImage"/> <!-- This was an emit @ImageUrl="calculateUsedImage" -->
            <div class="input-div">
                <q-input outlined  v-model="data.metaDescription" type="textarea" label="Meta Description" class="input-field"/>
            </div>
            <div class="input-div">
                <q-input outlined  v-model="data.post_excerpt" type="textarea" label="Post Excerpt" class="input-field"/>
            </div>
            <buttonComponent label="Publish" icon="publish" @click="insertdata(data)" :disable="isEditorDataEmpty"/>
        </q-page>
    </q-page-container>
</template>

<script setup>
import EditorWYSIWYGComponent from 'src/components/Editor-WYSIWYG-Component.vue';
import buttonComponent from 'src/components/button-component.vue';
import { computed, ref } from 'vue';
import {blogsStorage} from 'src/stores/BlogStorage';
import axios from 'axios';

const imgUrls=ref([]);
const insertedImages= ref([]);

const data= ref({
    title: '',
    post: '',
    featuredImage: null,
    metaDescription: '',
    post_excerpt: '',
    usedImages: imgUrls.value,
    insertedImgs: insertedImages.value
});


const isEditorDataEmpty = computed(() => {
    return !data.value.post || data.value.post.length === 0;
});



function CalculateCurrentUsedImgs(data){

    //clearing array
    if(imgUrls.value.length > 0){
        imgUrls.value.splice(0, imgUrls.value.length);
    }
  
 

    // Convert the data (HTML string) into a DOM element
    var tempElement = document.createElement('div');
    tempElement.innerHTML = data;

    // Find all img tags inside the tempElement
    var imgElements = tempElement.querySelectorAll('img');

    // Check if imgElements are found
    if (imgElements.length > 0) {
    // Loop through all img elements and print them
    imgElements.forEach(function(imgElement) {
        var imgUrl= imgElement.getAttribute('src');
        imgUrls.value.push(imgUrl);
    });
}
//console.log(imgUrls.value);
}


function calculateUsedImage(imageUrl){
    let newImgUrl= imageUrl;
    let count= insertedImages.value.length;
    let isUnique= true;
    if(count !== 0){

        for(var i=0; i<count; i++){
            if(insertedImages.value[i] === newImgUrl){
                isUnique= false;
                break;
            }
        }

        if(isUnique){
            insertedImages.value.push(newImgUrl);
        }

        
    } else{
        insertedImages.value.push(newImgUrl);
    }

   //console.log(insertedImages.value);
}


function insertdata(SubmittedData){
    // console.log("data"+SubmittedData);
    const config= {headers:{'Content-Type': 'multipart/form-data'}};
    const data= new FormData();
    data.append('title', SubmittedData.title);
            data.append('post', SubmittedData.post);
            data.append('metaDescription', SubmittedData.metaDescription);
            data.append('post_excerpt', SubmittedData.post_excerpt);
            data.append('featuredImage', SubmittedData.featuredImage);
            
            SubmittedData.usedImages.forEach(image => {
                data.append('usedImages[]', image);
            });
            SubmittedData.insertedImgs.forEach(image => {
                data.append('insertedImgs[]', image);
            });
  
      axios.post('http://127.0.0.1:8000/api/postBlog', data, config).then((response)=>{
          console.log(response);
      }).catch(e=>{
    console.log(e);
  });


  //clearing insertedImages array after submission of blog post. By reassigning it to a new empty array. BUt some time this reassigning approach have chances to get some error/conflict.
  insertedImages.value=[];  //that's way there is splice method in javascript to delete or remove the value of array in js. which is considered a good approach than reassigning approach which i have used in above code

}


</script>

<style scoped>
.pageContainer{
    width: 70vw;
    margin: auto;
}

.pageContainer .input-div{
    display: block;
    margin-bottom: 20px;
    margin-top: 10px;
 
}

@media(max-width: 600px) {

    .pageContainer{
    width: 100vw;
}
}
</style>