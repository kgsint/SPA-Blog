import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

import axios from 'axios'

export const useStore = defineStore('store', {
  state: () => {
    return {
      authenticated: false,
      user: null,
    }
  },
  getters: {
     isAuthenticated() {
      return this.authenticated
    },
    getUser() {
      return this.user
    }
  },
  actions: {
    async authenticate() {
        try {
          const user = await axios.get('/api/user')
          this.authenticated = true
          this.user = user.data
        }catch(e) {
          this.authenticated = false
          this.user = null
          return 
        }
    },
    async login(credentials) {
      await axios.get('/sanctum/csrf-cookie')
      await axios.post('/login', credentials)

      this.authenticated = true

      this.authenticate()
    },
    async logout() {
      await axios.get('/sanctum/csrf-cookie')
      await axios.post('/logout')

      this.authenticated = false
    }
  }
})
