<script setup>
import {onMounted} from "vue";
import usePostTask from "../executable/posttask";

const { task,getTask,updateTask } = usePostTask();

const props = defineProps({
  id:{
    required:true,
    type:String,
  },
});
onMounted(()=>getTask(props.id));
</script>
<template>
  <br>
  <p>Edit Section</p>
  <br>
  <div>
    <form @submit.prevent="updateTask($route.params.id)">
      <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" v-model="task.title"><br>
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" v-model="task.slug"><br>
        <label for="description">Content</label>
        <input type="text" name="description" id="description" v-model="task.description"><br>
      </div>
      <div>
        <button type="submit">Store</button>
      </div>
    </form>
  </div>
</template>