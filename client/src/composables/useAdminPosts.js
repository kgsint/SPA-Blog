import { ref } from 'vue'
import axios from 'axios'

export const useAdminPosts = () => {
    const posts = ref([])
    const post = ref([])

    const fetchPosts = async () => {
        const res = await axios.get('/api/admin/posts')
        posts.value = res.data.data
    }

    const fetchPost = async (uuid) => {
        try {
            const res = await axios.get(`/api/admin/posts/${uuid}/edit`)
            post.value = await res.data.data
        }catch(e) {
            throw new Error(e)
        }
        // console.log(post.value.title);
    }

    const createPost = async () => {
        try {
            const res = await axios.post('/api/admin/posts')

            return res.data.data

        }catch(e) {

        }
    }

    const patchPost = async (uuid) => {
        await axios.patch(`/api/admin/posts/${uuid}`, post.value)
    }

    return { post, posts , fetchPosts, fetchPost, createPost, patchPost }
}