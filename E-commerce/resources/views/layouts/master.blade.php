<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Blog Template · Bootstrap v5.0</title>

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}


{{--
    <!-- Bootstrap core CSS -->
    <link href="/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSRF Token -->
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    {{-- FONTS --}}
    {{-- <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}
<!-- CSS Ion.RangeSlider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        nav svg{
            height: 20px;
        }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
        .blog-header {
        line-height: 1;
        border-bottom: 1px solid #e5e5e5;
        }

        .blog-header-logo {
        font-family: "Playfair Display", Georgia, "Times New Roman", serif/*rtl:Amiri, Georgia, "Times New Roman", serif*/;
        font-size: 2.25rem;
        }

        .blog-header-logo:hover {
        text-decoration: none;
        }

        h1, h2, h3, h4, h5, h6 {
        font-family: "Playfair Display", Georgia, "Times New Roman", serif/*rtl:Amiri, Georgia, "Times New Roman", serif*/;
        }

        .display-4 {
        font-size: 2.5rem;
        }
        @media (min-width: 768px) {
        .display-4 {
            font-size: 3rem;
        }
        }

        .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
        }

        .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
        }

        .nav-scroller .nav-link {
        padding-top: .75rem;
        padding-bottom: .75rem;
        font-size: .875rem;
        }

        .card-img-right {
        height: 100%;
        border-radius: 0 3px 3px 0;
        }

        .flex-auto {
        flex: 0 0 auto;
        }

        .h-250 { height: 250px; }
        @media (min-width: 768px) {
        .h-md-250 { height: 250px; }
        }

        /* Pagination */
        .blog-pagination {
        margin-bottom: 4rem;
        }
        .blog-pagination > .btn {
        border-radius: 2rem;
        }

        /*
        * Blog posts
        */
        .blog-post {
        margin-bottom: 4rem;
        }
        .blog-post-title {
        margin-bottom: .25rem;
        font-size: 2.5rem;
        }
        .blog-post-meta {
        margin-bottom: 1.25rem;
        color: #727272;
        }

        /*
        * Footer
        */
        .blog-footer {
        padding: 2.5rem 0;
        color: #727272;
        text-align: center;
        background-color: #f9f9f9;
        border-top: .05rem solid #e5e5e5;
        }
        .blog-footer p:last-child {
        margin-bottom: 0;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
  </head>
  <body>

<div class="container">
  <header class="blog-header py-3">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{( 'LassBoutique') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <a class="link-secondary" href="#" aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
                    </a>
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto" style="display: flex; align-items:center">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('') }}" style="font-weight:bold; font-size:15px">A propos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('') }}" style="font-weight:bold; font-size:15px">Contact</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('') }}" style="font-weight:bold; font-size:15px">Blog</a>
                  </li>

                  |
                    <!-- Authentication Links -->
                    @if (Auth::user())
                        @if(Auth::user()->userType == 'Admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('home') }}" style="font-weight:bold; font-size:15px">Tableau de bord</a>
                            </li>
                        @endif
                    @endif
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown " style="display: flex; gap:10px;" >
                            <div style="margin-left: 10px">
                                {{ Auth::user()->nom }}
                            </div>
                            -
                                <div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                               </div>
                               <div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                              </div>
                        </li>

                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="" style="display:flex; align-items:center; gap:30px">
          <div>
            <span class="bg-danger rounded-pill text-light p-1"><a class="link-secondary text-decoration-none text-light" href="{{ route('card.index')}}">Panier {{ Cart::instance('cart.index')->content()->count() }}</span></a>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
              </svg>


              @if (Cart::instance('layouts.wishlist')->count() > 0)
              <span>{{Cart::instance('layouts.wishlist')->count()}}</span>
              @endif
          </div>
        </div>
        <div class="col-4 text-center">
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
        </div>
      </div>
  </header>
</div>
@if (session('success'))
  <div class="alert alert-success text-center">
    {{session('success')}}
  </div>
@endif
<main class="container" style="max-width: 13280px;" >
  {{-- style="display:flex;max-width: 1590px; --}}
    <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
      <div class="col-md-6 px-0">
        <h1 class="display-4 fst-italic">Title of a longer featured blog post</h1>
        <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
        <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
      </div>
    </div>
    <div class="row">
      @yield('content')
    </div>
    <div style="margin-top: 40px">
    </div>

  {{-- <div style="width:100%; background-color:red">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Default checkbox
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
      <label class="form-check-label" for="flexCheckChecked">
        Checked checkbox
      </label>
    </div>
  </div> --}}
</main>
<!-- JavaScript Bootstrap -->
{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- JavaScript Ion.RangeSlider -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

<footer class="blog-footer">
  <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>
<style>
    .wishlist .fa{
        color:#1ac02b;
        font-size: 25px;

    }
    .wishlists{
        gap:
    }

</style>
  </body>
</html>
