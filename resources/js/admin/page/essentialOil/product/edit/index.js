import React, { useState, useEffect } from 'react';
import JoditEditor from "jodit-react";
import Swal from 'sweetalert2';
import { useLocation, Link } from 'react-router-dom';

import './style.scss'

import CategoryProductController from '../../../../controller/EssentialOil/categoryProduct';
import EssentialOilProductController from '../../../../controller/EssentialOil/product';

const EssentialOilProductPanelEdit = ({ history, match }) => {
  /**
 * USER STATE
 */
  //Set data
  const { state } = useLocation();
  if (state == null) {
    // window.location.href = '/admin/essential-oil/product';
  }

  const [nameProduct, setNameProduct] = useState(state.EssentialOilProduct_Name);
  const [categoryProduct, setCategoryProduct] = useState(state.FkEssentialOilCategory_id);
  const [priceProduct, setPriceProduct] = useState(state.EssentialOilProduct_Price);
  const [discountProduct, setDiscountProduct] = useState(state.EssentialOilProduct_Discount);
  const [sapoProduct, setSapoProduct] = useState(state.EssentialOilProduct_Sapo);
  const [description, setEditorDescription] = useState(state.EssentialOilProduct_Description);
  const [information, setEditorInformation] = useState(state.EssentialOilProduct_Info);
  const [listImage, setListImage] = useState({ listOld: JSON.parse(state.EssentialOilProduct_ListImage), listNew: [] });
  //data main to get
  const [dataCategoryProduct, setDataCategoryProduct] = useState([]);


  /**
   * FUNCTION
   */
  const actionEdit = (event) => {
    event.preventDefault();


    let listFileImageNew = listImage.listNew.map(image => image.file);
    let listIDImageOld = listImage.listOld.map(image => { return { idImage: image.idImage } });

    const data = new FormData();
    listFileImageNew.forEach((image, index) => {
      data.append(`image${index}`, image)
    });

    data.append('listImageOld', JSON.stringify(listIDImageOld));
    data.append('product_id', state.product_id);
    data.append('lengthListImageNew', listFileImageNew.length);
    data.append('nameProduct', nameProduct);
    data.append('categoryProductID', categoryProduct);
    data.append('priceProduct', priceProduct);
    data.append('discountProduct', discountProduct);
    data.append('sapoProduct', sapoProduct);
    data.append('description', description);
    data.append('information', information);

    EssentialOilProductController.edit(data, (result) => {
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
          window.location.href = '/admin/essential-oil/product';
        });

        setNameProduct('');
        setCategoryProduct('');
        setPriceProduct('');
        setDiscountProduct('');
        setSapoProduct('');
        description.clear();
        information.clear();
        setEditorInformation(null);
        setListImage({ listNew: [], listOld: [] });
        document.getElementById('selectCategoryProduct').value = 'null';
      }
    });

  };

  useEffect(() => {
    CategoryProductController.getData((data) => {
      setDataCategoryProduct(data);
    });

    if (document.getElementById('editorDescription') && document.getElementById('editorInformation')) {
      CategoryProductController.getData((data) => {
        setDataCategoryProduct(data);
      });

    }
  }, []);

  return (
    <div className="content-wrapper">
      <div className="content-header">
        <div className="container-fluid">
          <div className="row mb-2">
            <div className="col-sm-12">
              <h1 className="m-0">Cập nhật thông tinh cho sản phẩm - {state ? state.EssentialOilProduct_Name : ''}</h1>
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
                  <h3 className="card-title">Sửa thông tin sản phẩm tinh dầu</h3>
                </div>
                <form method="POST" id="formEditNewProductEssentialOil" onSubmit={actionEdit} encType="multipart/form-data">
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
                                defaultValue={categoryProduct.FkEssentialOilCategory_id}
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
                              value={description}
                              onChange={(newContent => setEditorDescription(newContent))}
                            />
                          </div>
                        </div>
                        {/* End Description */}

                        {/* Information */}
                        <div className="form-group">
                          <label>Thông tin thành phần sản phẩm</label>
                          <div id="editorInformation">
                            <JoditEditor
                              value={information}
                              onChange={(newContent) => setEditorInformation(newContent)}
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

                                      setListImage({ listOld: listImage.listOld, listNew: listTemp });
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
                                <img className="card-img-top" src={`/image/essential-oil/product/${state.product_id}/${image.idImage}`} alt="Card image cap" />
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
                                <img className="card-img-top" src={image.urlTemp} alt="Card image cap" />
                              </div>
                            ))}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="card-footer">
                    <button type="submit" className="btn btn-primary mr-3">Cập nhật thông tin</button>
                    <Link to="/admin/essential-oil/product" className="btn btn-danger">Huỷ bỏ</Link>
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

export default EssentialOilProductPanelEdit;