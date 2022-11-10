<x-crud-table header="{{$course->title}}">
    <x-slot name="header_button">
        <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="" data-bs-original-title="Click to add a content">
            <a href="#" onclick="Livewire.emit('openModal', 'admin.content.video.content.create.modal',{{json_encode(['course_id'=>$course->id])}})" class="btn btn-sm btn-light btn-active-primary">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                <span class="svg-icon svg-icon-3">
                    														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    															<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black"></rect>
                    															<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
                    														</svg>
                    													</span>
                <!--end::Svg Icon-->New content</a>
        </div>
    </x-slot>

    <thead>
    <tr class="fw-bolder text-muted">
        <th class="w-25px">
            <div class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".widget-9-check" />
            </div>
        </th>
        <th class="min-w-150px">Title</th>
        <th class="min-w-150px">Vimeo video</th>
        <th class="min-w-150px">Duration</th>
        <th class="min-w-140px">Material</th>
        <th class="min-w-120px">Description</th>
        <th class="min-w-120px">Created at</th>
        <th class="min-w-100px text-end">Actions</th>
    </tr>
    </thead>
    <tbody>
    @if($course->course_contents()->count())
        @foreach($course->course_contents()->get() as $content)
            <tr>

                <td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input widget-9-check" type="checkbox" value="1">
                    </div>
                </td>
                <td>{{$content->title}}</td>
                <td>
                    <a href="https://vimeo.com/{{$content->path}}" target="_blank">{{$content->path}}</a>
                </td>
                <td>{{$content->length}} min</td>
                <td>
                    @if($content->material_path)
                    <a href="{{Request::root().'/'.$content->material_path}}" download>Material</a>
                    @endif
                </td>

                <td>
                    @if($content->description)
                    {{$content->description}}
                    @endif
                </td>
                <td>
                    {{$content->created_at}}
                </td>
                <td>
                    <div class="d-flex justify-content-end flex-shrink-0">
                        <a href="#" onclick="Livewire.emit('openModal', 'admin.content.video.content.edit.modal',{{ json_encode(['content_id'=>$content->id]) }})" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                            <span class="svg-icon svg-icon-3">
																				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																					<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
																					<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
																				</svg>
																			</span>
                            <!--end::Svg Icon-->
                        </a>
                        <a href="{{ route('admin.video.courses.content.delete',['content'=>$content]) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
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
</x-crud-table>
