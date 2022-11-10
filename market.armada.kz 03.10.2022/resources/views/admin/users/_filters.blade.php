<aside class="filters filters--hidden col-12 col-md-3">
    <div class="filters__header p-4 d-flex border-bottom align-items-center justify-content-between">
        <b>Фильтр</b>
        <div class="filters__close">
            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.50776 5.50008L10.7909 1.21668C11.0697 0.938066 11.0697 0.48758 10.7909 0.208963C10.5123 -0.0696543 10.0619 -0.0696543 9.78324 0.208963L5.49993 4.49236L1.21676 0.208963C0.938014 -0.0696543 0.487668 -0.0696543 0.209056 0.208963C-0.0696855 0.48758 -0.0696855 0.938066 0.209056 1.21668L4.49224 5.50008L0.209056 9.78348C-0.0696855 10.0621 -0.0696855 10.5126 0.209056 10.7912C0.347906 10.9302 0.530471 11 0.712906 11C0.895341 11 1.07778 10.9302 1.21676 10.7912L5.49993 6.5078L9.78324 10.7912C9.92222 10.9302 10.1047 11 10.2871 11C10.4695 11 10.652 10.9302 10.7909 10.7912C11.0697 10.5126 11.0697 10.0621 10.7909 9.78348L6.50776 5.50008Z" fill="#1C2021"/>
            </svg>
        </div>
    </div>
    <div class="filters__search border-bottom">
        <p class="font-weight-semibold">Производитель</p>
        <form id="alphabet" action="#" class="search search--alphabet mt-3">
            <input type="text" placeholder="Поиск">
            <button type="submit">
                <img src="img/svg/search.svg" alt="Search">
            </button>
        </form>
    </div>
    <div class="filters__checkbox-group mt-3 mb-4">
        <p class="font-weight-semibold">Алфавитный указатель</p>
        <div class="custom-scrollbar default-skin" style="max-height: 340px">
            <ul class="list-style-none mb-b p-0">
                <li class="custom-control filter-apply custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-1"
                           class="custom-control-input">
                    <label for="vendor-1" class="custom-control-label">Производитель 1</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-2"
                           class="custom-control-input"><label
                        for="vendor-2" class="custom-control-label">Производитель 2</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-3"
                           class="custom-control-input"><label
                        for="vendor-3" class="custom-control-label">Производитель 3</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-4"
                           class="custom-control-input"><label
                        for="vendor-4" class="custom-control-label">Производитель 4</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-5"
                           class="custom-control-input"><label
                        for="vendor-5" class="custom-control-label">Производитель 5</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-6"
                           class="custom-control-input"><label
                        for="vendor-6" class="custom-control-label">Производитель 6</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-7"
                           class="custom-control-input"><label
                        for="vendor-7" class="custom-control-label">Производитель 7</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-8"
                           class="custom-control-input"><label
                        for="vendor-8" class="custom-control-label">Производитель 8</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-9"
                           class="custom-control-input"><label
                        for="vendor-9" class="custom-control-label">Производитель 9</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-10"
                           class="custom-control-input"><label
                        for="vendor-10" class="custom-control-label">Производитель 10</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-11"
                           class="custom-control-input"><label
                        for="vendor-11" class="custom-control-label">Производитель 11</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-12"
                           class="custom-control-input"><label
                        for="vendor-12" class="custom-control-label">Производитель 12</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-13"
                           class="custom-control-input"><label
                        for="vendor-13" class="custom-control-label">Производитель 13</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-14"
                           class="custom-control-input"><label
                        for="vendor-14" class="custom-control-label">Производитель 14</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-15"
                           class="custom-control-input"><label
                        for="vendor-15" class="custom-control-label">Производитель 15</label></li>
            </ul>
        </div>
    </div>
    <div class="price-range filters__price">
        <p class="font-weight-semibold">Цена</p>
        <div class="price-range__values">
            <input type="number" min="0" max="9900" value="6" onchange="validity.valid||(value='0');" id="min_price" class="price-range-field bg-light border-0 rounded" />
            <span></span>
            <input type="number" min="0" max="60000" value="60000" onchange="validity.valid||(value='10000');" id="max_price" class="price-range-field bg-light border-0 rounded" />
        </div>
        <div id="slider-range" class="price-range__slider price-filter-range" name="rangeInput"></div>
    </div>
    <div class="filters__checkbox-group mt-4">
        <p class="font-weight-semibold">Страна производитель</p>
        <div class="custom-scrollbar default-skin" style="max-height: 340px">
            <ul class="list-style-none mb-b p-0">
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-1r"
                           class="custom-control-input">
                    <label for="vendor-1r" class="custom-control-label">Производитель 1</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-2r"
                           class="custom-control-input">
                    <label for="vendor-2r" class="custom-control-label">Производитель 2</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-3r"
                           class="custom-control-input">
                    <label for="vendor-3r" class="custom-control-label">Производитель 3</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-4r"
                           class="custom-control-input">
                    <label for="vendor-4r" class="custom-control-label">Производитель 4</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-5r"
                           class="custom-control-input">
                    <label for="vendor-5r" class="custom-control-label">Производитель 5</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-6r"
                           class="custom-control-input">
                    <label for="vendor-6r" class="custom-control-label">Производитель 6</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-7r"
                           class="custom-control-input">
                    <label for="vendor-7r" class="custom-control-label">Производитель 7</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-8r"
                           class="custom-control-input">
                    <label for="vendor-8r" class="custom-control-label">Производитель 8</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-9r"
                           class="custom-control-input">
                    <label for="vendor-9r" class="custom-control-label">Производитель 9</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-10r"
                           class="custom-control-input">
                    <label for="vendor-10r" class="custom-control-label">Производитель 10</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-11r"
                           class="custom-control-input">
                    <label for="vendor-11r" class="custom-control-label">Производитель 11</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-12r"
                           class="custom-control-input">
                    <label for="vendor-12r" class="custom-control-label">Производитель 12</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-13r"
                           class="custom-control-input">
                    <label for="vendor-13r" class="custom-control-label">Производитель 13</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-14r"
                           class="custom-control-input">
                    <label for="vendor-14r" class="custom-control-label">Производитель 14</label></li>
                <li class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" id="vendor-15r"
                           class="custom-control-input">
                    <label for="vendor-15r" class="custom-control-label">Производитель 15</label></li>
            </ul>
        </div>
    </div>
    <button class="button btn-primary my-4 mr-4 float-right">Применить</button>
</aside>
