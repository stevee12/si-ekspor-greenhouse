<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (Route::is('dashboard'))
        {{ config('app.name', 'PT. Lazuard Agritech') }} | {{ __('Dashboard') }}
        @elseif (Route::is('products'))
        {{ config('app.name', 'PT. Lazuard Agritech') }} | {{ __('Products') }}
        @elseif (Route::is('products.edit'))
        {{ __('Edit Product') }}: {{ $product->name }} | {{ config('app.name', 'PT. Lazuard Agritech') }}
        @elseif (Route::is('orders'))
        {{ config('app.name', 'PT. Lazuard Agritech') }} | {{ __('Orders') }}
        @elseif (Route::is('orders.edit'))
        {{ __('Edit Order') }}: {{ $order->customer_name }} | {{ config('app.name', 'PT. Lazuard Agritech') }}
        @elseif (Route::is('customers'))
        {{ config('app.name', 'PT. Lazuard Agritech') }} | {{ __('Customers') }}
        @elseif (Route::is('customers.edit'))
        {{ __('Edit Customer') }}: {{ $order->name }} | {{ config('app.name', 'PT. Lazuard Agritech') }}
        @else
        {{ $title?? config('app.name', 'PT. Lazuard Agritech') }}
        @endif
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="app.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        .min-h-screen {
            background-color: rgb(231, 231, 231);
        }

        th.sort-table,
        th.sortable {
            position: relative;
            cursor: pointer;
        }

        th.sort-table i,
        th.sortable i {
            position: absolute;
            right: 10px;
            /* adjust the value to move the icon to the right edge */
            top: 50%;
            transform: translateY(-50%);
        }

        #date_from,
        #date_to {
            border: #121110;
            border-radius: 5px;
        }

        .three-dots {
            position: relative;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: #000;
            /* change background color to black */
            color: #fff;
            /* change text color to white */
        }

        input,
        textarea {
            border: none;
            border-radius: 5px;
            box-shadow: none;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>