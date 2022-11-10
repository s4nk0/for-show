<form wire:submit.prevent="editContent" method="post" id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
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
            <label class="col-lg-4 col-form-label fw-bold fs-6">
                <span>Description</span>
            </label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                <textarea class="form-control form-control-lg form-control-solid" wire:model="description" id="" cols="20" rows="5"  placeholder="Description"></textarea>

                <div class="fv-plugins-message-container invalid-feedback">@error('description') {{ $message }} @enderror</div></div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-bold fs-6">
                <span>Audio</span>
            </label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                @if ($file)
                    Audio Preview:
                    <audio
                        controls
                        src="{{$file->temporaryUrl() }}">
                        <source src="{{ $file->temporaryUrl() }}" type="audio/mp3">
                        <a href="{{ $file->temporaryUrl() }}">
                            Download audio
                        </a>
                    </audio>
                @else
                    Audio Preview:
                    <audio
                        controls
                        src="{{Request::root().'/'. $content->path }}">
                        <source src="{{Request::root().'/'. $content->path }}" type="audio/mp3">
                        <a href="{{ Request::root().'/'.$content->path }}">
                            Download audio
                        </a>
                    </audio>
                @endif
                <input type="file" class="form-control form-control-lg form-control-solid" wire:model="file" />
                <div class="fv-plugins-message-container invalid-feedback">@error('file') {{ $message }} @enderror</div></div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->


        <!--end::Input group-->
    @isset($affirmation_texts)
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-bold fs-6">
                <span class="d-flex justify-content-between align-items-center">Texts <span><a href="#" class="btn btn-danger mx-5" wire:click="decrease_text">-</a><a href="#" class="btn btn-primary" wire:click="add_text">+</a></span></span>
            </label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                    @foreach ($affirmation_texts as $index => $affirmation_text)
                        <div class="my-5 border-top">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span>Text</span>
                            </label>
                            <input type="text" class="form-control form-control-lg form-control-solid" wire:model="affirmation_texts.{{ $index }}.text">

                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span>Delay in seconds</span>
                            </label>
                            <input type="text" class="form-control form-control-lg form-control-solid" wire:model="affirmation_texts.{{ $index }}.delay">
                        </div>
                    @endforeach

                <div class="fv-plugins-message-container invalid-feedback">@error('affirmation_text') {{ $message }} @enderror</div></div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        @endisset
    </div>
    <!--end::Card body-->
    <!--begin::Actions-->
    <div class="card-footer d-flex justify-content-end py-6 px-9">
        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Submit</button>
    </div>
    <!--end::Actions-->
    <input type="hidden"><div></div></form>
