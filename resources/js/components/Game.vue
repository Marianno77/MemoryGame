<template>
    <div class="container">
        <div class="info">
            <div class="timer">
                <div class="top">
                    <img :src="'/images/timer.png'" alt="" width="40px">
                    <h2>Time: </h2>
                </div>
                <div class="bottom">
                    <h2>{{ minutes }} : {{ seconds }}</h2>
                </div>
            </div>
            <div class="moves">
                <div class="top">
                    <img :src="'/images/counter.png'" alt="" width="40px">
                    <h2>Number of moves made: </h2>
                </div>
                <div class="bottom">
                    <h2>{{ this.moves }}</h2>
                </div>
            </div>
        </div>
        <div class="grid-container" v-if="cards.length > 0">
            <div v-for="(card, index) in cards" :key="index" class="card" @click="toggleCardFunction(index, card.name)" :class="{ flipped: toggleCard === index || matchedCardsNames.includes(card.name) || cardActive.includes(index)}">
                <div class="card-inner">
                    <div class="card-front">
                        <img :src="`/${card.image}`" :alt="card.name">
                    </div>
                    <div class="card-back">
                        <img :src="'/cards/card.png'">
                    </div>
                </div>
            </div>
        </div>    
        <div class="loading" v-else>
            <h3>{{ text }} {{ dots }}</h3>
        </div>
        <div class="win" v-if="win">
            <h2>Wygrana!</h2>
            <div class="win-time">
                <p>Twój czas: </p> 
                <p>{{ minutes }} : {{ seconds }}</p>
            </div>
            <button @click="reset()">Zagraj Ponownie</button>
        </div>

        <div class="back">
            <a href="/"><button>Back</button></a>
        </div>
    </div>
</template>
<script> 
import axios from 'axios';
import { ref } from 'vue';

export default {
    data() {
        return {
            cards: [],
            toggleCard: null,
            FirstCardName: null,
            SecondCardName: null,
            matchedCardsNames: [],
            previousIndex: null,
            moves: 0,
            round: 0,
            cardActive: [],
            timer: null,
            seconds: 0,
            minutes: 0,
            win: false,
            isProcessing: false,
            firstClick: false,
            text: '',
            dots: '',
        };
    },
    methods: {

        async fetchCard() {
            const urlParms = new URLSearchParams(window.location.search);
            const deckId = urlParms.get('deck');

            if (!deckId) {
                console.error('Brak deckId!');
                return;
            }

            try {
                const response = await axios.get(`/play/get-cards/${deckId}`);
                console.log('Cards data:', response.data);
                this.cards = response.data;
            } catch(error) {
                console.error(error);
            }
        },

        addTime() {
            this.timer = setInterval(() => {
                this.seconds += 1;
                
                if(this.seconds == 60) {
                    this.minutes += 1;
                    this.seconds = 0;
                }
            }, 1000)
        },

        toggleCardFunction(index, name) {
            if (this.previousIndex == index || this.win || this.isProcessing) {return}

            if (this.firstClick == false) {
                this.addTime();
                this.firstClick = true;
            }

            this.cardActive.push(index);
            if (this.round === 0) {
                this.moves++;
                this.round = 1;
            } else if (this.round === 1) {
                this.round = 0;
                this.isProcessing = true;
                setTimeout(() => {
                    this.cardActive = [];
                    this.toggleCard = null;
                    this.FirstCardName = null;
                    this.previousIndex = null;
                    this.isProcessing = false;
                }, 700);
            }
            
            this.toggleCard = this.toggleCard === index ? null : index;
            this.SecondCardName = name;
            console.log('First: '+ this.FirstCardName + ' Second: ' + this.SecondCardName);
            
            if (this.FirstCardName == this.SecondCardName){
                console.log('Para: '+name);
                this.matchedCardsNames.push(name);
                this.toggleCard = null;
            }

            this.FirstCardName = name;
            this.previousIndex = index;
            //console.log('Ilość zmaczowanych: '+this.matchedCardsNames.length + ' Ilość kard: ' + this.cards.length/2);
            
            if (this.matchedCardsNames.length == this.cards.length/2) {
                console.log("wygrana!!");
                this.win = true;
                clearInterval(this.timer);
            }
            console.log('Matched: ' + this.matchedCardsNames);
        },

        textAnimate() {
            const fullText = 'Ładowanie';
            let i = 0;
            const interval = setInterval(() => {
                if (i < fullText.length) {
                    this.text += fullText[i];
                    i++;
                } else {
                    clearInterval(interval);
                    
                    let dotCount = 0;
                    setInterval(() => {
                        dotCount = (dotCount + 1) % 4;
                        this.dots = '.'.repeat(dotCount);
                    }, 500);
                }
            }, 100);
        },

        reset() {
            this.fetchCard();
            this.toggleCard = null;
            this.FirstCardName = null;
            this.SecondCardName = null;
            this.matchedCardsNames = [];
            this.previousIndex = null;
            this.moves = 0;
            this.round = 0;
            this.cardActive = [];
            this.timer = null;
            this.seconds = 0;
            this.minutes = 0;
            this.win = false;
            this.firstClick = false;
        },
    },
    mounted() {
        console.log('Mounted hook działa');
        this.fetchCard();
        this.textAnimate();
    },
}
</script>

<style scoped>

.container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.container h2 {
    text-align: center;
    color: #fff;
}

.loading, .win {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50% , -50%);
    -webkit-transform: translate(-50%, -50%);
    color: #fff;
}

.win {
    background-color: #2a2a2e;
    width: 200px;
    height: 300px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 20px;
    align-items: center;
    padding: 10px;
    border: 2px solid #555;
    border-radius: 10px;
    font-size: 20px;
    font-weight: bold;
    color: #fff;
}

.win button {
    width: 150px;
    height: 50px;
    font-size: 18px;
    font-weight: bold;
    background: linear-gradient(to bottom, #ffffff, #dddddd);
    border: 2px solid #000;
    border-radius: 20px;
    cursor: pointer;
    transition: transform 0.3s ease;
    -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 1);
    -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 1);
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 1);
}

.grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, 150px);
    gap: 10px;
    padding: 1rem;
    max-width: calc(150px * 4 + 30px);   
    margin: 80px auto;
    justify-content: center;
    background-color: rgba(42, 42, 46, 0.3);
    border: 2px solid rgba(85, 85, 85, 0.3);
    border-radius: 10px;
}

@media(max-width:710px) {
    .grid-container {
        max-width: 90%;
    }
}

.card, .show {
    height: 150px;
    display: flex;
    justify-content: center; 
    align-items: center;     
    width: 100%;
    max-width: 150px;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 0 5px rgba(0,0,0,0.2);
    cursor: pointer;
    transition: transform 0.3s ease;
}

.card img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
}

.card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  transition: transform 0.6s;
  transform-style: preserve-3d;
}

.card.flipped .card-inner {
  transform: rotateY(180deg);
}

.card-front,
.card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  border-radius: 10px;
  backface-visibility: hidden;
  overflow: hidden;
  box-shadow: 0 0 5px rgba(0,0,0,0.2);
}

.card-front img,
.card-back img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.card-back {
  transform: rotateY(0deg);
}

.card-front {
    transform: rotateY(180deg);
}

.hidden {
    display: none;
}

.info {
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: start;
    flex-wrap: wrap;
    text-align: center;
    
}

.timer, .moves {
    padding: 10px;
    flex: 1 1 300px;
    max-width: 400px;
}

.card:hover {
    transform: scale(1.05);
}

.back button {
    margin-bottom: 80px;
    width: 200px;
    height: 50px;
    font-size: 18px;
    font-weight: bold;
    background-color: linear-gradient(to bottom, #ffffff, #dddddd);;
    border: 2px solid #000;
    border-radius: 20px;
    cursor: pointer;
    transition: transform 0.3s ease;
    -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 1);
    -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 1);
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 1);
}

.win button:hover,
.back button:hover {
    transform: scale(1.05);
    background: linear-gradient(to bottom, #eeeeee, #cccccc);
}

.top {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.win-time {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.win-time p {
    margin-top: 0;
}

</style>