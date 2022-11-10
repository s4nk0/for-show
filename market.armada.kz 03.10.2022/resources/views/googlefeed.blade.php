<?xml version='1.0' encoding='UTF-8'?>.
<yml_catalog date="2020-08-04 02:00">
    <shop>
        <name>Магазин</name>
        <company>Магазин</company>
        <url>https://market.armada.kz/</url>
        <brands>
            <brand url="https://market.armada.kz/brand/1">Lego</brand>
            <brand url="https://market.armada.kz/brand/2">Лукойл</brand>
            <brand url="https://market.armada.kz/brand/3">BMW</brand>
        </brands>
        <categories>
            <category url="https://market.armada.kz/cat/1" id="1">Спорт и отдых</category>
            <category url="https://market.armada.kz/cat/2" id="2" parentId="1">Тренажеры и фитнес</category>
            <category url="https://market.armada.kz/cat/3" id="3" parentId="2">Тренажеры</category>
            <category url="https://market.armada.kz/cat/4" id="4" parentId="3">Эллиптические тренажеры</category>
        </categories>
        <offers>
            @foreach($products as $product)
                <offer type="vendor.model" available="true" id="1">
                    <url>https://market.armada.kz/product/{{$product->id}}-{{$product->slug}}</url>
                    <price>{{$product->price}}</price>
                    <oldprice>1399.00</oldprice>
                    <currencyId>KZT</currencyId>
                    <categoryId>{{$product->catalog_id}}</categoryId>
                                    <picture>https://market.armada.kz/storage/{{$product->images[0]}}</picture>
                    <typePrefix>{{$product->title}}</typePrefix>
                    <vendor>{{$product->title}}</vendor>
                    <model>{{$product->title}}</model>
                    <description>{{$product->description}}</description>
                    <sales_notes>Сборка - бесплатно.</sales_notes>
                    <manufacturer_warranty>true</manufacturer_warranty>
                                    <offerCode>{{$product->articul}}</offerCode>
                                    <snippet>{{$product->description}}</snippet>
                    <label>ярлык-на-товар-акция-на-товар</label>

                                    <param name="popularity">3</param>
                                    <param name="Вес в упаковке" unit="кг">221</param>
                                    <param name="Длина" unit="м">1.8</param>
                                    <param name="Ширина" unit="м">0.7</param>
                                    <param name="Высота" unit="м">1.7</param>
                    <pickup>false</pickup>
                    <store>false</store>
                    <region id="msk">
                        <available>true</available>
                        <price>9999</price>
                    </region>
                    <region id="spb">
                        <available>false</available>
                        <price>11200</price>
                    </region>
                </offer>
            @endforeach
        </offers>
    </shop>
</yml_catalog>
