<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Webhook;
use App\Models\Plan;
use App\Models\User;
use App\Models\Payment;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey(env('sk_test_51PiVn4LTANQhvXtF9W7NbfaO1aaU2vgsFyFVGcfW2vHU04W99Ll7I6MtYYOoTvJdQdT3SY3eLSbIu5DkhUSyXhIw00doAkuWht'));

    // Fetch the plan data from the Plan table
    $plan = Plan::find($request->input('plan_id'));

    if (!$plan) {
        return response()->json(['error' => 'Plan not found.'], 404);
    }

    $user = auth()->user();

    // Get the payment amount and email address from the form.
    $amount = $plan->monthly_price * 100; // Convert amount to cents
    $plan_type = $plan->plan_type;
    // $email = $request->input('email');

    // Create a new Stripe customer.
    $customer = \Stripe\Customer::create([
        'email' => $user->email,
        'source' => $request->input('stripeToken'),
    ]);

    // Create a new Stripe charge.
    $charge = \Stripe\Charge::create([
        'amount' => $amount,
        'currency' => 'usd',
        'customer' => $customer->id,
        'description' => $plan_type,
    ]);

    // Save payment details in the database (optional)
    // Payment::create([
    //     'customer_id' => $customer->id,
    //     'charge_id' => $charge->id,
    //     'email' => $email,
    //     'amount' => $amount,
    //     'currency' => 'usd',
    //     'plan_type' => $plan_type,
    // ]);

    // Display a success message to the user.
    return response()->json(['message' => 'Payment successful!'], 200);
    }


    public function get(Request $request)
    {
        Stripe::setApiKey('sk_test_51PiVn4LTANQhvXtF9W7NbfaO1aaU2vgsFyFVGcfW2vHU04W99Ll7I6MtYYOoTvJdQdT3SY3eLSbIu5DkhUSyXhIw00doAkuWht');
        $endpointSecret = 'whsec_ba891e7fa205a96f7a5b258421aaeba79c7b7b097a93315b81f85925c184d2c9';

        $payload = @file_get_contents('php://input');
        $sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = Webhook::constructEvent(
                $payload, $sigHeader, $endpointSecret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        if ($event->type == 'checkout.session.completed') {
            $session = $event->data->object;

            // Store payment details in database
            Payment::create([
                'user_id' => $session->client_reference_id,
                'charge_id' => $session->payment_intent,
                'amount' => $session->amount_total,
                'currency' => $session->currency,
                'plan_type' => $session->metadata->plan_type,
            ]);
        }

        return response()->json(['success' => 'Payment processed successfully'], 200);

    }

    public function getPlans()
    {
        $plans = Plan::class()->monthly_price->get();
        $plans = Plan::class()->plan_type->get();
        return response()->json($plans);
    }




}
