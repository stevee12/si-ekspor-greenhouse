<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Order') }}
        </h2>
    </x-slot>

    <div class="container-fluid py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('order.update', $order->uuid) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Form fields for editing order data -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 form-group">
                            <label for="customer_name" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $order->customer_name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 form-group">
                            <label for="order_date" class="form-label">Order Date</label>
                            <input type="date" class="form-control" id="order_date" name="order_date" value="{{ $order->order_date }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 form-group">
                            <label for="item_name" class="form-label">Product Name</label>
                            <select id="item_name" class="form-control" name="item_name" onchange="calculateTotal()">
                                @foreach ($products as $product)
                                <option value="{{ $product->name }}" data-price="{{ $product->price }}" data-code="{{ $product->code }}" {{ $order->item_name == $product->name ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 form-group">
                            <label for="product_code" class="form-label">Product Code</label>
                            <input type="text" class="form-control" id="product_code" name="product_code" value="{{ $order->product_code }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 form-group">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $order->quantity }}" oninput="calculateTotal()">
                            <span id="quantity-error" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 form-group">
                            <label for="total" class="form-label">Total</label>
                            <input type="text" class="form-control" id="total" name="total" value="{{ $order->total }}" onchange="calculateTotal()">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 form-group">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" class="form-control" name="status">
                                <option value="pending" {{ $order->status == 'pending'? 'selected' : '' }}>Pending</option>
                                <option value="on_process" {{ $order->status == 'on_process'? 'selected' : '' }}>On Process</option>
                                <option value="completed" {{ $order->status == 'completed'? 'selected' : '' }}>Completed</option>
                                <option value="canceled" {{ $order->status == 'canceled'? 'selected' : '' }}>Canceled</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Order</button>
            </form>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var productName = document.getElementById('item_name').value;
                    var selectedOption = document.querySelector(`#item_name option[value="${productName}"]`);
                    var productCode = selectedOption.getAttribute('data-code');
                    document.getElementById('product_code').value = productCode;
                });
            </script>
            <script>
                document.getElementById('item_name').addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var productCode = selectedOption.getAttribute('data-code');
                    document.getElementById('product_code').value = productCode;
                });
            </script>
            <script>
                function calculateTotal() {
                    var productName = document.getElementById('item_name').value;
                    var quantity = document.getElementById('quantity').value;
                    if (!quantity || quantity.trim() === '') {
                        document.getElementById('quantity-error').innerHTML = 'Please enter a valid quantity';
                        document.getElementById('total').value = 0;
                        return;
                    }
                    var productPrice = parseFloat(document.querySelector(`#item_name option[value="${productName}"]`).getAttribute('data-price'));
                    if (isNaN(quantity) || isNaN(productPrice)) {
                        document.getElementById('quantity-error').innerHTML = 'Invalid quantity or product price';
                        document.getElementById('total').value = 0;
                        return;
                    }
                    var total = quantity * productPrice;
                    document.getElementById('total').value = total.toFixed(2);
                    document.getElementById('total_hidden').value = total.toFixed(2); // Update hidden field value
                    document.getElementById('quantity-error').innerHTML = ''; // Clear error message
                }

                // Call calculateTotal() when page loads to set initial total value
                calculateTotal();
            </script>
        </div>
    </div>
</x-app-layout>