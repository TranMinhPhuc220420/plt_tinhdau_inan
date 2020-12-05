import React, { useState } from 'react';
import { Link } from 'react-router-dom';

import './style.scss';

const NavLeft = () => {
  const [dataMenu, setDataMenu] = useState([
    {
      text: 'Tinh dầu',
      iconCls: 'fab fa-battle-net',
      menuItem: [
        {
          text: 'Sản phẩm',
          iconCls: 'fas fa-th-large',
          path: '/admin/essential-oil/product',
          isActive: false
        },
        {
          text: 'Loại sản phẩm',
          iconCls: 'fas fa-stream',
          path: '/admin/essential-oil/type-product',
          isActive: false
        }
      ]
    },

    {
      text: 'In ấn',
      iconCls: 'fas fa-print',
      menuItem: [
        {
          text: 'Sản phẩm',
          iconCls: 'fas fa-th-large',
          path: '/admin/essential-oil/product',
          isActive: false
        },
      ]
    }
  ]);

  return (
    <aside className="main-sidebar sidebar-dark-primary elevation-4">
      <a href="#" className="brand-link">
        <img src="./image/41a2f8291637e769be26" alt="AdminLTE Logo" className="brand-image img-circle elevation-3" />
        <span className="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <div className="sidebar">
        <div className="user-panel mt-3 pb-3 mb-3 d-flex">
          <div className="image">
            <img src="./image/20052000" className="img-circle elevation-2" alt="User Image" />
          </div>
          <div className="info">
            <a href="#" className="d-block">Xin chào Admin!</a>
          </div>
        </div>

        <nav className="mt-2">
          <ul className="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li className="nav-item">
              <Link to='/admin/home' className="nav-link">
                <i className="fas fa-home"></i>
                <p>Trang chủ</p>
              </Link>
            </li>

            {dataMenu.map((item, index) => (
              <li className="nav-item menu-is-opening menu-open" key={index}>
                <a href="#" className="nav-link">
                  <i className={item.iconCls}></i>
                  <p>
                    {item.text}
                    <i className="fas fa-angle-left right"></i>
                    {/* <span className="badge badge-info right">6</span> */}
                  </p>
                </a>
                <ul className="nav nav-treeview" style={{ display: 'block' }}>
                  {item.menuItem.map((itemChild, indexChild) => (
                    <li className="nav-item" key={indexChild}>
                      <Link
                        to={itemChild.path}
                        className={itemChild.isActive ? 'active nav-link' : 'nav-link'}
                      // onClick={(event) => {
                      //   console.log('test');
                      //   let dataMenuTem = [...dataMenu];

                      //   for (let i = 0; i < dataMenuTem.length; i++) {
                      //     const item = dataMenuTem[i];

                      //     for (let j = 0; j < item.menuItem.length; j++) {
                      //       const navItem = item.menuItem[j];

                      //       if (indexChild === j) {
                      //         navItem.isActive = true;
                      //       } else {
                      //         navItem.isActive = false;
                      //       }
                      //     }
                      //   }
                      //   setDataMenu(dataMenuTem);
                      // }}
                      >

                        <i className={itemChild.iconCls}></i>
                        <p>{itemChild.text}</p>
                      </Link>
                    </li>
                  ))}
                </ul>
              </li>
            ))}

            <li className="nav-item">
              <a href='/admin/logout' className="nav-link">
                <i class="fas fa-sign-out-alt"></i>
                <p>Đăng xuất</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
  )
};

export default NavLeft;
