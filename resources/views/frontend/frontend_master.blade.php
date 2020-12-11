<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bootstrap Blog - B4 Template by Bootstrap Temple</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/font-awesome/css/font-awesome.min.css')}}">
    <!-- Custom icon font-->
    <link rel="stylesheet" href="{{asset('public/frontend/css/fontastic.css')}}">
    <!-- Google fonts - Open Sans-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <!-- Fancybox-->
    <link rel="stylesheet" href="{{asset('public/frontend/vendor/@fancyapps/fancybox/jquery.fancybox.min.css')}}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('public/frontend/css/style.default.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('public/frontend/css/custom.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png')}}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <header class="header">
      <!-- Main Navbar-->
      <nav class="navbar navbar-expand-lg">
        <div class="search-area">
          <div class="search-area-inner d-flex align-items-center justify-content-center">
            <div class="close-btn"><i class="icon-close"></i></div>
            <div class="row d-flex justify-content-center">
              <div class="col-md-8">
                <form action="#">
                  <div class="form-group">
                    <input type="search" name="search" id="search" placeholder="What are you looking for?">
                    <button type="submit" class="submit"><i class="icon-search-1"></i></button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <!-- Navbar Brand -->
          <div class="navbar-header d-flex align-items-center justify-content-between">
            <!-- Navbar Brand --><a href="index.html" class="navbar-brand">Bootstrap Blog</a>
            <!-- Toggle Button-->
            <button type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span></span><span></span><span></span></button>
          </div>
          <!-- Navbar Menu -->
          <div id="navbarcollapse" class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item"><a href="{{ url('/') }}" class="nav-link active ">Home</a>
              </li>
              <li class="nav-item"><a href="{{route('blog.posts')}}" class="nav-link ">Blog</a>
              </li>
              <li class="nav-item"><a href="#" class="nav-link ">Contact</a>
              </li>
              <!--Login section-->
              
              @if (Route::has('login'))
                  
                      @auth
                      <li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link ">Home</a></li>
                      @else
                      <li class="nav-item"><a href="{{ route('login') }}" class="nav-link ">Login</a></li>

                          @if (Route::has('register'))
                          <li class="nav-item"><a href="{{ route('register') }}" class="nav-link ">Register</a></li>
                          @endif
                      @endauth
                  </li>
              @endif
               <!--Login section end-->
            </ul>
            <div class="navbar-text"><a href="#" class="search-btn"><i class="icon-search-1"></i></a></div>
            <ul class="langs navbar-text">{{-- <a href="{{ route('login') }}" class="active" >Login</a><span>||</span><a href="{{ route('register') }}"class="active">Register</a> --}}
                
            </ul>
          </div>
        </div>
      </nav>
    </header>
    
      @yield('home_content')
      <div class="container">
        <div class="row">
          {{-- For post Content --}}
          @yield('post_content')
          {{-- Sidebar --}}
          <?php if(isset($sidebar)){if ($sidebar==1) { ?>  
          <aside class="col-lg-4">
            <!-- Widget [Search Bar Widget]-->
            <div class="widget search">
              <header>
                <h3 class="h6">Search the blog</h3>
              </header>
              <form action="#" class="search-form">
                <div class="form-group">
                  <input type="search" placeholder="What are you looking for?">
                  <button type="submit" class="submit"><i class="icon-search"></i></button>
                </div>
              </form>
            </div>
           <!-- Widget [Latest Posts Widget]        -->
          <div class="widget latest-posts">
            <header>
              <h3 class="h6">Latest Posts</h3>
            </header>
            <div class="blog-posts">
              @foreach ($latest_posts as $latest_post)
                <a href="{{ URL::to('post/'.$latest_post->post_id) }}">
                  <div class="item d-flex align-items-center">
                    <?php if ($latest_post->post_image != NULL) { ?>
                      <div class="image"><img src="{{asset($latest_post->post_image)}}" alt="Post Image" class="img-fluid"></div>
                    <?php } ?>
                    <div class="title"><strong>{{$latest_post->post_title}}</strong>
                      <div class="d-flex align-items-center">
                        <div class="views"><i class="icon-eye"></i> {{$latest_post->hit_count}}</div>
                        <div class="comments"><i class="icon-comment"></i>12</div>
                      </div>
                    </div>
                  </div>
                </a>
                @endforeach
              </div>
          </div>
            <!-- Widget [Categories Widget]-->
            <div class="widget categories">
              <header>
                <h3 class="h6">Categories</h3>
              </header>
              <?php 
              $all_published_catagories=DB::table('catagories')->select('*')->where('publication_status',1)->get();
              foreach ($all_published_catagories as $catagory) {
              ?>
              <div class="item d-flex justify-content-between"><a href="{{URL::to('posts-by-category/'.$catagory->id)}}">{{$catagory->catagory_name}}</a><span>12</span></div>
              
              <?php } ?>
            </div>
            <!-- Widget [Popular Posts Widget] -->
          <div class="widget latest-posts">
            <header>
              <h3 class="h6">Popular Posts</h3>
            </header>
            <div class="blog-posts">
              @foreach ($popular_posts as $post)
                <a href="{{ URL::to('post/'.$post->post_id) }}">
                  <div class="item d-flex align-items-center">
                    <?php if ($post->post_image != NULL) { ?>
                      <div class="image"><img src="{{asset($post->post_image)}}" alt="Post Image" class="img-fluid"></div>
                    <?php } ?>
                    <div class="title"><strong>{{$post->post_title}}</strong>
                      <div class="d-flex align-items-center">
                        <div class="views"><i class="icon-eye"></i> {{$post->hit_count}}</div>
                        <div class="comments"><i class="icon-comment"></i>12</div>
                      </div>
                    </div>
                  </div>
                </a>
                @endforeach
              </div>
          </div>
            <!-- Widget [Tags Cloud Widget]-->
            <div class="widget tags">       
              <header>
                <h3 class="h6">Tags</h3>
              </header>
              <ul class="list-inline">
                <li class="list-inline-item"><a href="#" class="tag">#Business</a></li>
                <li class="list-inline-item"><a href="#" class="tag">#Technology</a></li>
                <li class="list-inline-item"><a href="#" class="tag">#Fashion</a></li>
                <li class="list-inline-item"><a href="#" class="tag">#Sports</a></li>
                <li class="list-inline-item"><a href="#" class="tag">#Economy</a></li>
              </ul>
            </div>
          </aside>
        <?php } } ?>
        </div>
      </div>
     
    
    <!-- Page Footer-->
    <footer class="main-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="logo">
              <h6 class="text-white">Bootstrap Blog</h6>
            </div>
            <div class="contact-details">
              <p>53 Broadway, Broklyn, NY 11249</p>
              <p>Phone: (020) 123 456 789</p>
              <p>Email: <a href="mailto:info@company.com">Info@Company.com</a></p>
              <ul class="social-menu">
                <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fa fa-behance"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
            <div class="menus d-flex">
              <ul class="list-unstyled">
                <li> <a href="#">My Account</a></li>
                <li> <a href="#">Add Listing</a></li>
                <li> <a href="#">Pricing</a></li>
                <li> <a href="#">Privacy &amp; Policy</a></li>
              </ul>
              <ul class="list-unstyled">
                <li> <a href="#">Our Partners</a></li>
                <li> <a href="#">FAQ</a></li>
                <li> <a href="#">How It Works</a></li>
                <li> <a href="#">Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
            <div class="latest-posts"><a href="#">
                <div class="post d-flex align-items-center">
                  <div class="image"><img src="{{asset('public/frontend/img/small-thumbnail-1.jpg')}}" alt="..." class="img-fluid"></div>
                  <div class="title"><strong>Hotels for all budgets</strong><span class="date last-meta">October 26, 2016</span></div>
                </div></a><a href="#">
                <div class="post d-flex align-items-center">
                  <div class="image"><img src="{{asset('public/frontend/img/small-thumbnail-2.jpg')}}" alt="..." class="img-fluid"></div>
                  <div class="title"><strong>Great street atrs in London</strong><span class="date last-meta">October 26, 2016</span></div>
                </div></a><a href="#">
                <div class="post d-flex align-items-center">
                  <div class="image"><img src="{{asset('public/frontend/img/small-thumbnail-3.jpg')}}" alt="..." class="img-fluid"></div>
                  <div class="title"><strong>Best coffee shops in Sydney</strong><span class="date last-meta">October 26, 2016</span></div>
                </div></a></div>
          </div>
        </div>
      </div>
      <div class="copyrights">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <p>&copy; 2017. All rights reserved. Your great site.</p>
            </div>
            <div class="col-md-6 text-right">
              <p>Template By <a href="https://bootstrapious.com/p/bootstrap-carousel" class="text-white">Bootstrapious</a>
                <!-- Please do not remove the backlink to Bootstrap Temple unless you purchase an attribution-free license @ Bootstrap Temple or support us at http://bootstrapious.com/donate. It is part of the license conditions. Thanks for understanding :)                         -->
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- JavaScript files-->
    <script src="{{asset('public/frontend/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/frontend/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('public/frontend/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('public/frontend/vendor/@fancyapps/fancybox/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/front.js')}}"></script>
  </body>
</html>