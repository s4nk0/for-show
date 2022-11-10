<form wire:submit.prevent="saveCourse" method="post" id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
@csrf
<!--begin::Card body-->
    <div class="card-body border-top p-9">
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6">Title</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <input type="text" wire:model="title" class="form-control form-control-lg form-control-solid" placeholder="Title" >
                <div class="fv-plugins-message-container invalid-feedback">@error('title') {{ $message }} @enderror</div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
    </div>
    <!--end::Card body-->
    <!--begin::Actions-->
    <div class="card-footer d-flex justify-content-end py-6 px-9">
        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Submit</button>
    </div>
    <!--end::Actions-->
    <input type="hidden"><div></div></form>
