import axios from 'axios';

const EssentialOilCategoryProductModel = {
  getData: (callback) => {
    axios.get('/admin/essential-oil/category-product/get-all')
      .then((response) => {
        if (response.status == 200) {
          callback(response.data.data);
        }
      });
  },

  addNewCategory: (data, callback) => {
    axios.post('/admin/essential-oil/category-product/add', data)
      .then((response) => {
        if (response.status == 200) {
          callback(response.data);
        }
      });
  },

  delete: (data, callback) => {
    axios.post('/admin/essential-oil/category-product/delete', data)
      .then(response => {
        callback(response);
      });
  },

  edit: (data, callback) => {
    axios.post('/admin/essential-oil/category-product/edit', data)
      .then(response => {
        callback(response);
      });
  }
};

export default EssentialOilCategoryProductModel;