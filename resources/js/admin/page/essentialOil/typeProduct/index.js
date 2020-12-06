import React, { useState, useEffect } from 'react';
import axios from 'axios';
import Swal from 'sweetalert2'

import './style.scss'

const EssentialOilTypeProduct = () => {
  const [nameTypeProduct, setNameTypeProduct] = useState('');
  const [dataTypeProduct, setDataTypeProduct] = useState([]);
  const [tookData, setTookData] = useState(false);

  //Function
  const actionAdd = (event) => {
    event.preventDefault();
    nameTypeProduct.trim();

    if (nameTypeProduct != '') {
      let data = {
        name: nameTypeProduct
      };

      axios.post('/admin/essential-oil/type-product/add', data)
        .then(response => {
          if (response.status === 200 && response.data.message == 'ok') {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Thêm thành công! 😉',
              showConfirmButton: false,
              timer: 1000
            });
            setNameTypeProduct(''); //refresh input
            // getData(false); //get new data
            setTookData(false);
          }
        });
    } else {
      Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: 'Thêm không thành công! 😥',
        showConfirmButton: false,
        timer: 1000
      });
    }

  };

  const formatDate = (strDate) => {
    let date = new Date(strDate);
    return `${date.getDate() < 10 ? '0' + date.getDate() : date.getDate()}-${date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth()}-${date.getFullYear()}`;
  };

  const getData = (isConstructor) => {
    axios.get('/admin/essential-oil/type-product/get-all')
      .then((response) => {
        if (response.status == 200) {
          setDataTypeProduct(response.data.data);
          setTookData(true);
        }
      });
  };

  const alertBoxEdit = (itemEdit) => {
    Swal.fire({
      title: 'Nhập tên thể loại sản phẩm bạn muốn sửa',
      input: 'text',
      inputPlaceholder: itemEdit.EssentialOilType_Name,
      inputAttributes: {
        autocapitalize: 'off'
      },
      confirmButtonText: 'Sửa',
      showLoaderOnConfirm: true,
      preConfirm: (nameTypeProductChange) => {
        nameTypeProductChange.trim();

        if (nameTypeProductChange !== '') {
          let data = {
            id: itemEdit.id,
            nameChange: nameTypeProductChange
          };

          return axios.post('/admin/essential-oil/type-product/edit', data)
            .then(response => {
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Sửa thành công! 😉',
                showConfirmButton: false,
                timer: 900
              });
              // getData(false); //get new data
              setTookData(false);
            })
            .catch(error => {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Sửa không thành công! 😥',
              });
            });

        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Sửa không thành công! 😥',
          });
        }
      },
      allowOutsideClick: () => !Swal.isLoading()
    });
  };

  const deleteConfirm = (itemDelete) => {
    Swal.fire({
      title: 'Xoá thể loại sản phẩm',
      text: "Bạn có chắc là muốn xoá không? 🤔",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok, xoá nó đi'
    }).then((result) => {
      if (result.isConfirmed) {
        let data = {
          id: itemDelete.id,
        };

        return axios.post('/admin/essential-oil/type-product/delete', data)
          .then(response => {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Xoá thành công! 😉',
              showConfirmButton: false,
              timer: 900
            });
            // getData(false); //get new data
            setTookData(false);
          })
          .catch(error => {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Xoá không thành công! 😥',
            });
          });
      }
    })
  };

  // Construct
  useEffect(() => {
    if (!tookData) {
      getData();
    }
  });

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
                <form method="POST" onSubmit={actionAdd}>
                  <div className="card-body">
                    <div className="form-group">
                      <label htmlFor="essentialOilType_Name">Tên thể loại sản phẩm thêm</label>
                      <input type="text" className="form-control" id="essentialOilType_Name" placeholder="Tên thể loại sản phẩm muốn thêm..."
                        value={nameTypeProduct}
                        onChange={(event) => setNameTypeProduct(event.target.value)} />
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
                  <h3 className="card-title">Danh sách thể loại sản phẩm</h3>

                  <div className="card-tools">
                    <button type="button" className="btn btn-tool" data-card-widget="collapse">
                      <i className="fas fa-minus"></i>
                    </button>
                    {/* <button type="button" className="btn btn-tool" data-card-widget="remove">
                      <i className="fas fa-times"></i>
                    </button> */}
                  </div>
                </div>

                <div className="card-body p-0">
                  <div className="table-responsive">
                    <table className="table m-0" id="gridViewTypeProduct">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Tên loại</th>
                          <th>Số lượng loại sản phẩm</th>
                          <th>Ngày thêm</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        {dataTypeProduct.map((item, index) => (
                          <tr key={item.id}>
                            <td> <a href="#">{item.id}</a> </td>
                            <td> {item.EssentialOilType_Name} </td>
                            <td> <span className="badge badge-success">0</span> </td>
                            <td> {formatDate(item.EssentialOilType_UpdateAt)} </td>
                            <td className="td-center">
                              <a className="badge badge-success"
                                onClick={() => alertBoxEdit(item)} // Click edit
                              > <i className="far fa-edit" /> </a>
                            </td>
                            <td className="td-center">
                              <a className="badge badge-danger"
                                onClick={() => deleteConfirm(item)} // Click delete
                              > <i className="fas fa-trash" /> </a>.
                            </td>
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

export default EssentialOilTypeProduct;
