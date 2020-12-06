import React, { useState, useEffect } from 'react';
import Swal from 'sweetalert2';

// Model
import TypeProductModel from '../../../model/EssentialOil/typeProduct';
import CategoryProductController from '../../../controller/EssentialOil/categoryProduct';

import './style.scss'

const EssentialOilCategoryProduct = () => {
  /**
   * USER STATE
   */
  //data set
  const [tookDataTypeProperty, setTookDataTypeProperty] = useState(false);
  const [tookCategoryProduct, setTookCategoryProduct] = useState(false);
  const [dataNewCategoryProduct, setDataNewCategoryProduct] = useState({
    name: '',
    typeProduct_id: ''
  });

  //data main to get
  const [dataTypeProduct, setDataTypeProduct] = useState([]);
  const [dataCategoryProduct, setDataCategoryProduct] = useState([]);


  /**
   * FUNCTION
   */
  const actionAdd = (event) => {
    event.preventDefault();
    CategoryProductController.add(dataNewCategoryProduct, (result) => {
      if (result.status == 200) {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Thêm thành công! 😉',
          showConfirmButton: false,
          timer: 1000
        });
        setDataNewCategoryProduct({
          name: '',
          typeProduct_id: ''
        }); //refresh input
        setTookCategoryProduct(false);
        document.getElementById('selectTypeProduct').value = 'null';
      } else {
        Swal.fire({
          position: 'top-end',
          icon: 'error',
          title: 'Thêm không thành công! 😥',
          showConfirmButton: false,
          timer: 1000
        });
      }
    });
  };

  const formatDate = (strDate) => {
    let date = new Date(strDate);
    return `${date.getDate() < 10 ? '0' + date.getDate() : date.getDate()}-${date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth()}-${date.getFullYear()}`;
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

        CategoryProductController.delete(data, (result) => {
          if (result.status == 200) {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Xoá thành công! 😉',
              showConfirmButton: false,
              timer: 900
            });
            // getData(false); //get new data
            setTookCategoryProduct(false);

          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Xoá không thành công! 😥',
            });
          }
        })
      }
    })
  };

  const alertBoxEdit = (itemEdit) => {
    let dataType = dataTypeProduct.map(item => item.EssentialOilType_Name);

    Swal.mixin({
      allowOutsideClick: () => !Swal.isLoading(),
      confirmButtonText: 'Next &rarr;',
      showCancelButton: true,
      progressSteps: ['1', '2']
    }).queue([
      {
        input: 'text',
        title: 'Tên loại sản phẩm',
        text: 'Nhập tên loại sản phẩm mới',
        inputPlaceholder: itemEdit.EssentialOilCategory_Name
      },
      {
        input: 'select',
        title: 'Thể loại',
        text: 'Chọn thể loại sản phẩm mới',
        inputOptions: dataType
      },
    ]).then((result) => {
      if (result.value) {
        const answers = result.value;
        let nameChange = answers[0].trim();
        let typeProduct_idChange = dataTypeProduct[answers[1]].id;

        if (nameChange != '') {
          let data = {
            'idCategory': itemEdit.id,
            'nameChange': nameChange,
            'typeProduct_idChange': typeProduct_idChange
          };

          CategoryProductController.edit(data, (result) => {
            if (result.status == 200) {
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Sửa thành công! 😉',
                showConfirmButton: false,
                timer: 900
              });
              // getData(false); //get new data
              setTookCategoryProduct(false);
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Sửa không thành công! 😥',
              });
            }
          });

        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Sửa không thành công! 😥',
          });
        }
      }
    })
  };

  /**
   * LIFE CIRCLE COMPONENT
   */
  useEffect(() => {
    // Load data type
    if (!tookDataTypeProperty) {
      TypeProductModel.getData((data) => {
        setDataTypeProduct(data);
        setTookDataTypeProperty(true);
      });
    }

    // Load data category
    if (!tookCategoryProduct) {
      CategoryProductController.getData((data) => {
        setDataCategoryProduct(data);
        setTookCategoryProduct(true);
      });
    }
  });


  /**
   * RETURN RENDER COMPONENT
   */
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
                  <h3 className="card-title">Thêm loại sản phẩm</h3>
                </div>
                <form method="POST" onSubmit={actionAdd}>
                  <div className="card-body">
                    <div className="form-group">
                      <label htmlFor="essentialOilCategory_Name">Tên loại sản phẩm thêm</label>
                      <input type="text" className="form-control"
                        id="essentialOilCategory_Name" placeholder="Tên loại sản phẩm muốn thêm..."
                        value={dataNewCategoryProduct.name}
                        onChange={(event) => setDataNewCategoryProduct({ name: event.target.value, typeProduct_id: dataNewCategoryProduct.typeProduct_id })}
                      />
                    </div>

                    <div className="form-group">
                      <label>Thể loại sản phẩm</label>
                      <select id="selectTypeProduct" className="form-control select2 select2-hidden-accessible"
                        style={{ width: '100%' }}
                        defaultValue='null'
                        onChange={(event) => setDataNewCategoryProduct({ name: dataNewCategoryProduct.name, typeProduct_id: event.target.value })}
                      >
                        <option value="null" disabled> Choose a salutation ...</option>
                        {dataTypeProduct.map((item, index) => (
                          <option key={index} value={item.id}> {item.EssentialOilType_Name} </option>
                        ))}
                      </select>
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
                    {/* <button type="button" className="btn btn-tool" data-card-widget="remove">
                      <i className="fas fa-times"></i>
                    </button> */}
                  </div>
                </div>

                <div className="card-body p-0">
                  <div className="table-responsive">
                    <table className="table m-0" id="gridViewCategoryProduct">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Tên loại</th>
                          <th>Thể loại</th>
                          <th>Số lượng sản phẩm có</th>
                          <th>Ngày thêm</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        {dataCategoryProduct.map((item, index) => (
                          <tr key={item.id}>
                            <td> <a href="#">{item.id}</a> </td>
                            <td> {item.EssentialOilCategory_Name} </td>
                            <td> {item.EssentialOilType_Name} </td>
                            <td> <span className="badge badge-success">0</span> </td>
                            <td> {formatDate(item.created_at)} </td>
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
  );
}

export default EssentialOilCategoryProduct;