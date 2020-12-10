@extends('client.essentialOil.layout.main')

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
                      src="{{ asset('/storage/images/essential-oil/product/'. $idProduct .'/'. $item->idImage .'.png') }}"
                      alt="First slide">
                  </li>
                @endforeach
              </ol>

              <div class="carousel-inner" role="listbox">
                @foreach($listImage as $item)
                  <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img
                      src="{{ asset('/storage/images/essential-oil/product/'. $idProduct .'/'. $item->idImage .'.png') }}"/>
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

              <h4 class="product-name">{{ $data->EssentialOilProduct_Name }}</h4>
              <p class="product-sapo"> {{ $data->EssentialOilProduct_Sapo }} </p>

              <p class="product-category">
                Loại: <a href="#"
                         class="category-link pos-re hv-lb"> {{ $data->EssentialOilCategory_Name }} </a>
              </p>

              <div class="option-price">
                <h4 class="price">{{$data->EssentialOilProduct_Price}} VNĐ</h4>
                <h6 class="price-discount">{{$data->EssentialOilProduct_Discount}} VNĐ</h6>
              </div>

              <div class="options-oder">
                <form>
                  <div class="input-control">
                    <button type="button" class="plus"> +</button>
                    <input type="number" name="count" id="count-product" min="1" value="1">
                    <button type="button" class="minus"> -</button>
                  </div>

                  <button type="submit" class="btn-submit"> thêm vào giỏ hàng</button>
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
            {!!   $data->EssentialOilProduct_Description !!}
          </div>
          <div class="tab-pane fade shadow" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            {!! $data->EssentialOilProduct_Info !!}
          </div>
          <div class="tab-pane fade shadow" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <h4 class="title">Bình luận và đánh giá</h4>
            <p class="description-more">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Similique
              iusto
              harum cupiditate? Aliquam
              beatae animi et sint velit itaque incidunt repellendus ab atque nostrum vitae, quia odit
              optio illum
              dolor.</p>
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
              <div class="col-md-4 my-2" onclick="test({{$item->id}}, '{{ $item->EssentialOilProduct_Name }}')">
                <div class="card text-left">
                  <img class="card-img-top"
                       src="{{ asset('/storage/images/essential-oil/product/'. $item->id .'/'. json_decode($item->EssentialOilProduct_ListImage)[0]->idImage .'.png') }}"
                       alt="">
                  <div class="card-body">

                    <div class="top">
                      <h4 class="card-title product-name">{{ $item->EssentialOilProduct_Name }}</h4>
                      <p class="card-text product-type">{{ $data->EssentialOilCategory_Name }}</p>
                    </div>

                    <div class="bottom">
                      <div class="price-column">
                        <span class="price">{{ $item->EssentialOilProduct_Price }} VNĐ</span>
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

