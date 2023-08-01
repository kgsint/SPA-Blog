<script setup>
import { ref, reactive } from 'vue';
import { useStore } from '../stores/useStore';
import { useRouter } from 'vue-router';

const store = useStore()
const router = useRouter()

const errors = ref({})
const form = reactive({
    email: '',
    password: '',
})

const login = async () => {
    try {
        await store.login(form)

        form.email = ''
        form.password = ''
        
        router.replace({ name: 'admin-posts'})

    }catch(e) {
        if(e.response.status === 422) {
            errors.value = e.response.data.errors 
        }
        return;
    }
}

</script>


<template>
    <div class="max-w-3xl mx-auto shadow-lg px-4 py-6 rounded-md">
        <h1 class="text-center text-2xl">Login</h1>

        <form @submit.prevent="login">
            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                <input type="email" id="email"
                    v-model="form.email"
                    class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="name@flowbite.com" >
                    <div v-if="errors.email" class="text-sm text-red-500">
                        {{ errors.email[0] }}
                    </div>
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Your
                    password</label>
                <input type="password" id="password"
                    v-model="form.password"
                    class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    >
                    <div v-if="errors.password" class="text-red-500 text-sm">
                        {{ errors.password[0] }}
                    </div>
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>

    </div>
</template>

