<script setup>
import { reactive, watch } from 'vue';
import usePostTask from '../executable/posttask';

const { storePost, errors } = usePostTask();

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
  <div id="create-post">
    <h2>Create Post Here</h2>
    <form @submit.prevent="storePost(form)">
      <div class="form-group">
        <label for="title">Title</label>
        <input
            type="text"
            name="title"
            id="title"
            v-model="form.title"
            class="input-field"
            placeholder="Enter the title"
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
            placeholder="Slug will auto-generate"
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
            placeholder="Enter the content"
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
#create-post {
  width:190%;
  max-width: 800px; /* Set a max width for the create post form */
  margin: 0 auto; /* Center the component */
  padding: 30px; /* Padding for spacing */
  background: var(--color-background-soft);
  border-radius: 8px;
  box-shadow: 0 2px 4px var(--color-border-hover);
}

h2 {
  text-align: center; /* Center the heading */
  color: var(--color-heading);
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
