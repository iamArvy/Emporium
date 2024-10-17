<script setup>
import SecondaryButton from './SecondaryButton.vue'
import Item from './ProductListItem.vue'
defineProps({
  title: String
})
</script>
<template>
  <section>
    <h1>{{ title }}</h1>
    <ul>
      <li><Item /></li>
      <li><Item /></li>
      <li><Item /></li>
      <li><Item /></li>
    </ul>
    <SecondaryButton value="View All" />
  </section>
</template>
<style scoped>
section {
  padding-top: 3rem;
  padding-bottom: 3rem;
}
ul {
  width: 100%;
  display: flex;
  justify-content: space-between;
  gap: 1.5rem;
  overflow-x: scroll;
  overflow-y: hidden;
}
h1 {
  color: black;
  text-align: center;
  font-size: 50px;
  text-transform: uppercase;
  margin: 1rem 0;
  /* place-content: center; */
}
button {
  align-self: center;
}
@media screen and (max-width: 500px) {
  h1{
    font-size: 35px;
  }
  button{
    margin-top: 2rem;
    width: 100%;
  }
}
</style>
