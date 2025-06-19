<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        :root {
            --primary: #0984e3;
            --secondary: #74b9ff;
            --dark: #2d3436;
            --light: #dfe6e9;
            --white: #ffffff;
        }

        .container {
            width: 80%;
            margin: 2rem auto;
            padding: 2rem;
            background: var(--white);
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: var(--dark);
            margin-bottom: 2rem;
            font-size: 2.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--light);
        }

        th {
            background-color: #f8f9fa;
            color: var(--dark);
            font-weight: 600;
        }

        tbody tr:hover {
            background-color: rgba(116, 185, 255, 0.05);
        }

        .btn {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn:hover {
            background: var(--secondary);
            transform: translateY(-2px);
        }

        .remove-btn {
            background: #e74c3c;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .remove-btn:hover {
            background: #c0392b;
        }

        .checkout-btn {
            background: #27ae60;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            display: block;
            width: 100%;
            max-width: 300px;
            margin: 2rem auto;
            text-align: center;
        }

        .checkout-btn:hover {
            background: #219653;
        }

        .empty-cart {
            text-align: center;
            padding: 3rem;
            color: #666;
        }

        .empty-cart a {
            color: var(--primary);
            text-decoration: none;
        }

        .empty-cart a:hover {
            text-decoration: underline;
        }

        .tfoot-row {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .product-cell {
            display: flex;
            align-items: center;
        }

        .product-img {
            width: 60px;
            height: 60px;
            border-radius: 4px;
            margin-right: 1rem;
            object-fit: cover;
        }

         /* Tambahkan style untuk notifikasi error */
         .alert-error {
            background: #e74c3c;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <x-navigation-home-user />

    <div class="container">
        <h1>Shopping Cart</h1>

        @if(session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif

        @if (count($cartItems) > 0)
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $index => $item)
                        <tr>
                            <td class="product-cell">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="product-img">
                                {{ $item['name'] }}
                            </td>
                            <td>${{ number_format($item['price'], 0) }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>${{ number_format($item['price'] * $item['quantity'], 0) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $index) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="remove-btn">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="tfoot-row">
                        <td colspan="3" style="text-align: right;">Grand Total</td>
                        <td><strong>${{ number_format($total, 0) }}</strong></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn checkout-btn">Proceed to Checkout</button>
            </form>
        @else
            <div class="empty-cart">
                <p>Your cart is empty</p>
                <p><a href="{{ route('dashboard') }}">Continue shopping</a></p>
            </div>
        @endif
    </div>
</body>
</html>