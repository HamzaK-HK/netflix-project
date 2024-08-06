<?php

namespace App\Http\Controllers;

use Exception;
use Stripe\Price;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Product;
use App\Models\Payment;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;

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
        dd($request->all());
        // $lineItems = $request->input('lineItems', []);

        // foreach ($lineItems as $item) {
        //     Payment::create([
        //         'user_id' => auth()->id(), // Assuming you have user authentication
        //         // 'plan_type' => $item['plan_type'],
        //         'price' => $item['price'],
        //         'quantity' => $item['quantity'],
        //     ]);
        // }

        // return response()->json(['success' => 'Payment successful'], 200);
    }

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
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}

