<template>
    <div class="form-container">
      <h3>Add Score</h3>
     
        <label for="game" class="block mb-2 text-sm font-medium text-gray-900 ">Game:</label>
        <select v-model="game" id="game" required class="block w-full p-2 mb-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-50 ">
          <option value="">Select Game</option>
          <option v-for="game in games" :key="game.id" :value="game.id">{{ game.id }}</option>
        </select>
        

        <label for="scope" class="block mb-2 text-sm font-medium text-gray-900 ">Scope:</label>
        <select v-model="scope" id="scope" required class="block w-full p-2 mb-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-50">
          <option value="">Select scope</option>
          <option value="notstarted">Not Started</option>
          <option value="ft">FT</option>
          <option value="ht">HT</option>
        </select>

        <label for="team1Score" class="block mb-2 text-sm font-medium mt-5 text-gray-900 ">Team 1 Score:</label>
        <input v-model="team1Score" type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " id="team1Score" name="team1Score" required>

        <label for="team2Score" class="block mb-2 text-sm font-medium mt-5 text-gray-900 ">Team 2 Score:</label>
        <input v-model="team2Score" type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " id="team2Score" name="team2Score" required>
        
        <div v-if="errors.length" class="error">
          Please fill in all fields.
        </div>

        <button
        type="submit"
        @click="addScore"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 mt-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center "
      >Submit</button>
   
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  export default {
    data() {
      return {
        games: [], // Array to store games fetched from API
        game: '', // Selected game
        scope: '', // Selected scope
        team1Score: '', // Team 1 score
        team2Score: '', // Team 2 score
        errors: [], // Array to store validation errors
      };
    },
    created() {
      // Fetch games from API
      this.fetchGames();
    },
    methods: {
      async fetchGames() {
        try {
          const response = await axios.get('http://localhost/global-ventures/server/api/games.php');
          this.games = response.data.games;
        } catch (error) {
          console.error(error);
        }
      },
      async addScore() {
        // Reset errors
        this.errors = [];
  
        // Validate form fields
        if (!this.game || !this.scope || !this.team1Score || !this.team2Score) {
          this.errors.push('Please fill in all fields.');
          return;
        }
  
        // Perform score addition logic here
        // You can use axios to send the form data to the server and handle the response
        // You can access the form data using this.game, this.scope, this.team1Score, this.team2Score
        try {
            const response = await axios.post('http://localhost/global-ventures/server/api/scores.php', {
                team2Score: parseInt(this.team2Score), 
                team1Score: parseInt(this.team1Score), 
                scope: this.scope, 
                game: parseInt(this.game),
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
  