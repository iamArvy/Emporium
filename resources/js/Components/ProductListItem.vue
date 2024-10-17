<script setup>
import Rating from './Ratings.vue'
const rating = 3.5
</script>
<template>
  <router-link to="/">
    <figure>
      <img src="" alt="" />
    </figure>
    <figcaption>
      <h2>T-shirt with Tape and Details</h2>
      <span
        ><Rating :rating="rating" /><span>{{ rating }}</span
        >/5</span
      >
      <div class="price">
        <h3>$240</h3>
        <div class="discount">
          <h3>$260</h3>
          <span>-20%</span>
        </div>
        <span></span>
      </div>
    </figcaption>
  </router-link>
</template>
<style scoped>
figcaption {
  color: black;
}
.price {
  display: flex;
  gap: 10px;
}
.discount {
  place-items: center;
}
.discount > * {
  display: inline;
}
.discount > h3 {
  text-decoration: line-through;
  color: grey;
}
.discount > span {
  color: red;
  font-size: 10px;
  border-radius: 5px;
  padding: 2px 5px;
  background-color: rgba(255, 0, 0, 0.1);
}
h2 {
  font-size: 15px;
}
a {
  text-decoration: none;
}
@media screen and (max-width: 500px) {
  img{
    max-width: 200px;
  }
  #mobile{
    display: flex;
  }
}
</style>
