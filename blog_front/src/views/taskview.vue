<script setup>
import usePostTask from "../executable/posttask";
import {onMounted} from "vue";

const {tasks,getTasks} = usePostTask();
onMounted(()=>{getTasks()});

</script>
<template>
  <br>
  <div>
    <h1>TASKS SECTION</h1>
  </div>
  <br>
  <div>
    <RouterLink :to="{name:'taskcreate'}">New Task</RouterLink>
  </div>
  <br>
  <div class="">
    <div v-for="task of tasks" :key="task.id" style="padding-top: 10px">
      <h2>{{task.title}}</h2>
      <h5>{{task.slug}}</h5>
      <p>{{task.description}}</p>
      <p>Comment Count:{{task.get_comment_count}}</p>
      <RouterLink :to="{name:'singletask', params:{id: task.id }}">View</RouterLink>
    </div>
  </div>
</template>