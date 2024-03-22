import { defineStore } from "pinia";
import { ref } from "vue";

export const blogsStorage= defineStore('blogStore',()=>{
    const blog= ref([]);

    function appendBlog(data){
        // console.log(data);
        blog.value.push(data);
    }

    return{ blog, appendBlog}
})