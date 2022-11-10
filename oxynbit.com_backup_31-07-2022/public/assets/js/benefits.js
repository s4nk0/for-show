if (window.innerWidth < 760){
    new Swiper('.benefits__container', {
        slidesPerView: 1,
        spaceBetween: 80,
        speed: 550,
        loop: true,
        slidesPerGroup: 1,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination-benefits',
            type: 'bullets',
            clickable: true
        },
    });
}