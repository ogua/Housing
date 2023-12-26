@extends('layout')

@section('title')
{{ $name }}
@endsection

@section('main-content')
<!--/ Intro Single star /-->
  <section class="intro-single">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8">
          <div class="title-single-box">
            <h1 class="title-single">{{ $data->title }}</h1>
            <span class="color-text-a">{{ $data->housedetail->location }}</span>
          </div>
        </div>
        <div class="col-md-12 col-lg-4">
          <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="/">Home</a>
              </li>
              <li class="breadcrumb-item">
                <a href="/{{ $data->ctype == "For rent" ? "properties-for-rent" : "properties-for-sale" }}">Properties</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                {{ $data->title }}
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!--/ Intro Single End /-->

  <!--/ Property Single Star /-->
  <section class="property-single nav-arrow-b">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div id="property-single-carousel" class="owl-carousel owl-arrow gallery-property">
            @php
              $absolutePath = 'https://efiewura.com/';
            $html = str_replace('../../../', $absolutePath, $data->housedetail->imgs);
            @endphp
            {!! $html !!}
            
          </div>
          <div class="row justify-content-between">
            <div class="col-md-5 col-lg-4">
              <div class="property-price d-flex justify-content-center foo">
                <div class="card-header-c d-flex">
                  <div class="card-title-c align-self-center">
                    <h5 class="title-c">{{ $data->px }}</h5>
                  </div>
                </div>
              </div>
              <div class="property-summary">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="title-box-d section-t4">
                      <h3 class="title-d">Quick Summary</h3>
                    </div>
                  </div>
                </div>
                <div class="summary-list">
                  <ul class="list">
                    <li class="d-flex justify-content-between">
                      <strong>Property ID:</strong>
                      <span>{{ $data->id }}</span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>Location:</strong>
                      <span>{{ $data->housedetail->location }}</span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>Property Type:</strong>
                      <span>House</span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>Status:</strong>
                      <span>{{ $data->ctype }}</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-7 col-lg-7 section-md-t3">
              <div class="row">
                <div class="col-sm-12">
                  <div class="title-box-d">
                    <h3 class="title-d">Property Description</h3>
                  </div>
                </div>
              </div>
              <div class="property-description">
                <p class="description color-text-a">
                 {{ $data->housedetail->features }}
                </p>
                <p class="description color-text-a no-margin">
                  {{ $data->housedetail->otherdetails }}
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="row section-t3">
            <div class="offset-6 col-md-6">
              <div class="title-box-d">
                <h3 class="title-d">Contact Agent</h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="offset-6 col-md-6">
              <div class="property-agent">
                <h4 class="title-agent">{{ $data->housedetail->agentname }}</h4>
                <p class="color-text-a">
                  
                </p>
                <ul class="list-unstyled">
                  <li class="d-flex justify-content-between">
                    <strong>Phone:</strong>
                    <span class="color-text-a">{{ $data->housedetail->agentcontact }}</span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <strong>Mobile:</strong>
                    <span class="color-text-a"><a href="{{ $data->housedetail->agentwatsap }}">Whatsapp</a></span>
                  </li>
                 {{--  <li class="d-flex justify-content-between">
                    <strong>Email:</strong>
                    <span class="color-text-a">annabella@example.com</span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <strong>Skype:</strong>
                    <span class="color-text-a">Annabela.ge</span>
                  </li> --}}
                </ul>
                <div class="socials-a">
                  <ul class="list-inline">
                    <li class="list-inline-item">
                      <a href="#">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#">
                        <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#">
                        <i class="fa fa-dribbble" aria-hidden="true"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ Property Single End /-->
  @endsection