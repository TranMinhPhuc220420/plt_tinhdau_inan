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
            <section class="hyperlinks">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card text-left">
                            <a href="./tinh-dau" class="card-body hyperlink">
                                <img src="{{ asset('images/hyperlink-1.jpg') }}" alt="">
                                <p class="card-text">TINH DẦU <span class="count-product">(20)</span></p>
                                {{-- <p class="card-text">TINH DẦU</p> --}}
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card text-left">
                            <a href="./in-an" class="card-body hyperlink">
                                <img src="{{ asset('images/hyperlink-inan.jpg') }}" alt="">
                                <!-- <p class="card-text">Children <span class="count-product">(50)</span></p> -->
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

