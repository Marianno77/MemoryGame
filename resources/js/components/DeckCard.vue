<template>
  <div
    class="deck"
    @mousemove="handleMouseMove"
    @mouseleave="resetRotation"
    @mouseenter="isHovering = true"
    :style="cardStyle"
  >
    <div class="img">
      <img :src="`/${deck.image}`" />
    </div>
    <div class="txt">
      <p>{{ deck.name }}</p>
      <hr>
      <p :style="{color: difficultyColor(deck.difficulty)}">{{ deck.difficulty }}</p>
    </div>
    <div class="button">
      <a :href="`/play?deck=${deck.id}`">
        <button>Play!</button>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    deck: Object,
  },
  data() {
    return {
      rotationX: 0,
      rotationY: 0,
      isHovering: false,
    };
  },
  computed: {
    cardStyle() {
        const rotate = `rotateX(${this.rotationX}deg) rotateY(${this.rotationY}deg)`;
        const scale = this.isHovering ? 'scale(1.05)' : '';
      return {
        transform: `${rotate} ${scale}`.trim(),
        transition: 'transform 0.1s ease',
        boxShadow: `${-this.rotationY * 2}px ${this.rotationX * 2}px 15px rgba(127,127,255,0.2)`,
      };
    },
  },
  methods: {
    handleMouseMove(e) {
      const card = e.currentTarget;
      const rect = card.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;
      const centerX = rect.width / 2;
      const centerY = rect.height / 2;

      this.rotationX = (centerY - y) / 7;
      this.rotationY = (x - centerX) / 7;
    },

    resetRotation() {
      this.rotationX = 0;
      this.rotationY = 0;
      this.isHovering = false;
    },

    difficultyColor(difficulty) {
        switch(difficulty) {
            case 'easy': return '#aaffaa';
            case 'medium': return '#ffffaa';
            case 'hard': return '#ffaaaa';
            default: return '#fff';
        }
    }
  },
};
</script>

<style scoped>
.deck {
    width: 200px;
    height: 350px;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    align-items: center;
    background-color: #2a2a2e;
    padding: 10px;
    border: 2px solid #555 ;
    border-radius: 10px;
    perspective: 1000px;
    will-change: transform;
    transform-style: preserve-3d;
    box-shadow: 0 10px 20px rgba(127,127,255,0.2);
    position: relative;
    backface-visibility: hidden;
}

.deck::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #555;
    transform: translateZ(-15px);
    border-radius: 10px;
    z-index: -1;
    pointer-events: none;
}

.deck .img {
    width: 150px;
    height: 150px;
    border-radius: 10px;
    overflow: hidden;
    
    -webkit-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 1);
    -moz-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 1);
    box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 1);
}

.deck .img img {
    width: 100%;
}

.deck .txt {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    color: #fff;
}


.deck .txt hr {
    width: 130px;
}

.deck .button button {
    width: 150px;
    height: 50px;
    font-size: 18px;
    font-weight: bold;
    background: linear-gradient(to bottom, #ffffff, #dddddd);
    border: 2px solid #000;
    border-radius: 20px;
    cursor: pointer;

    -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 1);
    -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 1);
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 1);
}


.deck .button button:hover {
    background: linear-gradient(to bottom, #eeeeee, #cccccc);
    box-shadow: 0 0 15px rgba(0,0,0,0.5);
}
</style>