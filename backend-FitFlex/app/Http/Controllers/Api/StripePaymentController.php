<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Http\Middleware\CorsMiddleware;

class StripePaymentController extends Controller
{
    

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    // Aplica el middleware cors solo en este controlador
    public function __construct()
    {
        $this->middleware('cors');
        $this->middleware('auth:sanctum')->only('stripePost');
    }

    public function stripe()
    {
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
    
        $payment = Stripe\Charge::create ([
                "amount" => $request->amount,
                "payment_intent" => $request->id,
                "currency" => "usd",
                "source" => $request->token,
                "description" => "Suscripcion a plan premium realizada con exito.",
                
        ]);
      
        Session::flash('success', 'Payment successful!');
        if ($payment) {
            return response()->json([
                'success' => true,
                'data'    => $payment
            ],200);
        }  else {
            return response()->json([
                'success' => false,
                'message'    => "Error al realizar el pago."
            ],400);
        }   
        
    }
}