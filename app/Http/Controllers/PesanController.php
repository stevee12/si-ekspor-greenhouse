<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use App\Mail\OrderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;


class PesanController extends Controller
{

    function generateRandomId($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function placeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_address' => 'required|string',
            'customer_phone' => 'required|string',
            'product_code' => 'required|exists:products,code',
            'quantity' => 'required|integer|min:1',
        ]);

        // Simpan data customer
        $customer = new Customer();
        $uuid = $this->generateRandomId(15);
        $customer->uuid = $uuid;
        $customer->name = $request->input('customer_name');
        $customer->address = $request->input('customer_address');
        $customer->email = $request->input('customer_email');
        $customer->phone = $request->input('customer_phone');
        $customer->save();

        // Simpan data order

        $product = Product::where('code', $request->input('product_code'))->first();

        $order = new Order();
        $uuid = $this->generateRandomId(15);
        $order->uuid = $uuid;
        $order->customer_name = $request->input('customer_name');
        $order->order_date = now();
        $order->product_code = $product->code;
        $order->item_name = $product->name;
        $order->quantity = $request->input('quantity');
        $order->total = $product->price * $request->input('quantity');
        $order->status = 'pending';
        $order->save();

        Mail::to($customer->email)->send(new OrderMail($order));

        return redirect()->back()->with('success', 'Order placed successfully!');
    }
}
