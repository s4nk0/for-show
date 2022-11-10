let tradeList = document.querySelector('.trade-list')
let spanTrade = document.querySelector('.menu__item-bf')
let trade = document.querySelector('.trade')

if (window.innerWidth > 1250){
    // Эран больше 1250
    trade.addEventListener('mouseover', ()=>{
        tradeList.classList.add('menu__list-trade-activ')
        spanTrade.classList.add('menu__item-hover')
    });
    trade.addEventListener('mouseout', ()=>{
        tradeList.classList.remove('menu__list-trade-activ')
        spanTrade.classList.remove('menu__item-hover')
    });

} else {
    // Эран меньше 1250
    let btnMobile = document.querySelector('.menu__btn')
    let menuListBox = document.querySelector('.menu__list-box')
    let tradeLink = document.querySelector('.menu__trade-link')
    let bgRemove = document.querySelector('.bg-remove')

    btnMobile.addEventListener('click', ()=>{
        btnMobile.classList.toggle('menu__btn-activ')
        menuListBox.classList.toggle('menu__list-box-activ')
        bgRemove.classList.add('bg-remove-active')
    });

    tradeLink.addEventListener('click', ()=>{
        trade.classList.toggle('trade-activ')
    })


    bgRemove.addEventListener('click', ()=>{
        btnMobile.classList.remove('menu__btn-activ')
        menuListBox.classList.remove('menu__list-box-activ')
        bgRemove.classList.remove('bg-remove-active')
    });


}

