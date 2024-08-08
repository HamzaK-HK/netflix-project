<?php

namespace App\Http\Controllers;

use Session;
use Exception;
use Stripe\Price;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Product;
use Stripe\Webhook;
use App\Models\Plan;
use App\Models\Payment;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    //
    // public function store(Request $request)
    // {
    //     Stripe::setApiKey('sk_test_51PiVn4LTANQhvXtF9W7NbfaO1aaU2vgsFyFVGcfW2vHU04W99Ll7I6MtYYOoTvJdQdT3SY3eLSbIu5DkhUSyXhIw00doAkuWht');

    //     try {
    //         // Create a payment intent
    //         $paymentIntent = PaymentIntent::create([
    //             'amount' => $request->amount,
    //             'currency' => $request->currency,
    //             'payment_method' => $request->payment_method_id,
    //             'confirmation_method' => 'manual',
    //             'confirm' => true,
    //             'description' => 'Payment from ' . $request->user()->email,
    //             'metadata' => [
    //                 'line_items' => json_encode($request->line_items),
    //             ],
    //         ]);

    //         // Store payment information in the database
    //         $payment = Payment::create([
    //             'user_id' => $request->user()->id,
    //             'charge_id' => $paymentIntent->id,
    //             'amount' => $paymentIntent->amount,
    //             'currency' => $paymentIntent->currency,
    //             'plan_type' => $paymentIntent->plan_type,
    //         ]);

    //         return response()->json([
    //             'success' => true,
    //             'session_id' => $paymentIntent->id,
    //         ], 201);

    //     } catch (Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Payment failed',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    public function store(Request $request)
    {
        $type = $request->query('type');

        return response()->json(['type' => $type]);
    }


     public function handleWebhook(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $endpoint_secret = 'whsec_ba891e7fa205a96f7a5b258421aaeba79c7b7b097a93315b81f85925c184d2c9';
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch(\UnexpectedValueException $e) {
            return response()->json(['success' => false, 'message' => 'Invalid payload'], 400);
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['success' => false, 'message' => 'Invalid signature'], 400);
        }

        // Handle the event
        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            $paymentIntent = $session->payment_intent;

            // Store the data in the database
            $payment = new Payment();
            $payment->user_id = $session->metadata->user_id;
            $payment->plan_type = $session->metadata->plan_type;
            $payment->price = $session->amount_total / 100; // Amount in dollars
            $payment->quantity = $session->metadata->quantity;
            $payment->save();
        }

        return response()->json(['success' => true]);
    }




    public function postPayment(Request $request)
    {
        $type = $request->query('type');
        $user_id = auth()->id(); // Assuming the user is authenticated
        $price = $request->input('price');
        $quantity = $request->input('quantity');

        $payment = new Payment();
        $payment->user_id = $user_id;
        $payment->plan_type = $type;
        $payment->price = $price;
        $payment->quantity = $quantity;
        $payment->save();

        return response()->json(['success' => true, 'payment' => $payment]);
    }

    // public function store(Request $request)
    // {
    //     dd($request->all());
    //     $lineItems = $request->input('lineItems', []);

    //     foreach ($lineItems as $item) {
    //         Payment::create([
    //             'user_id' => auth()->id(), // Assuming you have user authentication
    //             // 'plan_type' => $item['plan_type'],
    //             'price' => $item['price'],
    //             'quantity' => $item['quantity'],
    //         ]);
    //     }

    //     return response()->json(['success' => 'Payment successful'], 200);
    // }

    public function __construct()
    {
        Stripe::setApiKey('sk_test_51PiVn4LTANQhvXtF9W7NbfaO1aaU2vgsFyFVGcfW2vHU04W99Ll7I6MtYYOoTvJdQdT3SY3eLSbIu5DkhUSyXhIw00doAkuWht'); // Set your Stripe secret key
    }

    public function getProduct($priceId)
    {
        try {
            $price = Price::retrieve($priceId);
            $product = Product::retrieve($price->product);
            return response()->json(['name' => $product->name]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function storePayment(Request $request)
    {

    }

}

