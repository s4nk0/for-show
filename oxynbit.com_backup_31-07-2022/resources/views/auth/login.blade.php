<x-app-layout>
    <x-jet-authentication-card>
{{--        <x-slot name="logo">--}}
{{--            <x-jet-authentication-card-logo />--}}
{{--        </x-slot>--}}

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <span>Sign In</span>
            <div class="form-group">
                <x-jet-input id="email" class="login-input" type="email" name="email" placeholder="Email Address" :value="old('email')" required autofocus  />
            </div>

            <div class="form-group">
                <x-jet-input id="password" class="login-input" type="password" name="password" placeholder="Password" required autocomplete="current-password" />
            </div>
            <div class="text-right">
                @if (Route::has('password.request'))
                    <a class="text-primary" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>
            <div class="custom-control custom-checkbox">
                <x-jet-checkbox class="custom-control-input"  id="remember_me" name="remember" />
                <label class="custom-control-label" for="remember_me">{{ __('Remember me') }}</label>
            </div>
            <x-button id="sign_in" type="submit" class="btn btn-primary">Sign In</x-button>
        </form>
        <p class="mt-3 text-center font-weight-bold">Don't have an account? <a class="text-primary" href="{{ route('register') }}">Sign up here</a></p>
    </x-jet-authentication-card>
</x-app-layout>
