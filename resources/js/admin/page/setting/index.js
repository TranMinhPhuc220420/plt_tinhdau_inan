import React, {useState, useEffect} from 'react';
import axios from "axios";
import Swal from "sweetalert2";

const UserModel = {
  getProfile: (callback) => {
    axios.get('/admin/profile/get-all')
      .then(response => {
        callback(response.data);
      });
  },

  updateInfor: (data, callback) => {
    axios.post('/admin/profile/sub-update', data)
      .then(response => {
        callback(response.data);
      });
  }
};

const SettingComponent = () => {
  const [dataProfile, setDataProfile] = useState(null);
  const [fullName, setFullName] = useState('');
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [rePassword, setRePassword] = useState('');

  useEffect(() => {
    getDataProfile();
  }, []);

  const getDataProfile = () => {
    UserModel.getProfile(result => {
      setDataProfile(result);
    })
  };

  const formatDate = (strDate) => {
    let date = new Date(strDate);
    return `${date.getDate() < 10 ? '0' + date.getDate() : date.getDate()}-${date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth()}-${date.getFullYear()}`;
  };

  const actionChangeInfo = (event) => {
    event.preventDefault();

    //Check validate
    let a = fullName.trim(), b = username.trim(), c = password.trim(), d = rePassword.trim();
    if (a === '' || b === '' || c === '' || d === ''){
      Swal.fire({
        icon: 'error',
        title: 'Vui lòng nhập đầy đủ thông tin',
      });
    }else{
      if (c !== d){
        Swal.fire({
          icon: 'error',
          title: 'Mật khẩu xác nhận không trùng khớp',
        });
      }else{
        let data = {
          'fullName': fullName,
          'username': username,
          'password': password,
        };

        UserModel.updateInfor(data, (result => {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Cập nhật thông tin thàng công! 😉',
            showConfirmButton: false,
            timer: 1000
          })
        }));
      }
    }
  };

  return (
    <div className="content-wrapper">
      <div className="content-header">
        <div className="container-fluid">
          <div className="row mb-2">
            <div className="col-sm-12">
              <h1 className="m-0">Cài đặt tài khoản </h1>
            </div>
          </div>


          {dataProfile && (
            <div className="row">
              <div className="col-md-12">
                <div className="card card-primary" >
                  <div className="card-header">
                    <h3 className="card-title">Thông tin hồ sơ</h3>
                  </div>

                  <div className="group-information" style={{padding: 10}}>
                    <p><strong>ID: </strong> {dataProfile.id}</p>
                    <p><strong>Email: </strong> {dataProfile.User_Email}</p>
                    <p><strong>Ngày tạo: </strong> {formatDate(dataProfile.created_at)} </p>
                    <p><strong>Ngày cập nhật: </strong> {formatDate(dataProfile.updated_at)}</p>
                  </div>
                  <form onSubmit={actionChangeInfo}>
                    <div className="card-body">
                      <div className="form-group">
                        <label htmlFor="FullName">Họ và Tên</label>
                        <input type="text" className="form-control" id="FullName" placeholder={dataProfile.User_FullName}
                               onChange={(event => setFullName(event.target.value))}
                        />
                      </div>

                      <div className="form-group">
                        <label htmlFor="Username">Username</label>
                        <input type="text" className="form-control" id="Username" placeholder={dataProfile.User_Username}
                               onChange={(event => setUsername(event.target.value))}
                        />
                      </div>

                      <div className="form-group">
                        <label htmlFor="Password">Mật khẩu mới</label>
                        <input type="password" className="form-control" id="Password"
                               onChange={event => setPassword(event.target.value)}
                               placeholder="Nhập mật khẩu mới..."/>
                      </div>
                      <div className="form-group">
                        <label htmlFor="RePassword">Xác nhận mật khẩu mới</label>
                        <input type="password" className="form-control" id="RePassword"
                               onChange={event => setRePassword(event.target.value)}
                               placeholder="Nhập lại mật khẩu mới..."/>
                      </div>

                    </div>

                    <div className="card-footer text-right">
                      <button type="submit" className="btn btn-primary">Cập nhập thông tin</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}

export default SettingComponent;
