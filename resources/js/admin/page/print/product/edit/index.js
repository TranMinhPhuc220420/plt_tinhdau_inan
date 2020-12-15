import React, {useState, useEffect} from 'react';
import JoditEditor from "jodit-react";
import Swal from 'sweetalert2';
import {useLocation, Link} from 'react-router-dom';

import {PrintProductController} from '../index';

import './style.scss'
import EssentialOilProductController from "../../../../controller/EssentialOil/product";

/*
* VIEW UI
* */
const PrintProductPanelEdit = () => {
  //Set data
  const {state} = useLocation();
  if (state == null) {
    window.location.href = '/admin/essential-oil/product';
  }

  /**
   * USER STATE
   */
    //Set data
  const [idProduct, setIdProduct] = useState(state.id);
  const [nameProduct, setNameProduct] = useState(state.PrintProduct_Name);
  const [listPriceProduct, setListPriceProduct] = useState(JSON.parse(state.PrintProduct_ListPrice));
  const [sapoProduct, setSapoProduct] = useState(state.PrintProduct_Sapo);
  const [description, setEditorDescription] = useState(state.PrintProduct_Description);
  const [information, setEditorInformation] = useState(state.PrintProduct_Info);
  const [listImage, setListImage] = useState({listOld: JSON.parse(state.PrintProduct_ListImage), listNew: []});

  useEffect(() => {
  }, []);

  const actionEdit = (event) => {
    event.preventDefault();
    let listFileImageNew = listImage.listNew.map(image => image.file);
    let listIDImageOld = listImage.listOld.map(image => {
      return {idImage: image.idImage}
    });

    const data = new FormData();
    listFileImageNew.forEach((image, index) => {
      data.append(`image${index}`, image)
    });

    data.append('listImageOld', JSON.stringify(listIDImageOld));
    data.append('idProduct', idProduct);
    data.append('lengthListImageNew', listFileImageNew.length);
    data.append('nameProduct', nameProduct);
    data.append('listPrice', JSON.stringify(listPriceProduct));
    data.append('sapo', sapoProduct);
    data.append('description', description);
    data.append('information', information);


    PrintProductController.edit(data, (result) => {
      if (result.status === 202) {
        Swal.fire({
          icon: 'error',
          title: 'Thông tin nhập còn thiếu',
        });
      }
      if (result.status === 303) {
        Swal.fire({
          icon: 'error',
          title: 'Lỗi phía máy chủ!',
        });
      }
      if ((result.status === 200)) {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Thêm thành công! 😉',
          showConfirmButton: false,
          timer: 1000
        }).then(() => {
          window.location.href = '/admin/print-store/product';
        });
      }
    });
  }

  const actionDelete = (event) => {
    Swal.fire({
      title: 'Xoá sản phẩm',
      text: "Bạn có chắc là muốn xoá không? 🤔",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok, xoá nó đi'
    }).then((result) => {
        if (result.isConfirmed) {
          let data = new FormData();
          data.append('idProduct', idProduct);
          PrintProductController.delete(data, result => {
            if (result.status === 303) {
              Swal.fire({
                icon: 'error',
                title: 'Lỗi phía máy chủ!',
              });
            }

            if (result.status == 202) {
              Swal.fire({
                icon: 'error',
                title: 'Không tìm thấy id của sản phẩm cần xoá',
              });
            }

            if (result.status == 200) {
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Xoá thành công! 😉',
                showConfirmButton: false,
                timer: 1000
              }).then(() => {
                window.location.href = '/admin/print-store/product';
              });
            }
          })
        }
      }
    )
  };

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
              <div className="card card-primary">
                <div className="card-header">
                  <h3 className="card-title">Sửa sản phẩm In ấn</h3>
                </div>
                <form method="POST" id="formAddNewProductPrint" onSubmit={actionEdit} encType="multipart/form-data">
                  <div className="card-body">
                    <div className="row">
                      <div className="col-md-8">

                        {/* Name */}
                        <div className="form-group">
                          <label htmlFor="printProduct_Name">Tên sản phẩm</label>
                          <input type="text" className="form-control" id="printProduct_Name"
                                 placeholder="Tên phẩm muốn thêm..."
                                 value={nameProduct}
                                 onChange={(event) => setNameProduct(event.target.value)} //Set name product new
                          />
                        </div>
                        {/* End Name */}

                        {/* Count And Price */}
                        <div className="row">
                          <div className="col-md-4">
                            <div className="form-group">
                              <label>Số lượng</label>
                            </div>
                          </div>
                          <div className="col-md-4">
                            <div className="form-group">
                              <label>Giá bán</label>
                            </div>
                          </div>
                        </div>
                        {listPriceProduct.map((item, index) => (
                          <div className="row" key={index}>
                            <div className="col-md-4">
                              <div className="form-group">
                                <input value={item.count} type="text" className="form-control"
                                       placeholder="Nhập số lượng..."

                                       onChange={(event) => {
                                         let listTemp = [...listPriceProduct];
                                         listTemp[index].count = event.target.value
                                         setListPriceProduct(listTemp);
                                       }}
                                />
                              </div>
                            </div>

                            <div className="col-md-4">
                              <div className="form-group">
                                <input value={item.price} min="1" type="number" className="form-control"
                                       placeholder="Nhập giá phảm..."

                                       onChange={(event) => {
                                         let listTemp = [...listPriceProduct];
                                         listTemp[index].price = event.target.value
                                         setListPriceProduct(listTemp);
                                       }}
                                />
                              </div>
                            </div>

                            <div className="col-md-4">
                              {index != 0 && (
                                <button className="btn btn-outline-danger" onClick={(event) => {
                                  event.preventDefault();
                                  let listTemp = [...listPriceProduct];

                                  if (index != 0) {
                                    listTemp.splice(index, 1);
                                    setListPriceProduct(listTemp);
                                  }
                                }}>
                                  <i className="far fa-trash-alt"></i>
                                </button>
                              )}
                            </div>
                          </div>
                        ))}

                        {/*Add new price*/}
                        <div className="row">
                          <div className="col-md-12 text-right">
                            <button className="btn btn-outline-primary" onClick={() => {
                              let listTemp = [...listPriceProduct];
                              listTemp.push({
                                count: '1',
                                price: 0
                              });
                              setListPriceProduct(listTemp);
                            }}>Thêm giá mới
                            </button>
                          </div>
                        </div>

                        {/*End Add new price*/}

                        {/* End Count And Price */}

                        {/* Sapo */}
                        <div className="form-group">
                          <label>Mô tả nhanh</label>
                          <textarea className="form-control"
                                    style={{width: '100%', height: '150px'}}
                                    value={sapoProduct}
                                    onChange={(event => setSapoProduct(event.target.value))}
                                    placeholder="Nhập thông tin mô tả nhanh về sản phẩm">
                          </textarea>
                        </div>
                        {/* End Sapo */}

                        {/* Description */}
                        <div className="form-group">
                          <label>Mô tả chi tiết sản phẩm</label>
                          <div id="editorDescription">
                            <JoditEditor
                              height="600"
                              value={description}
                              onChange={(newContent) => setEditorDescription(newContent)}
                            />
                          </div>
                        </div>
                        {/* End Description */}

                        {/* Information */}
                        <div className="form-group">
                          <label>Thông tin thành phần sản phẩm</label>
                          <div id="editorInformation">
                            <JoditEditor
                              height="600"
                              value={information}
                              onChange={(newContent) => {
                                setEditorInformation(newContent);
                              }}
                            />
                          </div>
                        </div>
                        {/* End Information */}

                      </div>

                      <div className="col-md-4">
                        <div className="form-group">
                          <label htmlFor="fileImage">Hình ảnh mô tả về sản phẩm <small style={{color: 'red'}}>tối đa 5
                            file</small> </label>
                          <div className="input-group">
                            <div className="custom-file">
                              <input type="file" className="custom-file-input" id="fileImage"
                                     accept="image/png, image/jpeg"
                                     multiple="multiple"
                                     onChange={(event) => {
                                       let listTemp = [...listImage.listNew];
                                       for (let i = 0; i < event.target.files.length; i++) {
                                         const element = event.target.files[i];
                                         if ((listTemp.length + listImage.listOld.length) < 5) {
                                           console.log(listTemp.length + listImage.listOld.length);
                                           console.log(listTemp.length);
                                           console.log(listImage.listOld.length);
                                           listTemp.push({
                                             file: element,
                                             urlTemp: (window.URL || window.webkitURL).createObjectURL(element)
                                           });

                                           setListImage({listOld: listImage.listOld, listNew: listTemp});
                                         } else {
                                           document.getElementById('fileImage').disabled = true;
                                           Swal.fire({
                                             icon: 'error',
                                             title: 'Quá số lượng file.',
                                           });
                                         }
                                       }

                                       event.target.files = null;
                                     }}
                              />
                              <label className="custom-file-label" htmlFor="fileImage">Choose file</label>
                            </div>
                          </div>
                        </div>

                        <div className="file-image">
                          <div className="card-columns">
                            {listImage.listOld.map((image, index) => (
                              <div key={index} className="card shadow">
                                <button type="button" className="btn btn-danger btn-remove"
                                        onClick={() => {
                                          const listImgOldTemp = [...listImage.listOld];
                                          listImgOldTemp.splice(index, 1);
                                          setListImage({
                                            listOld: listImgOldTemp,
                                            listNew: listImage.listNew
                                          });

                                          if ((listImgOldTemp.length + listImage.listNew.length) < 5) {
                                            document.getElementById('fileImage').disabled = false;
                                          }
                                        }}>
                                  <i className="far fa-trash-alt"></i>
                                </button>
                                <img className="card-img-top"
                                     src={`/image/print-store/product/${state.id}/${image.idImage}`}
                                     alt="Card image cap"/>
                              </div>
                            ))}

                            {listImage.listNew.map((image, index) => (
                              <div key={index} className="card shadow">
                                <button type="button" className="btn btn-danger btn-remove"
                                        onClick={() => {
                                          const listImgNewTemp = [...listImage.listNew];
                                          listImgNewTemp.splice(image, 1);
                                          setListImage({
                                            listOld: listImage.listOld,
                                            listNew: listImgNewTemp
                                          });

                                          if ((listImgNewTemp.length + listImage.listOld.length) < 5) {
                                            document.getElementById('fileImage').disabled = false;
                                          }
                                        }}>
                                  <i className="far fa-trash-alt"></i>
                                </button>
                                <img className="card-img-top" src={image.urlTemp} alt="Card image cap"/>
                              </div>
                            ))}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="card-footer">
                    <div className="left">
                      <button type="submit" className="btn btn-success mr-3"><i className="far fa-edit"></i> Cập nhật
                        thông tin
                      </button>
                      <Link to="/admin/print-store/product" className="btn btn-primary">Huỷ thao tác</Link>
                    </div>
                    <div className="right">
                      <button type="button" className="btn btn-danger" onClick={actionDelete}><i
                        className="fas fa-trash"></i> Xoá sản phẩm
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </section>
    </div>
  )
}

export default PrintProductPanelEdit;
