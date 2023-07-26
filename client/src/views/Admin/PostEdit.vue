<script setup>
import { onMounted, watch, watchEffect } from 'vue';
import { useAdminPosts } from '../../composables/useAdminPosts'
import { cloneDeep, debounce } from 'loadsh'
import ResizeTextarea from '../../components/ResizeTextarea.vue'
import Editor from '../../components/Editor.vue'
import slugify from 'slugify'

const props = defineProps({
    slug: String,
    required: true,
})

const { fetchPost, post, patchPost } = useAdminPosts()


const updatePost = async () => {
    await patchPost(props.slug)
}

const reslug = () => {
    const slug = post.value.slug

    if(slug.charAt(slug.length - 1) === " ") {
        return
    }

    post.value.slug = slug ? slugify(slug, { strict: true }) : post.value.uuid
}

onMounted(async () => {
    await fetchPost(props.slug)

    // update on changes
    watch(() => cloneDeep(post), debounce(updatePost, 1000))

    // slugify
    watchEffect(() => {
        reslug()
    })
})


</script>


<template>

    

    <div>
        <div class="absolute top-0 left-0 flex justify-between items-center px-8 py-6 w-full space-x-6">
            <div class="flex flex-grow items-center">
                <span class="font-bold mr-1">/</span> 
                <input 
                    type="text" 
                    v-model="post.slug" 
                    class="w-full focus:outline-none" 
                    @click="$event.target.select()"
                    spellcheck="false"
                >
            </div>
            <div class="flex items-center space-x-4">
                <div>
                    <span class="text-sm font-semibold">Autosave</span>
                </div>
                <div>
                    <button 
                        @click="post.published = !post.published"
                        class="bg-gray-100 px-4 py-2 rounded-full text-xs font-bold duration-150 hover:bg-gray-200">
                        <span v-if="!post.published">Publish</span>
                        <span v-else class="text-red-400">Unpublish</span>
                    </button>
                </div>
                <div>
                    <RouterLink :to="{ name: 'post', params: { slug: post.slug }}" class="text-sm font-semibold">Preview</RouterLink>
                </div>
            </div>
        </div>
        <div class="my-20">
            <ResizeTextarea v-if="post.title">
                <template v-slot:default="{ resize, el }">
                    <textarea :ref="el" v-model="post.title"
                        @input="resize"
                        class="w-full text-4xl lg:text-6xl text-center border-0 focus:ring-0 focus:outline-none resize-none">
                    </textarea>
                </template>
            </ResizeTextarea>

        </div>
        <Editor :modelValue="post.body" @update:modelValue="newValue => post.body = newValue" />
    </div>
</template>


<style></style>