<script setup>
import { onMounted } from 'vue';
import { usePosts } from '../composables/usePosts'
import { useStore } from '../stores/useStore';

const { posts, fetchPosts } = usePosts()

onMounted(fetchPosts);

const store = useStore()


</script>

<template>
  <main class="space-y-4">
    <div v-for="post in posts" :key="post.uuid" class="shadow px-4 py-6 rounded">
      <div class="flex items-center space-x-2 mb-2">
        <h5 class="text-gray-500">{{ post.user.name }}</h5>
        <time datetime="" class="text-xs">{{ post.published_at }}</time>
      </div>
        <RouterLink :to="{ name: 'post',  params: { slug: post.slug }}" class="">
          <h1 class="text-2xl font-semibold mb-3 hover:underline duration-150">{{ post.title }}</h1>
        </RouterLink>
          <p class="text-sm text-gray-500">{{ post.excerpt }}...</p>
    </div>
  </main>
</template>
