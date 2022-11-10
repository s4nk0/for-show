<x-jet-form-section submit="personalInformationForm">
    <x-slot name="title">
        {{ __('Personal Information') }}
    </x-slot>

    <x-slot name="form">
        <div class="form-group col-xl-6 col-md-6">
            <x-jet-label for="name" value="{{ __('Your Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="user.name" autocomplete="new-name"  />
            <x-jet-input-error for="user.name" class="mt-2" />
        </div>

        <div class="form-group col-xl-6 col-md-6">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input type="email"  wire:model="user.email"/>
                <x-jet-input-error for="user.email" class="mt-2" />
                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                    <p class="text-sm mt-2">
                        {{ __('Your email address is unverified.') }}

                        <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900" wire:click.prevent="sendEmailVerification">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if ($this->verificationLinkSent)
                        <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                @endif
        </div>

        <div class="form-group col-xl-6 col-md-6">
            <x-jet-label for="birth" value="{{ __('Date of birth') }}" />
            <x-jet-input id="birth" type="date" class="mt-1 block w-full" wire:model="user.date_of_birth"  autocomplete="date_of_birth" />
            <x-jet-input-error for="user.date_of_birth" class="mt-2" />
        </div>

        <div class="form-group col-xl-6 col-md-6">
            <x-jet-label for="address" value="{{ __('Present Address') }}" />
            <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model="user.present_address" autocomplete="present_address" />
            <x-jet-input-error for="user.present_address" class="mt-2" />
        </div>

        <div class="form-group col-xl-6 col-md-6">
            <x-jet-label for="paddress" value="{{ __('Permanent Address') }}" />
            <x-jet-input id="paddress" type="text" class="mt-1 block w-full" wire:model="user.permanent_address" autocomplete="permanent_address" />
            <x-jet-input-error for="user.permanent_address" class="mt-2" />
        </div>

        <div class="form-group col-xl-6 col-md-6">
            <x-jet-label for="city" value="{{ __('City') }}" />
            <x-jet-input id="city" type="text" class="mt-1 block w-full" wire:model="user.city" autocomplete="city" />
            <x-jet-input-error for="user.city" class="mt-2" />
        </div>

        <div class="form-group col-xl-6 col-md-6">
            <x-jet-label for="pcode" value="{{ __('Postal Code') }}" />
            <x-jet-input id="pcode" type="number" class="mt-1 block w-full" wire:model="user.postal_code" autocomplete="postal_code" />
            <x-jet-input-error for="user.postal_code" class="mt-2" />
        </div>

        <div class="form-group col-xl-6 col-md-6">
            <x-jet-label for="country" value="{{ __('Country') }}" />
            <x-jet-input id="country" type="text" class="mt-1 block w-full" wire:model="user.country" autocomplete="country" />
            <x-jet-input-error for="user.country" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-button  wire:loading.attr="disabled" wire:target="user">
            {{ __('Save') }}
        </x-jet-button>
        <x-jet-action-message class="mx-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>
    </x-slot>
</x-jet-form-section>
