@extends('client.essentialOil.layout.main')

@section('carousel')
  <!-- carousel -->
  <div class="container">
    <div id="carouselMain" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselMain" data-slide-to="0" class="active">
          <img src="{{ asset('images/essential-oil-first-slider-thumbnail.png') }}" alt="">
        </li>

        @if($dataProduct->count() != 0)
          <li data-target="#carouselMain" data-slide-to="1">
            <img src="{{ asset('images/essential-oil-product-new-not-define-second-slider-thumbnail.png') }}" alt="">
          </li>
        @endif
      </ol>

      <div class="carousel-inner" role="listbox">
        <div class="carousel-item carousel-item-normal active">
          <img style="width: 600px;" class="carousel-img" src="{{ asset('images/banner-essential-oil.png') }}"
               alt="First slide">
          <div class="carousel-caption d-md-block">

            <div class="caption-top">
              <h3 class="product-name">Tinh dầu Thủ Đức Việt Nam</h3>
              <p class="product-type">
                Thiên nhiên đã hào phóng ban tặng cho chúng ta một hệ động thực vật vô cùng đa dạng, phong phú và huyền
                bí.
              </p>
            </div>
          </div>
        </div>

        @if($dataProduct->count() != 0)
          <div class="carousel-item carousel-link">
            <img style="width: 450px;border-radius: 50%" class="carousel-img shadow"
                 src="{{ asset('/storage/images/essential-oil/product/'. $dataProduct[0]->id .'/'. json_decode($dataProduct[0]->EssentialOilProduct_ListImage)[0]->idImage .'.png') }}"
                 alt="First slide">
            <div class="carousel-caption d-md-block">

              <div class="caption-top">
                <h3 class="product-name">
                  @if(strlen($dataProduct[0]->EssentialOilProduct_Name) >= 50)
                    {{ \Illuminate\Support\Str::limit($dataProduct[0]->EssentialOilProduct_Name, 50, $end='...') }}
                  @else
                    {{$dataProduct[0]->EssentialOilProduct_Name}}
                  @endif
                </h3>
                <p class="product-type">{{ $dataProduct[0]->EssentialOilCategory_Name  }}</p>
              </div>

              <div class="caption-bottom">
                <p class="price-discount">
                  {{ number_format( $dataProduct[0]->EssentialOilProduct_Discount, 0, ',', '.') }}
                  VNĐ</p>
                <p class="price">
                  {{ number_format( $dataProduct[0]->EssentialOilProduct_Price, 0, ',', '.') }}
                  VNĐ</p>

                <a href="/essential-oil/detail/Với thiết kế kiểu dáng tinh tế sang trọng./Với thiết kế kiểu dáng tinh tế sang trọng. /{{ $dataProduct[0]->id }}/tét" class="link">shop now</a>
              </div>
            </div>
          </div>
        @endif

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
            <div class="col-md-4 my-3"  data-aos="zoom-in">
              <div class="card text-left">
                <a
                  href="{{ url('/essential-oil/shop/'.$item->id .'/'. implode('-', explode(' ', strtolower(preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $item->EssentialOilCategory_Name)))).'/'. time() )}}"
                  class="card-body">
                  <img
                    src="{{ asset('storage/images/essential-oil/category/'. $item->id .'/'.$item->EssentialOilCategory_Image.'.png') }}"
                    alt="{{ $item->EssentialOilCategory_Name }}"/>

                  <p class="card-text">{{ $item->EssentialOilCategory_Name }}
                  </p>
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </section>

      <section class="latest-item">

        <div class="title-section">
          <span>Hàng mới nhất</span>
        </div>

        <div class="section-body">
          <div class="row">
            @foreach($dataProduct as $item)
              <div class="col-md-4 my-2" onclick="test({{$item->id}}, '{{ $item->EssentialOilProduct_Name }}')" data-aos="fade-up">
                <div class="card text-left">
                  <img class="card-img-top"
                       src="{{ asset('/storage/images/essential-oil/product/'. $item->id .'/'. json_decode($item->EssentialOilProduct_ListImage)[0]->idImage .'.png') }}"
                       alt="">
                  <div class="card-body">

                    <div class="top">
                      <h4 class="card-title product-name">
                        @if(strlen($item->EssentialOilProduct_Name) >= 45)
                          {{ \Illuminate\Support\Str::limit($item->EssentialOilProduct_Name, 45, $end='...') }}
                        @else
                          {{$item->EssentialOilProduct_Name}}
                        @endif
                      </h4>
                      <p class="card-text product-type">{{ $item->EssentialOilCategory_Name }}</p>
                    </div>

                    <div class="bottom">
                      <div class="price-column">
                        <span class="price">
                          {{ number_format( $item->EssentialOilProduct_Price, 0, ',', '.') }}
                        </span>
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
          <span>Hàng giảm giá</span>
        </div>

        <div class="section-body">
          <div class="row">
            @foreach($dataProductDiscount as $item)
              <div class="col-md-3" onclick="test({{$item->id}}, '{{ $item->EssentialOilProduct_Name }}')">
                <ul class="list-unstyled">
                  <li class="media mt-3">
                    <div class="img-inner">
                      <img class="mr-3"
                           src="{{ asset('/storage/images/essential-oil/product/'. $item->id .'/'. json_decode($item->EssentialOilProduct_ListImage)[0]->idImage .'.png') }}"
                           alt="Generic placeholder image">
                    </div>
                    <div class="media-body">
                      <h5 class="mt-0 mb-1 product-name">
                        @if(strlen($item->EssentialOilProduct_Name) >= 30)
                          {{ \Illuminate\Support\Str::limit($item->EssentialOilProduct_Name, 30, $end='...') }}
                        @else
                          {{$item->EssentialOilProduct_Name}}
                        @endif
                      </h5>
                      <p class="price">
                        {{ number_format( $item->EssentialOilProduct_Price, 0, ',', '.') }}
                        <span class="currency">VNĐ</span></p>
                      <p class="price-discount">
                        {{ number_format( $item->EssentialOilProduct_Discount, 0, ',', '.') }}
                        <span class="currency">VNĐ</span>
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
