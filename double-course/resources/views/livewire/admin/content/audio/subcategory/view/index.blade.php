<div class="card h-md-100">
    <!--begin::Header-->
    <div class="card-header align-items-center border-0">
        <!--begin::Title-->
        <h3 class="fw-bolder text-gray-900 m-0">Subcategories</h3>
        <!--end::Title-->
        <a class="btn btn-primary btn-sm px-4" href="#" onclick="Livewire.emit('openModal', 'admin.content.audio.subcategory.create.modal',{{json_encode(['category_id'=>$category->id])}})">New</a>

    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-2">
        <!--begin::Nav-->
        <ul class="nav nav-pills nav-pills-custom mb-3">
        @if($category->subcategories()->count())
            @foreach($category->subcategories()->get() as $subcategory)
                <!--begin::Item-->
                    <li class="nav-item mb-3 me-3 me-lg-6">
                        <!--begin::Link-->
                        <a class="nav-link d-flex justify-content-center flex-column flex-center overflow-hidden @if($category->subcategories()->first()->id == $subcategory->id) active @endif w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_2_tab_{{$subcategory->id}}">
                            <!--begin::Subtitle-->
                            <span class="nav-text text-gray-700 fw-bolder fs-6 lh-1">{{$subcategory->title}}</span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                            <!--end::Bullet-->
                        </a>
                        <!--end::Link-->
                    </li>
            @endforeach
        @endif
        <!--end::Item-->
        </ul>
        <!--end::Nav-->
        <!--begin::Tab Content-->
        <div class="tab-content">
        @if($category->subcategories()->count())
            @foreach($category->subcategories()->get() as $subcategory)

                <!--begin::Tap pane-->
                    <div class="tab-pane fade @if($category->subcategories()->first()->id == $subcategory->id) show active @endif" id="kt_stats_widget_2_tab_{{$subcategory->id}}">
                        <div class="border-top py-6 d-flex">
                            <h1>{{$subcategory->title}}</h1>
                            <a href="#" class="btn btn-sm btn-light btn-active-light-primary mx-6" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-5 m-0">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
															</svg>
														</span>
                                <!--end::Svg Icon--></a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a onclick="Livewire.emit('openModal', 'admin.content.audio.content.create.modal',{{json_encode(['subcategory_id'=>$subcategory->id])}})" href="#" class="menu-link px-3" data-kt-ecommerce-product-filter="delete_row">Add content</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a onclick="Livewire.emit('openModal', 'admin.content.audio.subcategory.edit.modal',{{json_encode(['subcategory_id'=>$subcategory->id])}})" href="#" class="menu-link px-3">Edit</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{route('admin.contents.audio.subcategory.delete',['subcategory'=>$subcategory])}}" class="menu-link px-3" data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </div>

                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                <!--begin::Table head-->
                                <thead>
                                <tr class="fs-7 fw-bolder text-gray-500 border-bottom-0">
                                    <th class="min-w-140px">Content</th>
                                    <th class="pe-0 text-end min-w-120px">Length</th>
                                    <th class="pe-0 text-end min-w-120px">Created</th>
                                    <th class="pe-0 text-end min-w-120px">Actions</th>
                                </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                @foreach($subcategory->contents()->get() as $content)
                                    <tr>
                                        <td class="ps-0">
                                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 fw-bolder text-hover-primary mb-1 fs-6 text-start pe-0"> {{mb_strlen($content->title) > 30 ? mb_substr($content->title, 0, 30) . "..." : $content->title}}</a>
                                            <span class="text-gray-400 fw-bold fs-7 d-block text-start ps-0">@if($content->description) {{mb_strlen($content->description) > 30 ? mb_substr($content->description, 0, 30) . "..." : $content->description}} @endif</span>
                                            <div class="my-3">
                                                <audio
                                                    controls
                                                    src="{{Request::root()}}/{{$content->path}}">
                                                    <source src="{{Request::root()}}/{{$content->path}}" type="audio/mp3">
                                                    <a src="../{{$content->path}}">
                                                        Download audio
                                                    </a>
                                                </audio>
                                            </div>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span class="text-gray-800 fw-bolder d-block fs-6">{{$content->length}} min</span>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span class="text-gray-800 fw-bolder d-block fs-6">{{$content->created_at}}</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{route('admin.contents.audio.content.delete',$content)}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
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
                                            <a href="#" onclick="Livewire.emit('openModal', 'admin.content.audio.content.edit.modal',{{json_encode(['content_id'=>$content->id])}})" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                <span class="svg-icon svg-icon-3">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
																					<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
																				</svg>
																			</span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <!--end::Table body-->
                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Tap pane-->
            @endforeach
        @endif
        <!--end::Tap pane-->
        </div>
        <!--end::Tab Content-->
    </div>
    <!--end: Card Body-->
</div>
