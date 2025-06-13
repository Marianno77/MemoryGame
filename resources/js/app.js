import './bootstrap';
import { createApp } from 'vue';
import Home from './components/Home.vue';
import Game from './components/Game.vue';

const app = createApp({})

app.component('home', Home)
app.component('game', Game)

app.mount('#app');