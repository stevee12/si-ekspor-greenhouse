<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
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
        $customers = Customer::paginate(5);
        return view('customers.customer', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $customer = new Customer();
        $uuid = $this->generateRandomId(15);
        $customer->uuid = $uuid;
        $customer->name = $request->input('name');
        $customer->address = $request->input('address');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');
        $customer->save();
        return redirect()->route('customers')->with('success', 'Customer added successfully!');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->address = $request->input('address');
        $customer->phone = $request->input('phone');
        $customer->save();
        return redirect()->route('customers')->with('success', 'Customer updated successfully!');
    }

    public function delete($uuid)
    {
        $customer = Customer::find($uuid);
        $customer->delete();
        session()->flash('danger', 'Order deleted successfully!!');
        return redirect()->route('customers');
    }
}
