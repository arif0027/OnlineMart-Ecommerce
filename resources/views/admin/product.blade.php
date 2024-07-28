<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')

    <style type="text/css">
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Arial', sans-serif;
        }

        .div_center {
            text-align: center;
            padding: 50px;
            background-color: #1e1e1e;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            max-width: 600px;
            margin: auto;
        }

        .h2_font {
            font-size: 36px;
            padding-bottom: 30px;
            color: #ff6f61;
        }

        .form_group {
            margin-bottom: 20px;
            text-align: left;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }

        .form_group label {
            width: 100%;
            font-weight: bold;
            margin-bottom: 5px;
            color: #ff6f61;
        }

        .form_group input,
        .form_group select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #333;
            background-color: #2c2c2c;
            color: #fff;
        }

        .form_group input[type="file"] {
            padding: 3px;
        }

        .btn-primary {
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #ff6f61;
            border: none;
            margin-top: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #e65c54;
        }

        .alert {
            width: 50%;
            margin: 20px auto;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')

        <div class="main-panel">
            <div class="content-wrapper">

                <div>
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </div>

                <div class="div_center">
                    <h2 class="h2_font">Add Product</h2>

                    <form action="{{ url('/store_product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form_group">
                            <label for="title">Product Title:</label>
                            <input class="form-control" type="text" id="title" name="title" placeholder="Write a title" required>
                        </div>
                        <div class="form_group">
                            <label for="description">Product Description:</label>
                            <input class="form-control" type="text" id="description" name="description" placeholder="Write a description">
                        </div>
                        <div class="form_group">
                            <label for="price">Product Price:</label>
                            <input class="form-control" type="number" id="price" name="price" min="0" placeholder="Write a price" required>
                        </div>
                        <div class="form_group">
                            <label for="dis_price">Discount Price:</label>
                            <input class="form-control" type="number" id="dis_price" name="dis_price" placeholder="Write a discount price">
                        </div>
                        <div class="form_group">
                            <label for="quantity">Product Quantity:</label>
                            <input class="form-control" type="number" id="quantity" name="quantity" min="0" placeholder="Write a quantity" required>
                        </div>
                        <div class="form_group">
                            <label for="category">Product Category:</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="" selected>Add a Category here</option>
                                @foreach ($category as $category)
                                    <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form_group">
                            <label for="image">Product Image:</label>
                            <input type="file" id="image" name="image" required>
                        </div>
                        <div class="form_group">
                            <input class="btn-primary" type="submit" value="Add Product">
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>

    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>

</html>
