<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Stripe;

class PaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $r)
    {
        //$total_prc= $r->input('totale_price');
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => (int)\Cart::getTotal() * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "This payment is tested purpose"
        ]);

        session()->flash('success', 'Payment est passé avec succes!');

        return back();
    }
}
