@if( Auth::check() && (\Illuminate\Support\Facades\Request::is('user/profile/*') || \Illuminate\Support\Facades\Request::routeIs('profile.show')))
<div class="page-title dashboard content-body">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="page-title-content">
                        <p>{{ $slot }}
                            <span> {{ Auth::user()->name }}</span>
                        </p>
            </div>
        </div>
    </div>
</div>
</div>
@endif
