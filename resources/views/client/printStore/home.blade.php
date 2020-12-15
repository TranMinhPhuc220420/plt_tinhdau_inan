@extends('client.printStore.layout.main')

@section('carousel')
  <!-- carousel -->
  <div class="container">
    <div id="carouselMain" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselMain" data-slide-to="0" class="active">
          <img src="{{ asset('images/print-store-first-slider-thumbnail.png') }}" alt="">
        </li>

        @if($dataProduct->count() != 0)
          <li data-target="#carouselMain" data-slide-to="1">
            <img src="{{ asset('images/essential-oil-product-new-not-define-second-slider-thumbnail.png') }}" alt="">
          </li>
        @endif
      </ol>

      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <img style="width: 450px;" class="carousel-img" src="{{ asset('images/banner-print.png') }}"
               alt="First slide">
          <div class="carousel-caption d-md-block">

            <div class="caption-top">
              <h3 class="product-name">In ấn Thủ Đức Việt Nam</h3>
              <p class="product-type">
                Bao Bì Yến Phát với nhiều nằm kinh nghiệm cung cấp thiết kế in ấn các loại bao bì. Bao bì phục vụ doanh nghiệp, cửa hàng, bao bì đựng sản phẩm có logo và thiết kế.
              </p>
            </div>
          </div>
        </div>

        @if($dataProduct->count() != 0)
          <div class="carousel-item carousel-link">
            <img style="width: 450px;border-radius: 50%" class="carousel-img shadow"
                 src="{{ asset('/storage/images/print-store/product/'. $dataProduct[0]->id .'/'. json_decode($dataProduct[0]->PrintProduct_ListImage)[0]->idImage .'.png') }}"
                 alt="First slide">
            <div class="carousel-caption d-md-block">

              <div class="caption-top">
                <h3 class="product-name">
                  @if(strlen($dataProduct[0]->PrintProduct_Name) >= 50)
                    {{ \Illuminate\Support\Str::limit($dataProduct[0]->PrintProduct_Name, 50, $end='...') }}
                  @else
                    {{$dataProduct[0]->PrintProduct_Name}}
                  @endif
                </h3>
                {{--                <p class="product-type">{{ $dataProduct[0]->EssentialOilCategory_Name  }}</p>--}}
              </div>

              <div class="caption-bottom">
                <p class="price-discount">
                  {{ number_format( json_decode($dataProduct[0]->PrintProduct_ListPrice)[0]->price, 0, ',', '.') }}
                  /
                  {{ json_decode($dataProduct[0]->PrintProduct_ListPrice)[0]->count }}

                </p>
                <p class="price">
                </p>

                <a
                  href="/print-store/detail/Với thiết kế kiểu dáng tinh tế sang trọng./Với thiết kế kiểu dáng tinh tế sang trọng. /{{ $dataProduct[0]->id }}/tét"
                  class="link">shop now</a>
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
      <section class="latest-item">
        <div class="title-section">
          <span>Hàng mới nhất</span>
        </div>

        <div class="section-body">
          <div class="row">
            @foreach($dataProduct as $item)
              <div class="col-md-4 my-2" onclick="test({{$item->id}}, '{{ $item->PrintProduct_Name }}' , true)">
                <div class="card text-left">
                  <img class="card-img-top"
                       src="{{ asset('/storage/images/print-store/product/'. $item->id .'/'. json_decode($item->PrintProduct_ListImage)[0]->idImage .'.png') }}"
                       alt="">
                  <div class="card-body">

                    <div class="top">
                      <h4 class="card-title product-name">
                        @if(strlen($item->PrintProduct_Name) >= 45)
                          {{ \Illuminate\Support\Str::limit($item->PrintProduct_Name, 45, $end='...') }}
                        @else
                          {{$item->PrintProduct_Name}}
                        @endif
                      </h4>
                      {{--                      <p class="card-text product-type">{{ $item->EssentialOilCategory_Name }}</p>--}}
                    </div>

                    <div class="bottom">
                      <div class="price-column">
                        <span class="price">
                          {{ number_format( json_decode($item->PrintProduct_ListPrice)[0]->price, 0, ',', '.') }} /
                          {{ json_decode($item->PrintProduct_ListPrice)[0]->count}}
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
    </div>
  </div>
  <!-- /content -->
@endsection
