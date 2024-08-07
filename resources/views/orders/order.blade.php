<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>
    <!-- view_order.php -->
    <div class="container-fluid py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-2 flex justify-content-between">
                <input type="text" id="search" placeholder="Search..." style="width: 23.5%;" autofocus>
            </div>
            <div class="pb-2 flex justify-content-between">
                <select id="status" class="form-control" style="width: 40%;" onchange="filterByStatus(this.value)">
                    <option value="" selected disabled hidden>-- Status --</option>
                    <option value="">All</option>
                    <option value="pending">Pending</option>
                    <option value="on_process">On Process</option>
                    <option value="completed">Completed</option>
                    <option value="canceled">Canceled</option>
                </select>
                <div class="input-group flex justify-content-end">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#orderModal" class="btn btn-outline-success ml-2" id="add-button">+ Add Order</a>
                </div>
            </div>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @elseif (session('danger'))
            <div class="alert alert-danger">
                {{ session('danger') }}
            </div>
            @endif
            <table class="table table-hover table-bordered" id="order-table">
                <thead class="table-dark header-row">
                    <tr>
                        <th scope="col" style="width: 3%;">#</th>
                        <th scope="col" style="width: 10%;">Order Date</th>
                        <th scope="col" style="width: 18%;">Customer Name</th>
                        <th scope="col" style="width: 11%;">Product Code</th>
                        <th scope="col" style="width: 12%;">Product Name</th>
                        <th scope="col" style="width: 5%;">Quantity</th>
                        <th scope="col" style="width: 10%;" class="text-center">Total</th>
                        <th scope="col" style="width: 12%; text-align: center;">Status</th>
                        <th scope="col" style="width: 5%;" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider table-responsive" id="order-table">
                    <?php $i = 1; ?>
                    @forelse ($orders as $order)
                    <tr data-row-index="{{ $i }}" data-status="{{ $order->status }}">
                        <td>{{ $i++ }}</td>
                        <td>{{ date('d-m-Y', strtotime($order->order_date)) }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->product_code }}</td>
                        <td>{{ $order->item_name }}</td>
                        <td style="text-align: end;">{{ $order->quantity }}</td>
                        <td style="text-align: end;">{{ $order->total }}</td>
                        <td class="text-center">
                            @if ($order->status == 'pending')
                            <span class="badge text-bg-warning text-white"><i class="bi bi-clock"></i> Pending</span>
                            @elseif ($order->status == 'on_process')
                            <span class="badge text-bg-info text-white"><i class="bi bi-arrow-clockwise"></i> On Process</span>
                            @elseif ($order->status == 'completed')
                            <span class="badge text-bg-success" style="color: #000;"><i class="bi bi-check2-circle"></i> Completed</span>
                            @elseif ($order->status == 'canceled')
                            <span class="badge text-bg-danger" style="color: #000;"><i class="bi bi-x-circle"></i> Canceled</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <span class="dropdown three-dots" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </span>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('order.details', $order->uuid) }}" target="_blank">Details</a>
                                    <a class="dropdown-item" href="{{ route('order.edit', $order->uuid) }}" id="edit-button">Edit</a>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $order->uuid }}" id="delete-modal">Delete</a>
                                </div>
                            </div>
                            <div class="modal fade" id="deleteModal-{{ $order->uuid }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Order</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this order?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <a href="{{ route('order.delete', $order->id) }}" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">
                            <div class="alert alert-warning">
                                NO ORDERS FOUND!
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center" style="width: auto;">
                    <li class="page-item {{ $orders->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $orders->previousPageUrl() }}">Previous</a>
                    </li>
                    @for ($i = 1; $i <= $orders->lastPage(); $i++)
                        <li class="page-item {{ $orders->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $orders->url($i) }}">{{ $i }}</a>
                        </li>
                        @endfor
                        <li class="page-item {{ $orders->onLastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $orders->nextPageUrl() }}">Next</a>
                        </li>
                </ul>
            </nav>
            <!-- Modal ADD -->
            <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header text-white">
                            <h5 class="modal-title" id="exampleModalLabel">Add Order</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Alert Success -->
                        <div id="success-alert" class="alert alert-success" role="alert" style="display: none;">
                            Order added successfully.
                        </div>
                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3 form-group">
                                    <label for="customer_name" class="form-label">Customer Name</label>
                                    <select name="customer_name" id="customer_name" class="form-control">
                                        <option value="" selected hidden>--- Select Customer ---</option>
                                        @foreach ($customers as $customer)
                                        <option value="{{ $customer->name }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="order_date" class="form-label">Order Date</label>
                                    <input type="date" class="form-control" id="order_date" name="order_date">
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="item_name" class="form-label">Product Name</label>
                                    <select id="item_name" class="form-control" name="item_name">
                                        <option value="" selected disabled hidden>-- Select Product --</option>
                                        @foreach ($products as $product)
                                        <option value="{{ $product->name }}" data-code="{{ $product->code }}" data-stock="{{ $product->stock }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="product_code" class="form-label">Product Code</label>
                                    <input type="text" class="form-control" id="product_code" name="product_code">
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" oninput="calculateTotal()">
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="total" class="form-label">Total</label>
                                    <input type="text" class="form-control" id="total" name="total">
                                    <span id="quantity-error" style="color: red;"></span>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <select id="status" class="form-control" name="status">
                                        <option value="pending">Pending</option>
                                        <option value="on_process">On Process</option>
                                        <option value="completed">Completed</option>
                                        <option value="canceled">Canceled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        <script>
                            function calculateTotal() {
                                var productName = document.getElementById('item_name').value;
                                var quantity = document.getElementById('quantity').value;
                                var selectedOption = document.querySelector(`#item_name option[value="${productName}"]`);
                                var productPrice = selectedOption.getAttribute('data-price');
                                var total = quantity * productPrice;
                                document.getElementById('total').value = total.toFixed(2);
                            }
                        </script>
                        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('item_name').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var productCame = selectedOption.getAttribute('data-code');
            document.getElementById('product_code').value = productCame;
        });
    </script>
    <script>
        $(document).ready(function() {
            var searchTerm = localStorage.getItem('search');
            if (searchTerm) {
                $('#search').val(searchTerm);
            }

            $('#search').on('keyup', function() {
                var searchTerm = $(this).val().toLowerCase();
                $('#order-table tbody tr').each(function() {
                    var customerName = $(this).find('td:nth-child(3)').text().toLowerCase();
                    var productName = $(this).find('td:nth-child(5)').text().toLowerCase();
                    var rowText = customerName + '' + productName;
                    if (rowText.indexOf(searchTerm) === -1) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
                localStorage.setItem('search', searchTerm);
            });
        });
    </script>
    <script>
        function filterByStatus(status) {
            $('#order-table tbody tr').each(function() {
                var rowStatus = $(this).data('status');
                if (status === '' || rowStatus === status) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    </script>
    <script>
        const customerSelect = document.getElementById('customer_name');
        const customerOptions = customerSelect.options;

        customerSelect.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            Array.prototype.forEach.call(customerOptions, function(option) {
                const customerName = option.text.toLowerCase();
                if (customerName.indexOf(searchTerm) === -1) {
                    option.style.display = 'none';
                } else {
                    option.style.display = 'block';
                }
            });
        });
    </script>
</x-app-layout>