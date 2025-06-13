<template>
    <h2>Select difficulty level</h2>
    <div class="container">
    <DeckCard v-for="deck in decks" :key="deck.id" :deck="deck" />
  </div>
</template>

<script>
import axios from 'axios';
import DeckCard from './DeckCard.vue'; // ścieżka zależna od struktury projektu

export default {
  components: { DeckCard },
  data() {
    return {
      decks: [],
    };
  },
  async mounted() {
    try {
      const response = await axios.get('/get-decks');
      this.decks = response.data;

      this.$nextTick(() => {
        window.dispatchEvent(new Event('resize'));
      });
    } catch (e) {
      console.error(e);
    }
  },
};
</script>

<style scoped>

h2{
  margin-top: 80px;
  text-align: center;
  color: #fafafa;
  font-size: 40px;
}

.container {
  width: 100%;
  margin-top: 100px;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  gap: 60px;
  position: relative;
  z-index: 1;
}
</style>