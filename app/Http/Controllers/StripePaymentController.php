<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Models\Client;
use App\Models\User;
use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PDF;

class StripePaymentController extends Controller
{
  /**
   * success response method.
   *
   * @return \Illuminate\Http\Response
   */
  public function stripe(Client $client)
  {
    return view('stripe', ['client' => $client]);
  }

  /**
   * success response method.
   *
   * @return \Illuminate\Http\Response
   */
  public function stripePost(Client $client, Request $request)
  {
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    Stripe\Charge::create([
      "amount" => $client->price * 100,
      "currency" => "eur",
      "source" => $request->stripeToken,
      "description" => $client->name . ' ' . $client->description
    ]);

    Session::flash('success', 'Payment successful!');

    $user = Auth::user();
    $pdf = PDF::loadView('PDF', compact('client'), compact('user'));
    Mail::to('38726@ufp.edu.pt')->send(new MyTestEmail($client), function ($message) use ($pdf) {
      $message->attachData($pdf->output(), "text.pdf");
    });
    $client->delete();
    return redirect('/adverts');
  }

  //If you must need to pass customer name and address with shipping address then you can use bellow method code:
  // public function stripePost(Request $request)
  // {
  //   Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

  //   $customer = Stripe\Customer::create(array(
  //     "address" => [
  //       "line1" => "Virani Chowk",
  //       "postal_code" => "360001",
  //       "city" => "Rajkot",
  //       "state" => "GJ",
  //       "country" => "IN",
  //     ],
  //     "email" => "demo@gmail.com",
  //     "name" => "Hardik Savani",
  //     "source" => $request->stripeToken
  //   ));

  //   Stripe\Charge::create([
  //     "amount" => 100 * 100,
  //     "currency" => "usd",
  //     "customer" => $customer->id,
  //     "description" => "Test payment from itsolutionstuff.com.",
  //     "shipping" => [
  //       "name" => "Jenny Rosen",
  //       "address" => [
  //         "line1" => "510 Townsend St",
  //         "postal_code" => "98140",
  //         "city" => "San Francisco",
  //         "state" => "CA",
  //         "country" => "US",
  //       ],
  //     ]
  //   ]);

  //   Session::flash('success', 'Payment successful!');

  //   return back();
  // }
}
