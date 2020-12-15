@extends('client.printStore.layout.main')

@section('content')
  <!-- content -->
  <div id="content">
    <div class="container">
      <section class="product-detail">
        <div class="row">
          <div class="col-md-5 detail-image">

            <div id="carouselId" class="carousel slide" data-ride="carousel">

              <ol class="carousel-indicators">
                @foreach($listImage as $item)
                  <li data-target="#carouselId"
                      data-slide-to="{{$loop->index}}" {{ $loop->first ? 'class="active"' : '' }}>
                    <img
                      src="{{ asset('/storage/images/print-store/product/'. $idProduct .'/'. $item->idImage .'.png') }}"
                      alt="First slide">
                  </li>
                @endforeach
              </ol>

              <div class="carousel-inner" role="listbox">
                @foreach($listImage as $item)
                  <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img
                      src="{{ asset('/storage/images/print-store/product/'. $idProduct .'/'. $item->idImage .'.png') }}"/>
                  </div>
                @endforeach
              </div>

              <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                <i class="fas fa-chevron-left"></i>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                <i class="fas fa-chevron-right"></i>
                <span class="sr-only">Next</span>
              </a>

            </div>
          </div>
          <div class="col-md-7">
            <div class="detail-info-oder">

              <h4 class="product-name">{{ $data->PrintProduct_Name }}</h4>
              <p class="product-sapo"> {{ $data->PrintProduct_Sapo }} </p>

              <div class="option-price">
                <table style="width: 70%;" class="shadow-sm">
                  <thead>
                  <tr>
                    <th style="text-align: center; height: 50px;background: #ff4f40; color: #fff">Số lượng</th>
                    <th style="text-align: center; height: 50px;background: #ff4f40; color: #fff">Giá</th>
                    <th style="text-align: center; height: 50px;background: #ff4f40; color: #fff">Đặt hàng</th>
                  </tr>
                  </thead>
                  @foreach($dataListPrice as $item)
                    <tr style="text-align: center; height: 35px; border-bottom: 1px solid #ddd">
                      <td>{{ $item->count }}</td>
                      <td>{{ number_format( $item->price, 0, ',', '.') }} VNĐ</td>
                      <td>
                        <input type="radio" data-price="{{ $item->price }}"
                               name="selectOptionOrderPrint">
                      </td>
                    </tr>
                  @endforeach
                </table>
              </div>

              <div class="options-oder">
                <form action="/AreYouHacker? (-.-)" id="printStoreAddCart" method="POST">
                  <input type="hidden" name="idProduct" id="idProduct" value="{{ $idProduct }}">
                  <input type="hidden" name="nameProduct" id="nameProduct" value="{{ $data->PrintProduct_Name }}">
                  <input type="hidden" name="idImage" id="idImage" value="{{ $listImage[0]->idImage }}">
                  <button style="margin: 0" type="submit" class="btn-submit"> thêm vào giỏ hàng</button>
                </form>
              </div>
            </div>

          </div>
        </div>
      </section>

      <section class="tablist">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
               aria-controls="home"
               aria-selected="true">Chi tiết</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
               aria-controls="profile"
               aria-selected="false">Thành phần</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
               aria-controls="contact"
               aria-selected="false">Bình luận <span class="desktop"> và đánh giá</span> </a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active shadow" id="home" role="tabpanel" aria-labelledby="home-tab">
            {!!   $data->PrintProduct_Description !!}
          </div>
          <div class="tab-pane fade shadow" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            {!! $data->PrintProduct_Info !!}
          </div>
          <div class="tab-pane fade shadow" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <h4 class="title" style="border-bottom: 1px solid #ddd; width: 50%; padding-bottom: 5px">Bình luận và đánh
              giá</h4>
            <div class="row" id="listComment">
              @foreach($dataComment as $item)
                <div class="col-md-12">
                  <div class="media g-mb-30 media-comment">
                    <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15"
                         src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Image Description">
                    <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                      <div class="g-mb-15">
                        <h5 class="h5 g-color-gray-dark-v1 mb-0">{{ $item->Comment_Username }}</h5>
                        <span class="g-color-gray-dark-v4 g-font-size-12">{{ $item->created_at}}</span>
                      </div>

                      <p>{{ $item->Comment_Content}}</p>

                    </div>
                  </div>
                </div>
              @endforeach
            </div>

            <form id="formPostNewComment" class="mt-5" action="./AreYouHacker?  (-.-) " method="POST">
              @csrf
              <input type="hidden" id="fuckingWowShit" value="{{ $idProduct }}">
              <input type="hidden" id="commentPrintStore" value="true">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputFullName">Họ và Tên</label>
                    <input type="text" name="inputFullName" class="form-control" id="inputFullName"
                           placeholder="Nhập họ tên..." required>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail">Email address</label>
                    <input type="email" name="inputEmail" class="form-control" id="inputEmail"
                           aria-describedby="emailHelp"
                           placeholder="Nhập email..." required>
                    <small id="emailHelp" class="form-text text-muted">Chúng tôi sẽ không chia sẽ email này cho bất kỳ
                      tổ
                      chức nào</small>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="inputComment">Nhập phần bình buận của bạn: </label>
                    <textarea name="inputComment" class="form-control" id="inputComment" rows="5" required></textarea>
                  </div>
                  <div class="form-group text-right">
                    <button class="btn btn-primary" type="submit">Đăng Bình Luận</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>

      <section class="latest-item load-more mt-5">
        <div class="section-top">
          <div class="title-search">
            <span>Sản phẩm liên quan: </span>
          </div>

          <!-- <div class="option-view">

          </div> -->
        </div>

        <div class="section-body">
          <div class="row">

            @foreach($dataProductSem as $item)
              <div class="col-md-4 my-2" onclick="test({{$item->id}}, '{{ $item->PrintProduct_Name }}', true)">
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

        <div class="section-footer my-5">
          <span class="load-more"> tải thêm </span>
        </div>

      </section>
    </div>
  </div>
  <!-- /content -->
@endsection

