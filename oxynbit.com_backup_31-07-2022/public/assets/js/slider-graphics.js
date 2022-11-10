new Swiper('.slider-graphics', {
    slidesPerView: 5,
    slidesPerGroup: 1,
    loop: true,
    speed: 550,
    navigation: {
        nextEl: '.slider__graphics-button-next',
        prevEl: '.slider__graphics-button-prev',
    },
    pagination: {
        el: '.swiper-pagination-grafix',
        type: 'bullets',
        clickable: true
    },
    spaceBetween: 40,
    breakpoints: {
        320:{
            slidesPerView: 1
        },
        490:{
            spaceBetween: 5,
            slidesPerView: 2,
            slidesPerGroup: 2
        },
        750: {
            slidesPerView: 3
        },
        960: {
            slidesPerView: 4
        },
        1200: {
            slidesPerView: 5
        },
        1400:{
            slidesPerView: 6
        }
        // 630: {
        //     slidesPerView: 1,
        // },
        // 370: {
        //     slidesPerView: 1,
        // },
        // 400: {
        //     slidesPerView: 1,
        // },
        // 550: {
        //     slidesPerView: 2,
        // },
        // 600: {
        //     slidesPerView: 2,
        // },
        // 750: {
        //     slidesPerView: 3,
        // },
        // 900: {
        //     slidesPerView: 4,
        // },
        // 1100: {
        //     slidesPerView: 4,
        // },
        // 1200: {
        //     slidesPerView: 5,
        // },
        // 1400: {
        //     slidesPerView: 5,
        // },
        // 1600: {
        //     slidesPerView: 6,
        // },
        // 1800: {
        //     slidesPerView: 6,
        // }
    }
});
