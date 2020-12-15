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
    axios.get('/admin/order/get-data-live')
      .then(response => {
        callback(response.data)
      });
  },
};

const Home = () => {
  const [dataLive, setDataLive] = useState([]);
  const [dataListOrder, setDataListOrder] = useState([]);

  useEffect(() => {
    LiveModel.getDataLive(result => {
      setDataLive(result)
    });
  }, [])

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
                  <h3 className="card-title">Đơn hàng mới nhất</h3>

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
                    <table className="table m-0">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Mục</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td><a href="pages/examples/invoice.html">OR9842</a></td>
                        <td>Call of Duty IV</td>
                        <td><span className="badge badge-success">Shipped</span></td>
                        <td>
                          <div className="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                        </td>
                      </tr>
                      <tr>
                        <td><a href="pages/examples/invoice.html">OR1848</a></td>
                        <td>Samsung Smart TV</td>
                        <td><span className="badge badge-warning">Pending</span></td>
                        <td>
                          <div className="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                        </td>
                      </tr>
                      <tr>
                        <td><a href="pages/examples/invoice.html">OR7429</a></td>
                        <td>iPhone 6 Plus</td>
                        <td><span className="badge badge-danger">Delivered</span></td>
                        <td>
                          <div className="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                        </td>
                      </tr>
                      <tr>
                        <td><a href="pages/examples/invoice.html">OR7429</a></td>
                        <td>Samsung Smart TV</td>
                        <td><span className="badge badge-info">Processing</span></td>
                        <td>
                          <div className="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                        </td>
                      </tr>
                      <tr>
                        <td><a href="pages/examples/invoice.html">OR1848</a></td>
                        <td>Samsung Smart TV</td>
                        <td><span className="badge badge-warning">Pending</span></td>
                        <td>
                          <div className="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                        </td>
                      </tr>
                      <tr>
                        <td><a href="pages/examples/invoice.html">OR7429</a></td>
                        <td>iPhone 6 Plus</td>
                        <td><span className="badge badge-danger">Delivered</span></td>
                        <td>
                          <div className="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                        </td>
                      </tr>
                      <tr>
                        <td><a href="pages/examples/invoice.html">OR9842</a></td>
                        <td>Call of Duty IV</td>
                        <td><span className="badge badge-success">Shipped</span></td>
                        <td>
                          <div className="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                        </td>
                      </tr>
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
    </div>
  )
};

export default Home;
