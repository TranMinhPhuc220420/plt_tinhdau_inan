import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import Swal from 'sweetalert2';

// Controller
import EssentialOilProductController from '../../../controller/EssentialOil/product'

import './style.scss';

const EssentialOilProduct = props => {
  const [dataProduct, setDataProduct] = useState([]);

  /**
   * FUNCTION
   */
  const formatDate = (strDate) => {
    let date = new Date(strDate);
    return `${date.getDate() < 10 ? '0' + date.getDate() : date.getDate()}-${date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth()}-${date.getFullYear()}`;
  };

  /**
   * LIFE CIRCLE COMPONENT
   */
  useEffect(() => {
    EssentialOilProductController.getAll(result => {
      if (result.status === 200) {
        setDataProduct(result.data);
      }
    })
  }, [])

  return (
    <div className="content-wrapper">
      <div className="content-header">
        <div className="container-fluid">
          <div className="row mb-2">
            <div className="col-sm-12">
              <h1 className="m-0">Sản phẩm tinh dầu</h1>
            </div>
          </div>
        </div>
      </div>

      <section className="content">
        <div className="container-fluid">
          <div className="row">

            <div className="col-md-12">
              <div className="card">
                <div className="card-header border-transparent">
                  <h3 className="card-title">Danh sách sản phẩm</h3>

                  <div className="card-tools">
                    <Link to="/admin/essential-oil/product-add" className="btn btn-success">
                      Thêm sản phẩm mới <i className="fas fa-plus"></i>
                    </Link>
                  </div>
                </div>

                <div className="card-body p-0">
                  <div className="table-responsive">
                    <table className="table m-0" id="gridViewProduct">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Tên sản phẩm</th>
                          <th>Tên loại sản phẩm</th>
                          <th>Bán được</th>
                          <th>Giá chính</th>
                          <th>Giá giảm</th>
                          <th>Mô tả nhanh</th>
                          <th>Ngày thềm</th>
                        </tr>
                      </thead>
                      <tbody>
                        {dataProduct.map((item, index) => (
                          <tr key={item.product_id}>
                            <td> <Link to={{ pathname: '/admin/essential-oil/product-edit', state: item }}>{item.product_id}</Link> </td>
                            <td> {item.EssentialOilProduct_Name} </td>
                            <td> {item.EssentialOilCategory_Name} </td>
                            <td> <span className="badge badge-success"> 0 </span> </td>
                            <td> {item.EssentialOilProduct_Price} </td>
                            <td> {item.EssentialOilProduct_Discount} </td>
                            <td>
                              <img className="img" src={`/image/essential-oil/product/${item.product_id}/${JSON.parse(item.EssentialOilProduct_ListImage)[0].idImage}`}/>
                            </td>
                            <td> {formatDate(item.created_at)} </td>
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
  )
};

export default EssentialOilProduct;