<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="container-fluid py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-2 justify-content-between">
                <div class="bg-white shadow-md rounded px-4 py-4">
                    <h4 class="text-lg font-bold mb-2">Order Information</h4>
                    <div class="flex flex-wrap -mx-4">
                        <div class="w-1/2 p-4">
                            <p class="text-gray-600">Order Date :</p>
                            <p class="text-lg">{{ date('d-m-Y', strtotime($order->order_date)) }}</p>
                            <p class="text-gray-600">Customer Name :</p>
                            <p class="text-lg">{{ $order->customer_name }}</p>
                            <p class="text-gray-600">Phone Number :</p>
                            <p class="text-lg">{{ $customer->phone }}</p>
                        </div>
                        <div class="w-1/2 p-4">
                            <p class="text-gray-600">Email :</p>
                            <p class="text-lg">{{ $customer->email }}</p>
                            <p class="text-gray-600">Address :</p>
                            <p class="text-lg">{{ $customer->address }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-md rounded px-4 py-4">
                    <h4 class="text-lg font-bold mb-2">Product Information</h4>
                    <div class="flex flex-wrap -mx-4">
                        <div class="w-1/2 p-4">
                            <p class="text-gray-600">Product Code :</p>
                            <p class="text-lg">{{ $order->product_code }}</p>
                            <p class="text-gray-600">Product Name :</p>
                            <p class="text-lg">{{ $order->item_name }}</p>
                        </div>
                        <div class="w-1/2 p-4">
                            <p class="text-gray-600">Quantity :</p>
                            <p class="text-lg">{{ $order->quantity }}</p>
                            <p class="text-gray-600">Total :</p>
                            <p class="text-lg">{{ $order->total }}</p>
                            <p class="text-gray-600">Status :</p>
                            <p class="text-lg">{{ $order->status }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>