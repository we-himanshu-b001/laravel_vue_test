<script setup>
import { reactive, watch } from 'vue';
import usePostTask from '../executable/posttask';

const { storePost } = usePostTask();

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
  <br>
  <h2>Create post Here</h2><br>
  <div>
    <form @submit.prevent="storePost(form)">
      <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" v-model="form.title"><br>
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" v-model="form.slug" readonly><br>
        <label for="description">Content</label>
        <input type="text" name="description" id="description" v-model="form.description"><br>
      </div>
      <div>
        <button type="submit">Store</button>
      </div>
    </form>
  </div>
</template>
