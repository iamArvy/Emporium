<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import HeroSection from '@/Components/HeroSection.vue'
import BrandMarquee from '@/Components/BrandMarquee.vue'
import ProductListSection from '@/Components/ProductListSection.vue'
import Testimonial from '@/Components/TestimonialSection.vue'
</script>

<template>
  <AppLayout>
    <HeroSection />
    <BrandMarquee class="full-width" />
    <ProductListSection title="New Arrivals" />
    <ProductListSection title="Top Selling" />
    <Categories />
    <!-- <Testimonial /> -->
  </AppLayout>
</template>
