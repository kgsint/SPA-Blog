<script setup>
import { RouterLink, useRouter, useRoute } from 'vue-router';
import { useStore } from '../stores/useStore';

const toggleMobileNav = () => {
    document.querySelector('#navbar-sticky').classList.toggle('hidden')
}

const route = useRouter()

console.log(route.currentRoute.value.name)
const store = useStore()
const router = useRouter()

const logout = async () => {
    
    try {
        store.authenticated = false
        await store.logout()

        router.replace({ name: 'home' })
    }catch(e) {
        console.log(e)
    }
}

</script>

<template>
    <nav class="bg-whitefixed w-full z-20 top-0 left-0 border-b border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <RouterLink :to="{ name: 'home' }" class="flex items-center text-2xl">
                Bloggie
            </RouterLink>
            <div class="flex md:order-2">
                <form @submit.prevent="logout" id="logout-form"></form>
                <button form="logout-form"  v-if="store.isAuthenticated" :to="{ name: 'login' }" type="submit"
                    class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0">Logout</button>
                <RouterLink v-else :to="{ name: 'login' }" type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0">Login</RouterLink>

                <button @click="toggleMobileNav" data-collapse-toggle="navbar-sticky" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center hidden justify-between w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul
                    class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white">
                    <li>
                        <RouterLink :to="{ name: 'home' }"
                            class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0"
                            :class="{ 'md:text-blue-500': route.currentRoute.value.name === 'home'}"
                            aria-current="page">Home</RouterLink>
                    </li>
                    <li>
                        <RouterLink :to="{ name: 'admin-posts' }"
                            class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0"
                            :class="{ 'md:text-blue-500': route.currentRoute.value.name === 'admin-posts'}">
                            Dashboard
                        </RouterLink>
                    </li>
            </ul>
        </div>
    </div>
</nav>
</template>

