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
            <h1 class="title-single">Our Amazing Properties</h1>
            <span class="color-text-a">{{ $name }}</span>
          </div>
        </div>
        <div class="col-md-12 col-lg-4">
          <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="#">Home</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                {{ $name }}
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!--/ Intro Single End /-->

  <!--/ Property Grid Star /-->
  <section class="property-grid grid">
    <div class="container">
      <div class="row">

         @foreach($data as $row)
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
                    {{-- <li>
                      <h4 class="card-info-title">Garages</h4>
                      <span>1</span>
                    </li> --}}
                  

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
      
      <div class="row">
        <div class="col-sm-12">
          <nav class="pagination-a">
            <ul class="pagination justify-content-end">

              @if ($data->onFirstPage())
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                      <span class="ion-ios-arrow-back"></span>
                    </a>
                  </li>
              @else
              <li class="page-item">
                    <a class="page-link" href="{{ $data->previousPageUrl() }}" tabindex="-1">
                      <span class="ion-ios-arrow-back"></span>
                    </a>
                  </li>
              @endif

              @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                  <li class="page-item">
                    <a class="page-link {{ $page == $data->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
                  </li>
              @endforeach

              @if ($data->hasMorePages())
                  <li class="page-item next">
                    <a class="page-link" href="{{ $data->nextPageUrl() }}">
                      <span class="ion-ios-arrow-forward"></span>
                    </a>
                  </li>
              @else
                  <li class="page-item disabled">
                    <a class="page-link" href="#">
                      <span class="ion-ios-arrow-forward"></span>
                    </a>
               </li>
              @endif


            </ul>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!--/ Property Grid End /-->


@endsection