import React, {useState, useEffect} from 'react';
import axios from "axios";

const UserModel = {
  getProfile: (callback) => {
    axios.get('/admin/profile/get-all')
      .then(response => {
        callback(response.data);
      });
  },

};

const SettingComponent = () => {
  const [dataProfile, setDataProfile] = useState(null);

  useEffect(() => {
    getDataProfile();
  }, [])

  const getDataProfile = () => {
    UserModel.getProfile(result => {
      setDataProfile(result);
    })
  };

  const formatDate = (strDate) => {
    let date = new Date(strDate);
    return `${date.getDate() < 10 ? '0' + date.getDate() : date.getDate()}-${date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth()}-${date.getFullYear()}`;
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
                <div className="card card-primary">
                  <div className="card-header">
                    <h3 className="card-title">Thông tin hồ sơ</h3>
                  </div>

                  <div className="group-information">
                    <p><strong>ID: </strong> {dataProfile.id}</p>
                    <p><strong>Email: </strong> {dataProfile.User_Email}</p>
                    <p><strong>Ngày tạo: </strong> {formatDate(dataProfile.created_at)} </p>
                    <p><strong>Ngày cập nhật: </strong> {formatDate(dataProfile.updated_at)}</p>
                  </div>
                  <form>
                    <div className="card-body">
                      <div className="form-group">
                        <label htmlFor="FullName">Họ và Tên</label>
                        <input type="text" className="form-control" id="FullName" placeholder="Nhập họ và tên..."
                               value={dataProfile.User_FullName}
                        />
                      </div>

                      <div className="form-group">
                        <label htmlFor="Username">Username</label>
                        <input type="text" className="form-control" id="Username" placeholder="Username..."
                               value={dataProfile.User_Username}
                        />
                      </div>

                      <div className="form-group">
                        <label htmlFor="Password">Mật khẩu mới</label>
                        <input type="password" className="form-control" id="Password"
                               placeholder="Nhập mật khẩu mới..."/>
                      </div>
                      <div className="form-group">
                        <label htmlFor="RePassword">Xác nhận mật khẩu mới</label>
                        <input type="password" className="form-control" id="RePassword"
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
