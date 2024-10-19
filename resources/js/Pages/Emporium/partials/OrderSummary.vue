<script setup lang="ts">
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps<{
    total: number,
    checkout: Function
}>()
</script>
<template>
<article>
    <h1>Cart Summary</h1>
    <hr>
    <p> <span>Subtotal</span> <span>${{ total }}</span></p>
    <hr>
    <PrimaryButton @click="checkout">Checkout</PrimaryButton>
</article>
</template>
<style scoped>
article>*{
 margin: 5px 0;
}
p{
    display: flex;
    flex-direction: row;
    width: 100%;
    justify-content: space-between;
    /* margin: 10px 0; */
}
</style>