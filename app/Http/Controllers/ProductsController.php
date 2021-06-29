<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use Stripe\Stripe;
use Stripe\Charge;
use Auth;

class ProductsController extends Controller
{
    //shows the prducts
	 public function index()
    {	
		$products=Products::get();
       return view('products',compact('products'));
    }
	
	//shows the prductsdetails check out page
	 public function productdetails($id)
    {	if(Auth::user()){
		$product=Products::findorfail($id);
		$intent = auth()->user()->createSetupIntent();
       return view('product_details',compact('product','intent'));
	   }else{
	   return back()->with('flash_messaage',"Please login");
	   }
    }
	
	//checkout
	 public function checkout(Request $request)
    {	
	 $user          = Auth::user();
     $paymentMethod = $request->input('payment_method');

    try {
        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($paymentMethod);
        $user->charge($request->price * 100, $paymentMethod);        
    } catch (\Exception $exception) {
        //return back()->with('error', $exception->getMessage());
		
    }
	return redirect('/products')->with('flash_messaage',"Payment successfull");
	die;
	try{
				//dd($request->all());/*stripe request and response*/
				$description='Name:'.$request->name.'Email:'.request('stripeEmail');				
				Stripe::setApiKey(config('services.stripe.secret'));			
				$token = request('stripeToken'); 
				$stripeamt= number_format((float) $request->price, 2, '.', '')*100;			
				$charge = Charge::create([
					'amount' =>$stripeamt,
					'currency' => 'USD',
					'description' => $description,
					'source' => $token,
					
				]);
		
		   } catch (\Exception $ex) {
				  return $ex->getMessage().' error occured';
				  Session::flash('error','Payment Failed.');
      		}
    
		return redirect('/products')->with('flash_messaage',"Payment successfull");
    }
	
	public function subscribe_process(Request $request)
{
    try {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $user = User::find(1);
        $user->newSubscription('main', 'bronze')->create($request->stripeToken);

        return 'Subscription successful!';
    } catch (\Exception $ex) {
        return $ex->getMessage();
    }

}
}
