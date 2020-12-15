@extends('client.layouts.main')

@section('carousel')
    <!-- carousel -->
    <div class="container">
        <div id="carouselMain" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselMain" data-slide-to="0" class="active">
                    <img src="{{ asset('images/welcome-first-slider-thumbnail.png') }}" alt="">
                </li>
                <li data-target="#carouselMain" data-slide-to="1">
                    <img src="{{ asset('images/welcome-second-slider-thumbnail.png') }}" alt="">
                </li>
            </ol>

            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img style="width: 600px;" class="carousel-img" src="{{ asset('images/banner-essential-oil.png') }}" alt="First slide">
                    <div class="carousel-caption d-md-block">

                        <div class="caption-top">
                            <h3 class="product-name">Tinh dầu Thủ Đức Việt Nam</h3>
                            <p class="product-type">
                              Thiên nhiên đã hào phóng ban tặng cho chúng ta một hệ động thực vật vô cùng đa dạng, phong phú và huyền bí.
                            </p>
                        </div>

{{--                        <div class="caption-bottom">--}}
{{--                            <p class="price-discount">150.000 VNĐ</p>--}}
{{--                            <p class="price">350.000 VNĐ</p>--}}
{{--                        </div>--}}
                    </div>
                </div>

                <div class="carousel-item carousel-link">
                    <img class="carousel-img" src="{{ asset('images/banner-print.png') }}" alt="First slide">
                    <div class="carousel-caption d-md-block">

                        <div class="caption-top">
                            <h3 class="product-name">In ấn Thủ Đức Việt Nam</h3>
                            <p class="product-type">
                              Bao Bì Yến Phát với nhiều nằm kinh nghiệm cung cấp thiết kế in ấn các loại bao bì. Bao bì phục vụ doanh nghiệp, cửa hàng, bao bì đựng sản phẩm có logo và thiết kế.
                            </p>
                        </div>

                        <div class="caption-bottom">
{{--                            <p class="price-discount">150.000 VNĐ</p>--}}
{{--                            <p class="price">350.000 VNĐ</p>--}}

                            <a href="./print-store" class="link">Đến cửa hàng</a>
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
            <section class="hyperlinks">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card text-left">
                            <a href="{{ url('/essential-oil') }}" class="card-body hyperlink">
                                <img src="{{ asset('images/hyperlink-1.jpg') }}" alt="">
                                <p class="card-text">TINH DẦU</p>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card text-left">
                            <a href="./print-store" class="card-body hyperlink">
                                <img src="{{ asset('images/hyperlink-inan.jpg') }}" alt="">
                                <p class="card-text">IN ẤN</p>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /content -->
@endsection

