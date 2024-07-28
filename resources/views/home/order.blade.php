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
            padding: 30px;
            text-align: center;
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
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #f7444e;
            color: white;
            font-size: 18px;
            font-weight: 700;
        }

        td {
            background-color: #ffffff;
        }

        .img_size {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
        }

        .button a {
            padding: 10px 20px;
            margin: 5px;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }

        .button a.btn-danger {
            background-color: #dc3545;
            color: white;
            border-radius: 5px;
        }

        .button a.btn-danger:hover {
            background-color: #c82333;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            color: white;
        }

        .not-allowed {
            color: blue;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- header section starts -->
    @include('home.header')
    <!-- header section ends -->

    <div class="center">
        <table>
            <tr>
                <th>Product Title</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Payment Status</th>
                <th>Delivery Status</th>
                <th>Image</th>
                <th>Action</th>
            </tr>

            @foreach ($order as $order)
                <tr>
                    <td>{{ $order->product_title }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>${{ $order->price }}</td>
                    <td>{{ $order->payment_status }}</td>
                    <td>{{ $order->delivery_status }}</td>
                    <td>
                        <img class="img_size" src="product/{{ $order->image }}" alt="Product Image">
                    </td>

                    <td class="button">
                        @if ($order->delivery_status == 'processing')
                            <a onclick="return confirm('Are you sure to cancel this order?')" class="btn btn-danger" href="{{ url('cancel_order', $order->id) }}">Cancel Order</a>
                        @else
                            <p class="not-allowed">Not Allowed</p>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <!-- jQuery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>
    