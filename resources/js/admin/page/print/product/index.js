import React, {useState, useEffect} from "react";
import {Link} from "react-router-dom";
import axios from "axios";
import Swal from "sweetalert2";

/**
 * MODEL PRODUCT
 * */
const PrintProductModel = {
  /* Add new product */
  add: (data, callback) => {
    axios.post('/admin/print-store/product/add/sub-add', data)
      .then(response => {
        callback({status: response.data.status === 200 ? 200 : 303})
      })
      .catch(error => {
        callback({status: 303})
      })
  },

  /**
   * Get all data product in Print Store
   * @param callback
   */
  getAll: (callback) => {
    axios.post('/admin/print-store/product/get-all')
      .then(response => {
        if (response.data.status == 200) {
          callback({status: 200, data: response.data.data})
        } else {
          callback({status: 303, data: []})
        }
      })
      .catch(error => {
        callback({status: 303, data: []})
      })
  },

  edit: (data, callback) => {
    axios.post('/admin/print-store/product/edit/sub-edit', data)
      .then((response) => {
        if(response.data.status == 200) {
          callback({ status: 200 });
        }else{
          callback({ status: 303 })
        }
      })
      .catch(error => {
        callback({ status: 303 })
      });
  },

  delete: (data, callback) => {
    axios.post('/admin/print-store/product/delete/sub-delete', data)
      .then((response) => {
        if(response.data.status == 200) {
          callback({ status: 200 });
        }else{
          callback({ status: 303 })
        }
      })
      .catch(error => {
        callback({ status: 303 })
      });
  }
};

/**
 * CONTROLLER PRODUCT
 * */
export const PrintProductController = {
  /**
   * Get all product
   * @param callback
   */
  getAll: (callback) => {
    PrintProductModel.getAll(callback);
  },

  /* Add new product */
  add: (data, callback) => {
    data.set('nameProduct', data.get('nameProduct').trim());
    data.set('listPrice', data.get('listPrice').trim());
    data.set('sapo', data.get('sapo').trim());
    data.set('description', data.get('description').trim());
    data.set('information', data.get('information').trim());
    data.set('lengthListImage', data.get('lengthListImage').trim());

    if (data.get('nameProduct') === ''
      || data.get('listPrice') === ''
      || data.get('image0') == null
      || data.get('sapo') === ''
      || data.get('lengthListImage') === 0) {
      callback({status: 202})
    } else {
      PrintProductModel.add(data, callback);
    }
  },

  edit: (data, callback) => {
    data.set('idProduct', data.get('idProduct').trim());
    data.set('nameProduct', data.get('nameProduct').trim());
    data.set('listPrice', data.get('listPrice').trim());
    data.set('sapo', data.get('sapo').trim());
    data.set('description', data.get('description').trim());
    data.set('information', data.get('information').trim());
    data.set('lengthListImageNew', data.get('lengthListImageNew').trim());

    if (data.get('nameProduct') === ''
      || data.get('idProduct') === ''
      || data.get('listPrice') === ''
      || data.get('sapo') === ''
      || (data.get('image0') == null && JSON.parse(data.get('listImageOld')).length == 0) && data.get('lengthListImageNew') == 0) {
      callback({status: 202})
    } else {
      PrintProductModel.edit(data, callback);
    }
  },

  delete: (data, callback) => {
    data.set('idProduct', data.get('idProduct').trim());

    if(data.get('idProduct') == ''){
      callback({status: 202})
    }else{
      PrintProductModel.delete(data, callback);
    }
  }
};

/**
 * VIEW PRODUCT
 * */
const CmpTableListPrice = (props) => {
  const listPrice = JSON.parse(props.data);

  return (
    <table style={{width: '100%'}}>
      <tbody>
      {listPrice.map((item, index) => (
        <tr key={index}>
          <td style={{width: '50%'}}>{item.count}</td>
          <td>{item.price}</td>
        </tr>
      ))}
      </tbody>
    </table>
  )
};

const PrintProduct = () => {
  const [dataProduct, setDataProduct] = useState([]);

  /**
   * FUNCTION
   */
  const formatDate = (strDate) => {
    let date = new Date(strDate);
    return `${date.getDate() < 10 ? '0' + date.getDate() : date.getDate()}-${date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth()}-${date.getFullYear()}`;
  };

  /*
  Constructor
  * */
  useEffect(() => {
    PrintProductController.getAll(result => {
      if (result.status == 200) {
        setDataProduct(result.data);
        console.log(dataProduct);
      }

    });
  }, [])

  return (
    <div className="content-wrapper">
      <div className="content-header">
        <div className="container-fluid">
          <div className="row mb-2">
            <div className="col-sm-12">
              <h1 className="m-0">Sản phẩm In Ấn</h1>
            </div>
          </div>
        </div>
      </div>

      <section className="content">
        <div className="container-fluid">
          <div className="row">

            {/*<div className="col-md-12">*/}
            {/*  <div className="card collapsed-card">*/}
            {/*    <div className="card-header border-transparent">*/}
            {/*      <h3 className="card-title">Form tìm kiếm sản phẩm</h3>*/}

            {/*      <div className="card-tools">*/}
            {/*        <button type="button" className="btn btn-tool" data-card-widget="collapse">*/}
            {/*          <i className="fas fa-minus"></i>*/}
            {/*        </button>*/}
            {/*      </div>*/}
            {/*    </div>*/}

            {/*    <div className="card-body p-0">*/}

            {/*    </div>*/}
            {/*  </div>*/}
            {/*</div>*/}

            <div className="col-md-12">
              <div className="card">
                <div className="card-header border-transparent">
                  <h2 className="card-title">Danh sách sản phẩm</h2>

                  <div className="card-tools">
                    <Link to="/admin/print-store/product-add" className="btn btn-success">
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
                        <th>Số lượng</th>
                        <th>Giá bán</th>
                        <th>Mô tả nhanh</th>
                        <th>Ngày thêm</th>
                      </tr>
                      </thead>
                      <tbody>
                      {dataProduct.map((item, index) => (
                        <tr key={item.id}>
                          <td>
                            <Link to={{ pathname: '/admin/print-store/product-edit', state: item }}>{item.id}</Link>
                          </td>
                          <td> {item.PrintProduct_Name} </td>
                          <td colSpan={2}><CmpTableListPrice data={item.PrintProduct_ListPrice}/></td>
                          <td>
                            <img className="img"
                                 src={`/image/print-store/product/${item.id}/${JSON.parse(item.PrintProduct_ListImage)[0].idImage}`}/>
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
  );
};


export default PrintProduct;
