<script setup>
import {onMounted,reactive} from "vue";
import usePostTask from "../executable/posttask";

const { post,getPost,storeComment } = usePostTask();

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
  <div>
    <form @submit.prevent="storeComment(form)">
      <div>
        <label for="comment">Comment Form</label>
        <input type="text" name="comment" id="comment" v-model="form.comment">
      </div>
      <div>
        <button type="submit">Store</button>
      </div>
    </form>
  </div>
</template>