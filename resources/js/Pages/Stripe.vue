<script setup>
import { ref, reactive, onMounted, watchEffect } from "vue";
import { useRoute, useRouter } from "vue-router";
import { StripeCheckout } from "@vue-stripe/vue-stripe";
import Plans from "../Pages/Plans.vue";
import axios from "axios";

const route = useRoute();

const router = useRouter();

const publishableKey = ref(
    "pk_test_51PiVn4LTANQhvXtF7oH3RhKPNOEp3if3meh19pKl9pxQwAn7Awh1VcDJ13thRUS1Z198fmYlbbd8bvGKajyvznNk00XxjCiR0D"
);
const loading = ref(false);
const plans = ref([]);
const lineItems = reactive([]);
let planType = route.params.type;

const getPlans = async () => {
    try {
        const response = await axios.get("/api/getplans");
        console.log(response.data); // Check the structure of the response data
        plans.value = response.data.plans;

        if (Array.isArray(plans.value) && plans.value.length > 0) {
            lineItems.length = 0; // Clear the array first

            //   for (const plan of plans.value) {
            let productId = "";

            switch (planType) {
                case "mobile":
                    productId = "price_1PjEJyLTANQhvXtFLoAvvUyU";

                    break;
                case "basic":
                    productId = "price_1PjEKQLTANQhvXtFHE4T1aEL";

                    break;
                case "standard":
                    productId = "price_1PjEKlLTANQhvXtFmPYVM0w2";

                    break;
                case "premium":
                    productId = "price_1PjEL5LTANQhvXtFk7Tgg7kK";

                    break;
                default:
                    productId = "price_1PjEL5LTANQhvXtFk7Tgg7kK";

            }
            if (productId) {
                lineItems.push({
                    price: productId,
                    quantity: 1,
                });



           await submit(productId);
            }
        } else {
            console.error("Plans data is not an array", plans.value);
        }
    } catch (error) {
        console.error("Failed to fetch plans", error);
    }
};


const storePlanType = async () => {
      try {
        const response = await axios.post('/api/postpayment', {
          type: planType,
          lineItems: lineItems,   // Replace with actual quantity
        });
        console.log(response);
      } catch (error) {
        console.error('Failed to store plan type', error);
      }
    };




onMounted(() => {
    getPlans();

});

    const successUrl = `http://127.0.0.1:8000/payment?type=${planType}`;
    const cancelUrl = 'http://127.0.0.1:8000/payment';

    const submit = async (productId) => {
    try {
        console.log('Initiating redirect to Stripe Checkout...');
        const { error } = await checkoutRef.value.redirectToCheckout({
            successUrl,
            cancelUrl
        });

        if (error) {
            console.error("Stripe Checkout error:", error);
        }
    } catch (error) {
        console.error("Failed to handle the payment process:", error);
    }
    storePlanType();
};

const checkoutRef = ref(null);
</script>

<template>
    <div>
        <stripe-checkout
            ref="checkoutRef"
            mode="subscription"
            :pk="publishableKey"
            :success-url="successUrl"
            :cancel-url="cancelURL"
            :line-items="lineItems"
            @loading="(v) => (loading = v)"
        />

        <!-- <Plans

        @click="submit" /> -->
        <!-- Pay now -->
    </div>
</template>

<style>
body {
    background-color: #fff;
}
</style>
