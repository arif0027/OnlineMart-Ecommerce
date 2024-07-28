<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')

    <style type="text/css">
        .title_deg {
            text-align: center;
            font-size: 20px;
            font-weight: 700;
        }

        .table_deg{
            border: 2px solid white;
            margin: auto;
            width: 100%;
            text-align: center;
            margin-top: 40px;
        }
        .th_deg{
            font-size: 15px;
            background: white;
            color: black;
            padding: 15px;
            font-weight: 700;
        }
        tr{
            border: 3px solid white;
        }
        td{
            font-size: 13px;
            padding: 10px;
        } 
        .img_size{
            height: 100px;
            width: 100px;
        }
    </style>


  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
        

        <div class="main-panel">
            <div class="content-wrapper">
                    <h1 class="title_deg">All Orders</h1>

                    <div style="padding-left:850px; padding-top:30px;">
                        <form action="{{ url('search') }}" method="get">
                            @csrf
                            <input style="color: black;" type="text" name="search" placeholder="Search for something">
                            <input type="submit" value="search" class="btn btn-outline-primary">
                        </form>
                    </div>

                    <table class="table_deg">
                        <tr>
                            <th class="th_deg">Name</th>
                            <th class="th_deg">Email</th>
                            <th class="th_deg">Phone</th>
                            <th class="th_deg">Product Title</th>
                            <th class="th_deg">Quantity</th>
                            <th class="th_deg">Price</th>
                            <th class="th_deg">Payment Status</th>
                            <th class="th_deg">Delivery Status</th>
                            <th class="th_deg">Image</th>
                            <th class="th_deg">Delivered</th>
                            <th class="th_deg">Print PDF</th>
                            <th class="th_deg">Send Email</th>
                        </tr>

                        @forelse ($order as $order)
                            <tr>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->product_title }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->delivery_status }}</td>
                                <td>
                                    <img class="img_size" src="/product/{{ $order->image }}" alt="">
                                </td>

                                
                                <td>
                                    @if ($order->delivery_status=='processing')      
                                        <a onclick="return confirm('Are you sure to product is delivered?')" href="{{ url('delivered',$order->id) }}" class="btn btn-primary">Deliverd</a>

                                        @else

                                        <p style="color: green; font-weight:bold;">Delivered</p>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ url('print_pdf',$order->id) }}" class="btn btn-secondary">pdf</a>
                                </td>

                                <td>
                                    <a href="{{ url('send_email',$order->id) }}" class="btn btn-info">Mail</a>
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="16" style="font-size: 25px;">No Data Found</td>
                            </tr>
                        @endforelse
                        
                    </table>
            </div>
        </div>



    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>