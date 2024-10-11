<script setup>
import { reactive, watch } from 'vue';
import usePostTask from '../executable/posttask';

const { storeTask, errors,successMessage } = usePostTask();

const form = reactive({
  title: '',
  slug: '',
  description: ''
});

watch(() => form.title,
    (newTitle) => {
      form.slug = generateSlug(newTitle);
    }
);

const generateSlug = (title) => {
  return title.toLowerCase()
      .trim()
      .replace(/[^a-z0-9 -]/g, '') // Remove special characters
      .replace(/ +/g, '-') // Replace spaces with hyphens
      .replace(/--+/g, '-') // Replace multiple hyphens with a single one
      .replace(/^-|-$/g, ''); // Trim hyphens from start and end
};
</script>
<template>
  <div id="create-task">
    <h2>Create Task Here</h2>
    <form @submit.prevent="storeTask(form)">
      <div class="form-group">
        <label for="title">Title</label>
        <input
            type="text"
            name="title"
            id="title"
            v-model="form.title"
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
            v-model="form.slug"
            class="input-field"
            readonly
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
            v-model="form.description"
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

      <div v-if="successMessage" class="success-message">
        {{ successMessage.message }}
      </div>
    </form>
  </div>
</template>

<style scoped>
#create-task {
  max-width: 600px; /* Set a max width for the form */
  margin: 0 auto; /* Center the form */
  padding: 20px; /* Padding for spacing */
  background: var(--color-background-soft);
  border-radius: 8px;
  box-shadow: 0 2px 4px var(--color-border-hover);
  width: 190%;
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

.success-message {
  color: green; /* Success message styling */
  margin-top: 20px; /* Space above the success message */
  text-align: center; /* Center the success message */
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
