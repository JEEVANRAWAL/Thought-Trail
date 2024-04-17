import { defineStore } from "pinia";
import { reactive, ref } from "vue";

export const blogsStorage= defineStore('blogStore',()=>{
    const fullBlog= ref('');
    const page= ref(1);
    const logedIn_userData= ref('');


    const blogFetcher= async (page, rowsPerPage)=>{
        try{
            const response= await fetch(`http://127.0.0.1:8000/api/fetchBlogs?page=${page}&rowsPerPage=${rowsPerPage}`);
            const data = await response.json();
            return data;
        }catch(error){
            console.error("error occures during fetching Blogs", error);
        }
    };

    async function checkUserAuthentication(){
        try{
            const response = await fetch('http://127.0.0.1:8000/api/getUser', {
                credentials: 'include'
            });
            const data = await response.json();
            // console.log(data.user.id);
            logedIn_userData.value= data.user;
            
        }catch(error){
            console.error("error occures during retriving user.", error.message);
        }
    }

    function action(data){
        fullBlog.value= data;
    }

    return{ fullBlog, page, logedIn_userData, blogFetcher, action,  checkUserAuthentication}
})