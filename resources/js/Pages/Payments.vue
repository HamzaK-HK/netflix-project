<template>
    <div>
      <h1 class="text-[40px] font-bold text-black">Plans Payments</h1>
      <h1 class="text-[40px] font-bold text-black">{{ planType }}</h1>
    </div>
  </template>

  <script>
  import axios from 'axios';
  import { onMounted, ref } from 'vue';
  import { useRoute } from 'vue-router';

  export default {
    setup() {
      const route = useRoute();
      const planType = route.query.type;

      const playTypes = async () => {
        try {
          const response = await axios.get('/api/payments', {
            type: planType,
          });
        //   const data  = planType.value;
          console.log(response);
        } catch (error) {
          console.error('Failed to fetch plans', error);
        }
      };

      const storePlanType = async () => {
      try {
        const response = await axios.post('/api/postpayment', {
          planType: planType,
          user_id: 1,
          price: '10.00', // Replace with actual price
          quantity: 1,    // Replace with actual quantity
        });
        console.log('Response:', response);
      } catch (error) {
        console.error('Failed to store plan type', error);
      }
    };
      onMounted(() => {
        playTypes();
        storePlanType();
      });

      return {
        planType,
      };
    },
  };
  </script>
