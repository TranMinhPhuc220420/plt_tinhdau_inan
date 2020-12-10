$('#btnSearchNav')[0].addEventListener('click', (event) => {
  $('#btnSearchNav').toggleClass('active');
  $('#formSearch').toggleClass('show');
});

$('#btnCheckCart')[0].addEventListener('click', (event) => {
  $('#btnCheckCart').toggleClass('active');
  $('#panelCheckCart').toggleClass('show');
});

$('#btnCollapseNav')[0].addEventListener('click', (event) => {
  $('.navbar .nav-right').toggleClass('show');
});


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
let parent = document.getElementsByClassName('carousel-inner');
for (let i = 0; i < parent.length; i++) {
  const element = parent[i];
  element.onmouseover = element.onmouseout = element.onmousemove = handler;
}


function test(id, name) {
  window.location.pathname = `tinh-dau/detail/${Math.random()}/${Date().toLowerCase() //Low case name file film
    .normalize("NFD")
    .replace(/đ/g, "d")
    .replace(/Đ/g, "D")
    .replace(/[^a-zA-Z0-9 ]/g, "")
    .replace(/\\s+/g, "-")}/${id}/${name.toLowerCase()
    .normalize("NFD")
    .replace(/đ/g, "d")
    .replace(/Đ/g, "D")
    .replace(/[^a-zA-Z0-9 ]/g, "")
    .replace(/\\s+/g, "-")}`;
}
