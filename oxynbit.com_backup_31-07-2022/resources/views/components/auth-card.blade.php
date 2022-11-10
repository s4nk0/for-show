<div class="col-xl-12 vh-100 d-flex justify-content-center">
    @isset($logo)<div>
        {{ $logo }}
    </div>
    @endisset

    <div class="form-access my-auto">
        {{ $slot }}
    </div>
</div>
