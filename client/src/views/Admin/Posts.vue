<script setup>


import { useAdminPosts } from '../../composables/useAdminPosts'
import { onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const { fetchPosts, createPost, posts } = useAdminPosts()

onMounted(() => fetchPosts())

const addNewPost = async() => {
    const post = await createPost()

    router.replace({ name: 'admin-post-edit', params: { slug: post.slug } })
}

</script>


<template>
    <section class="space-y-4">
        <button class="bg-blue-400 text-white px-4 py-2 rounded" @click="addNewPost">Add new Post</button>
        <div class="space-y-12">
            <div class="flex justify-between items-center" v-for="post in posts" :key="post.uuid">
            <h1 class="text-2xl">{{ post.title }}</h1>
            <div class="flex space-x-6">
                <span class="bg-green-300 px-4 py-2 rounded-full text-white text-sm" v-if="post.published">Published</span>
                <span class="bg-red-300 px-4 py-2 rounded-full text-white text-sm" v-else>Unpublished</span>
                <RouterLink :to="{ name: 'admin-post-edit', params: { slug: post.uuid } }" class="bg-gray-300 rounded-md px-4 py-2 text-white hover:bg-gray-200 duration-150 text-sm">edit</RouterLink>
                <RouterLink to="/" class="bg-red-500 px-4 py-2 text-white hover:bg-red-300 duration-200 rounded-sm text-sm">delete</RouterLink>
            </div>
        </div>
        </div>
    </section>
</template>


<style></style>