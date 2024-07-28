<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;
use Stripe;


class HomeController extends Controller
{

    public function index()
    {
        $product = Product::all();
        return view('home.userpage', compact('product'));
    }

    public function redirect(){
        $userType = Auth::user()->usertype;

        if ($userType=='1') {

            $total_product = Product::all()->count();
            $total_order = Order::all()->count();
            $total_user = User::all()->count();

            $order = Order::all();
            $total_revenue = 0;

            foreach ($order as $order) {

                $total_revenue = $total_revenue + $order->price;

            }

            $total_delivered = Order::where('delivery_status','=','delivered')->get()->count(); 
            $total_processing = Order::where('delivery_status','=','processing')->get()->count(); 

            return view('admin.home',compact('total_product','total_order','total_user','total_revenue','total_delivered','total_processing'));
        }
        else{  
            $product = Product::all();
            return view('home.userpage', compact('product'));
        }
    }



    //product details
    public function product_details($id){
        $product = Product::find($id);
        return view('home.product_details',compact('product'));
    }


    //add to cart
    public function add_cart(Request $request, $id){

        // user logged in check
        if(Auth::id()){
            $user = Auth::user();
            $product = Product::find($id);
            $cart = new Cart;

            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->addresss;
            $cart->user_id = $user->id;

            $cart->product_title = $product->title;

            if ($product->discount_price!=null) {
                $cart->price = $product->discount_price * $request->quantity;
            }
            else{
                $cart->price = $product->price * $request->quantity;
            }

            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->quantity = $request->quantity;

            $cart->save();
            return redirect()->back()->with('message', 'Product Add to Cart successfully.');
        }
        else{
            return redirect('login');
        }

    }


    public function show_cart(){
       if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id','=',$id)->get();
            return view('home.show_cart',compact('cart'));
       }
       else{
        return redirect('login');
       }
    }

    public function remove_cart($id){
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    public function cash_order(){
        $user = Auth::user();
        $userID = $user->id;
        $data = Cart::where('user_id','=',$userID)->get();
        
        foreach ($data as $data) {
            $order = new Order;
            $order->name = $data->name; 
            $order->email = $data->email; 
            $order->phone = $data->phone; 
            $order->address = $data->address; 
            $order->user_id = $data->user_id; 
            $order->product_title = $data->product_title; 
            $order->price = $data->price; 
            $order->quantity = $data->quantity; 
            $order->image = $data->image; 
            $order->product_id = $data->product_id; 
            $order->payment_status = 'cash on delivery'; 
            $order->delivery_status = 'processing'; 
            
            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();

        }
        return redirect()->back()->with('message', 'We have received your order. We will connect with you soon.');
    }
    

    public function stripe($totalPrice){
        return view('home.stripe',compact('totalPrice'));
    }

    public function stripePost(Request $request, $totalPrice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalPrice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment." 
        ]);


        $user = Auth::user();
        $userID = $user->id;
        $data = Cart::where('user_id','=',$userID)->get();
        
        foreach ($data as $data) {
            $order = new Order;
            $order->name = $data->name; 
            $order->email = $data->email; 
            $order->phone = $data->phone; 
            $order->address = $data->address; 
            $order->user_id = $data->user_id; 
            $order->product_title = $data->product_title; 
            $order->price = $data->price; 
            $order->quantity = $data->quantity; 
            $order->image = $data->image; 
            $order->product_id = $data->product_id; 
            $order->payment_status = 'Paid'; 
            $order->delivery_status = 'processing'; 
            
            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }


    public function show_order(){
        if (Auth::id()) {

            $user = Auth::user();
            $userID = $user->id;
            $order = Order::where('user_id','=',$userID)->get();
            return view('home.order',compact('order'));
        }else{
            return redirect('login');
        }
    }

    public function cancel_order($id){
        $order = Order::find($id);
        $order->delivery_status = 'canceled order';
        $order->save();
        return redirect()->back();
    }

    public function products(){
        $product = Product::all();
        return view('home.products_nav',compact('product'));
    }


    // contact page
    public function contact(Request $request){
            if(Auth::id()){
            $user = Auth::user();
            $contact = new Contact; 
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->message = $request->message;

            $contact->save();
            return redirect()->back()->with('message', 'Message Sent Successfully');
        }
        else{
            return redirect('login');
        }
    }

    public function contact_us(){
        return view('home.contact_nav');
    }
}
