import axios from 'axios';

const TypeProductModel = {
  getData: (callback) => {
    axios.get('/admin/essential-oil/type-product/get-all')
      .then((response) => {
        if (response.status == 200) {
          callback(response.data.data);
        }
      });
  }
};

export default TypeProductModel;