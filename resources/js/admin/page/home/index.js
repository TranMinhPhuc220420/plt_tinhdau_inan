import React, {useState, useEffect} from 'react';
import './style.scss';

import axios from "axios";

const LiveModel = {
  getDataLive: (callback) => {
    axios.get('/api/admin/home/get-data-live')
      .then(response => {
        callback(response.data)
      });
  }
};

const OrderModel = {
  getData: (callback) => {
    axios.get('/admin/print-store/order/get-all')
      .then(response => {
        callback(response.data.data)
      });
  },
};

const Home = () => {
  const [dataLive, setDataLive] = useState([]);
  const [dataListPrintStoreOrder, setDataListPrintStoreOrder] = useState([]);
  const [dataItemPrintStoreOrderSelected, setDataItemPrintStoreOrderSelected] = useState(null);

  useEffect(() => {
    LiveModel.getDataLive(result => setDataLive(result));
    OrderModel.getData(result => setDataListPrintStoreOrder(result))
  }, [])

  const formatDate = (strDate) => {
    let date = new Date(strDate);
    return `${date.getDate() < 10 ? '0' + date.getDate() : date.getDate()}-${date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth()}-${date.getFullYear()}`;
  };

  return (
    <div className="content-wrapper">
      <div className="content-header">
        <div className="container-fluid">
          <div className="row mb-2">
            <div className="col-sm-12">
              <h1 className="m-0">Trang chủ</h1>
            </div>
          </div>
        </div>
      </div>

      <section className="content">
        <div className="container-fluid">
          <div className="row">
            <div className="col-12 col-sm-6 col-md-3">
              <div className="info-box">
                <span className="info-box-icon bg-info elevation-1"><i className="far fa-eye"></i></span>

                <div className="info-box-content">
                  <span className="info-box-text">Lượt xem trang</span>
                  <span className="info-box-number">
                    {dataLive.userLive}
                </span>
                </div>
              </div>
            </div>
            <div className="col-12 col-sm-6 col-md-3">
              <div className="info-box mb-3">
                <span className="info-box-icon bg-danger elevation-1"><i className="fas fa-th"></i></span>

                <div className="info-box-content">
                  <span className="info-box-text">Số lượng sản phẩm</span>
                  <span className="info-box-number">{dataLive.countProduct}</span>
                </div>
              </div>
            </div>

            <div className="clearfix hidden-md-up"></div>

            <div className="col-12 col-sm-6 col-md-3">
              <div className="info-box mb-3">
                <span className="info-box-icon bg-success elevation-1"><i className="fas fa-receipt"></i></span>

                <div className="info-box-content">
                  <span className="info-box-text">Số lượng đơn hàng</span>
                  <span className="info-box-number">{dataLive.countOrder}</span>
                </div>
              </div>
            </div>
            <div className="col-12 col-sm-6 col-md-3">
              <div className="info-box mb-3">
                <span className="info-box-icon bg-warning elevation-1"><i className="fas fa-users"></i></span>

                <div className="info-box-content">
                  <span className="info-box-text">Phản hồi người dùng</span>
                  <span className="info-box-number">{dataLive.countFeedBack}</span>
                </div>
              </div>
            </div>
          </div>

          <div className="row">
            <div className="col-md-12">
              <div className="card">
                <div className="card-header border-transparent">
                  <h3 className="card-title"><strong>In ấn</strong> - Đơn hàng mới nhất</h3>

                  <div className="card-tools">
                    <button type="button" className="btn btn-tool" data-card-widget="collapse">
                      <i className="fas fa-minus"></i>
                    </button>
                    <button type="button" className="btn btn-tool" data-card-widget="remove">
                      <i className="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div className="card-body p-0">
                  <div className="table-responsive">
                    <table className="table m-0 gridView-default">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Trạng thái</th>
                        <th>Tổng hoá đơn</th>
                        <th>Ngày đặt</th>
                      </tr>
                      </thead>
                      <tbody>
                      {dataListPrintStoreOrder.map((item, index) => (
                        <tr key={index} data-toggle="modal" data-target="#modalDetailItemPrintStoreOrder"
                            onClick={(event => {
                              setDataItemPrintStoreOrderSelected(item);
                            })}>
                          <td>
                            {item.id}
                          </td>
                          <td>
                            {item.Order_FullNameUser}
                          </td>
                          <td>
                            {item.Order_Status == 0 && (
                              <small className="badge badge-danger">Chưa xem</small>
                            )}
                            {item.Order_Status == 1 && (
                              <small className="badge badge-warning">Đã xem</small>
                            )}
                            {item.Order_Status == 2 && (
                              <small className="badge badge-primary">Đã in hoá đơn</small>
                            )}
                            {item.Order_Status == 3 && (
                              <small className="badge badge-success">Đã giao</small>
                            )}
                          </td>
                          <td>{item.Order_ListProduct.countOrder}</td>
                          <td>{formatDate(item.created_at)}</td>
                        </tr>
                      ))}
                      </tbody>
                    </table>
                  </div>
                </div>
                <div className="card-footer clearfix">
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>


      {dataItemPrintStoreOrderSelected && (
        <div className="modal fade bd-example-modal-lg" id="modalDetailItemPrintStoreOrder" tabIndex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
          <div className="modal-dialog modal-lg">
            <div className="modal-content">

              <div className="modal-header">
                <h5 className="modal-title" id="exampleModalLabel">Hoá đơn Mã: {dataItemPrintStoreOrderSelected.id} của
                  khách hàng {dataItemPrintStoreOrderSelected.Order_FullNameUser}</h5>
                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div className="modal-body">
                <section className="content">
                  <div className="container-fluid">
                    <div className="row">
                      <div className="col-12">
                        <div className="callout callout-info">
                          <h5><i className="fas fa-info"></i> Note:</h5>
                          Trang này đã được cải tiến để in. Bấm vào nút in ở cuối hóa đơn để kiểm tra.
                        </div>


                        <div className="invoice p-3 mb-3" id="modalDetailItemPrintStoreOrder-toPrint">
                          <div className="row">
                            <div className="col-12">
                              <h4>
                                <i className="fas fa-globe"></i> Admin Eva VietNam.
                                <small className="float-right">Ngày: {formatDate(new Date())}</small>
                              </h4>
                            </div>
                          </div>
                          <div className="row invoice-info">
                            <div className="col-sm-8 invoice-col">
                              Gửi đến
                              <address>
                                <strong>{dataItemPrintStoreOrderSelected.Order_FullNameUser}</strong><br/>
                                <p>Địa Chỉ: {dataItemPrintStoreOrderSelected.Order_AddressUserSend}</p>
                                <br/>
                                Số điện thoại: {dataItemPrintStoreOrderSelected.Order_PhoneNumber}<br/>
                                Email: {dataItemPrintStoreOrderSelected.Order_EmailUser}
                              </address>
                            </div>
                            <div className="col-sm-4 invoice-col">
                              <b>Mã đơn hàng: {dataItemPrintStoreOrderSelected.id}</b><br/>
                              <br/>
                              <b>Mã đơn hàng:</b> {dataItemPrintStoreOrderSelected.id}<br/>
                              <b>Ngày gửi đơn:</b> {formatDate(dataItemPrintStoreOrderSelected.created_at)}<br/>
                            </div>
                          </div>
                          <div className="row">
                            <div className="col-12 table-responsive">
                              <table className="table table-striped">
                                <thead>
                                <tr>
                                  <th>STT</th>
                                  <th>Sản phẩm</th>
                                  <th>Mã sản phẩm</th>
                                  <th>Tổng giá</th>
                                </tr>
                                </thead>
                                <tbody>
                                {dataItemPrintStoreOrderSelected.Order_ListProduct.listProduct.map((item, index) => (
                                  <tr key={index + 1}>
                                    <td>{index}</td>
                                    <td>{item.dataProduct.PrintProduct_Name}</td>
                                    <td>{item.dataProduct.id}</td>
                                    <td>{item.priceSelect}</td>
                                  </tr>
                                ))}
                                </tbody>
                              </table>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>

              <div className="modal-footer">
                <button type="button" className="btn btn-primary">
                  <i className="far fa-eye"></i>
                  Đánh dấu đã xem
                </button>
                <button type="button" className="btn btn-primary" onClick={() => {
                  let mywindow = window.open('', 'PRINT');

                  mywindow.document.write('<html>' +
                    '<head><title>' + document.title + '</title>'
                  );
                  mywindow.document.write('</head><body >');
                  mywindow.document.write('<h1>' + document.title + '</h1>');
                  mywindow.document.write(document.getElementById('modalDetailItemPrintStoreOrder-toPrint').innerHTML);
                  mywindow.document.write('</body></html>');

                  mywindow.document.close(); // necessary for IE >= 10
                  mywindow.focus(); // necessary for IE >= 10*/

                  mywindow.print();
                  mywindow.close();
                }}>
                  <i className="fas fa-print"></i>
                  In Hoá đơn
                </button>
                <button type="button" className="btn btn-secondary" data-dismiss="modal">Đóng</button>
              </div>
            </div>

          </div>
        </div>
      )}
    </div>
  )
};

export default Home;
