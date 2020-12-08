<!-- nav -->
<nav class="navbar">
    <div class="container">
        <div class="nav-left">
            <div class="nav-logo">
                <a href="/">
                    <img src="{{asset('images/logo-eva-vn-c5.jpg')}}" alt="" class="logo">
                </a>
            </div>

            <div class="name-business">
                <a href="/"><span class="text">eva vietnam</span></a>
            </div>

            <div class="collapse-nav">
                <a class="cart">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="count">5</span>
                </a>

                <button class="btn-collapse" id="btnCollapseNav">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <div class="nav-right">
            <a href="#">
                <img src="{{asset('images/logo-eva-vn-c5.jpg')}}" class="logo-navbar-mobile" alt="">
            </a>

            <div class="nav-link">
                <ul class="list-link">
                    <li class="item pos-re hv-lb">
                        <a href="#" class="link">Trang chủ</a>
                    </li>

                    <li class="item pos-re hv-lb">
                        <a href="#" class="link">Cửa hàng</a>
                    </li>

                    <li class="item pos-re hv-lb">
                        <a href="#" class="link">Liên hệ</a>
                    </li>
                </ul>
            </div>

            <div class="nav-search nav-link">
                <div id="formSearch" class="form-search">
                    <input class="shadow-sm" type="text" name="key" placeholder="Enter key search...">
                    <button id="btnSearchNav" class="btn-submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="nav-icon">
                <div class="cart" id="panelCheckCart">

                    <div class="icon-cart">
                        <button id="btnCheckCart" class="cart">
                            <i class="fas fa-shopping-bag"></i>
                            <span class="count">5</span>
                        </button>
                    </div>

                    <div class="panel-check-cart shadow-sm">
                        <!-- cart-empty -->
                        <div class="panel-body empty">
                            <p>Hiện chưa có sản phẩm nào</p>
                            <a href="#" class="link hv-lb">Đi đến cửa hàng</a>
                        </div>

                        <!-- cart-not-empty -->
                        <!-- <div class="panel-body has">
                          <ul class="list-unstyled">
                            <li class="media">
                              <img class="mr-3" src="./public/images/pd-1.jpg" alt="Generic placeholder image">
                              <div class="media-body">
                                <div class="left">
                                  <h6 class="mt-0 mb-1">List-based media object</h6>
                                  <div class="quantity">
                                    <span class="mc-quantity">
                                      Quantity:
                                      <span class="count">1</span>
                                      *
                                      <span class="price">150.000 VNĐ</span>
                                    </span>
                                  </div>
                                </div>
                                <div class="right">
                                  <div class="price-count">
                                    <span>150.000 VNĐ</span>
                                  </div>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </div> -->


                        <div class="panel-footer has">
                            <div class="panel-footer-body">
                                <!-- <div class="panel-btn">
                                  <a href="#" class="btn-viewcart">View Cart</a>
                                  <a href="#" class="btn-checkout">Checkout</a>
                                </div> -->
                                <div class="price-count">
                                    <span class="text">Tổng giỏ hàng:</span> <span
                                        class="count-cart"> 100.000 VNĐ</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="mobile-menu-overlay"></div>
        </div>
    </div>
</nav>
<!-- /nav -->
