<p class="page-user-area__notation">{{__('messages.profile.social.title')}}</p>
<div class="d-flex align-items-center flex-wrap justify-content-between">
    <div class="d-flex flex-wrap justify-content-center justify-content-md-start">
        <div class="social-login social-login--facebook mt-3 mt-md-0 mb-sm-0 mr-0 mr-sm-4">
            <div class="social-login__icon">
                <img src="{{ asset('img/facebook-logo.png') }}" alt="Facebook">
            </div>
            <div>
                <span class="d-block social-login__name">Facebook</span>
                <span>{{__('messages.profile.social.text')}}</span>
            </div>
        </div>
        <div class="social-login social-login--google mt-3 mt-md-0">
            <div class="social-login__icon">
                <img src="{{ asset('img/google-logo.png') }}" alt="Google">
            </div>
            <div>
                <span class="d-block social-login__name">Google</span>
                <span>{{__('messages.profile.social.text')}}</span>
            </div>
        </div>
    </div>
    <div class="user-block__edit mx-auto ml-sm-3 mr-sm-0 mt-4 mt-md-0" data-toggle="modal" data-target="#deleteAccount">
        <svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8.97321 13.8125H9.77679C9.88335 13.8125 9.98554 13.7705 10.0609 13.6958C10.1362 13.6211 10.1786 13.5197 10.1786 13.4141V6.24219C10.1786 6.13652 10.1362 6.03517 10.0609 5.96045C9.98554 5.88573 9.88335 5.84375 9.77679 5.84375H8.97321C8.86665 5.84375 8.76446 5.88573 8.68911 5.96045C8.61376 6.03517 8.57143 6.13652 8.57143 6.24219V13.4141C8.57143 13.5197 8.61376 13.6211 8.68911 13.6958C8.76446 13.7705 8.86665 13.8125 8.97321 13.8125ZM14.4643 2.65625H11.705L10.5666 0.773633C10.4238 0.537564 10.2217 0.342222 9.98003 0.206642C9.7384 0.0710621 9.46547 -0.000130933 9.18783 1.80773e-07H5.81216C5.53465 -1.62287e-05 5.26185 0.0712313 5.02035 0.206806C4.77884 0.34238 4.57685 0.53766 4.43404 0.773633L3.29498 2.65625H0.535714C0.393634 2.65625 0.257373 2.71222 0.156907 2.81185C0.0564412 2.91148 0 3.0466 0 3.1875L0 3.71875C0 3.85965 0.0564412 3.99477 0.156907 4.0944C0.257373 4.19403 0.393634 4.25 0.535714 4.25H1.07143V15.4062C1.07143 15.8289 1.24075 16.2343 1.54215 16.5332C1.84355 16.8321 2.25233 17 2.67857 17H12.3214C12.7477 17 13.1565 16.8321 13.4578 16.5332C13.7592 16.2343 13.9286 15.8289 13.9286 15.4062V4.25H14.4643C14.6064 4.25 14.7426 4.19403 14.8431 4.0944C14.9436 3.99477 15 3.85965 15 3.71875V3.1875C15 3.0466 14.9436 2.91148 14.8431 2.81185C14.7426 2.71222 14.6064 2.65625 14.4643 2.65625ZM5.75357 1.69037C5.77148 1.66082 5.79681 1.63638 5.82709 1.61944C5.85737 1.60251 5.89157 1.59365 5.92634 1.59375H9.07366C9.10837 1.59371 9.1425 1.60259 9.17272 1.61952C9.20294 1.63646 9.22822 1.66087 9.24609 1.69037L9.83069 2.65625H5.16931L5.75357 1.69037ZM12.3214 15.4062H2.67857V4.25H12.3214V15.4062ZM5.22321 13.8125H6.02679C6.13335 13.8125 6.23554 13.7705 6.31089 13.6958C6.38624 13.6211 6.42857 13.5197 6.42857 13.4141V6.24219C6.42857 6.13652 6.38624 6.03517 6.31089 5.96045C6.23554 5.88573 6.13335 5.84375 6.02679 5.84375H5.22321C5.11665 5.84375 5.01446 5.88573 4.93911 5.96045C4.86376 6.03517 4.82143 6.13652 4.82143 6.24219V13.4141C4.82143 13.5197 4.86376 13.6211 4.93911 13.6958C5.01446 13.7705 5.11665 13.8125 5.22321 13.8125Z" fill="#E0001A"/>
        </svg>
        <button type="button" class="color--accent bg-transparent border-0 cursor-pointer">{{__('messages.auth.delete.account')}}</button>
        <form id="destroy" action="{{ route('user.destroy',Auth::user()) }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>
