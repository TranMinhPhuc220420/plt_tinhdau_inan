/*
* More function
* */
if ($('#btnSearchNav')[0]) {
  $('#btnSearchNav')[0].addEventListener('click', (event) => {

    let input = $('#formSearch')[0].children[0];
    let valueKeySearch = input.value.trim();
    $('#btnSearchNav').toggleClass('active');
    $('#formSearch').toggleClass('show');

    if (valueKeySearch === '') {
      event.preventDefault();
    } else {

    }
  });
}

if ($('#btnCheckCart')[0]) {
  $('#btnCheckCart')[0].addEventListener('click', (event) => {
    $('#btnCheckCart').toggleClass('active');
    $('#panelCheckCart').toggleClass('show');
  });
}

if ($('#btnCollapseNav')[0]) {
  $('#btnCollapseNav')[0].addEventListener('click', (event) => {
    $('.navbar .nav-right').toggleClass('show');
  });
}

/**
 * Add comment
 * @param str
 * @returns {string}
 */
const formatDate = (str) => {
  let date;
  if (str) {
    date = new Date(str);
  } else {
    date = new Date();
  }

  return `${date.getFullYear()}-${date.getMonth()}-${date.getDate()} ${date.getHours()}:${date.getMinutes()}-${date.getSeconds()}`
}

/*
* Set display panel cart
* */
const showCart = () => {
  /**
   * Set list product in cart
   */
  const countProductInCart = document.getElementById('countProductInCart');
  const panelCartIsEmpty = document.getElementById('panelCartIsEmpty');
  const panelListProductInCart = document.getElementById('panelListProductInCart');
  const listProductInCart = document.getElementById('listProductInCart');
  const dockBtnCheckoutInCart = document.getElementById('dockBtnCheckoutInCart');
  const priceCountInCart = document.getElementById('priceCountInCart');


  const myCart = JSON.parse(localStorage.getItem("myCart"));

  if (listProductInCart) {
    if (!myCart || myCart.length === 0) {
      dockBtnCheckoutInCart.style.display = 'none';
      listProductInCart.style.display = 'none';
      priceCountInCart.innerHTML = '0';

      panelCartIsEmpty.style.display = 'block';
    } else {
      panelCartIsEmpty.style.display = 'none';

      dockBtnCheckoutInCart.style.display = 'block';
      listProductInCart.style.display = 'block';
      listProductInCart.innerHTML = '';
      countProductInCart.innerHTML = myCart.length;

      //Set display
      let countPrice = 0;
      myCart.forEach((itemProduct, index) => {
        let newItem = document.createElement('li');
        newItem.classList.add('media');

        let price = itemProduct.discountProduct != 0
          ? itemProduct.discountProduct * itemProduct.countProduct
          : itemProduct.priceProduct * itemProduct.countProduct
        countPrice += price;

        newItem.innerHTML = `<img class="mr-3" src="/image/essential-oil/product/${itemProduct.idProduct}/${itemProduct.idImage}" alt="Generic placeholder image">
                            <div class="media-body">
                              <div class="left">
                                <h6 class="mt-0 mb-1">${itemProduct.nameProduct.substring(0, 30)}</h6>
                                <div class="quantity">
                                  <span class="mc-quantity">
                                    Quantity:
                                    <span class="count">${itemProduct.countProduct}</span>
                                    *
                                    <span class="price">${itemProduct.discountProduct != 0 ? itemProduct.discountProduct : itemProduct.priceProduct}</span>
                                  </span>
                                </div>
                              </div>
                              <div class="right">
                                <div class="price-count">
                                  <span>
                                  ${price}
                                   VNĐ</span>
                                </div>
                              </div>
                            </div>`;

        listProductInCart.append(newItem);
      });

      priceCountInCart.innerHTML = countPrice;
    }
  }
};
const removeItemInCart = (idProduct) => {
  const myCart = JSON.parse(localStorage.getItem("myCart"));

  let index = -1;
  for (let i = 0; i < myCart.length; i++) {
    if (idProduct == myCart[i].idProduct) {
      index = i;
    }
  }
  if (index != -1) {
    myCart.splice(index, 1);
    localStorage.setItem("myCart", JSON.stringify(myCart));
    showListProductInCart();
    showCart();
  }
}
const showListProductInCart = () => {
  const listProductCheckout = document.getElementById('listProductCheckout');
  if (listProductCheckout) {
    listProductCheckout.innerHTML = '';

    if (listProductCheckout) {
      const myCart = JSON.parse(localStorage.getItem("myCart"));
      if (myCart) {
        let totalOrder = 0;
        myCart.forEach((itemProduct, index) => {
          let newItem = document.createElement('tr');
          let discountProduct = parseInt(itemProduct.discountProduct);
          let priceProduct = parseInt(itemProduct.priceProduct);
          let price = priceProduct;

          totalOrder += price;

          let stylePriceProduct = discountProduct > 0 ? 'text-decoration: line-through' : '';

          newItem.innerHTML = `
            <td>
              <button class="btn" onclick="removeItemInCart('${itemProduct.idProduct}')">
                <i class="fas fa-times"></i>
              </button>
            </td>
            <td>
              <img src="/image/essential-oil/product/${itemProduct.idProduct}/${itemProduct.idImage}" alt="">
            </td>
            <td>
              <a class="category-link pos-re hv-lb" href="#">
                ${itemProduct.nameProduct.substring(0, 50)}...
              </a>
            </td>
            <td style="${stylePriceProduct}">${itemProduct.priceProduct} VNĐ</td>
            <td>${priceProduct} VNĐ</td>
            <td>${price}</td>`;

          listProductCheckout.append(newItem);
        });

        document.getElementById('totalOrder').innerHTML = new Intl.NumberFormat('vi-VI', {
          style: 'currency',
          currency: 'VND'
        }).format(totalOrder)
      } else {
        //When none list product check out
      }
    }
  }
}

/*Print store*/
const PrintStoreShowCart = () => {
  /**
   * Set list product in cart
   */
  const countProductInCart = document.getElementById('countProductInCart');
  const panelCartIsEmpty = document.getElementById('panelCartIsEmpty');
  const listProductInCart = document.getElementById('listProductInCart');
  const dockBtnCheckoutInCart = document.getElementById('dockBtnCheckoutInCart');
  const priceCountInCart = document.getElementById('priceCountInCart');

  const myCart = JSON.parse(localStorage.getItem("myCartInPrintStore"));

  if (listProductInCart) {
    if (!myCart || myCart.length === 0) {
      dockBtnCheckoutInCart.style.display = 'none';
      listProductInCart.style.display = 'none';
      priceCountInCart.innerHTML = '0';

      panelCartIsEmpty.style.display = 'block';
    } else {
      panelCartIsEmpty.style.display = 'none';

      dockBtnCheckoutInCart.style.display = 'block';
      listProductInCart.style.display = 'block';
      listProductInCart.innerHTML = '';
      countProductInCart.innerHTML = myCart.length;

      //Set display
      let countPrice = 0;
      myCart.forEach((itemProduct, index) => {
        let newItem = document.createElement('li');
        newItem.classList.add('media');

        let price = parseInt(itemProduct.priceProduct);
        countPrice += price;

        newItem.innerHTML = `<img class="mr-3" src="/image/print-store/product/${itemProduct.idProduct}/${itemProduct.idImage}" alt="Generic placeholder image">
                            <div class="media-body">
                              <div class="left">
                                <h6 class="mt-0 mb-1">${itemProduct.nameProduct.substring(0, 30)}</h6>
                                <div class="quantity">
                                  <span class="mc-quantity">
                                    Quantity:
                                    <span class="count">1</span>
                                    *
                                    <span class="price">${price}</span>
                                  </span>
                                </div>
                              </div>
                              <div class="right">
                                <div class="price-count">
                                  <span> ${price} VNĐ</span>
                                </div>
                              </div>
                            </div>`;

        listProductInCart.append(newItem);
      });

      priceCountInCart.innerHTML = countPrice;
    }
  }
};
const PrintStoreShowListProductInCart = () => {
  const listProductCheckout = document.getElementById('listProductCheckout');
  if (listProductCheckout) {
    listProductCheckout.innerHTML = '';

    if (listProductCheckout) {
      const myCart = JSON.parse(localStorage.getItem("myCartInPrintStore"));
      if (myCart) {
        let totalOrder = 0;
        myCart.forEach((itemProduct, index) => {
          let newItem = document.createElement('tr');
          let discountProduct = parseInt(itemProduct.discountProduct);
          let priceProduct = parseInt(itemProduct.priceProduct);
          let price = priceProduct;

          totalOrder += price;

          let stylePriceProduct = discountProduct > 0 ? 'text-decoration: line-through' : '';

          newItem.innerHTML = `
            <td>
              <button class="btn" onclick="PrintStoreRemoveItemInCart('${itemProduct.idProduct}')">
                <i class="fas fa-times"></i>
              </button>
            </td>
            <td>
              <img src="/image/print-store/product/${itemProduct.idProduct}/${itemProduct.idImage}" alt="">
            </td>
            <td>
              <a class="category-link pos-re hv-lb" href="#">
                ${itemProduct.nameProduct.substring(0, 50)}...
              </a>
            </td>
            <td style="${stylePriceProduct}">${itemProduct.priceProduct} VNĐ</td>
            <td>${priceProduct} VNĐ</td>
            <td>${price}</td>`;

          listProductCheckout.append(newItem);
        });

        document.getElementById('totalOrder').innerHTML = new Intl.NumberFormat('vi-VI', {
          style: 'currency',
          currency: 'VND'
        }).format(totalOrder)
      } else {
        //When none list product check out
      }
    }
  }
}
const PrintStoreRemoveItemInCart = (idProduct) => {
  const myCart = JSON.parse(localStorage.getItem("myCartInPrintStore"));

  let index = -1;
  for (let i = 0; i < myCart.length; i++) {
    if (idProduct == myCart[i].idProduct) {
      index = i;
    }
  }
  if (index != -1) {
    myCart.splice(index, 1);
    localStorage.setItem("myCartInPrintStore", JSON.stringify(myCart));
    showListProductInCart();
    PrintStoreShowCart();
  }
}

window.onload = () => {
  /**
   * Handler event hover banner
   * @param event
   * @returns {boolean}
   */
  let parent = document.getElementsByClassName('carousel-inner');
  for (let i = 0; i < parent.length; i++) {
    const element = parent[i];
    element.onmouseover = element.onmouseout = element.onmousemove = handler;
  }

  /*
  * Add comment*/
  const formComment = $('#formPostNewComment')[0];
  if (formComment) {
    formComment.addEventListener('submit', (event) => {
      const _token = document.getElementsByName('_token')[0];
      const txtFullName = document.getElementById('inputFullName');
      const fuckingWowShit = document.getElementById('fuckingWowShit');
      const txtEmail = document.getElementById('inputEmail');
      const txtComment = document.getElementById('inputComment');
      const commentPrintStore = document.getElementById('commentPrintStore');
      event.preventDefault();

      const data = {
        _token: _token.value.trim(),
        fullName: txtFullName.value.trim(),
        email: txtEmail.value.trim(),
        fuckingWowShit: fuckingWowShit.value.trim(),
        contentComment: txtComment.value.trim(),
        isCommentForPrintStore: commentPrintStore ? commentPrintStore.value === 'true' : false
      };

      if (data._token !== ''
        && data.fullName !== ''
        && data.email !== ''
        && data.fuckingWowShit !== ''
        && data.contentComment !== ''
      )
        if (axios != null) {
          axios.post('/essential-oil/addComment', data)
            .then(response => {
              let dateUp = new Date();
              let listComment = document.getElementById('listComment');
              let newComment = document.createElement('div');
              newComment.classList.add('col-md-12');
              newComment.innerHTML = `<div class="media g-mb-30 media-comment">
                                    <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15"
                                         src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Image Description">
                                    <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                                      <div class="g-mb-15">
                                        <h5 class="h5 g-color-gray-dark-v1 mb-0">${data.fullName}</h5>
                                        <span class="g-color-gray-dark-v4 g-font-size-12">${formatDate()}</span>
                                      </div>

                                      <p>${data.contentComment}</p>

                                    </div>
                                  </div>`
              listComment.append(newComment);

              //Clear input
              txtComment.value = '';
            });
        }
    });
  }

  if (IN_PRINT_STORE) {
    /*Set list product check out*/
    PrintStoreShowListProductInCart();
    PrintStoreShowCart();

    const printStoreAddCart = document.getElementById('printStoreAddCart');
    if (printStoreAddCart) {
      printStoreAddCart.addEventListener('submit', (event) => {
        event.preventDefault();

        let idProduct = document.getElementById('idProduct');
        let idImage = document.getElementById('idImage');
        let selectOptionOrderPrint = document.querySelectorAll('input[name=selectOptionOrderPrint]');
        let nameProduct = document.getElementById('nameProduct');
        const myCart = JSON.parse(localStorage.getItem("myCartInPrintStore"));

        let priceProduct = -1;
        for (let i = 0; i < selectOptionOrderPrint.length; i++) {
          if (selectOptionOrderPrint[i].checked == true) {
            priceProduct = selectOptionOrderPrint[i].dataset.price;
            // break;
          }
        }
        if (priceProduct !== -1) {
          if (myCart) {
            myCart.push({
              'idProduct': idProduct.value,
              'idImage': idImage.value,
              'nameProduct': nameProduct.value,
              'priceProduct': priceProduct,
            });

            localStorage.setItem("myCartInPrintStore", JSON.stringify(myCart));
            /*Show item product in cart to navbar*/
            PrintStoreShowCart();
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Đã cho vào giỏ hàng',
              showConfirmButton: false,
              timer: 1500
            });

          } else {
            localStorage.setItem("myCartInPrintStore", JSON.stringify([{
              'idProduct': idProduct.value,
              'idImage': idImage.value,
              'nameProduct': nameProduct.value,
              'priceProduct': priceProduct,
            }]));
            /*Show item product in cart to navbar*/
            PrintStoreShowCart();
            Swal.fire(
              'Thên thành công',
              'Kiểm tra giỏ hàng của bạn xem nào!',
              'success'
            )
          }
        }else{
          Swal.fire(
            'Thêm thất bại',
            'Vui lòng chọn giá sản phẩm muốn mua',
            'error'
          )
        }
      });
    }
  } else {
    /*Show item product in cart to navbar*/
    showCart();
    showListProductInCart();

    /**
     * Add cart
     * @type {HTMLElement}
     */
    const btnPlusCount = document.getElementById('btnPlusCount');
    const btnMinusCount = document.getElementById('btnMinusCount');
    const countProduct = document.getElementById('countProduct');
    const formAddCart = document.getElementById('addCart');
    if (btnPlusCount) {
      btnPlusCount.addEventListener('click', () => {
        countProduct.value = parseInt(countProduct.value) + 1;
      });
    }
    if (countProduct) {
      btnMinusCount.addEventListener('click', () => {
        if (countProduct.value > 1) {
          countProduct.value = parseInt(countProduct.value) - 1;
        }
      });
    }
    if (formAddCart) {
      formAddCart.addEventListener('submit', (event) => {
        event.preventDefault();
        const idProduct = parseInt(document.getElementById('idProduct').value);
        const idImage = document.getElementById('idImage').value;
        const nameProduct = document.getElementById('nameProduct').innerText;
        const priceProduct = document.getElementById('priceProduct').value;
        const myCart = JSON.parse(localStorage.getItem("myCart"));
        let discountProduct = 0;

        if (document.getElementById('discountProduct')) {
          discountProduct = document.getElementById('discountProduct').value;
        }
        let indexItemProductHasInCart = -1;

        if (myCart) {
          myCart.forEach((itemProduct, index) => {
            if (itemProduct.idProduct == idProduct) {
              indexItemProductHasInCart = index;
            }
          });

          if (indexItemProductHasInCart != -1) {
            myCart[indexItemProductHasInCart].countProduct = myCart[indexItemProductHasInCart].countProduct + parseInt(countProduct.value);
          } else {
            myCart.push({
              'idProduct': idProduct,
              'countProduct': parseInt(countProduct.value),
              'idImage': idImage,
              'nameProduct': nameProduct,
              'priceProduct': priceProduct,
              'discountProduct': discountProduct,
            });
          }

          localStorage.setItem("myCart", JSON.stringify(myCart));
          /*Show item product in cart to navbar*/
          showCart();
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Đã cho vào giỏ hàng',
            // text: 'Kiểm tra giỏ hàng của bạn bằng các ấn vào icon giỏ hàng trên thanh menu',
            showConfirmButton: false,
            timer: 1500
          });

        } else {
          localStorage.setItem("myCart", JSON.stringify([{
            'idProduct': idProduct,
            'countProduct': parseInt(countProduct.value),
            'idImage': idImage,
            'nameProduct': nameProduct,
            'priceProduct': priceProduct,
            'discountProduct': discountProduct,
          }]));

          /*Show item product in cart to navbar*/
          showCart();
          Swal.fire(
            'Good job!',
            'You clicked the button!',
            'success'
          )
        }
      });
    }

    /*
    * Set event submit add new order
    * */
    const formAddOrder = document.getElementById('formAddOrder');
    if (formAddOrder) {
      formAddOrder.addEventListener('submit', (event) => {
        event.preventDefault();
        const inputOrderFullName = document.getElementById('inputOrderFullName');
        const inputOrderPhoneNumber = document.getElementById('inputOrderPhoneNumber');
        const inputOrderEmail = document.getElementById('inputOrderEmail');
        const inputOrderAddress = document.getElementById('inputOrderAddress');
        const inputOrderNote = document.getElementById('inputOrderNote');
        const myCart = JSON.parse(localStorage.getItem("myCart"));

        if (myCart == null || myCart.length === 0) {
          Swal.fire({
            icon: 'error',
            title: 'Không đặt hành thành công',
            text: 'Giỏ hàng hiện tại của bạn chưa có gì!',
            footer: '<a href="/essential-oil/shop">Đi đến cửa hàng</a>'
          })
        } else {
          const fullName = inputOrderFullName.value.trim();
          const phoneNumber = inputOrderPhoneNumber.value.trim();
          const email = inputOrderEmail.value.trim();
          const address = inputOrderAddress.value.trim();
          const note = inputOrderNote.value.trim();

          //validate
          if (fullName === '' || phoneNumber === '' || address === '') {
            Swal.fire({
              icon: 'error',
              title: 'Không đặt hành thành công',
              text: 'Thông tin bạn nhập còn thiếu!',
            })
          } else {
            //Create data to post
            const data = {
              fullName: fullName,
              phone: phoneNumber,
              email: email,
              address: address,
              note: note,
              listProductOrder: JSON.stringify(myCart)
            }

            axios.post('/oder/submit-add', data)
              .then(response => {
                console.log(response)
              })
          }
        }
      });
    }
  }
}

/**
 * Handler event hover banner
 * @param event
 * @returns {boolean}
 */
function handler(event) {
  let x = event.pageX;
  let y = event.pageY;
  let isCarouselLink = false;

  let element = document.getElementsByClassName('carousel-item');

  for (let i = 0; i < element.length; i++) {
    const elementSet = element[i];
    elementSet.classList.forEach(item => {
      if (item === 'carousel-link') {
        isCarouselLink = true;
      }
    });

    elementSet.children[0].style.top = x / 20 + 'px';
    if (isCarouselLink) {
      elementSet.children[0].style.right = y / 20 + 'px';
    } else {
      elementSet.children[0].style.left = y / 20 + 'px';
    }
  }

  return false;
}

/**
 * Handler link product
 * @param id
 * @param name
 */
function test(id, name, isPrintStore) {
  let date = new Date();

  let dateHad = `${date.getDate()}${date.getMonth()}${date.getFullYear()}`;
  let nameHad = name.toLowerCase()
    .normalize("NFD")
    .replace(/đ/g, "d")
    .replace(/Đ/g, "D")
    .replace(/[^a-zA-Z0-9 ]/g, "")
    .replace(/\s+/g, "-")

  if (isPrintStore) {
    window.location.pathname = `print-store/detail/${Math.random()}/${dateHad}/${id}/${nameHad}`;
  } else {
    window.location.pathname = `essential-oil/detail/${Math.random()}/${dateHad}/${id}/${nameHad}`;
  }
}
