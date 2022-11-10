<x-admin-layout>
    <div class="row">
        <div class="col">
            <x-crud-table header="Users">
                <x-slot name="header_button">
                            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add a user">
                                <a href="#" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                    <span class="svg-icon svg-icon-3">
                    														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    															<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black"></rect>
                    															<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
                    														</svg>
                    													</span>
                                    <!--end::Svg Icon-->New Member</a>
                            </div>
                </x-slot>

                <thead>
                <tr class="fw-bolder text-muted">
                    <th class="w-25px">
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".widget-9-check" />
                        </div>
                    </th>
                    <th class="min-w-150px">User</th>
                    <th class="min-w-140px">Status</th>
                    <th class="min-w-120px">Progress</th>
                    <th class="min-w-100px text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                @isset($users)
                    @foreach($users as $user)
                <tr>
                    <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input widget-9-check" type="checkbox" value="1">
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-45px me-5">
                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->full_name }}" >
                            </div>
                            <div class="d-flex justify-content-start flex-column">
                                <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ $user->full_name }}</a>
                                <span class="text-muted fw-bold text-muted d-block fs-7">+{{ $user->phone }}</span>
                            </div>
                        </div>
                    </td>

                    <td>
                        @if($user->isActive)
                            <span class="badge badge-light-success">Активный</span>
                        @else
                            <span class="badge badge-light-danger">Не активный</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="d-flex flex-column w-100 me-2">
                            <div class="d-flex flex-stack mb-2">
                                <span class="text-muted me-2 fs-7 fw-bold">50%</span>
                            </div>
                            <div class="progress h-6px w-100">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                <span class="svg-icon svg-icon-3">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black"></path>
																					<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black"></path>
																				</svg>
																			</span>
                                <!--end::Svg Icon-->
                            </a>
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <span class="svg-icon svg-icon-3">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
																					<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
																				</svg>
																			</span>
                                <!--end::Svg Icon-->
                            </a>
                            <a href="{{route('admin.users.delete',['user'=>$user])}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                <span class="svg-icon svg-icon-3">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
																					<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
																					<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
																				</svg>
																			</span>
                                <!--end::Svg Icon-->
                            </a>
                        </div>
                    </td>
                </tr>
                    @endforeach
                @else
                    <tr class="fw-bolder text-muted">
                        <th></th>
                        <th></th>
                        <th>No data</th>
                        <th></th>
                        <th></th>
                    </tr>
                @endif
                </tbody>

                <!--begin::Modal - Invite Friends-->
                <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header pb-0 border-0 justify-content-end">
                                <!--begin::Close-->
                                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg")}}-->
                                    <span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
								</svg>
							</span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--begin::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                                <!--begin::Heading-->
                                <div class="text-center mb-13">
                                    <!--begin::Title-->
                                    <h1 class="mb-3">Invite a Friend</h1>
                                    <!--end::Title-->
                                    <!--begin::Description-->
                                    <div class="text-muted fw-bold fs-5">If you need more info, please check out
                                        <a href="#" class="link-primary fw-bolder">FAQ Page</a>.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Google Contacts Invite-->
                                <div class="btn btn-light-primary fw-bolder w-100 mb-8">
                                    <img alt="Logo" src="{{asset("adminAssets/assets/media/svg/brand-logos/google-icon.svg")}}" class="h-20px me-3" />Invite Gmail Contacts</div>
                                <!--end::Google Contacts Invite-->
                                <!--begin::Separator-->
                                <div class="separator d-flex flex-center mb-8">
                                    <span class="text-uppercase bg-body fs-7 fw-bold text-muted px-3">or</span>
                                </div>
                                <!--end::Separator-->
                                <!--begin::Textarea-->
                                <textarea class="form-control form-control-solid mb-8" rows="3" placeholder="Type or paste emails here"></textarea>
                                <!--end::Textarea-->
                                <!--begin::Users-->
                                <div class="mb-10">
                                    <!--begin::Heading-->
                                    <div class="fs-6 fw-bold mb-2">Your Invitations</div>
                                    <!--end::Heading-->
                                    <!--begin::List-->
                                    <div class="mh-300px scroll-y me-n7 pe-7">
                                        <!--begin::User-->
                                        <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="{{asset("adminAssets/assets/media/avatars/300-6.jpg")}}" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Emma Smith</a>
                                                    <div class="fw-bold text-muted">e.smith@kpmg.com.au</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Access menu-->
                                            <div class="ms-2 w-100px">
                                                <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                                    <option value="1">Guest</option>
                                                    <option value="2" selected="selected">Owner</option>
                                                    <option value="3">Can Edit</option>
                                                </select>
                                            </div>
                                            <!--end::Access menu-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::User-->
                                        <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <span class="symbol-label bg-light-danger text-danger fw-bold">M</span>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Melody Macy</a>
                                                    <div class="fw-bold text-muted">melody@altbox.com</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Access menu-->
                                            <div class="ms-2 w-100px">
                                                <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                                    <option value="1" selected="selected">Guest</option>
                                                    <option value="2">Owner</option>
                                                    <option value="3">Can Edit</option>
                                                </select>
                                            </div>
                                            <!--end::Access menu-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::User-->
                                        <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="{{asset("adminAssets/assets/media/avatars/300-1.jpg")}}" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Max Smith</a>
                                                    <div class="fw-bold text-muted">max@kt.com</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Access menu-->
                                            <div class="ms-2 w-100px">
                                                <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                                    <option value="1">Guest</option>
                                                    <option value="2">Owner</option>
                                                    <option value="3" selected="selected">Can Edit</option>
                                                </select>
                                            </div>
                                            <!--end::Access menu-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::User-->
                                        <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="{{asset("adminAssets/assets/media/avatars/300-5.jpg")}}" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Sean Bean</a>
                                                    <div class="fw-bold text-muted">sean@dellito.com</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Access menu-->
                                            <div class="ms-2 w-100px">
                                                <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                                    <option value="1">Guest</option>
                                                    <option value="2" selected="selected">Owner</option>
                                                    <option value="3">Can Edit</option>
                                                </select>
                                            </div>
                                            <!--end::Access menu-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::User-->
                                        <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="{{asset("adminAssets/assets/media/avatars/300-25.jpg")}}" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Brian Cox</a>
                                                    <div class="fw-bold text-muted">brian@exchange.com</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Access menu-->
                                            <div class="ms-2 w-100px">
                                                <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                                    <option value="1">Guest</option>
                                                    <option value="2">Owner</option>
                                                    <option value="3" selected="selected">Can Edit</option>
                                                </select>
                                            </div>
                                            <!--end::Access menu-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::User-->
                                        <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <span class="symbol-label bg-light-warning text-warning fw-bold">C</span>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Mikaela Collins</a>
                                                    <div class="fw-bold text-muted">mikaela@pexcom.com</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Access menu-->
                                            <div class="ms-2 w-100px">
                                                <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                                    <option value="1">Guest</option>
                                                    <option value="2" selected="selected">Owner</option>
                                                    <option value="3">Can Edit</option>
                                                </select>
                                            </div>
                                            <!--end::Access menu-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::User-->
                                        <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="{{asset("adminAssets/assets/media/avatars/300-9.jpg")}}" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Francis Mitcham</a>
                                                    <div class="fw-bold text-muted">f.mitcham@kpmg.com.au</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Access menu-->
                                            <div class="ms-2 w-100px">
                                                <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                                    <option value="1">Guest</option>
                                                    <option value="2">Owner</option>
                                                    <option value="3" selected="selected">Can Edit</option>
                                                </select>
                                            </div>
                                            <!--end::Access menu-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::User-->
                                        <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <span class="symbol-label bg-light-danger text-danger fw-bold">O</span>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Olivia Wild</a>
                                                    <div class="fw-bold text-muted">olivia@corpmail.com</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Access menu-->
                                            <div class="ms-2 w-100px">
                                                <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                                    <option value="1">Guest</option>
                                                    <option value="2" selected="selected">Owner</option>
                                                    <option value="3">Can Edit</option>
                                                </select>
                                            </div>
                                            <!--end::Access menu-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::User-->
                                        <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <span class="symbol-label bg-light-primary text-primary fw-bold">N</span>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Neil Owen</a>
                                                    <div class="fw-bold text-muted">owen.neil@gmail.com</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Access menu-->
                                            <div class="ms-2 w-100px">
                                                <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                                    <option value="1" selected="selected">Guest</option>
                                                    <option value="2">Owner</option>
                                                    <option value="3">Can Edit</option>
                                                </select>
                                            </div>
                                            <!--end::Access menu-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::User-->
                                        <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="{{asset("adminAssets/assets/media/avatars/300-23.jpg")}}" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Dan Wilson</a>
                                                    <div class="fw-bold text-muted">dam@consilting.com</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Access menu-->
                                            <div class="ms-2 w-100px">
                                                <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                                    <option value="1">Guest</option>
                                                    <option value="2">Owner</option>
                                                    <option value="3" selected="selected">Can Edit</option>
                                                </select>
                                            </div>
                                            <!--end::Access menu-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::User-->
                                        <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <span class="symbol-label bg-light-danger text-danger fw-bold">E</span>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Emma Bold</a>
                                                    <div class="fw-bold text-muted">emma@intenso.com</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Access menu-->
                                            <div class="ms-2 w-100px">
                                                <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                                    <option value="1">Guest</option>
                                                    <option value="2" selected="selected">Owner</option>
                                                    <option value="3">Can Edit</option>
                                                </select>
                                            </div>
                                            <!--end::Access menu-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::User-->
                                        <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="{{asset("adminAssets/assets/media/avatars/300-12.jpg")}}" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Ana Crown</a>
                                                    <div class="fw-bold text-muted">ana.cf@limtel.com</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Access menu-->
                                            <div class="ms-2 w-100px">
                                                <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                                    <option value="1" selected="selected">Guest</option>
                                                    <option value="2">Owner</option>
                                                    <option value="3">Can Edit</option>
                                                </select>
                                            </div>
                                            <!--end::Access menu-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::User-->
                                        <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <span class="symbol-label bg-light-info text-info fw-bold">A</span>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Robert Doe</a>
                                                    <div class="fw-bold text-muted">robert@benko.com</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Access menu-->
                                            <div class="ms-2 w-100px">
                                                <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                                    <option value="1">Guest</option>
                                                    <option value="2">Owner</option>
                                                    <option value="3" selected="selected">Can Edit</option>
                                                </select>
                                            </div>
                                            <!--end::Access menu-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::User-->
                                        <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="{{asset("adminAssets/assets/media/avatars/300-13.jpg")}}" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">John Miller</a>
                                                    <div class="fw-bold text-muted">miller@mapple.com</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Access menu-->
                                            <div class="ms-2 w-100px">
                                                <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                                    <option value="1">Guest</option>
                                                    <option value="2">Owner</option>
                                                    <option value="3" selected="selected">Can Edit</option>
                                                </select>
                                            </div>
                                            <!--end::Access menu-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::User-->
                                        <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <span class="symbol-label bg-light-success text-success fw-bold">L</span>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Lucy Kunic</a>
                                                    <div class="fw-bold text-muted">lucy.m@fentech.com</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Access menu-->
                                            <div class="ms-2 w-100px">
                                                <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                                    <option value="1">Guest</option>
                                                    <option value="2" selected="selected">Owner</option>
                                                    <option value="3">Can Edit</option>
                                                </select>
                                            </div>
                                            <!--end::Access menu-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::User-->
                                        <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="{{asset("adminAssets/assets/media/avatars/300-21.jpg")}}" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Ethan Wilder</a>
                                                    <div class="fw-bold text-muted">ethan@loop.com.au</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Access menu-->
                                            <div class="ms-2 w-100px">
                                                <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                                    <option value="1" selected="selected">Guest</option>
                                                    <option value="2">Owner</option>
                                                    <option value="3">Can Edit</option>
                                                </select>
                                            </div>
                                            <!--end::Access menu-->
                                        </div>
                                        <!--end::User-->
                                        <!--begin::User-->
                                        <div class="d-flex flex-stack py-4">
                                            <!--begin::Details-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="{{asset("adminAssets/assets/media/avatars/300-21.jpg")}}" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-5">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Ethan Wilder</a>
                                                    <div class="fw-bold text-muted">ethan@loop.com.au</div>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::Details-->
                                            <!--begin::Access menu-->
                                            <div class="ms-2 w-100px">
                                                <select class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true">
                                                    <option value="1">Guest</option>
                                                    <option value="2">Owner</option>
                                                    <option value="3" selected="selected">Can Edit</option>
                                                </select>
                                            </div>
                                            <!--end::Access menu-->
                                        </div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::List-->
                                </div>
                                <!--end::Users-->
                                <!--begin::Notice-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Label-->
                                    <div class="me-5 fw-bold">
                                        <label class="fs-6">Adding Users by Team Members</label>
                                        <div class="fs-7 text-muted">If you need more info, please check budget planning</div>
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Switch-->
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" checked="checked" />
                                        <span class="form-check-label fw-bold text-muted">Allowed</span>
                                    </label>
                                    <!--end::Switch-->
                                </div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>
                <!--end::Modal - Invite Friend-->
            </x-crud-table>
        </div>
    </div>
</x-admin-layout>
