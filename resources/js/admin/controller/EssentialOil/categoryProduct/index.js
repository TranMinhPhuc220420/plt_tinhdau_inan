import EssentialOilCategoryProductModel from '../../../model/EssentialOil/categoryProduct'

const CategoryProductController = {
  getData: (callback) => {
    EssentialOilCategoryProductModel.getData(callback);
  },

  add: (data, callback) => {
    let result = {
      status: false,
      message: '',
    };

    data.name.trim();
    data.typeProduct_id.trim();

    if (data.name === '' || data.typeProduct_id === '') {
      result.message = 'Vui lòng nhập đầy đủ thông tin muốn thêm';
      callback(result);
    } else {
      EssentialOilCategoryProductModel.addNewCategory(data, callback);
    }
  },

  delete: (data, callback) => {
    if (data.id) {
      EssentialOilCategoryProductModel.delete(data, callback);
    } else {
      callback({
        status: 404,
        message: 'Lỗi! không xoá thành công'
      });
    }
  },

  edit: (data, callback) => {
    EssentialOilCategoryProductModel.edit(data, callback);
  }
};

export default CategoryProductController;