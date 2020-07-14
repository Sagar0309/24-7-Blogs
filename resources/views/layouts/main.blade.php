<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1"/>
    @if(View::hasSection('title'))
    <title>24/7 NewsForce - @yield('title')</title>
    <meta name="description" content="@yield('description')"/>
    @else
    <title>24/7 NewsForce</title>
    <meta name="description" content="24/7 Blog is the way, you can get an overview of the whole literature in one hour, saving tons of money and time." />
    <meta name="keywords" content="Free Book Summaries, Novel Summaries, Free Online Books" />
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
    <link href="{{ asset('public/css/blog-home.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/blog-post.css') }}" rel="stylesheet">
    <link href="{{ asset('public/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

</head>
<body>
    <header>
        

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('blog') }}">{ 24/7 NewsForce }</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('blog') }}">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/aboutus') }}">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
    </header>

    @yield('content')

    
    <!-- Footer -->
  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Interpolation & Team 2020</p>
    </div>
    <!-- /.container -->
  </footer>
    
    <script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>