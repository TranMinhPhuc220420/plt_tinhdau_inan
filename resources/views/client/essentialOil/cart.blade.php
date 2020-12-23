@extends('client.essentialOil.layout.main')

@section('content')
  <!-- content -->
  <div id="content">
    <div class="container">
      <section class="view-cart shadow">
        <table class="table">
          <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col">Đơn giá</th>
            <th scope="col">Giá giảm</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Tổng</th>
          </tr>
          </thead>
          <tbody id="listProductCheckout">
          {{--     CONTENT LIST CHECKOUT       --}}
          </tbody>
        </table>

        <div class="total-price-order text-right" style="padding: 10px 20px">
          <h5>Tổng hoá đơn: </h5><h3 id="totalOrder"></h3>
        </div>
      </section>

      <section class="information-order mt-5 shadow-sm">
        <form method="POST" id="formAddOrder" action="/WhatAreYouDoing? (-.-)" accept-charset="UTF-8">
          <h2 class="subtitle">Thông tin đặt hàng của bạn</h2>
          <p>Hãy điền đầy đủ thông tin bên dưới để chúng tôi có thể liên hệ nhanh nhất cho bạn.</p>
          <div class="panel panel-default">
            <div id="collapse-shipping" class="">
              <div class="panel-body">
                <table class="table table-bordered table-hover">
                  <tbody>
                  <tr>
                    <td width="30%" style="vertical-align: middle;">Họ và tên <b style="color:red;">*</b></td>
                    <td>
                      <input class="form-control" id="inputOrderFullName" name="Name" type="text" value="" required>
                    </td>
                  </tr>
                  <tr>
                    <td width="30%" style="vertical-align: middle;">SĐT <b style="color:red;">*</b></td>
                    <td>
                      <input class="form-control" id="inputOrderPhoneNumber" name="Phone" type="tel" value="" required>
                    </td>
                  </tr>
                  <tr>
                    <td width="30%" style="vertical-align: middle;">Email</td>
                    <td>
                      <input class="form-control" id="inputOrderEmail" name="Email" type="email" value="">
                    </td>
                  </tr>
                  <tr>
                    <td width="30%" style="vertical-align: middle;">Địa chỉ <b style="color:red;">*</b></td>
                    <td>
                      <input class="form-control" id="inputOrderAddress" name="Address" type="text" value="" required>
                    </td>
                  </tr>
                  <tr>
                    <td width="30%" style="vertical-align: middle;">Ghi chú</td>
                    <td>
                      <textarea class="form-control" id="inputOrderNote" style="height:120px;" name="Note" cols="50" rows="10"></textarea>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="buttons">
            <div class="pull-right text-right">
              <button type="submit" class="btn btn-primary">Hoàn tất đặt hàng</button>
            </div>
          </div>
        </form>
      </section>
    </div>
  </div>
  <!-- /content -->
@endsection

