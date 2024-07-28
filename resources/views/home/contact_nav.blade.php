<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <base href="/public">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
   

        <section class="contact contact">
            <div class="container">
               <div class="heading_container heading_center">
                  <h2>
                     Contact<span>US</span>
                  </h2>
               </div>

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

               <div class="row py-5">
                    <div class="col-md-6">
                    <form id="request" class="main_form" method="POST" action="{{ url('contact') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 ">
                                <input class="contactus" placeholder="Name" type="type" name="name" required> 
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Email" type="email" name="email" required> 
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Phone Number" type="number" name="phone" required>                          
                            </div>
                            <div class="col-md-12">
                                <textarea class="textarea" placeholder="Message" type="text" name="message" required>Message</textarea>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn" style="background-color: #f7444e; color:white">Send</button>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="col-md-6">
                    <div class="map_main">
                        <div class="map-responsive">
                            <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&amp;q=Eiffel+Tower+Paris+France" width="600" height="400" frameborder="0" style="border:0; width: 100%;" allowfullscreen=""></iframe>
                        </div>
                    </div>
                    </div>
                </div>

          </div>
</section>
    
    <!-- footer start -->
    @include('home.footer')
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
