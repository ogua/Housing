@extends('layout')

@section('title','home')


@section('Carousel')
<!--/ Carousel Star /-->
  <div class="intro intro-carousel">
    <div id="carousel" class="owl-carousel owl-theme">

      @foreach($corouseldata as $row)

      <div class="carousel-item-a intro-item bg-image" style="background-image: url({{ $row->img }})">
        <div class="overlay overlay-a"></div>
        <div class="intro-content display-table">
          <div class="table-cell">
            <div class="container">
              <div class="row">
                <div class="col-lg-8">
                  <div class="intro-body">
                    <p class="intro-title-top">{{ $row->housedetail->location }}
                      </p>
                    <h class="intro-title mb-4" style="font-size: 30px;">
                       {{ $row->title }}</h1>
                    <p class="intro-subtitle intro-price">
                      <a href="/property-info/{{ $row->id }}/{{ $row->title }}"><span class="price-a">{{ $row->ctype }} | {{ $row->px }}</span></a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <!--/ Carousel end /-->
@endsection



@section('main-content')
<div id="layoutshow">
  <section class="section-services section-t8">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-wrap d-flex justify-content-between">
            <div class="title-box">
              <h2 class="title-a">Our Services</h2>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="card-box-c foo">
            <div class="card-header-c d-flex">
              <div class="card-box-ico">
                <span class="fa fa-usd"></span>
              </div>
              <div class="card-title-c align-self-center">
                <h2 class="title-c">Buy</h2>
              </div>
            </div>
            <div class="card-body-c">
              <p class="content-c">
                Buy affordable houses
              </p>
            </div>
            <div class="card-footer-c">
              <a href="#" class="link-c link-icon">Read more
                <span class="ion-ios-arrow-forward"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-box-c foo">
            <div class="card-header-c d-flex">
              <div class="card-box-ico">
                <span class="fa fa-home"></span>
              </div>
              <div class="card-title-c align-self-center">
                <h2 class="title-c">Sell</h2>
              </div>
            </div>
            <div class="card-body-c">
              <p class="content-c">
                Sell your property
              </p>
            </div>
            <div class="card-footer-c">
              <a href="#" class="link-c link-icon">Read more
                <span class="ion-ios-arrow-forward"></span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="intro-single">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8">
          <div class="title-single-box">
            <h1 class="title-single">Latest Properties</h1>
            <span class="color-text-a"></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="property-grid grid">
    <div class="container">
      <div class="row">
        @foreach($otherdata as $row)
        <div class="col-md-4">
          <div class="card-box-a card-shadow">
            <div class="img-box-a" style="height: 500px;width: 600px;">
              <img src="{{ $row->img }}" alt="" class="img-a img-fluid">
            </div>
            <div class="card-overlay">
              <div class="card-overlay-a-content">
                <div class="card-header-a">
                  <h2 class="card-title-a" style="font-size: 20px;">
                    <a href="#">{{ $row->title }}</a>
                  </h2>
                </div>
                <div class="card-body-a">
                  <div class="price-box d-flex">
                    <span class="price-a">{{ $row->ctype }} | {{ $row->px }}</span>
                  </div>
                  <a href="/property-info/{{ $row->id }}/{{ $row->title }}" class="link-a">Click here to view
                    <span class="ion-ios-arrow-forward"></span>
                  </a>
                </div>
                <div class="card-footer-a">
                  <ul class="card-info d-flex justify-content-around">

                  @if($row->type == "efiewura")

                    @php
                      $detail1 = explode(",",$row->details);
                      $detail2 = explode("|",$detail1[2]);
                      //print_r($detail2[1]);
                      //exit;
                    @endphp

                    @if(isset($detail2[2]))
                    <li>
                      <h4 class="card-info-title">Area</h4>
                      <span>
                        <sup>{{ $detail2[2] }}</sup>
                      </span>
                    </li>
                    @endif
                    <li>
                      <h4 class="card-info-title">Beds</h4>
                      <span>{{ $detail2[0] }}</span>
                    </li>
                    @if(isset($detail2[1]))
                    <li>
                      <h4 class="card-info-title">Baths</h4>
                      <span>{{ $detail2[1] }}</span>
                    </li>
                    @endif
                  @else

                  @php
                      $detail1 = explode(",",$row->details);
                  @endphp

                  @if(isset($detail1[0]))
                  <li>
                      <h4 class="card-info-title">Region</h4>
                      <span>{{ $detail1[0] }}</span>
                  </li>
                  @endif

                  @if(isset($detail1[1]))
                  <li>
                      <h4 class="card-info-title">Area</h4>
                      <span>{{ $detail1[1] }}</span>
                  </li>
                  @endif



                  @endif


                  </ul>


                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
</div>
@endsection