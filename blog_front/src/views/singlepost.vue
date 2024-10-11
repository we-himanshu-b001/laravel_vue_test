<script setup>
import {onMounted,reactive} from "vue";
import usePostTask from "../executable/posttask";

const { post,getPost,storePostComment, deletePost, errors } = usePostTask();

const props = defineProps({
  id:{
    required:true,
    type:String,
  },
});
const form = reactive({
  comment:'',
  post_id:props.id,
  id:props.id
});

onMounted(()=>{getPost(props.id)});
</script>

<template>
  <div v-if="errors.message">
    <span class="error-message">{{ errors.message }}</span>
  </div>
  <div id="post-detail">
    <div>
      <div class="post-actions">
        <RouterLink :to="{ name: 'editpost', params: { id: post.id } }" class="btn btn-secondary">Edit This Post</RouterLink>
        <button class="btn btn-danger" @click="deletePost(post.id)">Delete</button>
      </div>

      <div class="post-content">
        <h2 class="post-title">{{ post.title }}</h2>
        <h5 class="post-slug">{{ post.slug }}</h5>
        <p class="post-description">{{ post.description }}</p>
      </div>

      <hr>

      <h3>COMMENTS SECTION</h3>
      <div class="comments-list">
        <p v-for="ct in post.get_comment" :key="ct.id" class="comment-item">
          <span>{{ ct.comment }}</span>
        </p>
      </div>

      <div class="comment-form" style="margin-top: 20px;">
        <form @submit.prevent="storePostComment(form)">
          <div>
            <label for="comment">Comment Form</label>
            <input
                type="text"
                name="comment"
                id="comment"
                v-model="form.comment"
                class="input-field"
                placeholder="Write your comment here..."
            />
            <div v-if="errors.comment">
              <span style="color: red;">{{ errors.comment[0] }}</span>
            </div>
          </div>
          <div style="margin-top: 10px">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<style scoped>
#post-detail {
  max-width: 800px; /* Set a max width for the post detail */
  margin: 0 auto; /* Center the component */
  padding: 20px;
  background: var(--color-background-soft);
  border-radius: 8px;
  box-shadow: 0 2px 4px var(--color-border-hover);
}

.post-actions {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.btn {
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  text-decoration: none;
  transition: background-color 0.3s, transform 0.2s;
}

.btn-secondary {
  background-color: var(--color-border);
  /*color: var(--vt-c-indigo);*/
}

.btn-secondary:hover {
  background-color: var(--color-border-hover);
}

.btn-danger {
  background-color: hsla(0, 100%, 37%, 1);
  color: white;
}

.btn-danger:hover {
  background-color: hsla(0, 100%, 30%, 1);
}

.post-content {
  margin-bottom: 20px;
}

.post-title {
  font-size: 1.75rem;
  margin: 0;
  color: var(--color-heading);
}

.post-slug {
  color: var(--color-text);
  margin: 5px 0;
}

.post-description {
  margin: 10px 0;
  line-height: 1.5;
}

.comments-list {
  margin: 15px 0;
  padding: 10px;
  border: 1px solid var(--color-border);
  border-radius: 8px;
}

.comment-item {
  margin: 5px 0;
}

.comment-form {
  margin-top: 20px;
}

.input-field {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid var(--color-border);
  margin-top: 5px;
}

.input-field:focus {
  outline: none;
  border-color: var(--color-heading);
}

/* Responsive Design */
@media (max-width: 768px) {
  .post-actions {
    flex-direction: column;
    align-items: stretch;
  }

  .btn {
    width: 100%;
    margin-bottom: 10px;
  }
}
</style>