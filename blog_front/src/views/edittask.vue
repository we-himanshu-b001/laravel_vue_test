<script setup>
import {onMounted} from "vue";
import usePostTask from "../executable/posttask";

const { task,getTask,updateTask,errors } = usePostTask();

const props = defineProps({
  id:{
    required:true,
    type:String,
  },
});
onMounted(()=>getTask(props.id));
</script>
<template>
  <div id="edit-task">
    <h2>Edit Task</h2>
    <form @submit.prevent="updateTask($route.params.id)">
      <div class="form-group">
        <label for="title">Title</label>
        <input
            type="text"
            name="title"
            id="title"
            v-model="task.title"
            class="input-field"
            placeholder="Enter task title"
        />
        <div v-if="errors.title">
          <span class="error-message">{{ errors.title[0] }}</span>
        </div>
      </div>

      <div class="form-group">
        <label for="slug">Slug</label>
        <input
            type="text"
            name="slug"
            id="slug"
            v-model="task.slug"
            class="input-field"
            placeholder="Enter task slug"
        />
        <div v-if="errors.slug">
          <span class="error-message">{{ errors.slug[0] }}</span>
        </div>
      </div>

      <div class="form-group">
        <label for="description">Content</label>
        <textarea
            name="description"
            id="description"
            v-model="task.description"
            class="input-field"
            placeholder="Enter task description"
            rows="5"
        ></textarea>
        <div v-if="errors.description">
          <span class="error-message">{{ errors.description[0] }}</span>
        </div>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</template>

<style scoped>
#edit-task {
  max-width: 800px; /* Set a max width for the edit task form */
  margin: 0 auto; /* Center the component */
  padding: 30px; /* Padding for spacing */
  background: var(--color-background-soft);
  border-radius: 8px;
  box-shadow: 0 2px 4px var(--color-border-hover);
  width:190%;
}

h2 {
  text-align: center; /* Center the heading */
  color: var(--color-heading);
  margin-bottom: 20px; /* Space below the title */
}

.form-group {
  margin-bottom: 20px; /* Space between form groups */
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

.form-actions {
  text-align: center; /* Center the submit button */
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
</style>