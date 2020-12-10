import EssentialOilCategoryProductModel from '../../../model/EssentialOil/categoryProduct'

const CategoryProductController = {
  getData: (callback) => {
    EssentialOilCategoryProductModel.getData(callback);
  },

  add: (data, callback) => {
    EssentialOilCategoryProductModel.addNewCategory(data, callback);
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