<script setup>
import {onMounted,reactive} from "vue";
import usePostTask from "../executable/posttask";

const { task,getTask,storeComment, deleteTask, errors } = usePostTask();

const props = defineProps({
  id:{
    required:true,
    type:String,
  },
});
const form = reactive({
  comment:'',
  task_id:props.id
});

onMounted(()=>{getTask(props.id)});
</script>

<template>
  <br>
  <div>
    <RouterLink :to="{name:'edittask', params:{id: task.id }}">Edit This Task</RouterLink>
    <button @click="deleteTask(task.id)">Delete</button>
  </div>
  <br>
  <div >
    <div>
      <h2>{{task.title}}</h2>
      <h5>{{task.slug}}</h5>
      <p>{{task.description}}</p>
    </div>
    <br>
    <span>COMMENTS SECTION</span>
    <div>
      <p v-for="ct in task.get_comment" :key="ct.id"><span>{{ct.comment}}</span></p>
    </div>
  </div>
  <br>
  <br>
  <div style="margin-top: 10px">
    <form @submit.prevent="storeComment(form)">
      <div>
        <label for="comment">Comment Form</label>
        <input type="text" name="comment" id="comment" v-model="form.comment">
        <div v-if="errors.comment">
          <span style="color:red">{{ errors.comment[0] }}</span>
        </div>
      </div>
      <div>
        <button type="submit">Store</button>
      </div>
    </form>
  </div>
</template>