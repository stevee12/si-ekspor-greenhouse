<!-- edit_customer.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Customer') }}
        </h2>
    </x-slot>

    <div class="container-fluid py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('customer.update', $customer->uuid) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Form fields for editing customer data -->
                <div class="mb-3 form-group">
                    <label for="name" class="form-label">Customer Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}">
                </div>
                <div class="mb-3 form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $customer->email) }}">
                    <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                </div>
                <div class="mb-3 form-group">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}">
                </div>
                <div class="mb-3 form-group">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address">{{ $customer->address }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update Customer</button>
            </form>
        </div>
    </div>
</x-app-layout>