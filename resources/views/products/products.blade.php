<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    <div class="container-fluid py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <?php
            $jenisNames = [
                'BU' => 'Buah',
                'SA' => 'Sayur',
                'GRE' => 'Greenhouse',
            ];
            ?>
            <div class="py-2 flex justify-content-between">
                <input type="text" id="search" placeholder="Search..." style="width: 23.5%;" autofocus>
            </div>
            <div class="pb-2 flex justify-content-between">
                <select id="category" class="form-control" onload="setDefaultCategory()" style="width: 40%;">
                    <option value="" selected disabled hidden>-- Category --</option>
                    <option value="">All</option>
                    @foreach ($jenisNames as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                <div class="input-group mb-1 flex justify-content-end">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#productModal" class="btn btn-outline-success ml-2">+ Add Product</a>
                </div>
            </div>
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" style="width: 3%;">#</th>
                        <th scope="col" style="width: 22%;">
                            <span>Category</span>
                        </th>
                        <th scope="col" style="width: 25%;">Product Name</th>
                        <th scope="col" style="width: 25%;" class="sort-table" data-sort-key="price">Price <i class="bi bi-chevron-down"></i></th>
                        <th scope="col" style="width: 10%;" class="sortable" data-sort-key="stock">Stock <i class="bi bi-chevron-down"></i></th>
                        <th scope="col" style="width: 15%;" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider table-responsive" id="product-table">
                    <?php $i = 1; ?>
                    @forelse ($products as $products)
                    <tr data-row-index="{{ $i }}" data-jenis="{{ $products->jenis }}">
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $jenisNames[$products->jenis] }}</td>
                        <td>{{$products->name}}</td>
                        <td>{{$products->price}}</td>
                        <td>{{$products->stock}}</td>
                        <td class="text-center">
                            <a href="{{ route('product.edit', $products->name) }}" class="btn btn-outline-warning" title="Edit">
                                Edit
                            </a>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $products->uuid }}" title="Delete">
                                Delete
                            </button>
                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal-{{ $products->uuid }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete {{ $products->name }}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('product.destroy', $products->name) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
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
                                DATA PRODUCT STILL EMPTY!! TRY ADD ONE
                            </div>
                        </td>
                    </tr>
                    @endforelse
                    @if ($errors->has('name'))
                    <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal ADD -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Alert Success -->
                <div id="success-alert" class="alert alert-success" role="alert" style="display: none;">
                    Product added successfully.
                </div>
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 form-group">
                            <label for="jenis" class="form-label">Jenis</label>
                            <select name="jenis" id="jenis" class="form-control">
                                <option value="" selected disabled hidden>-- Pilih Jenis --</option>
                                <option value="BU">Buah</option>
                                <option value="SA">Sayur</option>
                                <option value="GRE">Greenhouse</option>
                            </select>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="name" class="form-label">Code</label>
                            <input type="text" class="form-control" id="code" name="code" readonly>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="name" class="form-label">Name Product</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Product Price</label>
                            <input type="number" class="form-control" id="price" name="price"> /kg
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock Product</label>
                            <input type="number" class="form-control" id="stock" name="stock"> kg
                        </div>
                        <div class="mb-3 form-group">
                            <label for="image" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

                <script>
                    $(document).ready(function() {
                        $('#jenis').change(function() {
                            var selectedJenis = $(this).val();
                            var code = selectedJenis + '-' + Math.floor(Math.random() * 10000);
                            $('#code').val(code);
                        });
                    });

                    $('#productForm').submit(function(event) {
                        event.preventDefault();
                        // Logic to handle form submission
                        alert('Form submitted with values: ' + $(this).serialize());
                    });
                </script>
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
                if (searchTerm === '') {
                    localStorage.removeItem('search');
                } else {
                    localStorage.setItem('search', searchTerm);
                }
                $('#product-table tr').each(function() {
                    var rowText = $(this).text().toLowerCase();
                    if (rowText.indexOf(searchTerm) === -1) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('load', () => {
            const getCellValue = (tr, idx) => tr.children[idx].dataset.sortKey || tr.children[idx].textContent;
            const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
                v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
            )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

            document.querySelectorAll('th.sortable').forEach(th => th.addEventListener('click', (() => {
                let asc = true;
                return function() {
                    const table = th.closest('table');
                    const tbody = table.querySelector('tbody');
                    Array.from(tbody.querySelectorAll('tr'))
                        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), asc = !asc))
                        .forEach(tr => tbody.appendChild(tr));

                    document.querySelectorAll('th.sortable i').forEach(icon => {
                        icon.classList.remove('bi-chevron-up', 'bi-chevron-down');
                        icon.classList.add('bi-chevron-down');
                    });
                    const icon = th.querySelector('i');
                    icon.classList.toggle('bi-chevron-down', !asc);
                    icon.classList.toggle('bi-chevron-up', asc);
                };
            })()));
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const getCellValue = (tr, idx) => tr.children[idx].dataset.sortKey || tr.children[idx].textContent;
            const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
                v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
            )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

            document.querySelectorAll('th.sort-table').forEach(th => th.addEventListener('click', (() => {
                let asc = true;
                return function() {
                    const table = th.closest('table');
                    const tbody = table.querySelector('tbody');
                    Array.from(tbody.querySelectorAll('tr'))
                        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), asc = !asc))
                        .forEach(tr => tbody.appendChild(tr));

                    document.querySelectorAll('th.sort-table i').forEach(icon => {
                        icon.classList.remove('bi-chevron-up', 'bi-chevron-down');
                        icon.classList.add('bi-chevron-down');
                    });
                    const icon = th.querySelector('i');
                    icon.classList.toggle('bi-chevron-down', !asc);
                    icon.classList.toggle('bi-chevron-up', asc);
                };
            })()));
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#category').on('change', function() {
                var category = $(this).val();
                $('#product-table tr').each(function() {
                    var rowJenis = $(this).data('jenis');
                    if (category && rowJenis !== category) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });

            });
        });
    </script>
</x-app-layout>