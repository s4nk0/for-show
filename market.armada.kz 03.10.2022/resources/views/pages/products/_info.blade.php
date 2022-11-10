<section class="seo-text section container page-product__info border-top position-relative">
    <div id="info" class="position-absolute" style="top: -150px"></div>
    <div class="section__header">
        <h2 class="section__title text-center d-block w-100 font-weight-semibold">{{__('messages.product.info_about_product')}}</h2>
    </div>
    <div class="row">
        <div class="seo-text__content offset-md-1 col-md-10 col-12 section__content default-skin">
            {!! $product->description ?? __('messages.product.info_about_product.none').' :(' !!}
        </div>
    </div>
</section>
