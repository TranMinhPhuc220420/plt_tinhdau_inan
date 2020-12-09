import React, { useState, useEffect } from 'react';
import JoditEditor from "jodit-react";
import Swal from 'sweetalert2';


import CategoryProductController from '../../../../controller/EssentialOil/categoryProduct';
import EssentialOilProductController from '../../../../controller/EssentialOil/product';

import './style.scss'

const EssentialOilProductPanelAdd = (props) => {
  /**
   * USER STATE
   */
  //Set data
  const [nameProduct, setNameProduct] = useState('');
  const [categoryProduct, setCategoryProduct] = useState('');
  const [priceProduct, setPriceProduct] = useState('');
  const [discountProduct, setDiscountProduct] = useState('');
  const [sapoProduct, setSapoProduct] = useState('');
  const [description, setEditorDescription] = useState(null);
  const [information, setEditorInformation] = useState(null);
  const [listImage, setListImage] = useState([]);
  //data main to get
  const [dataCategoryProduct, setDataCategoryProduct] = useState([]);

  const actionAdd = (event) => {
    event.preventDefault();

    let listFileImage = listImage.map(image => image.file);

    const data = new FormData();
    listFileImage.forEach((image, index) => {
      data.append(`image${index}`, image)
    })
    data.append('lengthListImage', listFileImage.length);
    data.append('nameProduct', nameProduct);
    data.append('categoryProduct', categoryProduct);
    data.append('priceProduct', priceProduct);
    data.append('discountProduct', discountProduct);
    data.append('sapoProduct', sapoProduct);
    data.append('description', description ? description : 'Mô tả chi tiết sản phẩm trống');
    data.append('information', information ? information : 'Thông tin thành phần sản phẩm trống');

    EssentialOilProductController.add(data, (result) => {
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
        });

        setNameProduct('');
        setCategoryProduct('');
        setPriceProduct('');
        setDiscountProduct('');
        setSapoProduct('');

        setListImage([]);
        document.getElementById('selectCategoryProduct').value = 'null';

        window.location.href = '/admin/essential-oil/product';
      }
    });
  };

  /**
   * FUNCTION
   */

  /**
   * LIFE CIRCLE COMPONENT
   */
  useEffect(() => {
    CategoryProductController.getData((data) => {
      setDataCategoryProduct(data);
    });
  }, []);

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
                <form method="POST" id="formAddNewProductEssentialOil" onSubmit={actionAdd} encType="multipart/form-data">
                  <div className="card-body">
                    <div className="row">
                      <div className="col-md-8">

                        {/* Name */}
                        <div className="form-group">
                          <label htmlFor="essentialOilProduct_Name">Tên sản phẩm</label>
                          <input type="text" className="form-control" id="essentialOilProduct_Name" placeholder="Tên phẩm muốn thêm..."
                            value={nameProduct}
                            onChange={(event) => setNameProduct(event.target.value)} //Set name product new
                          />
                        </div>
                        {/* End Name */}

                        {/* Category And Price */}
                        <div className="row">
                          <div className="col-md-4">
                            <div className="form-group">
                              <label>Loại sản phẩm</label>
                              <select id="selectCategoryProduct" className="form-control select2 select2-hidden-accessible"
                                style={{ width: '100%' }}
                                defaultValue='null'
                                onChange={(event) => setCategoryProduct(event.target.value)}
                              >
                                <option value="null" disabled> Chọn loại sản phẩm ...</option>
                                {dataCategoryProduct.map((item, index) => (
                                  <option key={index} value={item.id}> {item.EssentialOilCategory_Name} </option>
                                ))}
                              </select>
                            </div>
                          </div>

                          <div className="col-md-4">
                            <div className="form-group">
                              <label htmlFor="essentialOilProduct_Price">Giá bán chính của sản phẩm</label>
                              <input min="0" type="number" className="form-control" id="essentialOilProduct_Price" placeholder="Nhập giá bán chính..."
                                value={priceProduct}
                                onChange={(event) => setPriceProduct(event.target.value)}
                              />
                            </div>
                          </div>

                          <div className="col-md-4">
                            <div className="form-group">
                              <label htmlFor="essentialOilProduct_Discount">Giá sản phẩm giảm</label>
                              <input min="0" type="number" className="form-control" id="essentialOilProduct_Discount" placeholder="Nhập giá phảm..."
                                value={discountProduct}
                                onChange={(event) => setDiscountProduct(event.target.value)}
                              />
                            </div>
                          </div>
                        </div>
                        {/* End Category And Price */}

                        {/* Sapo */}
                        <div className="form-group">
                          <label>Mô tả nhanh</label>
                          <textarea className="form-control"
                            style={{ width: '100%', height: '150px' }}
                            placeholder="Nhập thông tin mô tả nhanh về sản phẩm"
                            onChange={(event) => setSapoProduct(event.target.value)}
                            value={sapoProduct}
                          >
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
                                console.log(newContent);
                                setEditorInformation(newContent);
                              }}
                            />
                          </div>
                        </div>
                        {/* End Information */}

                      </div>

                      <div className="col-md-4">
                        <div className="form-group">
                          <label htmlFor="fileImage">Hình ảnh mô tả về sản phẩm <small style={{ color: 'red' }}>tối đa 5 file</small> </label>
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
                                <img className="card-img-top" src={image.urlTemp} alt="Card image cap" />
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

export default EssentialOilProductPanelAdd;