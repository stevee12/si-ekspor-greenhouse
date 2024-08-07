<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-md">
                        <div class="card-header bg-primary text-white">
                            <i class="bi bi-profile"></i> Welcome, {{ Auth::user()->name }}!
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <!-- Example Card for Counting Data -->
                                <div class="col-md-4">
                                    <div class="card text-white bg-success mb-3">
                                        <div class="card-header">
                                            <i class="bi bi-box"></i> Total Products
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $productsCount }}</h5>
                                            <p class="card-text">Number of products in the database.</p>
                                            <a href="{{ route('products') }}" class="btn btn-sm btn-success">View Products</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- You can add more cards here for other counts, like Orders, Customers, etc. -->
                                <div class="col-md-4">
                                    <div class="card text-white bg-info mb-3">
                                        <div class="card-header">
                                            <i class="bi bi-cart"></i> Total Orders
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $ordersCount }}</h5>
                                            <p class="card-text">Number of orders in the database.</p>
                                            <a href="{{ route('orders') }}" class="btn btn-sm btn-info text-white">View Orders</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card text-white bg-warning mb-3">
                                        <div class="card-header">
                                            <i class="bi bi-person"></i> Total Customers
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"> {{ $customersCount }}</h5>
                                            <p class="card-text">Number of customers in the database.</p>
                                            <a href="{{ route('customers') }}" class="btn btn-sm btn-warning text-white">View Customers</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Add a simple table to display some data -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h4>Recent Orders</h4>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order</th>
                                                <th>Customer Name</th>
                                                <th>Order Date</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentOrders as $order)
                                            <tr>
                                                <td>{{ $order->uuid }}</td>
                                                <td>{{ $order->customer_name }}</td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>{{ $order->total }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>