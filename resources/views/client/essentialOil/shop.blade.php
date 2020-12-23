@extends('client.essentialOil.layout.main')

@section('content')
  <!-- content -->
  <div id="content">
    <div class="container">
      <section class="latest-item">
        <div class="section-top">
          <div class="title-search">
            <span>Cửa hàng
              @if ($isSearch) -
                @if ($searchBy == 'category')
                  {{ $categoryName }}
                @endif
                @if ($searchBy == 'nameProduct')
                  Kết quả tìm kiếm theo tên
                @endif
                @if ($searchBy == 'description')
                  Kết quả tìm kiếm theo mô tả
                @endif
              @endif
            </span>
            @if ($isSearch) <p>Kết quả tìm kiếm được dựa vào từ khoá bạn đã nhập</p> @endif
            @if (!$isSearch) <p> Tổng số lượng sản phẩm có trong cửa hàng hiện tại
              là {{ count($dataProduct) }} </p> @endif
          </div>

          <!-- <div class="option-view">

          </div> -->
        </div>

        <div class="section-body">
          <div class="row">

            @foreach($dataProduct as  $item)
              <div class="col-md-4 my-2" onclick="test({{$item->id}}, '{{ $item->EssentialOilProduct_Name }}')"  data-aos="fade-up">
                <div class="card text-left">
                  <img class="card-img-top"
                       src="{{ asset('/storage/images/essential-oil/product/'. $item->id .'/'. json_decode($item->EssentialOilProduct_ListImage)[0]->idImage .'.png') }}"/>
                  <div class="card-body">

                    <div class="top">
                      <h4 class="card-title product-name">
                        @if(strlen($item->EssentialOilProduct_Name) >= 45)
                          {{ \Illuminate\Support\Str::limit($item->EssentialOilProduct_Name, 45, $end='...') }}
                        @else
                          {{$item->EssentialOilProduct_Name}}
                        @endif
                      </h4>
                      <p href="#" class="card-text product-type">{{ $item->EssentialOilCategory_Name }}</p>
                    </div>

                    <div class="bottom">
                      <div class="price-column">
{{--                        <span class="price">{{ $item->EssentialOilProduct_Price }}</span>--}}
                        <span class="price">{{ number_format( $item->EssentialOilProduct_Price, 0, ',', '.') }}</span>
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

        <div class="section-footer my-5">
            <span class="load-more">
              tải thêm
            </span>
        </div>

      </section>
    </div>
  </div>
  <!-- /content -->
@endsection

