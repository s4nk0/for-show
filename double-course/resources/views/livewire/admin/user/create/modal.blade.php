<form wire:submit.prevent="saveUser" method="post" id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
@csrf
<!--begin::Card body-->
    <div class="card-body border-top p-9">
        <!--begin::Input group-->
        <div class="row mb-0">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-bold fs-6">Active</label>
            <!--begin::Label-->
            <!--begin::Label-->
            <div class="col-lg-8 d-flex align-items-center">
                <div class="form-check form-check-solid form-switch fv-row">
                    <input class="form-check-input w-45px h-30px" wire:model="isActive" type="checkbox" id="allowmarketing" />
                    <label class="form-check-label" for="allowmarketing"></label>
                </div>
            </div>
            <!--begin::Label-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6">Full Name</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <!--begin::Row-->
                <div class="row">
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row fv-plugins-icon-container">
                        <input wire:model="name"  type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name">
                        <div class="fv-plugins-message-container invalid-feedback">@error('name') {{ $message }} @enderror</div>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-lg-6 fv-row fv-plugins-icon-container">
                        <input type="text" wire:model="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" >
                        <div class="fv-plugins-message-container invalid-feedback">@error('last_name') {{ $message }} @enderror</div></div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-bold fs-6">
                <span class="required">Roles</span>
            </label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <div class="fv-plugins-message-container invalid-feedback">@error('roles') {{ $message }} @enderror</div>
                <select wire:model="selected_roles" multiple aria-label="Select a Country" data-control="select2" data-placeholder="Select a country..." class="form-select form-select-solid form-select-lg fw-bold">
                    <option value="">Select a Role...</option>
                    @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->title}}</option>
                    @endforeach
                </select>

            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-bold fs-6">
                <span class="required">Contact Phone</span>
                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Phone number must be active" aria-label="Phone number must be active"></i>
            </label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                <input type="tel" wire:model="phone" class="form-control form-control-lg form-control-solid" placeholder="Phone number" >
                <div class="fv-plugins-message-container invalid-feedback">@error('phone') {{ $message }} @enderror</div></div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-bold fs-6">
                <span>Password</span>
            </label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                <input type="tel" wire:model="password" class="form-control form-control-lg form-control-solid" placeholder="Password" >
                <div class="fv-plugins-message-container invalid-feedback">@error('password') {{ $message }} @enderror</div></div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-bold fs-6">
                <span>Email</span>
            </label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                <input type="tel" wire:model="email" class="form-control form-control-lg form-control-solid" placeholder="Email for login" >
                <div class="fv-plugins-message-container invalid-feedback">@error('email') {{ $message }} @enderror</div></div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-bold fs-6">
                <span>Country</span>
            </label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <select wire:model="city" aria-label="Select a Country" data-control="select2" data-placeholder="Select a country..." class="form-select form-select-solid form-select-lg fw-bold">
                    <option value="">Select a city...</option>
                    @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->title}}</option>
                    @endforeach
                </select>
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
    </div>
    <!--end::Card body-->
    <!--begin::Actions-->
    <div class="card-footer d-flex justify-content-end py-6 px-9">
        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Submit</button>
    </div>
    <!--end::Actions-->
    <input type="hidden"><div></div></form>
<!--end::Form-->
