<script setup>
import {onMounted,reactive} from "vue";
import usePostTask from "../executable/posttask";

const { post,getPost,storePostComment, deletePost, errors } = usePostTask();

const props = defineProps({
  id:{
    required:true,
    type:String,
  },
});
const form = reactive({
  comment:'',
  post_id:props.id
});

onMounted(()=>{getPost(props.id)});
</script>

<template>
  <br>
  <div v-if="errors.message == 'Unable to locate the post data you requested.'">
    <span style="color:red">NO Data</span>
  </div>
  <div v-else>
    <div>
      <RouterLink :to="{name:'editpost', params:{id: post.id }}">Edit This Post</RouterLink>
      <button @click="deletePost(post.id)">Delete</button>
    </div>
    <br>
    <div class="">
      <div>
        <h2>{{post.title}}</h2>
        <h5>{{post.slug}}</h5>
        <p>{{post.description}}</p>
      </div>
      <br>
      <span>COMMENTS SECTION</span>
      <div>
        <p v-for="ct in post.get_comment" :key="ct.id"><span>{{ct.comment}}</span></p>
      </div>
    </div>
    <br>
    <br>
    <div style="margin-top: 10px">
      <form @submit.prevent="storePostComment(form)">
        <div>
          <label for="comment">Comment Form</label>
          <input type="text" name="comment" id="comment" v-model="form.comment">
          <div v-if="errors.comment">
            <span style="color:red">{{ errors.comment[0] }}</span>
          </div>
        </div>
        <div>
          <button type="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</template>