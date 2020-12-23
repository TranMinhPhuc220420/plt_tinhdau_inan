@extends('client.layouts.main')

@section('content')
  <!-- content -->
  <div id="content">
    <div class="container">
      <section class="contact">

        <div class="section-body mt-5">
          <div class="row" style="font-size: 13px;">
            <!--Middle Part Start-->
            <div id="bodyLeft" class="col-sm-6">
              <h3 class="subtitle" style=" border-bottom: 1px solid #ddd; padding-bottom: 5px; ">Địa chỉ cửa hàng</h3>
              <div class="row">
                <div class="col-sm-5"><strong>Cty TNHH TM-DV EVA VIỆT NAM</strong><br>
                  <address>
                    163/34 Đặng Văn Bi, P.Trường Thọ, Thủ Đức, TP.Hồ Chí Minh
                  </address>
                </div>
                <div class="col-sm-3"><strong>Điện thoại</strong><br>
                  <p>0389989499 (Tinh dầu)</p>
                  <p>0931489629 (In ấn)</p>
                </div>
                <div class="col-sm-4"><strong>Email</strong><br>
                  <p>saleinnhanhre@gmail.com</p>
                  <p>thiepcuoieva@gmail.com</p>
                  <p>tinhdauthuduc@gmail.com</p>
                </div>
              </div>
              <div class="row">
                <iframe width="100%" height="450" frameborder="0" style="border:0"
                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCNwNoMrcX-13gO_Aou-OjwyIwTfYt_qcg&amp;q=195+Đặng+Văn+Bi,+Trường+Thọ,+Thủ+Đức,+Thành+phố+Hồ+Chí+Minh,+Vietnam"
                        allowfullscreen="">
                </iframe>
              </div>
            </div>
            <aside id="bodyRight" class="col-sm-6 mt-3">
              <form method="POST" action="#" accept-charset="UTF-8" class="form-horizontal">
                <fieldset class="shadow" style="border: none">
                  <h3 class="subtitle" style=" border-bottom: 1px solid #ddd; padding-bottom: 5px; ">Gửi tin nhắn cho
                    chúng tôi</h3>
                  <div class="form-group required">
                    <label class="col-md-2 col-sm-3 control-label" for="input-name">Tên bạn</label>
                    <input class="form-control" name="Name" type="text" value="">
                  </div>
                  <div class="form-group required">
                    <label class="col-md-2 col-sm-3 control-label" for="input-email">Email</label>
                    <input class="form-control" name="Email" type="email" value="">
                  </div>
                  <div class="form-group required">
                    <label class="col-md-2 col-sm-3 control-label" for="input-email">SDT</label>
                    <input class="form-control" name="Phone" type="text" value="">
                  </div>
                  <div class="form-group required">
                    <label class="col-md-2 col-sm-3 control-label" for="input-enquiry">Nội dung</label>
                    <textarea class="form-control" name="Note" cols="50" rows="10"></textarea>
                  </div>
                </fieldset>
                <div class="buttons mt-2">
                  <div class="pull-right" style="text-align: right">
                    <input class="btn btn-primary" type="submit" value="Gửi tin nhắn">
                  </div>
                </div>
              </form>
            </aside>
            <!--Middle Part End -->
          </div>
        </div>
      </section>
    </div>
  </div>
  <!-- /content -->
@endsection

