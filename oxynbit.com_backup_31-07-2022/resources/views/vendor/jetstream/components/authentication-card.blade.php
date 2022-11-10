<div class="col-xl-12 vh-100 d-flex justify-content-center">
    <div>
        @isset($logo){{ $logo }}@endisset
    </div>

    <div class="form-access my-auto">
        {{ $slot }}
    </div>
</div>
