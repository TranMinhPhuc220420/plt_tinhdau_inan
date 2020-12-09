import axios from 'axios';

const EssentialOilCategoryProductModel = {
  getData: (callback) => {
    axios.get('/admin/essential-oil/product/get-all')
      .then((response) => {
        if (response.status == 200) {
          callback({ status: 200, data: response.data.data })
        } else {
          callback({ status: 303 })
        }
      })
      .catch(error => callback({ status: 303 }));
  },

  addNewProduct: (data, callback) => {
    axios.post('/admin/essential-oil/product/add/sub-add', data, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
      .then((response) => {
        if (response.status == 200) {
          callback({ status: 200 })
        } else {
          callback({ status: 303 })
        }
      })
      .catch(error => callback({ status: 303 }));
  },

  delete: (data, callback) => {
    axios.post('/admin/essential-oil/product/delete', data)
      .then((response) => {
        callback({ status: 200 });
      })
      .catch(error => {
        callback({ status: 303 })
      });
  },

  edit: (data, callback) => {
    axios.post('/admin/essential-oil/product/edit/sub-edit', data, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
      .then((response) => {
        callback({ status: 200 });
      })
      .catch(error => {
        // callback({ status: 303 })
      });
  }
};

export default EssentialOilCategoryProductModel;