<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">    <!-- Favicon -->
    <link rel="icon" href="{{ url('/img/favicon.ico') }}">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="{{ url('/lib/animate/animate.min.css') }}">

    <link rel="stylesheet" href="{{ url('/lib/owlcarousel/assets/owl.carousel.min.css') }}">
    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{ url('/css/bootstrap.min.css') }}">
    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body>
@include('layout.header')
@yield('content')

@include('layout.footer')

<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>


</body>

</html>
