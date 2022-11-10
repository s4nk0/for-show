<x-app-layout>
    <x-auth-card>
{{--        <x-slot name="logo">--}}
{{--            <a href="/">--}}
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--            </a>--}}
{{--        </x-slot>--}}

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('register') }}">
        @csrf
            <span>Create Account</span>
            <!-- User Name -->
            <div class="form-group">
                <x-input id="name" class="login-input" type="text" name="user_name" placeholder="Username" :value="old('user_name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <x-input id="email" class="login-input" type="email" name="email" placeholder="Email Address" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input id="password" class="login-input"
                         type="password"
                         name="password"
                         placeholder="Password"
                         required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <x-input id="password_confirmation" class="login-input"
                         type="password"
                         placeholder="Confirm Password"
                         name="password_confirmation" required />
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input reg-checkbox" id="form-checkbox" name="terms">
                <label class="custom-control-label" for="form-checkbox">I agree to the <a class="text-primary" href="terms">Terms &amp;
                        Conditions</a></label>
            </div>

            <x-button class="btn btn-primary">
                {{ __('Create Account') }}
            </x-button>
        </form>
        <p class="mt-3 text-center font-weight-bold">{{ __('Already have an account?') }} <a class="text-primary" href="{{ route('login') }}">Sign up here</a></p>

    </x-auth-card>
</x-app-layout>
