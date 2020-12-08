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
$('.mobile-menu-overlay')[0].addEventListener('click', (event) => {
  $('.navbar .nav-right').removeClass('show');
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


function test(id) {
  console.log(id);
  window.location.href = `tinh-dau/detail/${id}`;
}
