<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Products') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('product.update', $product->name) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" class="form-control" id="code" name="code" value="{{ $product->code }}" disabled>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" disabled>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="text" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</x-app-layout>