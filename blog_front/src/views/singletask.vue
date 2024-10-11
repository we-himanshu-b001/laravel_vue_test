<script setup>
import {onMounted,reactive} from "vue";
import usePostTask from "../executable/posttask";

const { task,getTask,storeTaskComment, deleteTask, errors } = usePostTask();

const props = defineProps({
  id:{
    required:true,
    type:String,
  },
});
const form = reactive({
  comment:'',
  task_id:props.id,
  id:props.id
});

onMounted(()=>{getTask(props.id)});
</script>
<template>

  <div id="task-details">
    <div class="task-actions">
      <RouterLink :to="{ name: 'edittask', params: { id: task.id } }" class="btn btn-secondary">Edit This Task</RouterLink>
      <button @click="deleteTask(task.id)" class="btn btn-danger">Delete</button>
    </div>

    <div class="task-content">
      <h2 class="task-title">{{ task.title }}</h2>
      <h5 class="task-slug">{{ task.slug }}</h5>
      <p class="task-description">{{ task.description }}</p>
    </div>

    <div class="comments-section">
      <h3>Comments</h3>
      <div v-if="task.get_comment">
        <p v-for="ct in task.get_comment" :key="ct.id" class="comment">{{ ct.comment }}</p>
      </div>
      <div v-else>
        <p>No comments yet.</p>
      </div>
    </div>

    <div class="comment-form">
      <form @submit.prevent="storeTaskComment(form)">
        <label for="comment">Add a Comment</label>
        <input
            type="text"
            name="comment"
            id="comment"
            v-model="form.comment"
            class="input-field"
            placeholder="Write your comment here"
        />
        <div v-if="errors.comment">
          <span class="error-message">{{ errors.comment[0] }}</span>
        </div>
        <div style="margin-top: 10px">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</template>

<style scoped>
#task-details {
  max-width: 800px; /* Max width for the task details section */
  margin: 0 auto; /* Center the section */
  padding: 30px; /* Padding for spacing */
  background: var(--color-background-soft);
  border-radius: 8px;
  box-shadow: 0 2px 4px var(--color-border-hover);
}

.task-actions {
  display: flex;
  justify-content: space-between; /* Space out the buttons */
  margin-bottom: 20px; /* Space below the action buttons */
}

.task-content {
  margin-bottom: 20px; /* Space below the task content */
}

.task-title {
  font-size: 1.5rem; /* Title size */
  color: var(--color-heading);
}

.task-slug {
  color: var(--color-text);
  margin-bottom: 10px;
}

.task-description {
  margin-bottom: 20px; /* Space below the description */
  word-wrap: break-word;
}

.comments-section {
  margin-bottom: 20px; /* Space below the comments section */
}

.comment {
  background: var(--color-background);
  padding: 10px;
  border-radius: 5px;
  margin-bottom: 10px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.comment-form {
  margin-top: 20px; /* Space above the comment form */
}

.input-field {
  width: 100%; /* Full width input */
  padding: 10px;
  border-radius: 5px;
  border: 1px solid var(--color-border);
  margin-top: 5px;
}

.input-field:focus {
  outline: none;
  border-color: var(--color-heading);
}

.error-message {
  color: red; /* Error message styling */
  font-size: 0.875rem; /* Slightly smaller font for error messages */
}

.btn {
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  text-decoration: none;
  transition: background-color 0.3s, transform 0.2s;
}

.btn-primary {
  background-color: hsla(160, 100%, 37%, 1);
  color: var(--vt-c-white);
}

.btn-primary:hover {
  background-color: hsla(160, 100%, 37%, 0.8);
  transform: translateY(-2px);
}

.btn-secondary {
  background-color: var(--color-border);
  /*color: var(--vt-c-indigo);*/
}

.btn-danger {
  background-color: red;
  color: white;
}

.btn-danger:hover {
  background-color: darkred;
}
</style>