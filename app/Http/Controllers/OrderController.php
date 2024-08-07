<?php

// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class OrderController extends Controller
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

    public function index()
    {
        $orders = Order::with('product')->paginate(5);
        $products = Product::all();
        $customers = Customer::all();
        return view('orders.order', compact('orders', 'products', 'customers'));
    }

    public function store(Request $request)
    {
        $order = new Order();
        $uuid = $this->generateRandomId(10);
        $order->uuid = $uuid;
        $order->customer_name = $request->input('customer_name');
        $order->order_date = $request->input('order_date');
        $order->product_code = $request->input('product_code');
        $order->item_name = $request->input('item_name');
        $order->quantity = $request->input('quantity');
        $order->total = $request->input('total');
        $order->status = $request->input('status');
        $order->save();

        $product = Product::where('code', $request->input('product_code'))->first();
        if ($product) {
            $product->stock -= $request->input('quantity');
            $product->save();
        }
        session()->flash('success', 'Order added successfully!!');
        return redirect()->route('orders');
    }

    public function edit($uuid)
    {
        $order = Order::where('uuid', $uuid)->first();
        $products = Product::all();
        return view('orders.edit', compact('order', 'products'));
    }

    public function update(Request $request, $uuid)
    {
        $order = Order::where('uuid', $uuid)->first();
        $order->customer_name = $request->input('customer_name');
        $order->order_date = $request->input('order_date');
        $order->product_code = $request->input('product_code');
        $order->item_name = $request->input('item_name');
        $order->quantity = $request->input('quantity');
        $order->total = $request->input('total');
        $order->status = $request->input('status');
        $order->save();

        $product = Product::where('code', $request->input('product_code'))->first();
        if ($product) {
            $oldQuantity = $order->getOriginal('quantity');
            $newQuantity = $request->input('quantity');
            $quantityDiff = $newQuantity - $oldQuantity;

            if ($quantityDiff > 0) {
                $product->stock -= $quantityDiff;
            } elseif ($quantityDiff < 0) {
                $product->stock += abs($quantityDiff);
            }

            $product->save();
        }
        session()->flash('success', 'Data edited successfully!!');
        return redirect()->route('orders');
    }

    public function delete($uuid)
    {
        $order = Order::find($uuid);
        $order->delete();
        session()->flash('danger', 'Order deleted successfully!!');
        return redirect()->route('orders');
    }

    public function details($uuid)
    {
        $order = Order::where('uuid', $uuid)->first();
        $customer = Customer::where('name', $order->customer_name)->first();
        return view('orders.detail', compact('order', 'customer'));
    }

    public function sendOrderEmail(Request $request)
    {
        $data = $request->all();

        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'quantity' => 'required|integer|min:1',
            'product_name' => 'required|string|max:255',
        ]);

        // Kirim email
        Mail::to($request->email)->send(new OrderMail($data));

        return back()->with('success', 'Pesanan Anda telah dikirim.');
    }
}
