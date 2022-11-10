<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">

        <!-- Name -->
        <div class="form-group col-xl-12">
            <x-jet-label for="name" value="Your Username" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.user_name" readonly/>
            <x-jet-input-error for="state.user_name" class="mt-2" />
        </div>

        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="form-group col-xl-12">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                       wire:model="photo"
                       x-ref="photo"
                       x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />
                <div class="media align-items-center mb-3">
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="! photoPreview">
                        <x-user.profile-photo class="mr-3 rounded-circle mr-0 mr-sm-3" height="50" width="50"/>
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div class="mr-3 rounded-circle mr-0 mr-sm-3" x-show="photoPreview" style="display: none;">
                        <span x-text:photoPreview></span>
                        <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                              x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <div class="media-body">
                        <h5 class="mb-0"><livewire:user.name/></h5>
                        <p class="mb-0">Max file size is 1 mb
                        </p>
                    </div>

                </div>
                <div class="file-upload-wrapper" data-text="Change Photo" x-on:click.prevent="$refs.photo.click()">
                    <input id="profile_photo" accept="image/x-png,image/jpeg"  type="file" class="file-upload-field" >
                </div>

{{--                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">--}}
{{--                    {{ __('Select A New Photo') }}--}}
{{--                </x-jet-secondary-button>--}}

                @if ($this->user->profile_photo_path)
                    <button id="save_img_login" class="btn btn-danger waves-effect px-4 mt-3" wire:click="deleteProfilePhoto">{{ __('Remove Photo') }}</button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
    @endif


    </x-slot>

    <x-slot name="actions">
        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
        <x-jet-action-message class="mx-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>
    </x-slot>
</x-jet-form-section>
