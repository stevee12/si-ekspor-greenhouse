<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="container-fluid py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-2 flex justify-content-between">
                <input type="text" id="search" placeholder="Search..." style="width: 23.5%;" autofocus>
                <a href="#" data-bs-toggle="modal" data-bs-target="#customerModal" class="btn btn-outline-success ml-2">+ Add Customer</a>
            </div>
            <div class="pb-2 flex justify-content-between">
                <div class="input-group flex justify-content-end">
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
            <table class="table table-hover table-bordered" id="customer-table">
                <thead class="table-dark header-row">
                    <tr>
                        <th scope="col" style="width: 3%;">#</th>
                        <th scope="col" style="width: 15%;">Customer Name</th>
                        <th scope="col" style="width: 20%;">Email</th>
                        <th scope="col" style="width: 15%;">Phone</th>
                        <th scope="col" style="width: 30%;">Address</th>
                        <th scope="col" style="width: 5%;" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider table-responsive" id="customer-table">
                    <?php $i = 1; ?>
                    @forelse ($customers as $customer)
                    <tr data-row-index="{{ $i }}">
                        <td>{{ $i++ }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->address }}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <span class="dropdown three-dots" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </span>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('customer.edit', $customer->uuid) }}">Edit</a>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $customer->uuid }}">Delete</a>
                                </div>
                            </div>
                            <div class="modal fade" id="deleteModal-{{ $customer->uuid }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Customer</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this customer?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <a href="{{ route('customer.delete', $customer->id) }}" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            <div class="alert alert-warning">
                                NO CUSTOMERS FOUND!
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center" style="width: auto;">
                    <li class="page-item {{ $customers->onFirstPage()? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $customers->previousPageUrl() }}">Previous</a>
                    </li>
                    @for ($i = 1; $i <= $customers->lastPage(); $i++)
                        <li class="page-item {{ $customers->currentPage() == $i? 'active' : '' }}">
                            <a class="page-link" href="{{ $customers->url($i) }}">{{ $i }}</a>
                        </li>
                        @endfor
                        <li class="page-item {{ $customers->onLastPage()? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $customers->nextPageUrl() }}">Next</a>
                        </li>
                </ul>
            </nav>
            <!-- Modal ADD -->
            <div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Alert Success -->
                        <div id="success-alert" class="alert alert-success" role="alert" style="display: none;">
                            Customer added successfully.
                        </div>
                        <form action="{{ route('customer.create') }}" method="POST" id="add-customer-form">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3 form-group">
                                    <label for="name" class="form-label">Customer Name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                    <span class="text-danger" id="name-error"></span>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                    <span class="text-danger" id="email-error"></span>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                    <span class="text-danger" id="phone-error"></span>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" name="address" id="address"></textarea>
                                    <span class="text-danger" id="address-error"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var searchTerm = localStorage.getItem('search');
            if (searchTerm) {
                $('#search').val(searchTerm);
            }

            $('#search').on('keyup', function() {
                var searchTerm = $(this).val().toLowerCase();
                $('#customer-table tbody tr').each(function() {
                    var customerName = $(this).find('td:nth-child(2)').text().toLowerCase();
                    var rowText = customerName;
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
        $(document).ready(function() {
            var searchTerm = localStorage.getItem('search');
            if (searchTerm) {
                $('#search').val(searchTerm);
            }

            $('#search').on('keyup', function() {
                var searchTerm = $(this).val().toLowerCase();
                $('#customer-table tbody tr').each(function() {
                    var customerName = $(this).find('td:nth-child(2)').text().toLowerCase();
                    var rowText = customerName;
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
</x-app-layout>