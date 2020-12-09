@extends('client.essentialOil.layout.main')

@section('carousel')
  <!-- carousel -->
  <div class="container">
    <div id="carouselMain" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselMain" data-slide-to="0" class="active">
          <img src="{{ asset('images/first-slider-thumbnail-100x50.png') }}" alt="">
        </li>
        <li data-target="#carouselMain" data-slide-to="1">
          <img src="{{ asset('images/second-slider-thumbnail.png') }}" alt="">
        </li>
      </ol>

      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <img class="carousel-img" src="{{ asset('images/lulita.png') }}" alt="First slide">
          <div class="carousel-caption d-md-block">

            <div class="caption-top">
              <h3 class="product-name">Hello World</h3>
              <p class="product-type">Type new development</p>
            </div>

            <div class="caption-bottom">
              <p class="price-discount">150.000 VNĐ</p>
              <p class="price">350.000 VNĐ</p>
            </div>
          </div>
        </div>

        <div class="carousel-item carousel-link">
          <img class="carousel-img" src="{{ asset('images/panamericano.png') }}" alt="First slide">
          <div class="carousel-caption d-md-block">

            <div class="caption-top">
              <h3 class="product-name">Hello World</h3>
              <p class="product-type">Type new development</p>
            </div>

            <div class="caption-bottom">
              <p class="price-discount">150.000 VNĐ</p>
              <p class="price">350.000 VNĐ</p>

              <a href="./detail.html" class="link">shop now</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- carousel -->
@endsection


@section('content')
  <!-- content -->
  <div id="content">
    <div class="container">
      <section class="product-type">
        <div class="row">
          @foreach($dataCategory as $item)
            <div class="col-md-4 my-3">
              <div class="card text-left">
                <a href="./shop.html" class="card-body">
                  <img
                    src="{{ asset('storage/images/essential-oil/type/'. $item->id .'/'.$item->EssentialOilType_Image.'.png') }}"
                    alt="{{ $item->EssentialOilType_Name }}"/>

                  <p class="card-text">{{ $item->EssentialOilType_Name }}
                  </p>
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </section>

      <section class="latest-item">

        <div class="title-section">
          <span>latest item</span>
        </div>

        <div class="section-body">
          <div class="row">
            @foreach($dataProduct as $item)
              <div class="col-md-4 my-2" onclick="test({{$item->id}})">
                <div class="card text-left">
                  <img class="card-img-top"
                       src="{{ asset('/storage/images/essential-oil/product/'. $item->id .'/'. json_decode($item->EssentialOilProduct_ListImage)[0]->idImage .'.png') }}"
                       alt="">
                  <div class="card-body">

                    <div class="top">
                      <h4 class="card-title product-name">{{ $item->EssentialOilProduct_Name }}</h4>
                      <p class="card-text product-type">{{ $item->EssentialOilCategory_Name }}</p>
                    </div>

                    <div class="bottom">
                      <div class="price-column">
                        <span class="price">{{ $item->EssentialOilProduct_Price }}</span>
                      </div>

                      <div class="add-to-cart-column">
                        <a href="#" class="btn-add-cart">
                          <i class="fas fa-cart-plus"></i>
                        </a>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>

      </section>

      <section class="discount-items mt-5">
        <div class="title-left">
          <span>latest item</span>
        </div>

        <div class="section-body">
          <div class="row">
            @foreach($dataProductDiscount as $item)
              <div class="col-md-3">
                <ul class="list-unstyled">
                  <li class="media mt-3">
                    <div class="img-inner">
                      <img class="mr-3"
                           src="{{ asset('/storage/images/essential-oil/product/'. $item->id .'/'. json_decode($item->EssentialOilProduct_ListImage)[0]->idImage .'.png') }}"
                           alt="Generic placeholder image">
                    </div>
                    <div class="media-body">
                      <h5 class="mt-0 mb-1 product-name">{{ \Illuminate\Support\Str::limit($item->EssentialOilProduct_Name, 20, $end='...') }}</h5>
                      <p class="discount">
                        <span class="price">{{ $item->EssentialOilProduct_Price }} <span class="currency">VNĐ</span> </span>
                        <span class="price-discount">{{ $item->EssentialOilProduct_Discount }} <span class="currency">VNĐ</span></span>
                      </p>
                      <p class="start"><i class="fas fa-star"></i> {{ $item->EssentialOilProduct_Vote }} </p>
                    </div>
                  </li>
                </ul>
              </div>
            @endforeach
          </div>
        </div>
      </section>
    </div>
  </div>
    <!-- /content -->
@endsection
