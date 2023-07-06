<template>
    <div class="form-container">
      
      <div v-if="leagueFormError" class="error">
        {{ leagueFormError }}
      </div>
      <!-- Display success message if team created successfully -->
      <div id="toast-simple" v-if="successMessage" class="flex mb-5 items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow  " role="alert">
          <svg class="w-5 h-5 text-blue-600 dark:text-blue-500 rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 17 8 2L9 1 1 19l8-2Zm0 0V9"/>
          </svg>
          <div class="pl-4 text-sm font-normal">{{successMessage}}</div>
      </div>
      <h3>Create Game</h3>
       <div>

        <label for="team1" class="block mb-2 text-sm font-medium text-gray-900 ">Team 1:</label>
        <select v-model="team1" id="team1" required class="block w-full p-2 mb-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500   ">
          <option value="">Select Team 1</option>
          <option v-for="team in teams" :key="team.id" :value="team.id">{{ team.name }}</option>
        </select>

        <label for="team2" class="block mb-2 text-sm font-medium text-gray-900 ">Team 2:</label>
        <select v-model="team2" id="team2" required class="block w-full p-2 mb-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500   ">
          <option value="">Select Team 2</option>
          <option v-for="team in teams" :key="team.id" :value="team.id">{{ team.name }}</option>
        </select>
        
        <label for="league" class="block mb-2 text-sm font-medium text-gray-900 ">League:</label>
        <select v-model="league" id="league" required class="block w-full p-2 mb-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500   ">
          <option value="">Select League</option>
          <option v-for="league in leagues" :key="league.id" :value="league.id">{{ league.name }}</option>
        </select>

        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 ">Status:</label>
        <select v-model="status" id="status" required class="block w-full p-2 mb-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500   ">
          <option value="">Select Status</option>
          <option value="notstarted">Not Started</option>
          <option value="ft">FT</option>
          <option value="ht">HT</option>
        </select>

       
        <input v-model="timestamp" id="timestamp" type="datetime-local" name="timestamp" class="bg-gray-50 border mt-10 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5    " required>
        
        <button
        type="submit"
        @click="createGame"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 mt-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
      >Submit</button>

        <div v-if="errors.length" class="error">
          Please fill in all fields.
        </div>
       
       </div>

       

    </div>
  </template>
  
  <script>
  import axios from 'axios';
  export default {
    data() {
      return {
        teams: [], // Array to store teams fetched from API
        leagues: [], // Array to store leagues fetched from API
        team1: '', // Selected team 1
        team2: '', // Selected team 2
        league: '', // Selected league
        status: '', // Selected status
        timestamp: '', // Selected timestamp
        leagueFormError: '', // Error message for league form
        successMessage: '', // Success message after creating game
        errors: [], // Array to store validation errors
      };
    },
    created() {
      // Fetch teams and leagues from API
      this.fetchTeams();
      this.fetchLeagues();
    },
    methods: {
      async fetchTeams() {
        try {
          const response = await axios.get('http://localhost/global-ventures/server/api/teams.php');
          this.teams = response.data.teams;
        } catch (error) {
          console.error(error);
        }
      },
      async fetchLeagues() {
        try {
          const response = await axios.get('http://localhost/global-ventures/server/api/leagues.php');
          this.leagues = response.data.leagues;
        } catch (error) {
          console.error(error);
        }
      },
      async createGame() {
        // Reset errors
        this.errors = [];
  
        // Validate form fields
        if (!this.team1 || !this.team2 || !this.league || !this.status || !this.timestamp) {
          this.errors.push('Please fill in all fields.');
          return;
        }
  
        // Perform game creation logic here
        // You can use axios to send the form data to the server and handle the response
        // You can access the form data using this.team1, this.team2, this.league, this.status, this.timestamp
        try {
            const response = await axios.post('http://localhost/global-ventures/server/api/games.php', {
                team1: parseInt(this.team1), 
                team2: parseInt(this.team2), 
                league: parseInt(this.league), 
                status: this.status,
                timestamp: this.timestamp
            });
            this.team1 = '', // Selected team 1
            this.team2 = '', // Selected team 2
            this.league = '', // Selected league
            this.status = '', // Selected status
            this.timestamp = '', // Selected timestamp
            this.successMessage = response.data.message;
          } catch (error) {
            console.error(error);
        }
      },
    },
  };
  </script>