<div class="images-wrap">
    @if(isset($data) and $data->$name != null and count($data->$name) > 0)
        @foreach($data->$name as $image)
            <div class="image-upload-wrap">
                <div class="image-upload">
                    <div class="image-upload__preview" data-default-image="{{ asset('/img/noimg.jpg') }}" style="background-image: url({{ "/storage/".$image ?? asset('/img/noimg.jpg') }})"></div>
                    <input type="hidden" name="{{ $name }}" value="{{ $image }}">
                    <ul class="image-upload__actions">
                        <li class="image-upload__action image-upload__action--load">
                            <label>
                                <svg width="21" height="25" viewBox="0 0 21 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.98606 6.98194L9.44853 3.54907V18.7546C9.44853 19.33 9.91959 19.7971 10.5 19.7971C11.0804 19.7971 11.5515 19.33 11.5515 18.7546V3.54907L15.0139 6.98194C15.219 7.18574 15.4881 7.28738 15.7573 7.28738C16.0265 7.28738 16.2957 7.18574 16.5007 6.98194C16.9113 6.57485 16.9113 5.91497 16.5007 5.50788L11.2434 0.295514C10.8333 -0.111571 10.1667 -0.111571 9.75661 0.295514L4.49929 5.50788C4.0887 5.91497 4.0887 6.57485 4.49929 6.98194C4.90936 7.38902 5.57599 7.38902 5.98606 6.98194Z" fill="white"/>
                                    <path d="M19.9632 16.6699C19.3827 16.6699 18.9117 17.1369 18.9117 17.7124V21.8823C18.9117 22.4572 18.4401 22.9247 17.8602 22.9247H3.13974C2.55986 22.9247 2.08828 22.4572 2.08828 21.8823V17.7124C2.08828 17.1369 1.61722 16.6699 1.03681 16.6699C0.456407 16.6699 -0.0146484 17.1369 -0.0146484 17.7124V21.8823C-0.0146484 23.607 1.4001 25.0097 3.13974 25.0097H17.8602C19.5999 25.0097 21.0146 23.607 21.0146 21.8823V17.7124C21.0146 17.1369 20.5436 16.6699 19.9632 16.6699Z" fill="white"/>
                                </svg>
                                <input
                                    type="file"
                                    class="image-upload__upload img"
                                    value="Загрузить фото"
                                    accept=".png, .jpg, .jpeg, .webp">
                            </label>
                        </li>
                        <li class="image-upload__action image-upload__action--clear">
                            <svg width="29" height="25" viewBox="0 0 29 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M28.1504 23.2497H18.8379L27.8358 14.0983C28.5861 13.3353 28.9993 12.3209 28.9993 11.2419C28.9993 10.163 28.5861 9.14851 27.8358 8.38549L20.7742 1.20381C19.2255 -0.371247 16.7056 -0.371247 15.1569 1.20381L1.16351 15.4352C0.413193 16.1982 0 17.2126 0 18.2917C0 19.3706 0.413193 20.385 1.16351 21.1481L4.68044 24.7248C4.83977 24.8868 5.05586 24.9779 5.28117 24.9779H28.1504C28.6196 24.9779 29 24.591 29 24.1138C29 23.6366 28.6196 23.2497 28.1504 23.2497ZM13.3633 5.47178L15.5993 7.7458L8.74673 14.715L6.51073 12.441L13.3633 5.47178ZM20.2017 12.4265L13.3491 19.3956L9.94819 15.9369L16.8008 8.96775L20.2017 12.4265ZM21.4032 13.6484L23.6392 15.9225L21.3471 18.2538L16.7867 22.8916L14.5506 20.6175L21.4032 13.6484ZM16.3584 2.42576C17.2446 1.52455 18.6865 1.52455 19.5727 2.42576L26.6343 9.60744C27.5205 10.5087 27.5205 11.9752 26.6343 12.8764L24.8408 14.7005L14.5648 4.24984L16.3584 2.42576ZM2.36497 19.9261C1.93564 19.4895 1.69922 18.9089 1.69922 18.2917C1.69922 17.6743 1.93564 17.0938 2.36492 16.6572L5.30915 13.6629L8.14583 16.5478L8.14588 16.5479L12.7482 21.2285C12.7484 21.2287 12.7486 21.2288 12.7487 21.229L14.7357 23.2497H5.63308L2.36497 19.9261Z" fill="white"/>
                            </svg>
                        </li>
                    </ul>
                </div>
            </div>
        @endforeach
    @else
        @isset($label)
            <label>{{ $label }}</label>
        @endisset
        <div class="image-upload-wrap">
            <div class="image-upload">
                <div class="image-upload__preview" data-default-image="{{ asset('/img/noimg.jpg') }}" style="background-image: url({{ asset('/img/noimg.jpg') }})"></div>
                <input type="hidden"
                       name="@isset($name){{ $name }}@else images[] @endisset" value="">
                <ul class="image-upload__actions">
                    <li class="image-upload__action image-upload__action--load">
                        <label>
                            <svg width="21" height="25" viewBox="0 0 21 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.98606 6.98194L9.44853 3.54907V18.7546C9.44853 19.33 9.91959 19.7971 10.5 19.7971C11.0804 19.7971 11.5515 19.33 11.5515 18.7546V3.54907L15.0139 6.98194C15.219 7.18574 15.4881 7.28738 15.7573 7.28738C16.0265 7.28738 16.2957 7.18574 16.5007 6.98194C16.9113 6.57485 16.9113 5.91497 16.5007 5.50788L11.2434 0.295514C10.8333 -0.111571 10.1667 -0.111571 9.75661 0.295514L4.49929 5.50788C4.0887 5.91497 4.0887 6.57485 4.49929 6.98194C4.90936 7.38902 5.57599 7.38902 5.98606 6.98194Z" fill="white"/>
                                <path d="M19.9632 16.6699C19.3827 16.6699 18.9117 17.1369 18.9117 17.7124V21.8823C18.9117 22.4572 18.4401 22.9247 17.8602 22.9247H3.13974C2.55986 22.9247 2.08828 22.4572 2.08828 21.8823V17.7124C2.08828 17.1369 1.61722 16.6699 1.03681 16.6699C0.456407 16.6699 -0.0146484 17.1369 -0.0146484 17.7124V21.8823C-0.0146484 23.607 1.4001 25.0097 3.13974 25.0097H17.8602C19.5999 25.0097 21.0146 23.607 21.0146 21.8823V17.7124C21.0146 17.1369 20.5436 16.6699 19.9632 16.6699Z" fill="white"/>
                            </svg>
                            <input
                                type="file"
                                class="image-upload__upload img"
                                value="Загрузить фото"
                                accept=".png, .jpg, .jpeg, .webp"
                                @isset($aspectRatioX)
                                data-aspect-ratio-x="{{ $aspectRatioX }}"
                                @endisset
                                @isset($aspectRatioY)
                                data-aspect-ratio-y="{{ $aspectRatioY }}"
                                @endisset>
                        </label>
                    </li>
                    <li class="image-upload__action image-upload__action--clear">
                        <svg width="29" height="25" viewBox="0 0 29 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M28.1504 23.2497H18.8379L27.8358 14.0983C28.5861 13.3353 28.9993 12.3209 28.9993 11.2419C28.9993 10.163 28.5861 9.14851 27.8358 8.38549L20.7742 1.20381C19.2255 -0.371247 16.7056 -0.371247 15.1569 1.20381L1.16351 15.4352C0.413193 16.1982 0 17.2126 0 18.2917C0 19.3706 0.413193 20.385 1.16351 21.1481L4.68044 24.7248C4.83977 24.8868 5.05586 24.9779 5.28117 24.9779H28.1504C28.6196 24.9779 29 24.591 29 24.1138C29 23.6366 28.6196 23.2497 28.1504 23.2497ZM13.3633 5.47178L15.5993 7.7458L8.74673 14.715L6.51073 12.441L13.3633 5.47178ZM20.2017 12.4265L13.3491 19.3956L9.94819 15.9369L16.8008 8.96775L20.2017 12.4265ZM21.4032 13.6484L23.6392 15.9225L21.3471 18.2538L16.7867 22.8916L14.5506 20.6175L21.4032 13.6484ZM16.3584 2.42576C17.2446 1.52455 18.6865 1.52455 19.5727 2.42576L26.6343 9.60744C27.5205 10.5087 27.5205 11.9752 26.6343 12.8764L24.8408 14.7005L14.5648 4.24984L16.3584 2.42576ZM2.36497 19.9261C1.93564 19.4895 1.69922 18.9089 1.69922 18.2917C1.69922 17.6743 1.93564 17.0938 2.36492 16.6572L5.30915 13.6629L8.14583 16.5478L8.14588 16.5479L12.7482 21.2285C12.7484 21.2287 12.7486 21.2288 12.7487 21.229L14.7357 23.2497H5.63308L2.36497 19.9261Z" fill="white"/>
                        </svg>
                    </li>
                </ul>
            </div>
        </div>
    @endif
</div>
