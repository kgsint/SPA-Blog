<script setup>
import Nav from './components/Nav.vue'
import { RouterView } from 'vue-router'
</script>

<template>
  <Nav />
  <div class="contaier max-w-4xl mx-auto py-12">
    <RouterView />
  </div>
</template>
