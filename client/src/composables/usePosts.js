import { ref } from 'vue'
import axios from 'axios'

export const usePosts = () => {
    const posts = ref([])
    const post = ref([])

    const fetchPosts = async () => {
        const res = await axios.get('/api/posts')
        posts.value = res.data.data
    }

    const fetchPost = async (slug) => {
        try {
            const res = await axios.get(`/api/posts/${slug}`)
            post.value = await res.data.data
        }catch(e) {
            throw new Error(e)
        }
        // console.log(post.value.title);
    }

    return { post, posts , fetchPosts, fetchPost }
}