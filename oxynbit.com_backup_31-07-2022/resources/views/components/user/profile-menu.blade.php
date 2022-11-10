@if( Auth::check() && (\Illuminate\Support\Facades\Request::is('user/profile/*') || \Illuminate\Support\Facades\Request::routeIs('profile.show')))
<!-- Profile menu -->
<div class="col-xl-12">
    <div class="card sub-menu">
        <div class="card-body">
            <ul class="d-flex">
                <li class="nav-item">
                    <a href="{{ route('user.wallet') }}" class="nav-link {{ Request::routeIs('user.wallet') ? 'active' : '' }}">
                        <i class="mdi mdi-bullseye"></i>
                        <span>Overview</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.deposit') }}" class="nav-link {{ Request::routeIs('user.deposit') ? 'active' : '' }}">
                        <i class="mdi mdi-database"></i>
                        <span>Deposit</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.withdraw') }}" class="nav-link {{ Request::routeIs('user.withdraw') ? 'active' : '' }}">
                        <i class="mdi mdi-transfer"></i>
                        <span>Withdraw</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user.transfer') }}" class="nav-link {{ Request::routeIs('user.transfer') ? 'active' : '' }}">
                        <i class="mdi mdi-reply"></i>
                        <span>Transfer</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user.invest') }}" class="nav-link {{ Request::routeIs('user.invest') ? 'active' : '' }}">
                        <i class="mdi mdi-cash-usd"></i>
                        <span>Invest</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user.affiliate') }}" class="nav-link {{ Request::routeIs('user.affiliate') ? 'active' : '' }}">
                        <i class="mdi mdi-diamond"></i>
                        <span>Affiliate</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user.api') }}" class="nav-link {{ Request::routeIs('user.api') ? 'active' : '' }}">
                        <i class="mdi mdi-key"></i>
                        <span>API</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('profile.show') }}" class="nav-link {{ Request::routeIs('profile.show') ? 'active' : '' }}">
                        <i class="mdi mdi-settings"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Profile menu end -->
@endif
