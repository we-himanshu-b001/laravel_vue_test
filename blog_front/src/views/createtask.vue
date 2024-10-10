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
  <br>
  <h2>Create Task Here</h2><br>
  <div>
    <form @submit.prevent="storeTask(form)">
      <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" v-model="form.title"><br>
        <div v-if="errors.title">
          <span style="color:red">{{ errors.title[0] }}</span>
        </div>
        <br>
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" v-model="form.slug" readonly><br>
        <div v-if="errors.slug">
          <span style="color:red">{{ errors.slug[0] }}</span>
        </div>
        <br>
        <label for="description">Content</label>
        <input type="text" name="description" id="description" v-model="form.description"><br>
        <div v-if="errors.description">
          <span style="color:red">{{ errors.description[0] }}</span>
        </div>
      </div>
      <div>
        <button type="submit">Submit</button>
      </div>

      <div v-if="successMessage" style="color:green">
        {{ successMessage.message }}
      </div>
    </form>
  </div>
</template>
