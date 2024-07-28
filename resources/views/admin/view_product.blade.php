<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')

    <style type="text/css">
        .h2_font{
            text-align: center;
            font-size: 40px;
        }
        .table_deg{
            border: 2px solid white;
            margin: auto;
            width: 80%;
            text-align: center;
            margin-top: 40px;
        }
        .th_deg{
            background: white;
            color: black;
            padding: 15px;
        }
        tr{
            border: 3px solid white;
        }
        td{
            padding: 10px;
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

                <h2 class="h2_font">All Products</h2>

                <table class="table_deg">
                    <tr>
                        <th class="th_deg">Product Title</th>
                        <th class="th_deg">Description</th>
                        <th class="th_deg">Quantity</th>
                        <th class="th_deg">Category</th>
                        <th class="th_deg">Price</th>
                        <th class="th_deg">Discount Price</th>
                        <th class="th_deg">Product Image</th>
                        <th class="th_deg">Action</th>
                        {{-- <th class="th_deg">Update</th> --}}
                    </tr>

                    @foreach ($product as $product)
                        <tr>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->discount_price }}</td>
                            <td>
                                <img style="height: 100px;" width="100" src="/product/{{ $product->image }}" alt="">
                            </td>
                            

                            <td>
                                <a onclick="return confirm('Are you sure to delete this?');" class="btn btn-danger" href="{{ url('product_delete', $product->id) }}">Delete</a>
                              
                                <a class="btn btn-primary" href="{{ url('product_update', $product->id) }}">Edit</a>
                              </td>
                        </tr>
                    @endforeach
                </table>


            </div>
        </div>
        



    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>