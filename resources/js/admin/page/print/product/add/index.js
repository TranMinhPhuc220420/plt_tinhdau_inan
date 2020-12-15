import React, {useState, useEffect} from 'react';
import JoditEditor from "jodit-react";
import Swal from 'sweetalert2';

import {PrintProductController} from '../index';

import './style.scss'


/*
* VIEW UI
* */
const PrintProductPanelAdd = () => {
  /**
   * USER STATE
   */
    //Set data
  const [nameProduct, setNameProduct] = useState('');
  const [listPriceProduct, setListPriceProduct] = useState([
    {
      count: '1',
      price: 100000
    }
  ]);
  const [sapoProduct, setSapoProduct] = useState('');
  const [description, setEditorDescription] = useState(null);
  const [information, setEditorInformation] = useState(null);
  const [listImage, setListImage] = useState([]);

  const actionAdd = (event) => {
    event.preventDefault();

    let listFileImage = listImage.map(image => image.file);

    const data = new FormData();
    listFileImage.forEach((image, index) => {
      data.append(`image${index}`, image)
    })

    data.append('nameProduct', nameProduct);
    data.append('listPrice', JSON.stringify(listPriceProduct));
    data.append('sapo', sapoProduct);
    data.append('description', !description ? 'Thông tin mô tả chi tiết trống' : description);
    data.append('information', !information ? 'Thông tin thành phần sản phẩm trống' : information);
    data.append('lengthListImage', listFileImage.length);

    //Add new product
    PrintProductController.add(data, (result) => {
      if (result.status === 202) {
        Swal.fire({
          icon: 'error',
          title: 'Thông tin nhập còn thiếu',
        });
      }
      if (result.status === 303) {
        Swal.fire({
          icon: 'error',
          title: 'Gặp sự cố ở máy chủ',
        });
      }
      if (result.status === 200) {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Thêm thành công! 😉',
          showConfirmButton: false,
          timer: 1000
        });
      }
    });
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
                  <h3 className="card-title">Thêm sản phẩm tinh dầu</h3>
                </div>
                <form method="POST" id="formAddNewProductPrint" onSubmit={actionAdd} encType="multipart/form-data">
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
                            <button className="btn btn-outline-primary" onClick={(event) => {
                              event.preventDefault();

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
                                       let listTemp = [...listImage];

                                       for (let i = 0; i < event.target.files.length; i++) {
                                         if (listTemp.length < 5) {
                                           const element = event.target.files[i];

                                           listTemp.push({
                                             file: element,
                                             urlTemp: (window.URL || window.webkitURL).createObjectURL(element)
                                           });

                                         } else {
                                           document.getElementById('fileImage').disabled = true;
                                           Swal.fire({
                                             icon: 'error',
                                             title: 'Quá số lượng file.',
                                           })
                                         }
                                       }

                                       setListImage(listTemp);
                                       event.target.files = null;
                                     }
                                     }
                              />
                              <label className="custom-file-label" htmlFor="fileImage">Choose file</label>
                            </div>
                          </div>
                        </div>

                        <div className="file-image">
                          <div className="card-columns">
                            {listImage.map((image, index) => (
                              <div key={index} className="card shadow">
                                <button type="button" className="btn btn-danger btn-remove"
                                        onClick={() => {
                                          const listImgNewTemp = [...listImage];
                                          listImgNewTemp.splice(index, 1);
                                          setListImage(listImgNewTemp);

                                          if (listImgNewTemp.length < 5) {
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
                    <button type="submit" className="btn btn-primary">Thêm</button>
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

export default PrintProductPanelAdd;
