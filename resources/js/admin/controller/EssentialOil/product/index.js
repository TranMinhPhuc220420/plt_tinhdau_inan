import EssentialOilCategoryProductModel from '../../../model/EssentialOil/product'

const EssentialOilProductController = {
  add: (data, callback) => {
    data.set('nameProduct', data.get('nameProduct').trim());
    data.set('categoryProduct', data.get('categoryProduct').trim());
    data.set('priceProduct', data.get('priceProduct').trim());
    data.set('discountProduct', data.get('discountProduct').trim());
    data.set('sapoProduct', data.get('sapoProduct').trim());

    if (data.get('nameProduct') == ''
      || data.get('categoryProduct') == ''
      || data.get('image0') == null
      || data.get('priceProduct') == ''
      || data.get('discountProduct') == ''
      || data.get('sapoProduct') == '') {
      callback({ status: 202 })
    } else {
      EssentialOilCategoryProductModel.addNewProduct(data, callback);
    }
  },

  edit: (data, callback) => {
    data.set('product_id', data.get('product_id').trim());
    data.set('nameProduct', data.get('nameProduct').trim());
    data.set('categoryProductID', data.get('categoryProductID').trim());
    data.set('priceProduct', data.get('priceProduct').trim());
    data.set('discountProduct', data.get('discountProduct').trim());
    data.set('sapoProduct', data.get('sapoProduct').trim());

    if (data.get('nameProduct') == ''
      || data.get('product_id') == ''
      || (data.get('image0') == null && JSON.parse(data.get('listImageOld')).length == 0)
      || data.get('categoryProductID') == ''
      || data.get('priceProduct') == ''
      || data.get('discountProduct') == ''
      || data.get('sapoProduct') == '') {
      callback({ status: 202 })
    } else {
      EssentialOilCategoryProductModel.edit(data, callback);
    }
  },

  getAll: (callback) => {
    EssentialOilCategoryProductModel.getData(callback);
  }
};

export default EssentialOilProductController;