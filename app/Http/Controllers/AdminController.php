<?php

namespace App\Http\Controllers;

use PDF;
use Notification;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
    public function view_category(){
        $data = Category::all();
        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request){
        $data = new Category;
        $data->category_name = $request->category;
        $data->save();

        return redirect()->back()->with('message', 'Category added Successfully');
    }
    

    public function delete_category($id){
        $data = Category::find($id);
        
        $data->delete();

        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }


    // product add
    public function add_product(){
        $category = Category::all();
        return view('admin.product',compact('category'));
    }
    public function store_product(Request $request){
        $product = new Product;

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->dis_price;
        $product->category = $request->category;

        $image = $request->image;

        if ($image) {
            
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imageName);
            $product->image=$imageName;

            
            $product->save();
            return redirect()->back()->with('message', 'Product Added Successfully');
        }

    }


    public function view_product(){
        $product = Product::all();
        return view('admin.view_product',compact('product'));
    }


    public function product_delete($id){
        $product = Product::find($id);
        $product->delete();
        return redirect()->back();
    }
    //update room
    public function product_update($id){

        $product = Product::find($id);
        $category = Category::all();

        return view('admin.update_product', compact('product','category'));
    }
    public function edit_product(Request $request, $id){
        $product = Product::find($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->dis_price;
        $product->category = $request->category;

        $image = $request->image;

        if ($image) {
            
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imageName);
            $product->image=$imageName;
        }

        $product->save();
        return redirect()->back()->with('message', 'Product Updated Successfully');
    }


    // order part
    public function order(){
        $order = Order::all();
        return view('admin.order',compact('order'));
    }

    public function delivered($id){
        $order = Order::find($id);
        $order->delivery_status = "Delivered";
        $order->payment_status = "Paid";
        $order->save();
        return redirect()->back();
    }

    public function print_pdf($id){
        $order = Order::find($id);
        $pdf = PDF::loadView('admin.pdf',compact('order'));
        return $pdf->download('order_details.pdf');
    }

    public function send_email($id){
        $order = Order::find($id);
        return view('admin.email_info',compact('order'));
    }

    public function send_user_email(Request $request, $id){
        $order = Order::find($id);

        $details = [
            'greeting'=>$request->greeting,
            'firstline'=>$request->firstline,
            'body'=>$request->body,
            'button'=>$request->button,
            'url'=>$request->url,
            'lastline'=>$request->lastline,
        ];
        Notification::send($order, new SendEmailNotification($details));
        return redirect()->back();
    }


    public function searchData(Request $request){
        $searchText = $request->search;
        $order = Order::where('name','LIKE',"%$searchText%")
                        ->orWhere('phone','LIKE',"%$searchText%")
                        ->orWhere('product_title','LIKE',"%$searchText%")->get();

        return view('admin.order',compact('order'));
    }


    //for contact message
    public function all_messages(){
        $data = Contact::all();
        return view('admin.all_messages',compact('data'));
    }
}
