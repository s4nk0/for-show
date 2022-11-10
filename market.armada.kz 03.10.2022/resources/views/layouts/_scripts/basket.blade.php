@if(!Route::is('admin.*','seller.*'))
    <script>

        (async () => {
            /*if ((localStorage.getItem('TOKEN') && localStorage.getItem('TOKEN').length < 20) || !localStorage.getItem('TOKEN')) {
                localStorage.setItem('TOKEN', document.querySelector('.TOKEN').value);
                localStorage.setItem('TOKEN-NEW', document.querySelector('.TOKEN').value);
            } else if (localStorage.getItem('TOKEN') && localStorage.getItem('TOKEN').length > 20) {
                localStorage.setItem('TOKEN-NEW', document.querySelector('.TOKEN').value);
            }*/
            const clearAll = async () => {

                    const length = localStorage.length;
                    for (let i = length - 1; i >= 0; i--) {
                        let key = localStorage.key(i);
                        if (key.includes('ARMADA_PRODUCT_CART_')) {
                            localStorage.removeItem(key);
                        }
                    }
                    await $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{route('orderPost')}}',
                        type: 'post',
                        data: {
                            "orders": [],
                            deleteAll: true
                        },
                        success: function(data) {
                            console.log(data);
                            window.location.reload();
                        },
                        error: function(data) {
                            console.log('error');
                            console.log(data);
                        },
                    });
                refreshInDatabase();
                };


            // $('#cart_clear_select').click(async()=>{
            //     await clearAll();
            // })


            let productColor = 0;
            let busketHidden = true;
            let timerProductCheck = true;

            //localStorage.setItem('numberOfUniqueProducts_ARMADA', 0);

            for (let i = 0; i < localStorage.length; i++) {
                let key = localStorage.key(i);
                if (key.includes('ARMADA_PRODUCT_CART_')) {

                        localStorage.setItem('numberOfUniqueProducts_ARMADA', +localStorage.getItem('numberOfUniqueProducts_ARMADA') + 1);
                        let obj = JSON.parse(localStorage.getItem(key));
                        if (document.getElementsByClassName(`ARMADA_PRODUCT_CART_${obj.id}_CH`)[0]) {
                            $(`.ARMADA_PRODUCT_CART_${obj.id}_CH`).each(function(){
                                this.setAttribute('data-chosen', 'true');
                            })
                        }
                        /*if (!obj.token || obj.token.length < 20) {
                            obj.token = localStorage.getItem('TOKEN');
                        }*/
                        obj = {
                            ...obj,
                            price: obj.price !== null && typeof obj.price !== 'number' ? obj.price.split(' ').join('') : obj.price,
                            price_2: (obj.price_2 !== null && typeof obj.price_2 !== 'number') ? obj.price_2.split(' ').join('') : obj.price_2
                        }
                        //obj.token_new = localStorage.getItem('TOKEN-NEW');
                        localStorage.setItem(key, JSON.stringify(obj));

                }
            }


            const updateBasketCount = () =>{
                let counter = 0;
                for (let i = 0; i < localStorage.length; i++) {
                    let key = localStorage.key(i);
                    if (key.includes('ARMADA_PRODUCT_CART_')) {
                        counter++;
                    }
                }
                setTimeout(function (){
                    document.querySelectorAll('.BASKET_count').forEach((item) => {
                        item.textContent = counter.toString()
                    })

                },200)

            }
            updateBasketCount();

            const updateOrdersToIdShops = (shop_id, setting) => {
                let ordersPrice = {
                    [`${shop_id}`]: 0
                };
                for (let i = 0; i < localStorage.length; i++) {
                    let key = localStorage.key(i);
                    if (key.includes('ARMADA_PRODUCT_CART_')) {
                        if (key.includes(`_USER_${authUserId}`)) {
                            let elemJSON = JSON.parse(localStorage.getItem(key));
                            if (elemJSON.store_id == shop_id) {
                                if (elemJSON.price_2 === null) {
                                    ordersPrice[`${shop_id}`] += elemJSON.price * elemJSON.count;
                                } else {
                                    ordersPrice[`${shop_id}`] += elemJSON.price_2 * elemJSON.count;
                                }
                            } else continue;
                        } else {
                            localStorage.removeItem(key);
                        }

                    }
                }

                $(`span.price[data-storeid="${shop_id}"] .finally-price-with-discount`).text(priceThreeDigitModification(ordersPrice[`${shop_id}`]));

                let store = document.querySelector(`div[data-storeid="${shop_id}"]`);
                let product = document.querySelector(`li[data-productid="${setting.product_id}"]`);
                let productList = product.parentNode;
                switch (setting.action) {
                    case 'DELETE': {
                        productList.removeChild(product);
                        if (!productList.querySelector('li')) {
                            store.parentNode.parentNode.innerHTML = '';
                        }
                        break;
                    }
                    case 'PLUS': {
                        product.querySelector('.product-card__count span').textContent++;
                        break;
                    }
                    case 'MINUS': {
                        product.querySelector('.product-card__count span').textContent--;
                        break;
                    }
                    case 'INPUT': {
                        product.querySelector('.product-card__count span').textContent = setting.count;
                        break;
                    }
                    default:
                        break;
                }
            }

            function getAllBasketCount(){
                let counter = 0;
                for (let i = 0; i < localStorage.length; i++) {
                    let key = localStorage.key(i);
                    if (key.includes('ARMADA_PRODUCT_CART_')) {
                        let cart_object = JSON.parse(localStorage.getItem(localStorage.key(i)));
                        counter = counter + parseInt(cart_object?.count);
                    }}
                $('.BASKET_total_count').text(counter)
            }

            function refreshInDatabase(){
                let carts = [];
                const length = localStorage.length;
                for (let i = length - 1; i >= 0; i--) {
                    let key = localStorage.key(i);
                    if (key.includes('ARMADA_PRODUCT_CART_')) {
                        let cart_object = JSON.parse(localStorage.getItem(localStorage.key(i)));
                        carts.push(cart_object);
                        ;			}
                }

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'https://market.armada.kz/user-cart-refresh',
                    type: 'post',
                    data: {
                        "carts": carts,
                    },
                    success: function(data) {
                        console.log(data);
                        // window.location.reload();
                    },
                    error: function(data) {
                        console.log('error');
                        console.log(data);
                    },
                });
            }

            function getAllBasketPrice(){
                let priceTotal = 0;
                for (let i = 0; i < localStorage.length; i++) {
                    let key = localStorage.key(i);
                    if (key.includes('ARMADA_PRODUCT_CART_')) {
                        let cart_object = JSON.parse(localStorage.getItem(localStorage.key(i)));
                        if (cart_object.price_2 === null) {
                            priceTotal = priceTotal + parseFloat(cart_object.price) * cart_object.count;
                        } else {
                            priceTotal = priceTotal + parseFloat(cart_object.price_2) * cart_object.count;
                        }
                    }
                }
                $('.BASKET_PRODUCT_final_price').text(priceThreeDigitModification(priceTotal));
            }

            const deleteProduct = (target, currentTarget) => {
                if (target.classList.contains('BASKET_PRODUCT_delete')) {
                    let id = currentTarget.getAttribute('data-BASKET_PRODUCT_id');
                    let elem_JSON = JSON.parse(localStorage.getItem(id));
                    if (elem_JSON.price_2 === null) {
                        $('.BASKET_PRODUCT_final_price')[0].textContent = priceThreeDigitModification($('.BASKET_PRODUCT_final_price')[0].textContent.split(" ").join('') - elem_JSON.price * elem_JSON.count);
                    } else {
                        $('.BASKET_PRODUCT_final_price')[0].textContent = priceThreeDigitModification($('.BASKET_PRODUCT_final_price')[0].textContent.split(" ").join('') - elem_JSON.price_2 * elem_JSON.count);
                    }
                    localStorage.removeItem(id);
                    currentTarget.remove();
                    localStorage.setItem('numberOfUniqueProducts_ARMADA', +localStorage.getItem('numberOfUniqueProducts_ARMADA') - 1);
                    updateBasketCount();
                    if (document.querySelector(`.${id}_CH`)) {
                        $(`.${id}_CH`).each(function (){
                        this.setAttribute('data-chosen', 'false');
                        })
                    }
                    requestToUpdateBasket();
                    getAllBasketCount();
                    if (document.location.pathname === '/orders') {
                        updateOrdersToIdShops(elem_JSON.store_id, {
                            action: 'DELETE',
                            product_id: elem_JSON.id
                        });
                    }
                    refreshInDatabase();
                }
            }

            const minusQuantityProduct = (target, currentTarget) => {
                if (target.classList.contains('BASKET_PRODUCT_minus')) {
                    let id = currentTarget.getAttribute('data-BASKET_PRODUCT_id');
                    let elem_JSON = JSON.parse(localStorage.getItem(id));
                    if (elem_JSON.count <= 1) return false;
                    elem_JSON.count--;
                    currentTarget.getElementsByClassName('BASKET_PRODUCT_count')[0].value = elem_JSON.count;
                    localStorage.setItem(id, JSON.stringify(elem_JSON));
                    if (elem_JSON.price_2 === null) {
                        currentTarget.getElementsByClassName('BASKET_PRODUCT_price_2')[0].textContent = priceThreeDigitModification(elem_JSON.price * elem_JSON.count);
                        $('.BASKET_PRODUCT_final_price')[0].textContent = priceThreeDigitModification($('.BASKET_PRODUCT_final_price')[0].textContent.split(" ").join('') - elem_JSON.price);
                    } else {
                        currentTarget.getElementsByClassName('BASKET_PRODUCT_price')[0].textContent = priceThreeDigitModification(elem_JSON.price * elem_JSON.count);
                        currentTarget.getElementsByClassName('BASKET_PRODUCT_price_2')[0].textContent = priceThreeDigitModification(elem_JSON.price_2 * elem_JSON.count);
                        $('.BASKET_PRODUCT_final_price')[0].textContent = priceThreeDigitModification($('.BASKET_PRODUCT_final_price')[0].textContent.split(" ").join('') - elem_JSON.price_2);
                    }
                    // if( elem_JSON.price === '0'){
                    //     currentTarget.getElementsByClassName('BASKET_PRODUCT_price_2')[0].textContent = "Уточняйте у продавца";
                    //     $('.cart-product__price .price__special .currency').text('');
                    // }

                    if (timerProductCheck) {
                        timerProductCheck = false;
                        setTimeout(() => {
                            requestToUpdateBasket();

                            timerProductCheck = true;
                        }, 5000)
                    }

                    getAllBasketCount();
                    if (document.location.pathname === '/orders') {
                        updateOrdersToIdShops(elem_JSON.store_id, {
                            action: 'MINUS',
                            product_id: elem_JSON.id
                        });
                    }
                    refreshInDatabase();
                }
            }

            const plusQuantityProduct = (target, currentTarget) => {
                if (target.classList.contains('BASKET_PRODUCT_plus')) {
                    let id = currentTarget.getAttribute('data-BASKET_PRODUCT_id');
                    let elem_JSON = JSON.parse(localStorage.getItem(id));
                    elem_JSON.count++;
                    currentTarget.getElementsByClassName('BASKET_PRODUCT_count')[0].value = elem_JSON.count;
                    localStorage.setItem(id, JSON.stringify(elem_JSON));
                    if (elem_JSON.price_2 === null) {
                        currentTarget.getElementsByClassName('BASKET_PRODUCT_price_2')[0].textContent = priceThreeDigitModification(elem_JSON.price * elem_JSON.count);
                        $('.BASKET_PRODUCT_final_price')[0].textContent = priceThreeDigitModification(+$('.BASKET_PRODUCT_final_price')[0].textContent.split(" ").join('') + +elem_JSON.price);
                    } else {
                        currentTarget.getElementsByClassName('BASKET_PRODUCT_price')[0].textContent = priceThreeDigitModification(elem_JSON.price * elem_JSON.count);
                        currentTarget.getElementsByClassName('BASKET_PRODUCT_price_2')[0].textContent = priceThreeDigitModification(elem_JSON.price_2 * elem_JSON.count);
                        $('.BASKET_PRODUCT_final_price')[0].textContent = priceThreeDigitModification(+$('.BASKET_PRODUCT_final_price')[0].textContent.split(" ").join('') + +elem_JSON.price_2);
                    }
                   /* if( elem_JSON.price === '0'){
                        currentTarget.getElementsByClassName('BASKET_PRODUCT_price_2')[0].textContent = "Уточняйте у продавца";
                        $('.cart-product__price .price__special .currency').text('');
                    }*/
                    if (timerProductCheck) {
                        timerProductCheck = false;
                        setTimeout(() => {
                            requestToUpdateBasket();
                            timerProductCheck = true;
                        }, 5000)
                    }
                    getAllBasketCount();
                    if (document.location.pathname === '/orders') {
                        updateOrdersToIdShops(elem_JSON.store_id, {
                            action: 'PLUS',
                            product_id: elem_JSON.id
                        });
                    }
                    refreshInDatabase();
                }
            }

            const addEventClickToProduct = (product) => {
                product.addEventListener('click', (e) => {
                    deleteProduct(e.target, e.currentTarget);
                    minusQuantityProduct(e.target, e.currentTarget);
                    plusQuantityProduct(e.target, e.currentTarget);
                });
            }

            const addEventInputToProduct = (product, nameClass) => {
                product.getElementsByClassName(`${nameClass}_count`)[0].addEventListener('input', (e) => {
                    let id = e.target.getAttribute('data-BASKET_PRODUCT_id');
                    let elem_JSON = JSON.parse(localStorage.getItem(id));
                    let old_count = elem_JSON.count;
                    elem_JSON.count = e.target.value;
                    localStorage.setItem(id, JSON.stringify(elem_JSON));
                    let parent = document.body.querySelector(`li.BASKET_PRODUCT[data-BASKET_PRODUCT_id=${id}]`);
                    if (elem_JSON.price_2 === null) {
                        parent.getElementsByClassName('BASKET_PRODUCT_price_2')[0].textContent = priceThreeDigitModification(elem_JSON.price * elem_JSON.count);
                        $('.BASKET_PRODUCT_final_price')[0].textContent = priceThreeDigitModification(+$('.BASKET_PRODUCT_final_price')[0].textContent.split(" ").join('') + ((elem_JSON.count - old_count) * elem_JSON.price));
                    } else {
                        parent.getElementsByClassName('BASKET_PRODUCT_price')[0].textContent = priceThreeDigitModification(elem_JSON.price * elem_JSON.count);
                        parent.getElementsByClassName('BASKET_PRODUCT_price_2')[0].textContent = priceThreeDigitModification(elem_JSON.price_2 * elem_JSON.count);
                        $('.BASKET_PRODUCT_final_price')[0].textContent = priceThreeDigitModification(+$('.BASKET_PRODUCT_final_price')[0].textContent.split(" ").join('') + ((elem_JSON.count - old_count) * elem_JSON.price_2));
                    }
                    /*if( elem_JSON.price === '0'){
                        parent.getElementsByClassName('BASKET_PRODUCT_price_2')[0].textContent = "Уточняйте у продавца";
                        $('.cart-product__price .price__special .currency').text('');
                    }*/
                    if (timerProductCheck) {
                        timerProductCheck = false;
                        setTimeout(() => {
                            requestToUpdateBasket();
                            timerProductCheck = true;
                        }, 5000)
                    }
                    if (document.location.pathname === '/orders') {
                        updateOrdersToIdShops(elem_JSON.store_id, {
                            action: 'INPUT',
                            product_id: elem_JSON.id,
                            count: elem_JSON.count
                        });
                    }
                });
            }

            const addEventKeypressToProduct = (product, nameClass) => {
                product.getElementsByClassName(`${nameClass}_count`)[0].addEventListener('keypress', (e) => {
                    if (e.charCode < 48 || (e.charCode === 48 && e.currentTarget.value === '')) {
                        e.preventDefault()
                    };
                });
            }

            const addEventBlurToProduct = (product, nameClass) => {
                product.getElementsByClassName(`${nameClass}_count`)[0].addEventListener('blur', (e) => {
                    if (e.currentTarget.value === '') {
                        e.currentTarget.value = 1;
                        let id = e.target.getAttribute('data-BASKET_PRODUCT_id');
                        let elem_JSON = JSON.parse(localStorage.getItem(id));
                        let old_count = elem_JSON.count;
                        elem_JSON.count = e.target.value;
                        localStorage.setItem(id, JSON.stringify(elem_JSON));
                        let parent = document.body.querySelector(`li.BASKET_PRODUCT[data-BASKET_PRODUCT_id=${id}]`);
                        if (elem_JSON.price_2 === null) {
                            parent.getElementsByClassName('BASKET_PRODUCT_price_2')[0].textContent = priceThreeDigitModification(elem_JSON.price * elem_JSON.count);
                            $('.BASKET_PRODUCT_final_price')[0].textContent =  priceThreeDigitModification(+$('.BASKET_PRODUCT_final_price')[0].textContent.split(" ").join('') + ((elem_JSON.count - old_count) * elem_JSON.price));
                        } else {
                            parent.getElementsByClassName('BASKET_PRODUCT_price')[0].textContent = priceThreeDigitModification(elem_JSON.price * elem_JSON.count);
                            parent.getElementsByClassName('BASKET_PRODUCT_price_2')[0].textContent = priceThreeDigitModification(elem_JSON.price_2 * elem_JSON.count);
                            $('.BASKET_PRODUCT_final_price')[0].textContent = priceThreeDigitModification(+$('.BASKET_PRODUCT_final_price')[0].textContent.split(" ").join('') + ((elem_JSON.count - old_count) * elem_JSON.price_2));
                        }
                        /*if( elem_JSON.price === '0'){
                            parent.getElementsByClassName('BASKET_PRODUCT_price_2')[0].textContent = "Уточняйте у продавца";
                            $('.cart-product__price .price__special .currency').text('');
                        }*/
                        if (timerProductCheck) {
                            timerProductCheck = false;
                            setTimeout(() => {
                                requestToUpdateBasket();
                                timerProductCheck = true;
                            }, 5000)
                        }
                        if (document.location.pathname === '/orders') {
                            updateOrdersToIdShops(elem_JSON.store_id, {
                                action: 'INPUT',
                                product_id: elem_JSON.id,
                                count: elem_JSON.count
                            });
                        }
                        e.preventDefault();
                    };
                });
            }

            const drawNewProduct = (obj) => {
                let product = obj.startLayot.cloneNode(true);
                let price = 0;
                product.setAttribute('id',`cart-li-${obj.productDataObj['id']}`);
                product.setAttribute(`data-${obj.startClass}_id`, `ARMADA_PRODUCT_CART_${obj.productDataObj['id']}_USER_${obj.productDataObj['userId']}`);
                product.getElementsByClassName(`${obj.startClass}_title`)[0].textContent = obj.productDataObj.title;
                product.getElementsByClassName(`${obj.startClass}_image`)[0].src = `/storage/${obj.productDataObj.image}`;
                product.getElementsByClassName(`${obj.startClass}_store`)[0].textContent = obj.productDataObj.store_title;
                $(product.getElementsByClassName(`${obj.startClass}_checkbox`)).val(obj.productDataObj['id']);
                $(product.getElementsByClassName(`${obj.startClass}_checkbox`)).attr('id', `cart-${obj.productDataObj['id']}`);
                $(product.getElementsByClassName(`${obj.startClass}_checkbox_label`)).attr('for', `cart-${obj.productDataObj['id']}`);
                if (obj.toBasket) {
                    if (obj.productDataObj.articul === null) {
                        product.getElementsByClassName(`${obj.startClass}_articul`)[0].parentNode.parentNode.style.display = 'none';
                    } else {
                        product.getElementsByClassName(`${obj.startClass}_articul`)[0].textContent = obj.productDataObj.articul;
                    }
                }
                if (obj.productDataObj.price_2 === null) {
                    product.getElementsByClassName(`${obj.startClass}_price`)[0].parentNode.style.display = 'none';
                    obj.toBasket ?
                        product.getElementsByClassName(`${obj.startClass}_price_2`)[0].textContent = priceThreeDigitModification(obj.productDataObj.price * obj.productDataObj.count) :
                        '';
                    price = obj.productDataObj.price * obj.productDataObj.count;
                } else {
                    product.getElementsByClassName(`${obj.startClass}_price`)[0].textContent =  priceThreeDigitModification(obj.productDataObj.price * obj.productDataObj.count);
                    obj.toBasket ?
                        product.getElementsByClassName(`${obj.startClass}_price_2`)[0].textContent = priceThreeDigitModification(obj.productDataObj.price_2 * obj.productDataObj.count) :
                        '';
                    price = obj.productDataObj.price_2 * obj.productDataObj.count;
                }




                product.getElementsByClassName(`${obj.startClass}_count`)[0].value = obj.productDataObj.count;
                product.style.display = 'block';
                obj.parent.appendChild(product);
                if (obj.toBasket) {
                    addEventClickToProduct(product);
                    product.getElementsByClassName(`${obj.startClass}_count`)[0].setAttribute(`data-${obj.startClass}_id`, `ARMADA_PRODUCT_CART_${obj.productDataObj.id}_USER_${obj.productDataObj.userId}`);
                    addEventInputToProduct(product, obj.startClass);
                    addEventKeypressToProduct(product, obj.startClass);
                    addEventBlurToProduct(product, obj.startClass);
                }

                /*if(obj.productDataObj.price === '0'){
                    product.getElementsByClassName(`${obj.startClass}_price_2`)[0].textContent = 'Уточняйте у продавца'
                    $('.cart-product__price .price__special .currency').text('');
                }*/

                return price;
            }

            // const clickToBasket = (target) => {
            //     if (target.classList.contains('BASKET') || (target.parentNode.tagName === 'svg' && target.parentNode.classList.contains('BASKET'))) {
            //         fillBasketData();
            //     }
            // }
            const fillBasketData = () =>{
                let card_info_arr = [];
                for (let i = 0; i < localStorage.length; i++) {
                    let key = localStorage.key(i);
                    if (key.includes('ARMADA_PRODUCT_CART_')) card_info_arr.push(JSON.parse(localStorage.getItem(key)));
                }

                let BASKET_PRODUCT_layot = $('.BASKET_PRODUCT')[0];

                let BASKET_PRODUCT_parent = $('.BASKET_PRODUCT_parent')[0];

                BASKET_PRODUCT_parent.innerHTML = '';
                BASKET_PRODUCT_parent.appendChild(BASKET_PRODUCT_layot);
                let final_price = 0;
                for (let i = 0; i < card_info_arr.length; i++) {
                    final_price += drawNewProduct({
                        startLayot: BASKET_PRODUCT_layot,
                        productDataObj: card_info_arr[i],
                        startClass: 'BASKET_PRODUCT',
                        toBasket: true,
                        parent: BASKET_PRODUCT_parent
                    });
                }

                $('.BASKET_PRODUCT_final_price')[0].textContent = priceThreeDigitModification(final_price);
                busketHidden = false;
                requestToUpdateBasket();
            }

            const clickToAddToBasket = async (target) => {
                const userId = @json(Auth::check() ? Auth::id() : null);
                let card_info_obj;
                let checkBuyAll = false;

                if (target.classList.contains('btn_to_basket')) {
                    card_info_obj = JSON.parse(target.getAttribute('data-product-information'));
                } else if (target.parentNode.classList.contains('btn_to_basket')) {
                    card_info_obj = JSON.parse(target.parentNode.getAttribute('data-product-information'));
                } else if (target.parentNode.parentNode.classList.contains('btn_to_basket')) {
                    card_info_obj = JSON.parse(target.parentNode.parentNode.getAttribute('data-product-information'));
                } else if ((target.tagName === 'div') && target.querySelector('button.btn_to_basket')) {
                    card_info_obj = JSON.parse(target.querySelector('button.btn_to_basket').getAttribute('data-product-information'));
                } else if (target.getAttribute('id') === 'buyAllProducts') {
                    card_info_obj = JSON.parse(target.getAttribute('data-likes'));
                    checkBuyAll = true;
                } else {
                    return false
                }

                if (!checkBuyAll) {
                    card_info_obj = {
                        obj: card_info_obj,
                    }
                }

                //data-product-information="{"id":20292,"store_id":482,"item_id":100,"slug":"test-discount-1-2","title":"Test Discount 1","price":3000,"price_2":null,"articul":null,"images":["images\/Apr2022\/8HSddlHzhD.webp"],"discount":10,"is_discount":1,"store":{"id":482,"title":"Test parrot","slug":"test-parrot"}}"

                for (let key in card_info_obj) {
                    let card_info_json = {
                        id: card_info_obj[key].id,
                        title: card_info_obj[key].title,
                        store_title: card_info_obj[key].store.title,
                        image: card_info_obj[key].images[0],
                        articul: card_info_obj[key].articul,
                        price: `${card_info_obj[key].price}`.split(" ").join(''),
                        store_id: card_info_obj[key].store.id,
                        is_price_from: card_info_obj[key].is_price_from,
                        //token: localStorage.getItem('TOKEN'),
                        //token_new: localStorage.getItem('TOKEN-NEW'),
                        userId,
                        color: productColor,
                        count: document.querySelector('.BASKET_PRODUCT_interior.BASKET_PRODUCT_count') ? document.querySelector('.BASKET_PRODUCT_interior.BASKET_PRODUCT_count').value : 1,
                        discount: card_info_obj[key].discount,
                        is_discount: card_info_obj[key].is_discount,
                        price_2: card_info_obj[key].price_2 != null ? `${card_info_obj[key].price_2}`.split(" ").join('') : (card_info_obj[key].is_discount === 1 ? `${card_info_obj[key].price * (1-card_info_obj[key].discount/100)}`.split(" ").join('') : null ),
                    }

                    productColor = 0;

                    if (!localStorage.getItem(`ARMADA_PRODUCT_CART_${card_info_json.id}_USER_${userId}`)) {
                        localStorage.setItem('numberOfUniqueProducts_ARMADA', +localStorage.getItem('numberOfUniqueProducts_ARMADA') + 1);
                        updateBasketCount();
                        $(`.ARMADA_PRODUCT_CART_${card_info_json.id}_CH`).each(
                            function (){
                                this.setAttribute('data-chosen', 'true')
                            }
                        )
                    }

                    localStorage.setItem(`ARMADA_PRODUCT_CART_${card_info_json.id}_USER_${userId}`, JSON.stringify(card_info_json));
                }

                updateBasketCount();
                refreshInDatabase();
            }

            const requestToUpdateBasket = () => {
                let card_info_arr = [];
                let deleteAll = false;
                for (let i = 0; i < localStorage.length; i++) {
                    let key = localStorage.key(i);
                    if (key.includes('ARMADA_PRODUCT_CART_')) card_info_arr.push(JSON.parse(localStorage.getItem(key)));
                }
                if (card_info_arr.length === 0) {
                    deleteAll = true;
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('orderPost')}}',
                    type: 'post',
                    data: {
                        "orders": card_info_arr,
                        deleteAll
                    },
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(data) {
                        console.log('error');
                        console.log(data);
                    },
                });
            }

            document.addEventListener('click', async (e) => {
                clickToAddToBasket(e.target);
                // clickToBasket(e.target);

                if (busketHidden === false && document.querySelector('#cardModal')?.hasAttribute('aria-modal')
                    && ( ( e.target.hasAttribute('id') && e.target.getAttribute('id') === 'cardModal' ) ||
                        ( e.target.hasAttribute('id') && e.target.getAttribute('id') === 'BASKET_PRODUCT_modal_close' ) ||
                        ( e.target.parentNode.hasAttribute('id') && e.target.parentNode.getAttribute('id') === 'BASKET_PRODUCT_modal_close' ) ) ) {
                    busketHidden = true;
                    requestToUpdateBasket();
                }


                if (e.target.classList.contains('BASKET_PRODUCT_minus') && e.target.classList.contains('BASKET_PRODUCT_interior')) {
                    let count = document.querySelector('.BASKET_PRODUCT_interior.BASKET_PRODUCT_count').value;
                    if (count <= 1) return false;
                    count--;
                    document.querySelector('.BASKET_PRODUCT_interior.BASKET_PRODUCT_count').value = count;
                }

                if (e.target.classList.contains('BASKET_PRODUCT_plus') && e.target.classList.contains('BASKET_PRODUCT_interior')) {
                    let count = document.querySelector('.BASKET_PRODUCT_interior.BASKET_PRODUCT_count').value;
                    count++;
                    document.querySelector('.BASKET_PRODUCT_interior.BASKET_PRODUCT_count').value = count;
                }

                if (document.querySelector('.BASKET_PRODUCT_interior.BASKET_PRODUCT_count')) {
                    document.querySelector('.BASKET_PRODUCT_interior.BASKET_PRODUCT_count').addEventListener('keypress', (e) => {
                        if (e.charCode < 48 || (e.charCode === 48 && e.currentTarget.value === '')) {
                            e.preventDefault();
                        };
                    });

                    document.querySelector('.BASKET_PRODUCT_interior.BASKET_PRODUCT_count').addEventListener('blur', (e) => {
                        if (e.currentTarget.value === '') {
                            e.currentTarget.value = 1;
                            e.preventDefault();
                        };
                    });
                }

                if (e.target.classList.contains('busket_submit')) {
                    if (!e.target.getAttribute('disabled')) {
                        e.target.setAttribute('disabled', true);

                        let card_info_arr = [];
                        for (let i = 0; i < localStorage.length; i++) {
                            let key = localStorage.key(i);
                            if (key.includes('ARMADA_PRODUCT_CART_')) card_info_arr.push(JSON.parse(localStorage.getItem(key)));
                        }
                        $('.ALL_ORDERS')[0].value = JSON.stringify(card_info_arr);
                        await requestToUpdateBasket();
                        let url = e.target.getAttribute('href');
                        setTimeout(function() {
                            window.location = url;
                            e.target.setAttribute('disabled', false);
                        }, 200);
                    }
                    e.preventDefault();
                }

                if (localStorage.getItem('numberOfUniqueProducts_ARMADA') === 0) $('.BASKET_PRODUCT_parent')[0].parentNode.style.display = 'none';
                else{
                    if($('.BASKET_PRODUCT_parent')[0]){
                        $('.BASKET_PRODUCT_parent')[0].parentNode.style.display = 'block';
                    }
                }
            });

            if (document.querySelector('.BASKET_PRODUCT_colors')) {
                document.querySelector('.BASKET_PRODUCT_colors').addEventListener('click', (e) => {
                    if (e.target.tagName !== 'UL' && e.target.tagName !== 'SPAN') {
                        productColor = e.target.querySelector('span').style.backgroundColor;
                    } else if (e.target.tagName === 'SPAN') {
                        productColor = e.target.style.backgroundColor;
                    };
                });
            }



            $( document ).ready(function() {

                if(window.location.pathname === '/cart' || window.location.pathname === '/kk/cart'){
                    fillBasketData()
                }
                    getAllBasketCount();



                const selectedItems = () => {
                    let val = [];
                    $('.BASKET_PRODUCT_checkbox:checked').each(function(i){
                        val[i] = $(this).val();
                    });
                    return val;
                }

                // check box for cart items
                const cart_select_all = $('#cart_select_all');
                const cart_item_checkbox = $('.BASKET_PRODUCT_checkbox');
                cart_select_all.change(function (){
                    if(cart_select_all.is(':checked')){
                        $('.BASKET_PRODUCT_checkbox').prop('checked',true)
                    }else{
                        $('.BASKET_PRODUCT_checkbox').prop('checked',false)
                    }
                })




                const deleteSelected = async () => {
                    let selectedArr = selectedItems();
                    await $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{route('orderPost')}}',
                        type: 'post',
                        data: {
                            "deleting_orders":selectedArr
                            // deleteAll: true
                        },
                        success: function(data) {
                            console.log(data);
                            const length = localStorage.length;
                            for (let i = length - 1; i >= 0; i--) {
                                let key = localStorage.key(i);
                                selectedArr.forEach(function(id){
                                    const cart_li = $(`#cart-li-${id}`);
                                    if (key.includes(`ARMADA_PRODUCT_CART_${id}`)) {
                                        localStorage.removeItem(key);
                                    }
                                    cart_li.remove();
                                });
                            }
                            getAllBasketPrice();
                            getAllBasketCount();
                            updateBasketCount();
                        },
                        error: function(data) {
                            console.log('error');
                            console.log(data);
                        },
                    });
                };
// $('#cart_clear_select').click(async()=>{
                //     await clearAll();
                // })

                $('#cart_clear_select').click(async()=>{
                    await deleteSelected();
                 })
            });

        })();


    </script>
@endif
