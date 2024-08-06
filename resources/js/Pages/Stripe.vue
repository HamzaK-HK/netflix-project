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

const getPlans = async () => {
    try {
        const response = await axios.get("/api/getplans");
        console.log(response.data); // Check the structure of the response data
        plans.value = response.data.plans;

        if (Array.isArray(plans.value) && plans.value.length > 0) {
            lineItems.length = 0; // Clear the array first

            //   for (const plan of plans.value) {
            let productId = "";
            let plan_type = "";

            switch (route.params.type) {
                case "mobile":
                    productId = "price_1PjEJyLTANQhvXtFLoAvvUyU";
                    plan_type = "Mobile";
                    break;
                case "basic":
                    productId = "price_1PjEKQLTANQhvXtFHE4T1aEL";
                    plan_type = "Basic";
                    break;
                case "standard":
                    productId = "price_1PjEKlLTANQhvXtFmPYVM0w2";
                    plan_type = "Standard";
                    break;
                case "premium":
                    productId = "price_1PjEL5LTANQhvXtFk7Tgg7kK";
                    plan_type = "Premium";
                    break;
                default:
                    productId = "price_1PjEL5LTANQhvXtFk7Tgg7kK";
                    plan_type = "Premium";
            }
            if (productId) {
                lineItems.push({
                    price: productId,
                    quantity: 1,
                });

                submit();
            }
        } else {
            console.error("Plans data is not an array", plans.value);
        }
    } catch (error) {
        console.error("Failed to fetch plans", error);
    }
};

onMounted(() => {
    getPlans();
});

const successUrl = `http://127.0.0.1:8000/payments`;
const cancelUrl = `${window.location.origin}/home`;

const submit = async () => {
    try {
        const { error } = await checkoutRef.value.redirectToCheckout({
            successUrl: successUrl,
            cancelUrl: cancelUrl,
        });
        if (error) {
            console.error("Stripe Checkout error:", error);
        }
    } catch (error) {
        console.error("Failed to redirect to Stripe Checkout:", error);
    }
};

const checkoutRef = ref(null);
</script>

<template>
    <div>
        <stripe-checkout
            ref="checkoutRef"
            mode="subscription"
            :pk="publishableKey"
            success-url="http://127.0.0.1:8000/home"
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
