<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    @include('admin.css')

    <style type="text/css">
        label{
            display: inline-block;
            width: 200px;
            font-size: 15px;
            font-weight: 700;
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

            <h1 style="text-align: center; font-size:25px;">Send Email to {{ $order->email }}</h1>

            <form action="{{ url('send_user_email', $order->id) }}" method="POST">
                @csrf
                <div style="padding-left: 35%; padding-top:40px">
                    <label for="">Email Greeting : </label>
                    <input style="color: black" type="text" name="greeting" id="">
                </div>

                <div style="padding-left: 35%; padding-top:40px">
                    <label for="">Email FirstLine : </label>
                    <input style="color: black" type="text" name="firstline" id="">
                </div>

                <div style="padding-left: 35%; padding-top:40px">
                    <label for="">Email Body : </label>
                    <input style="color: black" type="text" name="body" id="">
                </div>

                <div style="padding-left: 35%; padding-top:40px">
                    <label for="">Email Button Name : </label>
                    <input style="color: black" type="text" name="button" id="">
                </div>

                <div style="padding-left: 35%; padding-top:40px">
                    <label for="">Email Url : </label>
                    <input style="color: black" type="text" name="url" id="">
                </div>

                <div style="padding-left: 35%; padding-top:40px">
                    <label for="">Email Lastline : </label>
                    <input style="color: black" type="text" name="lastline" id="">
                </div>

                <div style="padding-left: 35%; padding-top:40px">
                    <input type="submit" value="Send Email" class="btn btn-primary">
                </div>
            </form>

        </div>
    </div>



    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>