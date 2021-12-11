

<div class="dropdown account-dropdown dropdown--user custom--dropdown">
    <a class="dropdown-toggle-btn shadow rounded">
        <img src="{{getFile(config('location.user.path').Auth::user()->image)}}" alt="Profile Icon">
    </a>
    <div class="xs-dropdown-menu dropdown-menu dropdown-right drop-l-content m-0 p-0">
        <div class="dropdown-content">
            <a class="dropdown-item" href="{{route('user.transfer-log')}}">
                <div class="media align-items-center">
                    <div class="media-icon profile">
                        <i class="icofont-exchange"></i>
                    </div>
                    <div class="media-body ml-15">
                        <h6 class="font-weight-bold">@lang('Transfer Log')</h6>
                    </div>
                </div>
            </a>
            <a class="dropdown-item" href="{{route('user.transaction')}}">
                <div class="media align-items-center">
                    <div class="media-icon profile">
                        <i class="icofont-history"></i>
                    </div>
                    <div class="media-body ml-15">
                        <h6 class="font-weight-bold">@lang('Transaction')</h6>
                    </div>
                </div>
            </a>

            <a class="dropdown-item" href="{{route('user.fund-history')}}">
                <div class="media align-items-center">
                    <div class="media-icon profile">
                        <i class="icofont-money"></i>
                    </div>
                    <div class="media-body ml-15">
                        <h6 class="font-weight-bold">@lang('Payment Log')</h6>
                    </div>
                </div>
            </a>

            <a class="dropdown-item" href="{{ route('user.profile') }}">
                <div class="media align-items-center">
                    <div class="media-icon profile">
                        <i class="icofont-user"></i>
                    </div>
                    <div class="media-body ml-15">
                        <h6 class="font-weight-bold">@lang('Profile Settings')</h6>
                    </div>
                </div>
            </a>


            <a class="dropdown-item" href="{{ route('user.twostep.security') }}">
                <div class="media align-items-center">
                    <div class="media-icon profile">
                        <i class="icofont-ssl-security"></i>
                    </div>
                    <div class="media-body ml-15">
                        <h6 class="font-weight-bold">@lang('2FA Security')</h6>
                    </div>
                </div>
            </a>

            <a class="dropdown-item" href="{{ route('user.ticket.list') }}">
                <div class="media align-items-center">
                    <div class="media-icon profile">
                        <i class="icofont-support"></i>
                    </div>
                    <div class="media-body ml-15">
                        <h6 class="font-weight-bold">@lang('Support')</h6>
                    </div>
                </div>
            </a>



            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                <div class="media align-items-center">
                    <div class="media-icon profile">
                        <i class="icofont-power"></i>
                    </div>
                    <div class="media-body ml-15">
                        <h6 class="font-weight-bold">{{trans('Logout') }}</h6>
                    </div>
                </div>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>
