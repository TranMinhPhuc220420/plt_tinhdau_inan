<!-- nav -->
<nav class="navbar">
    <div class="container">
        <div class="nav-left">
            <div class="nav-logo">
                <a href="/essential-oil">
                    <img src="{{asset('images/logo-eva-vn-c5.jpg')}}" alt="" class="logo">
                </a>
            </div>

            <div class="name-business">
                <a href="/essential-oil"><span class="text">Tinh dầu Thủ Đức</span></a>
            </div>

            <div class="collapse-nav">
                <a class="cart">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="count">0</span>
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
                        <a href="/essential-oil" class="link">Trang chủ</a>
                    </li>

                    <li class="item pos-re hv-lb">
                        <a href="/essential-oil/shop" class="link">Cửa hàng</a>
                    </li>

                    <li class="item pos-re hv-lb">
                        <a href="{{ url('/contact') }}" class="link">Liên hệ</a>
                    </li>
                </ul>
            </div>

            <div class="nav-search nav-link">
                <form action="{{ route('essential-oil-search') }}" id="formSearch" class="form-search">
                    <input class="shadow-sm" type="text" name="key" placeholder="Enter key search...">
                    <button id="btnSearchNav" class="btn-submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <div class="nav-icon">
                <div class="cart" id="panelCheckCart">

                    <div class="icon-cart">
                        <button id="btnCheckCart" class="cart">
                            <i class="fas fa-shopping-bag"></i>
                            <span id="countProductInCart" class="count"> 0 </span>
                        </button>
                    </div>

                    <div class="panel-check-cart shadow-sm">
                        <!-- cart-empty -->
                        <div class="panel-body empty" id="panelCartIsEmpty">
                            <p>Hiện chưa có sản phẩm nào</p>
                            <a href="{{ url('/essential-oil/shop') }}" class="link hv-lb">Đi đến cửa hàng</a>
                        </div>

                        <!-- cart-not-empty -->
                        <div id="panelListProductInCart" class="panel-body has">
                          <ul class="list-unstyled" id="listProductInCart">

                          </ul>
                        </div>


                        <div class="panel-footer has">
                            <div class="panel-footer-body">
                                <div id="dockBtnCheckoutInCart" class="panel-btn">
                                  <a href="{{ url('/essential-oil/cart') }}" class="btn-viewcart">View Cart</a>
                                  <a href="{{ url('/essential-oil/cart') }}" class="btn-checkout">Checkout</a>
                                </div>
                                <div class="price-count">
                                    <span class="text">Tổng giỏ hàng:</span> <span
                                        class="count-cart"> <span id="priceCountInCart"> </span> VNĐ</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</nav>
<!-- /nav -->
