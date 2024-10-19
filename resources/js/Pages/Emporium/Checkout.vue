<script setup lang="ts">
import ImgFigure from '@/Components/Emporium/ImgFigure.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { onMounted } from 'vue';
import CartList from './partials/CartList.vue';
import CartItem from './partials/CartItem.vue';
import OrderSummary from './partials/OrderSummary.vue';
import OrderSection from './partials/OrderSection.vue';
import CartPageDivider from './partials/CartPageDivider.vue';
import { router } from '@inertiajs/vue3';
const props = defineProps<{
    cartItems: {
        product: {
            id: string,
            name: string,
            price: string,
            discount: number,
            images: string[],
        },
        quantity : number,
    }[],
    cartTotal: number,
    cartQuantity: number
}>()

onMounted(()=>{
    console.log(props)
})

const checkout = () =>{
    router.get(route('cart.checkout'))
}
</script>
<template>
    <AppLayout>
        <CartPageDivider>
            <template #main>
                <OrderSection>
                    <form action=""></form>
                </OrderSection>
                <OrderSection>
                <CartList>
                    <CartItem v-for="(item, index) in props.cartItems" :key="index" :item="item" :last="index + 1 === props.cartItems.length" />
                </CartList>
            </OrderSection>
            </template>
            <template #summary>
                <OrderSection>
                <OrderSummary :total="props.cartTotal" :checkout="checkout" />
            </OrderSection>
            </template>
        </CartPageDivider>
    </AppLayout>
</template>

<style scoped>
/* section{
    display: grid;
    grid-template-columns: 1fr 0.7fr;
    gap: 1rem;
} */
</style>