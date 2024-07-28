<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>OnlineMart</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />

    <style type="text/css">
        .center {
            margin: auto;
            width: 80%;
            text-align: center;
            padding: 30px;
            background-color: #f8f9fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f7444e;
            color: white;
            font-size: 16px;
        }

        td {
            background-color: #ffffff;
        }

        .img_deg {
            width: 100px;
            height: 100px;
        }

        .total_deg {
            font-size: 20px;
            margin-top: 20px;
            padding: 10px;
            background-color: #f7444e;
            color: white;
            border-radius: 5px;
            display: inline-block;
        }

        .button a {
            padding: 10px 20px;
            margin: 5px;
            font-size: 15px;
            text-decoration: none;
        }

        .button a.btn-danger {
            background-color: #f7444e;
            color: white;
        }

        .button a.btn-danger:hover {
            background-color: #c82333;
            color: white;
        }

        .btn-primary {
            background-color: #f7444e;
            border: none;
            color: white;
        }

        .btn-primary:hover {
            background-color: #f7444e;
            color: white;
        }

        .cpy_ {
            padding: 20px;
            text-align: center;
            background-color: #343a40;
            color: white;
            margin-top: 20px;
        }

        .cpy_ a {
            color: #007bff;
            text-decoration: none;
        }

        .cpy_ a:hover {
            color: #0056b3;
        }

        .alert {
            width: 80%;
            margin: 20px auto;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

        <div>
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>

        <div class="center">
            <table>
                <tr>
                    <th>Product Title</th>
                    <th>Product Quantity</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                
                <?php $totalPrice = 0; ?>
                @foreach ($cart as $cart)
                    <tr>
                        <td>{{ $cart->product_title }}</td>
                        <td>{{ $cart->quantity }}</td>
                        <td>${{ $cart->price }}</td>
                        <td>
                            <img class="img_deg" src="/product/{{ $cart->image }}" alt="Product Image">
                        </td>
                        <td class="button">
                            <a onclick="return confirm('Are you sure to remove this product?')" class="btn btn-danger" href="{{ url('remove_cart', $cart->id) }}">Remove Product</a>
                        </td>
                    </tr>

                    <?php $totalPrice += $cart->price; ?>
                @endforeach
            </table>

            <div>
                <h1 class="total_deg">Total Price: ${{ $totalPrice }}</h1>
            </div>

            <div>
                <h1 style="font-size:25px;padding-bottom:15px;">Proceed to Order</h1>
                <a class="btn btn-primary" href="{{ url('cash_order') }}">Cash On Delivery</a>
                <a class="btn btn-primary" href="{{ url('stripe', $totalPrice) }}">Pay Using Card</a>
                <a class="btn btn-primary" href="{{ url('pay', $totalPrice) }}">Pay Using SSL</a>
            </div>
        </div>
    </div>

    <!-- footer start -->
    <div class="cpy_">
        <p class="mx-auto">© 2024, All Rights Reserved By <a href="https://arif0027.github.io/portfolio-arif/">M.H.Arif</a><br>
           Developed By <a href="https://arif0027.github.io/portfolio-arif/" target="_blank">Arif</a>
        </p>
    </div>
    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>
