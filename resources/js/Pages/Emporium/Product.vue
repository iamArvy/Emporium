<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue'
import ProductGallery from './partials/ProductGallery.vue';
import ProductInfo from './partials/ProductInfo.vue';
defineProps<{
    product: {
        name: string
        description:string
        images:string[]
        price: string
        discount? : string
    }
}>()
</script>

<template>
  <AppLayout>
    <section>
        <ProductGallery :images="product.images" id="gallery" />
        <ProductInfo :product="product" />
    </section>
    <!-- <HeroSection />
    <BrandMarquee class="full-width" />
    <ProductListSection title="New Arrivals" />
    <ProductListSection title="Top Selling" />
    <Categories /> -->
    <!-- <Testimonial /> -->
  </AppLayout>
</template>

<style scoped>
section{
    display: grid;
    /* flex-direction: row; */
    gap: 10px;
    grid-template-columns: 1fr 1fr;
    /* height: 500px; */
    /* padding: 5rem; */
}
</style>