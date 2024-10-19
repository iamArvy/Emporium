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
import CartForm from './partials/CartForm.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
const props = defineProps<{
    items: {
        product: {
            id: string,
            name: string,
            price: string,
            discount: number,
            images: string[],
        },
        quantity : number,
    }[],
    total: number,
    quantity: number
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
        <DialogModal>
            
        </DialogModal>
        <CartPageDivider>
            <template #main>
                <OrderSection>
                <CartList>
                    <CartItem v-for="(item, index) in props.items" :key="index" :item="item" :last="index + 1 === props.items.length" />
                </CartList>
            </OrderSection>
            </template>
            <template #summary>
                <OrderSection>
                    <OrderSummary :total="props.total" :checkout="checkout" />
                    
                </OrderSection>
                <OrderSection>
                    <CartForm>
                        <template #title>Customer Information</template>
                        <input type="text" placeholder="Name">
                        <input type="email" placeholder="Email">
                        <input type="number" placeholder="Phone Number">

                    </CartForm>
                </OrderSection>
                <OrderSection>
                    <CartForm>
                        <template #title>Delivery Information</template>
                        <!-- <div id="deliverytype">
                            <div class="radios">
                                <input type="radio" name="" id="" value="door">
                                <label for="door-radio"> Door Delivery</label>
                            </div>
                            <div class="radios">
                                <input type="radio">
                                <label for="pickup delivery"> Pickup Delivery</label>
                            </div>
                        </div> -->
                        <input type="text" placeholder="State">
                        <input type="text" placeholder="City">
                        <input type="text" placeholder="Address">
                    </CartForm>
                </OrderSection>
                <PrimaryButton @click="checkout">checkout</PrimaryButton>
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