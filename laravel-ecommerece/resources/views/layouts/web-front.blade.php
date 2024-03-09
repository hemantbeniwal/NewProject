<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>ThewayShop - Ecommerce Bootstrap 4 HTML Template</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

  
    @include('includes.web-head')

</head>

<body>
    @if (session()->has('success'))
    <div class="alert alert-success" id="msg">
        {{ session()->get('success') }}
    </div>
@endif
    <!-- Start Main Top -->
    
    <!-- End Main Top -->

    <!-- Start Main Top -->
    <header class="main-header">
      
      @include('includes.web-header')
        <!-- Start Navigation -->
        
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->
    @include('includes.web-nav')
    <!-- Start Top Search -->
    <!-- End Top Search -->

    <!-- Start Slider -->
    @yield('content')
    <!-- End Instagram Feed  -->


    <!-- Start Footer  -->
   @include('includes.web-footer1')
   @include('includes.web-footer')

    <!-- ALL JS FILES -->
    
</body>

</html>
