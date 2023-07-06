import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router';
import Home from './views/Home.vue';
import CreateLeague from './views/CreateLeague.vue';
import AddScore from './views/AddScore.vue';
import CreateGame from './views/CreateGame.vue';
import './style.css'
import App from './App.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/', name: 'Home', component: Home},
        {path: '/create-league', name: 'create-league', component: CreateLeague},
        {path: '/create-game', name: 'create-game', component: CreateGame},
        {path: '/add-score', name: '/add-score', component: AddScore}
    ]
})

createApp(App).use(router).mount('#app')
