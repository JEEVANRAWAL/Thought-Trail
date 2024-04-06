import { defineStore } from "pinia";
import { ref } from "vue";

export const blogsStorage= defineStore('blogStore',()=>{
    const fullBlog= ref('');
    const page= ref(1);


    const blogFetcher= async (page, rowsPerPage)=>{
        try{
            const response= await fetch(`http://127.0.0.1:8000/api/fetchBlogs?page=${page}&rowsPerPage=${rowsPerPage}`);
            const data = await response.json();
            return data;
        }catch(error){
            console.error("error occures during fetching Blogs", error);
        }
    };

    function action(data){
        fullBlog.value= data;
    }

    return{ fullBlog, page, blogFetcher, action}
})