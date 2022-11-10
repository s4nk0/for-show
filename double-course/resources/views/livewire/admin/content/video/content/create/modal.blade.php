<form wire:submit.prevent="saveContent" method="post" id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
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
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-bold fs-6">Description</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <textarea  wire:model="description" class="form-control form-control-lg form-control-solid"  cols="30" rows="10" placeholder="Description"></textarea>
                <div class="fv-plugins-message-container invalid-feedback">@error('description') {{ $message }} @enderror</div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6">Video</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <select class="form-control form-control-lg form-control-solid" wire:model="video_id_select">
                    <option value="00" selected>Выберите видео</option>
                    <option value="null">Написать другое</option>
                    @foreach($vimeo['body']['data'] as $data)

                    <option value="{{substr($data['link'],18)}}">{{$data['name']}} - {{intval(date("i", mktime(0, 0, intval($data['duration']))))}} min

                    </option>
                    @endforeach
                </select>
                <div class="fv-plugins-message-container invalid-feedback">@error('video_id_select') {{ $message }} @enderror</div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6">If video doesnt exist input id of vimeo video</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <input type="text" class="form-control form-control-lg form-control-solid" wire:model="video_id"  placeholder="Vimeo video id" >
                <div class="fv-plugins-message-container invalid-feedback">@error('video_id') {{ $message }} @enderror</div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-bold fs-6">Material</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <input type="file" wire:model="file" class="form-control form-control-lg form-control-solid" placeholder="file" >
                <div class="fv-plugins-message-container invalid-feedback">@error('file') {{ $message }} @enderror</div>
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
