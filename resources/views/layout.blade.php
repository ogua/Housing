<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>EstateAgency | @yield('title')</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link href="{{ URL::to('img/favicon.png') }}" rel="icon">
  <link href="{{ URL::to('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{ URL::to('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{ URL::to('lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ URL::to('lib/animate/animate.min.css') }}" rel="stylesheet">
  <link href="{{ URL::to('lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
  <link href="{{ URL::to('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="{{ URL::to('css/style.css') }}" rel="stylesheet">
</head>

<body>

  @include('nav')

  @yield('Carousel')

  @yield('main-content')
 
  <!--/ Testimonials Star /-->
  {{-- <section class="section-testimonials section-t8 nav-arrow-a">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-wrap d-flex justify-content-between">
            <div class="title-box">
              <h2 class="title-a">Testimonials</h2>
            </div>
          </div>
        </div>
      </div>
      <div id="testimonial-carousel" class="owl-carousel owl-arrow">
        <div class="carousel-item-a">
          <div class="testimonials-box">
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="testimonial-img">
                  <img src="img/testimonial-1.jpg" alt="" class="img-fluid">
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="testimonial-ico">
                  <span class="ion-ios-quote"></span>
                </div>
                <div class="testimonials-content">
                  <p class="testimonial-text">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, cupiditate ea nam praesentium
                    debitis hic ber quibusdam
                    voluptatibus officia expedita corpori.
                  </p>
                </div>
                <div class="testimonial-author-box">
                  <img src="img/mini-testimonial-1.jpg" alt="" class="testimonial-avatar">
                  <h5 class="testimonial-author">Albert & Erika</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item-a">
          <div class="testimonials-box">
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="testimonial-img">
                  <img src="img/testimonial-2.jpg" alt="" class="img-fluid">
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="testimonial-ico">
                  <span class="ion-ios-quote"></span>
                </div>
                <div class="testimonials-content">
                  <p class="testimonial-text">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, cupiditate ea nam praesentium
                    debitis hic ber quibusdam
                    voluptatibus officia expedita corpori.
                  </p>
                </div>
                <div class="testimonial-author-box">
                  <img src="img/mini-testimonial-2.jpg" alt="" class="testimonial-avatar">
                  <h5 class="testimonial-author">Pablo & Emma</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> --}}
  <!--/ Testimonials End /-->

  @include('footer')

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- JavaScript Libraries -->
  <script src="{{ URL::to('lib/jquery/jquery.min.js') }}"></script>
  <script src="{{ URL::to('lib/jquery/jquery-migrate.min.js') }}"></script>
  <script src="{{ URL::to('lib/popper/popper.min.js') }}"></script>
  <script src="{{ URL::to('lib/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ URL::to('lib/easing/easing.min.js') }}"></script>
  <script src="{{ URL::to('lib/owlcarousel/owl.carousel.min.js') }}"></script>
  <script src="{{ URL::to('lib/scrollreveal/scrollreveal.min.js')}}"></script>
  <!-- Contact Form JavaScript File -->
  <script src="{{ URL::to('contactform/contactform.js')}}"></script>

  <!-- Template Main Javascript File -->
  <script src="{{ URL::to('js/main.js') }}"></script>


  <script type="text/javascript">
  $('document').ready(function(){

    $(document).on("submit","#searchfilter", function(e){
      e.preventDefault();
      
      var Keyword = $("#Keyword").val();
      var Type = $("#Type").val();
      var city = $("#city").val();
      var bedrooms = $("#bedrooms").val();
      var bathrooms = $("#bathrooms").val();
      var price = $("#price").val();

      var url = `/search-results?Keyword=${Keyword ?? 'null'}&Type=${Type ?? 'null'}&city=${city ?? 'null'}&bedrooms=${bedrooms ?? 'null'}&bathrooms=${bathrooms ?? 'null'}&price=${price ?? 'null'}`;

      window.location.href = url;

    });
    //end


  });

</script>

</body>
</html>
