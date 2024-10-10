<script setup>
import usePostTask from "../executable/posttask";
import {onMounted} from "vue";

const {posts,getPosts} = usePostTask();
onMounted(()=>{getPosts()});

</script>
<template>
  <br>
  <div>
    <h1>POSTS SECTION</h1>
  </div>
  <br>
  <div>
    <RouterLink :to="{name:'postcreate'}">New Post</RouterLink>
  </div>
  <br>
  <div class="">
    <div v-for="post of posts" :key="post.id" style="padding-top: 10px">
      <h2>{{post.title}}</h2>
      <h5>{{post.slug}}</h5>
      <p>{{post.description}}</p>
      <p>Comment Count:{{post.get_comment_count}}</p>
      <RouterLink :to="{name:'singlepost', params:{id: post.id }}">View</RouterLink>
    </div>
  </div>
</template>