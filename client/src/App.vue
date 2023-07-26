<script setup>
import { RouterView } from 'vue-router'
import Navbar from './components/Navbar.vue';
</script>

<template>

  <Navbar />
  <div class="contaier max-w-4xl mx-auto py-12">
    <RouterView />
  </div>
</template>
