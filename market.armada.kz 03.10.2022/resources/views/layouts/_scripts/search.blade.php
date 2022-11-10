<script>
    (function () {
        let autosearch_page_number = 1;
        let autosearch_last_page_number = 0;
        let autosearch_shop_page_number = 1;
        let autosearch_shop_last_page_number = 0;
        let autosearch_input_value = '';
        let search_history_count = 3;

        let currentUrl = window.location.pathname

        let urlPrefix = "/kk/";

        let pattern = new RegExp('^' + urlPrefix);
        let hasPrefixKK = pattern.test(currentUrl);

        if(document.querySelector('.autosearch__PRODUCTS .autosearch__column-wrap')) {
            document.querySelector('.autosearch__PRODUCTS .autosearch__column-wrap')
                .addEventListener('scroll', function(e) {
                    if (e.target.scrollTop + e.target.clientHeight === e.currentTarget.scrollHeight) {
                        if (autosearch_last_page_number !== autosearch_page_number) {
                            autosearch_page_number++;
                            sendRequest();
                        }
                    }
                });
        }

        if(document.querySelector('.autosearch__SHOPS')) {
            document.querySelector('.autosearch__SHOPS .autosearch__column-wrap')
                .addEventListener('scroll', function(e) {
                    if (e.target.scrollTop + e.target.clientHeight === e.currentTarget.scrollHeight) {
                        if (autosearch_shop_last_page_number !== autosearch_shop_page_number) {
                            autosearch_shop_page_number++;
                            sendShopRequest();
                        }
                    }
                });
        }

        if(document.getElementById('search')) {
            document.getElementById('search').addEventListener('input', function (e) {
                autosearch_input_value = e.target.value.length >= 3 ? e.target.value : false;
                autosearch_page_number = 1;
                autosearch_shop_page_number = 1;

                checkSearchInput('none');
                sendRequest();
                sendShopRequest();

            });
        }

        const sendRequest = () => {
            if(autosearch_input_value){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'{{app()->getLocale() =='kk' ? '/'.app()->getLocale() : ''}}/search',
                    type:'post',
                    data:{"querys":autosearch_input_value,'page':autosearch_page_number},
                    success:function(data)
                    {
                        if (data[1].length !== 0) checkSearchInput('');
                        drawAutosearch(data);
                        autosearch_last_page_number = data[3];

                        if($( window ).width() < 500){
                            $('.autosearch__column-wrap.custom-scrollbar').mCustomScrollbar('destroy');
                        }
                    },
                    error:function(data)
                    {

                    },
                });
            }
        }

        const sendShopRequest = () => {
            if(autosearch_input_value){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'/search-store',
                    type:'post',
                    data:{"querys":autosearch_input_value,'page':autosearch_shop_page_number},
                    success:function(data)
                    {

                        autosearch_shop_last_page_number = data[0];
                    },
                    error:function(data)
                    {
                        console.log(data);
                    },
                });
            }
        }

       /* const drawShops = (shops) => {
            let HTML_shop_list = document.querySelector('.autosearch__SHOPS ul');
            let HTML_shop_layot_item = document.querySelector('.autosearch__SHOPS li');
            if (autosearch_shop_page_number === 1) {
                HTML_shop_list.innerHTML = '';
                HTML_shop_list.appendChild(HTML_shop_layot_item);
            }
            if (shops.length === 0) return false;
            for (let i = 0; i < shops.length; i++) {
                let HTML_shop_item_new = HTML_shop_layot_item.cloneNode(true);
                HTML_shop_item_new.querySelector('a').textContent = shops[i].title;
                HTML_shop_item_new.querySelector('a').href = '/shop/'+shops[i].slug;
                HTML_shop_item_new.style.display = '';
                HTML_shop_list.appendChild(HTML_shop_item_new);
            }
        }*/

        const drawAutosearch = (data) => {
            drawCategories(data[2]);
            drawProducts(data[0], data[1]);
            drawStore(data[1],data[0]);

        }

        const drawCategories = (categories) => {
            @if(env('ELASTICSEARCH_ENABLED') != true)
            let HTML_cat_list = document.querySelector('.autosearch__CATEGORIES ul');
            let HTML_cat_layot_item = document.querySelector('.autosearch__CATEGORIES li');
            HTML_cat_list.innerHTML = '';
            HTML_cat_list.appendChild(HTML_cat_layot_item);
            if (categories.length === 0) return false;

            // <div class="d-flex align-items-center">
            // <img class="mr-2" src="https://image.shutterstock.com/image-vector/cartoon-funny-parrot-isolated-on-600w-335692742.jpg" alt="" width="20px" height="20px">
            //     <div class="d-flex flex-column">
            //         <span class="item_title">Divan</span>
            //         <span class="item_catlog">Mebel / Divan</span>
            //     </div>
            // </div>
            for (let i = 0; i < categories.length; i++) {

                    let HTML_cat_item_new = HTML_cat_layot_item.cloneNode(true);
                    HTML_cat_item_new.querySelector('a').textContent = categories[i].title;
                    HTML_cat_item_new.querySelector('a').href = `${hasPrefixKK ? '/kk' : ''}`+'/item/'+categories[i].slug;
                    HTML_cat_item_new.style.display = '';
                    HTML_cat_list.appendChild(HTML_cat_item_new);


              /*  else{
                    let HTML_cat_item_new = HTML_cat_layot_item.cloneNode(true);
                    HTML_cat_item_new.querySelector('a').href = '/item/'+categories[i].slug;
                    HTML_cat_item_new.querySelector('a').innerHTML = "<div class=\"d-flex align-items-center\">" +
                    ` <img class=\"item_search_image mr-2\" src=\"/storage/${categories[i].images[0]}\" alt=\"categories[i].title\"> ` +
                    "<div class=\"d-flex flex-column\">" +
                    `<span class=\"item_title\">${categories[i].title}</span>` +
                    `<span class=\"item_catalog\">${categories[i]?.catalog?.title} / ` +
                    `${categories[i]?.subCatalog?.title} / ${categories[i].title}</span>` + "</div></div>";
                    HTML_cat_item_new.style.display = '';
                    HTML_cat_list.appendChild(HTML_cat_item_new);
                }*/
            }
            @endif
        }

        const drawStore = (store,products) => {
            @if(env('ELASTICSEARCH_ENABLED') != true)
            let HTML_cat_list = document.querySelector('.autosearch__SHOPS ul');
            let HTML_cat_layot_item = document.querySelector('.autosearch__SHOPS li');
            HTML_cat_list.innerHTML = '';
            HTML_cat_list.appendChild(HTML_cat_layot_item);
            if (store.length === 0) return false;
            // let store_block =[];
            // for (let i = 0; i < store.length; i++) {
            //     products.forEach((item) => {
            //         if (item.store_id === store[i].id) {
            //             store_block.push(store[i]);
            //         }
            //     });
            // }
            let store_block =[...new Set(store)];
            for(let i = 0; i< store_block.length;i++){
                // let HTML_cat_item_new = HTML_cat_layot_item.cloneNode(true);
                // HTML_cat_item_new.querySelector('a').textContent = store_block[i].title;
                // HTML_cat_item_new.querySelector('a').href = '/prodavcy/'+store_block[i]?.slug;
                // HTML_cat_item_new.style.display = '';
                // HTML_cat_list.appendChild(HTML_cat_item_new);
                let HTML_cat_item_new = HTML_cat_layot_item.cloneNode(true);
                HTML_cat_item_new.querySelector('a').href = `${hasPrefixKK ? '/kk' : ''}`+'/prodavcy/'+store_block[i].slug;
                HTML_cat_item_new.querySelector('a').innerHTML = "<div class=\"store_search_result\">" +
                    ` <img class=\"search_image\" src=\"/storage/${store_block[i]?.logo[0]}\" alt=\"logo\"> ` +
                    "<div class=\"d-flex flex-column product-card__content p-0\">" +
                    `<span class=\"store_title\">${store_block[i].title}</span>` +
                    `<span class=\"store_desc\">${store_block[i]?.mini_desc} ` +
                     "</div></div>";
                HTML_cat_item_new.style.display = '';
                HTML_cat_list.appendChild(HTML_cat_item_new);
            }
            @endif
        }

        const drawProducts = (products, slugs) => {
            @if(env('ELASTICSEARCH_ENABLED') != true)
            let HTML_prod_list = document.querySelector('.autosearch__PRODUCTS ul');
            let HTML_prod_layot_item = document.querySelector('.autosearch__PRODUCTS li');
            if (autosearch_page_number === 1) {
                HTML_prod_list.innerHTML = '';
                HTML_prod_list.appendChild(HTML_prod_layot_item);
            }
            if (products.length === 0) return false;
            for (let i = 0; i < products.length; i++) {
                let HTML_prod_item_new = HTML_prod_layot_item.cloneNode(true);
                slugs.forEach((item) => {
                    if (item.id === products[i].store_id) {
                        HTML_prod_item_new.querySelector('.product-card__vendor').textContent = item.title;
                    }
                });
                HTML_prod_item_new.querySelector('.product-card__title')
                    .textContent = products[i].title;
                $.get(`/public/storage/${products[i].images[0]}`)
                    .done(function() {
                        HTML_prod_item_new.querySelector('.product-card__image img')
                            .src = `/storage/${products[i].images[0]}`;
                    })
                    .fail(function() {
                        HTML_prod_item_new.querySelector('.product-card__image img')
                            .src = `/storage/${products[i].images[0]}`;
                        // HTML_prod_item_new.querySelector('.product-card__image img')
                        //     .src = 'img/noimg.jpg';
                    });
                HTML_prod_item_new.querySelector('.product-card__link')
                    .href = `${hasPrefixKK ? '/kk' : ''}`+`/product/${products[i].id+'-'+products[i].slug}`;

                if (products[i].price_2 === null) {
                    HTML_prod_item_new.querySelector('.price__previous')
                        .style.display = 'none';
                    // HTML_prod_item_new.querySelector('.price__special span')
                    //     .textContent = products[i].price !== 0 ? products[i].price + 'тг' : 'Уточняйте у продавца';
                    HTML_prod_item_new.querySelector('.price__special span')
                        .textContent =  products[i].price;
                    if(products[i].is_price_from=== 1){
                        HTML_prod_item_new.querySelector('.price__special span')
                            .textContent = "от " + products[i].price + 'тг';
                    }
                } else {
                    HTML_prod_item_new.querySelector('.price__previous span')
                        .textContent = products[i].price + 'тг';;
                    HTML_prod_item_new.querySelector('.price__special span')
                        .textContent = products[i].price_2 + 'тг';;
                }
                HTML_prod_item_new.style.display = '';
                HTML_prod_list.appendChild(HTML_prod_item_new);
            }
            @endif
        }


        const checkSearchInput = (display_value) => {
            @if(env('ELASTICSEARCH_ENABLED') != true)
            document.querySelector('.autosearch__CATEGORIES')
                .parentNode.style.display = display_value;
            @endif
        }

        // история поиска
        document.querySelector('.search').onsubmit = function () {

            var search_array = [];
            var search_text = document.getElementById('search').value;
            if (getCookie('search_history') != null) {
                search_array = JSON.parse(getCookie('search_history'));
            }

            if (search_array.length == search_history_count) {
                search_array.pop();
            }

            if (search_array.indexOf(search_text) !== 0 || search_array.length ==0){
                if(search_array.includes(search_text)){
                    search_array.pop(search_array.indexOf(search_text));
                }

                search_array.unshift(search_text);
                setCookie('search_history',JSON.stringify(search_array));
            }

        }

        const deleteHistory = (index) => {
            var search_array = JSON.parse(getCookie('search_history'));
            search_array.pop(index);
            setCookie('search_history',JSON.stringify(search_array));
        }

        function getCookie(name) {
            let matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }

        function setCookie(name, value, options = {}) {

            options = {
                path: '/',
                // при необходимости добавьте другие значения по умолчанию
                ...options
            };

            if (options.expires instanceof Date) {
                options.expires = options.expires.toUTCString();
            }

            let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

            for (let optionKey in options) {
                updatedCookie += "; " + optionKey;
                let optionValue = options[optionKey];
                if (optionValue !== true) {
                    updatedCookie += "=" + optionValue;
                }
            }

            document.cookie = updatedCookie;
        }
        function deleteCookie(name) {
            setCookie(name, "", {
                'max-age': -1
            })
        }
    })();
</script>
