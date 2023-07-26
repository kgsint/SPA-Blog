<script setup>
import { onMounted } from 'vue'
import { usePosts } from '../composables/usePosts'

const props = defineProps({
    slug: String,
    required: true,
})
const { post, fetchPost } = usePosts()

onMounted(() => {
    fetchPost(props.slug)
})

</script>


<template>
    <RouterLink :to="{ name: 'home' }" class="block text-blue-500 underline mb-6">Back</RouterLink>
    <div>
        <h1 class="text-2xl font-semibold mb-3">{{ post.title }}</h1>
        <p class="text-gray-500 prose prose-sm lg:prose" v-html="post.body"></p>
    </div>
</template>


<style></style>