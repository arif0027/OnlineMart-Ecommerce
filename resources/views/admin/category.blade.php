<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')

    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;
        }
        .h2_font {
            font-size: 36px;
            padding-bottom: 20px;
            color: #fff;
        }
        .input_color {
            color: black;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 300px;
            margin-right: 10px;
        }
        .btn-primary {
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .table_center {
            margin: auto;
            width: 70%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        td {
            background-color: #f8f9fa;
        }
        .btn-danger {
            padding: 5px 10px;
            border-radius: 5px;
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
                <h2 class="h2_font">Add Category</h2>

                <form action="{{ url('/add_category') }}" method="POST">
                    @csrf
                    <input class="input_color" type="text" name="category" placeholder="Write Category name">
                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                </form>
            </div>

            <table class="table_center">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($data as $data)
                    <tr>
                        <td style="color: black">{{ $data->category_name }}</td>
                        <td style="color: black">
                            <a onclick="return confirm('Are you sure to delete this !!!')" class="btn btn-danger" href="{{ url('delete_category', $data->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
      </div>
    </div>

    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
