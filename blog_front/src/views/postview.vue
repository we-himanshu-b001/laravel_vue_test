<script setup>
import usePostTask from "../executable/posttask";
import {onMounted} from "vue";

const {posts,getPosts} = usePostTask();
onMounted(()=>{getPosts()});

</script>
<template>
  <div id="app">
    <h1 class="section-title" aria-live="polite">Posts Section</h1>

    <div class="new-post-button">
      <RouterLink
          :to="{ name: 'postcreate' }"
          class="btn btn-primary"
          aria-label="Create a new post"
      >
        New Post
      </RouterLink>
    </div>

    <div class="post-list">
      <div
          v-for="post of posts"
          :key="post.id"
          class="post-card"
          role="article"
      >
        <h2 class="post-title">{{ post.title }}</h2>
        <h5 class="post-slug">{{ post.slug }}</h5>
        <p class="post-description">{{ post.description }}</p>
        <p class="post-comment-count">Comment Count: {{ post.get_comment_count }}</p>
        <RouterLink
            :to="{ name: 'singlepost', params: { id: post.id } }"
            class="btn btn-secondary"
            aria-label="View post {{ post.title }}"
        >
          View
        </RouterLink>
      </div>
    </div>
  </div>
</template>

<style scoped>
#app {
  background: var(--color-background-soft);
  color: var(--color-text);
  border-radius: 8px;
  box-shadow: 0 2px 4px var(--color-border-hover);
  padding: 20px;
  max-width: 900px;
  margin: 0 auto;
}

.section-title {
  color: var(--color-heading);
  font-size: 2rem;
  margin-bottom: 1.5rem;
  text-align: center;
}

.new-post-button {
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
}

.btn {
  padding: 12px 20px;
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

.btn-secondary:hover {
  background-color: var(--color-border-hover);
  transform: translateY(-2px);
}

.post-list {
  display: grid;
  gap: 20px;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
}

.post-card {
  background: var(--color-background);
  border: 1px solid var(--color-border);
  border-radius: 8px;
  padding: 15px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.3s ease;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  width:190%;
}

.post-card:hover {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.post-title {
  font-size: 1.5rem;
  margin: 0; /* Remove margin for better layout */
  color: var(--color-heading);
}

.post-slug {
  color: var(--color-text);
  margin: 5px 0;
}

.post-description {
  margin: 10px 0;
  line-height: 1.5;
  flex-grow: 1; /* Allow description to take available space */
}

.post-comment-count {
  margin: 10px 0;
  color: var(--vt-c-text-light-2);
}


/* Responsive Design */
@media (max-width: 768px) {
  .new-post-button {
    margin-bottom: 10px;
  }

  .btn {
    width: 100%;
    text-align: center;
  }

  .post-card {
    padding: 10px;
    width:100%;
  }
}

a{
  text-align: center;
}
</style>