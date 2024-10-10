<script setup>
import {onMounted} from "vue";
import usePostTask from "../executable/posttask";

const { post,getPost,updatePost } = usePostTask();

const props = defineProps({
  id:{
    required:true,
    type:String,
  },
});
onMounted(()=>getPost(props.id));
</script>
<template>
  <br>
  <p>Edit Section</p>
  <br>
  <div>
    <form @submit.prevent="updatePost($route.params.id)">
      <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" v-model="post.title"><br>
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" v-model="post.slug"><br>
        <label for="description">Content</label>
        <input type="text" name="description" id="description" v-model="post.description"><br>
      </div>
      <div>
        <button type="submit">Store</button>
      </div>
    </form>
  </div>
</template>