import React, { useState, useEffect } from 'react';
import axios from 'axios';
import Swal from 'sweetalert2'

import './style.scss'

const EssentialOilCategoryProduct = props => {
  return (
    <div className="content-wrapper">
      <div className="content-header">
        <div className="container-fluid">
          <div className="row mb-2">
            <div className="col-sm-12">
              <h1 className="m-0">Thể loại sản phẩm</h1>
            </div>
          </div>
        </div>
      </div>

      <section className="content">
        <div className="container-fluid">
          <div className="row">

            <div className="col-md-4">
              <div className="card card-primary">
                <div className="card-header">
                  <h3 className="card-title">Thêm thể loại sản phẩm</h3>
                </div>
                <form method="POST">
                  <div className="card-body">
                    <div className="form-group">
                      <label htmlFor="essentialOilCategory_Name">Tên loại sản phẩm thêm</label>
                      <input type="text" className="form-control" id="essentialOilCategory_Name" placeholder="Tên loại sản phẩm muốn thêm..." />
                    </div>
                  </div>

                  <div className="card-footer">
                    <button type="submit" className="btn btn-primary">Thêm</button>
                  </div>
                </form>
              </div>
            </div>


            <div className="col-md-8">
              <div className="card">
                <div className="card-header border-transparent">
                  <h3 className="card-title">Danh sách loại sản phẩm</h3>

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
                    <table className="table m-0" id="gridViewCategoryProduct">
                      <thead>
                        <tr>

                        </tr>
                      </thead>
                      <tbody>

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
  );
}

export default EssentialOilCategoryProduct;