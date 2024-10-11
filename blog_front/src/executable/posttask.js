import {ref} from 'vue';
import axios from 'axios';
import {useRouter,useRoute} from "vue-router";
import { toast } from 'vue3-toastify';

export default function usePostTask(){
    const posts = ref([]);
    const post =ref([]);
    const tasks = ref([]);
    const task =ref([]);
    const router = useRouter();
    // const route = useRoute();
    // const rid = route.params.id;
    const errors = ref({});
    const successMessage = ref('');

    const getPosts = async ()=>{
        const response = await axios.get('http://127.0.0.1:2000/api/post');
        posts.value=response.data;
    }

    const getPost = async (id)=>{
        try{
            const response = await axios.get('http://127.0.0.1:2000/api/post/'+id);
            // toast("Wow so easy!", {
            //     autoClose: 1000,
            // });
            post.value=response.data;
        }catch(error){
            if(error.response.status === 422){
                errors.value=error.response.data;
            }
            await router.push({name:"postindex"});
        }
    }

    const storePost = async(data)=>{
        try{
            await axios.post('http://127.0.0.1:2000/api/post',data);
            toast("Post Created Successfully!", {
                autoClose: 1000,
            });
            await router.push({name:"postindex"});
        }catch(error){
            if(error.response.status === 422){
                errors.value=error.response.data;
            }
        }
    }

    const updatePost = async(id)=>{
        try{
            await axios.put('http://127.0.0.1:2000/api/post/'+id,post.value);
            toast("Post Updated Successfully!", {
                autoClose: 1000,
            });
            await router.push({name:"singlepost",params:{id:id}});
        }catch(error){
            if(error.response.status === 422){
                errors.value=error.response.data;
            }
        }
    }

    const deletePost = async (id)=>{
        if(!window.confirm("Are you sure?")){
            return ;
        }
        await axios.delete('http://127.0.0.1:2000/api/post/'+id);
        toast("Post Deleted Successfully!", {
            autoClose: 1000,
        });
        await router.push({name:"postindex"});
    }

    const getTasks = async ()=>{
        const response = await axios.get('http://127.0.0.1:2000/api/task');
        tasks.value=response.data;
    }

    const getTask = async (id)=>{
        try{
            const response = await axios.get('http://127.0.0.1:2000/api/task/'+id);
            // toast.success("Task Posted Successfully!", {
            //     position: toast.POSITION.TOP_CENTER,
            // });
            task.value=response.data;
        }catch(error){
            if(error.response.status === 422){
                errors.value=error.response.data.errors;
            }
        }
    }

    const storeTask = async(data)=>{
        try{
            const response = await axios.post('http://127.0.0.1:2000/api/task',data);
            toast("Task Created Successfully!", {
                autoClose: 1000,
            });
            await router.push({name:"taskindex"});
        }catch(error){
            if(error.response.status === 422){
                errors.value=error.response.data;
            }
        }
    }

    const updateTask = async(id)=>{
        try{
            await axios.put('http://127.0.0.1:2000/api/task/'+id,task.value);
            toast("Task Updated Successfully!", {
                autoClose: 1000,
            });
            await router.push({name:"singletask",params:{id:id}});
        }catch(error){
            if(error.response.status === 422){
                errors.value=error.response.data;
            }
        }
    }

    const deleteTask = async (id)=>{
        if(!window.confirm("Are you sure?")){
            return ;
        }
        await axios.delete('http://127.0.0.1:2000/api/task/'+id);
        toast("Task Deleted Successfully!", {
            autoClose: 1000,
        });
        await router.push({name:"taskindex"});
    }

    const storePostComment = async(data)=>{

        try{
            await axios.post('http://127.0.0.1:2000/api/post/'+data.id+'/comment',data);
            toast("Comment added Successfully!", {
                autoClose: 1000,
            });
            await router.push({name:"singletask",params:{id:data.id}});
            // router.go(0);
        }catch(error){
            if(error.response.status === 422){
                errors.value=error.response.data.errors;
            }
        }
    }

    const storeTaskComment = async(data)=>{
        try{
            await axios.post('http://127.0.0.1:2000/api/task/'+data.id+'/comment',data);
            toast("Comment Added Successfully!", {
                autoClose: 1000,
            });
            // await router.push({name:"singletask",params:{id:rid}});
            router.go(0);
        }catch(error){
            if(error.response.status === 422){
                errors.value=error.response.data.errors;
            }
        }
    }

    return {
        post,
        posts,
        task,
        tasks,
        getPosts,
        getPost,
        storePost,
        updatePost,
        deletePost,
        getTasks,
        getTask,
        storeTask,
        updateTask,
        deleteTask,
        storePostComment,
        storeTaskComment,
        errors
    };
}