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
      
        <RouterLink :to="{ name: 'post',  params: { slug: post.slug }}" class="">
          <h1 class="text-2xl font-semibold mb-3">{{ post.title }}</h1>
          <p class="text-sm text-gray-500">{{ post.excerpt }}</p>
        </RouterLink>
    </div>
  </main>
</template>
