var swiper = new Swiper('.reporte-swiper', {
  slidesPerView: 2,
     freeMode: true,
     pagination: {
       el: '.swiper-pagination',
       clickable: true,
     },

     breakpoints: {
       0: {
         slidesPerView: 1,
         spaceBetween: 0,
       },
       1000: {
         slidesPerView: 2,
         spaceBetween: 0,
       },
       1100: {
         slidesPerView: 3,
         spaceBetween: 0,
       },
     }
});
