<template>
    <div class="home text-gray-900">
        <h3>Add League</h3>
      <div id="toast-simple" v-if="successMessage" class="flex mb-5 items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" role="alert">
          <svg class="w-5 h-5 text-blue-600 dark:text-blue-500 rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 17 8 2L9 1 1 19l8-2Zm0 0V9"/>
          </svg>
          <div class="pl-4 text-sm font-normal">{{successMessage}}</div>
      </div>
  
      <div class="relative z-0 w-full mb-6 group mt-6">
        
        <input
          name="leagueName"
          v-model="leagueName"
          id="leagueName"
          class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
          placeholder=""
          required
        />
        <label
          for="leagueName"
          class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
        >Enter League Name</label>
        <p v-if="errors.leagueName" class="text-red-500 text-sm mt-1">{{ errors.leagueName }}</p>
      </div>
      <button
        type="submit"
        @click="sendMessage"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
      >Submit</button>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        leagueName: '',
        errors: {},
        successMessage: null
      };
    },
    methods: {
      validateForm() {
        this.errors = {};
  
        if (!this.leagueName) {
          this.errors.leagueName = 'League Name is required.';
        } else if (this.leagueName.length < 3) {
          this.errors.leagueName = 'League Name must have a minimum of 3 characters.';
        }
  
        return Object.keys(this.errors).length === 0;
      },
      async sendMessage() {
        if (this.validateForm()) {
          try {
            const response = await axios.post('http://localhost/global-ventures/server/api/leagues.php', {
              leagueName: this.leagueName
            });
            this.leagueName = ""
            this.successMessage = response.data.message;
          } catch (error) {
            console.error(error);
          }
        }
      }
    }
  };
  </script>
  