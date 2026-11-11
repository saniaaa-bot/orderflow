<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image_url" => $product->image_url
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Item added to bag successfully!');
    }

    public function remove(Request $request, Product $product)
    {
        $cart = session()->get('cart');
        if(isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Item removed from bag!');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
        ]);

        $cart = session()->get('cart');
        if(!$cart) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        DB::beginTransaction();
        try {
            $total = 0;
            foreach($cart as $id => $details) {
                $product = Product::find($id);
                
                if(!$product || $product->stock < $details['quantity']) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Sorry, ' . ($product ? $product->name : 'Item') . ' is out of stock or insufficient quantity!');
                }
                
                $total += $product->price * $details['quantity'];
            }

            $order = Order::create([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'total_amount' => $total,
                'status' => 'Pending'
            ]);

            foreach($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price']
                ]);

                $product = Product::find($id);
                $product->stock -= $details['quantity'];
                $product->save();
            }

            DB::commit();
            session()->forget('cart');
            return redirect()->route('home')->with('success', 'Order placed successfully! Thank you.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}