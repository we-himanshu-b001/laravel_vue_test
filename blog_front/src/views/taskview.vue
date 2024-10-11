<script setup>
import usePostTask from "../executable/posttask";
import {onMounted} from "vue";

const {tasks,getTasks} = usePostTask();
onMounted(()=>{getTasks()});

</script>
<template>
  <div id="tasks-section">
    <h1 class="section-title">Tasks Section</h1>

    <div class="new-task-button">
      <RouterLink :to="{ name: 'taskcreate' }" class="btn btn-primary">New Task</RouterLink>
    </div>

    <div class="task-list">
      <div v-for="task in tasks" :key="task.id" class="task-card">
        <h2 class="task-title">{{ task.title }}</h2>
        <h5 class="task-slug">{{ task.slug }}</h5>
        <p class="task-description">{{ task.description }}</p>
        <p class="task-comment-count">Comment Count: {{ task.get_comment_count }}</p>
        <RouterLink :to="{ name: 'singletask', params: { id: task.id } }" class="btn btn-secondary">View</RouterLink>
      </div>
    </div>
  </div>
</template>

<style scoped>
#tasks-section {
  max-width: 800px; /* Set a max width for the tasks section */
  margin: 0 auto; /* Center the section */
  padding: 30px; /* Add padding */
  background: var(--color-background-soft);
  border-radius: 8px;
  box-shadow: 0 2px 4px var(--color-border-hover);
}

.section-title {
  text-align: center; /* Center the title */
  color: var(--color-heading);
  margin-bottom: 20px; /* Space below the title */
}

.new-task-button {
  display: flex;
  justify-content: center; /* Center the button */
  margin-bottom: 20px;
}

.task-list {
  display: grid;
  gap: 15px; /* Space between task cards */
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Responsive grid */
}

.task-card {
  background: var(--color-background);
  border: 1px solid var(--color-border);
  border-radius: 8px;
  padding: 15px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.3s ease;
  word-wrap: break-word;
}

.task-card:hover {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.task-title {
  font-size: 1.25rem; /* Title size */
  color: var(--color-heading);
  margin-bottom: 5px;
}

.task-slug {
  color: var(--color-text);
  margin-bottom: 10px;
}

.task-description {
  margin-bottom: 10px;
  -webkit-box-orient: vertical;
  display: -webkit-box;
  -webkit-line-clamp: 5;
  overflow: hidden;
}

.task-comment-count {
  margin-bottom: 10px;
  color: var(--vt-c-text-light-2);
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
}

.btn-secondary {
  background-color: var(--color-border);
  /*color: var(--vt-c-indigo);*/
}

.btn-secondary:hover {
  background-color: var(--color-border-hover);
}
</style>