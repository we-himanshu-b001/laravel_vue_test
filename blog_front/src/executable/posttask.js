import {ref} from 'vue';
import axios from 'axios';
import {useRouter,useRoute} from "vue-router";

export default function usePostTask(){
    const posts = ref([]);
    const post =ref([]);
    const router = useRouter();
    // const route = useRoute();
    // const rid = route.params.id;
    const errors = ref([]);

    const getPosts = async ()=>{
        const response = await axios.get('http://127.0.0.1:2000/api/post');
        posts.value=response.data;
    }

    const getPost = async (id)=>{
        const response = await axios.get('http://127.0.0.1:2000/api/post/'+id);
        post.value=response.data;
    }

    const storePost = async(data)=>{
        await axios.post('http://127.0.0.1:2000/api/post',data);
        await router.push({name:"postindex"});
    }

    const updatePost = async(id)=>{
        try{
            await axios.put('http://127.0.0.1:2000/api/post/'+id,post.value);
            await router.push({name:"singlepost",params:{id:id}});
        }catch(error){
            if(error.response.status === 422){
                console.log(error.response.data.errors);
                errors.value=error.response.data.errors;
            }
        }
    }

    const deletePost = async (id)=>{
        await axios.delete('http://127.0.0.1:2000/api/post/'+id);
        await router.push({name:"postindex"});
    }

    const storeComment = async(data)=>{
        await axios.post('http://127.0.0.1:2000/api/comment/add',data);
        // await router.push({name:"singlepost",params:{id:rid}});
        router.go(0);
    }

    return {
        post,
        posts,
        getPosts,
        getPost,
        storePost,
        updatePost,
        deletePost,
        storeComment
    };
}