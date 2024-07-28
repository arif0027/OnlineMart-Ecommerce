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

                <h2 class="h2_font">All Messages</h2>

                <table class="table_deg">
                    <tr>
                        <tr>
                            <th class="th_deg">Name</th>
                            <th class="th_deg">Email</th>
                            <th class="th_deg">Phone</th>
                            <th class="th_deg">Message</th>
                        </tr>
                    </tr>

                    @foreach ($data as $data)
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->phone }}</td>
                            <td>{{ $data->message }}</td>
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