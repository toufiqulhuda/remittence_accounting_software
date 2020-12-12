<ul class="navbar-nav">
    <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link active"><i class="fas fa-home"></i>&nbsp;Home</a></li>
    <li class="nav-item dropdown">
        <a id="transactionDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Transaction</a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="TransactionDropdown">
            <a class="dropdown-item" href="{{ url('/transaction/account') }}">Account Transaction</a>
            <a class="dropdown-item" href="{{ url('/transaction/reverse') }}">Reverse Transaction</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a id="houseKeepingDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">House Keeping</a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="houseKeepingDropdown">
            <a class="dropdown-item" href="{{ url('/groupAccount') }}">Group Accounts</a>
            <a class="dropdown-item" href="{{ url('/subGroupAccount') }}">Sub Group Accounts</a>
            <a class="dropdown-item" href="{{ url('/chartOfAccount') }}">Chart of Accounts</a>
            <a class="dropdown-item" href="#">Auto Tranx Account</a>
            <a class="dropdown-item" href="#">Branch Info</a>
            <a class="dropdown-item" href="#">Employee Information</a>
            <!-- <div class="dropdown-divider"></div>
            <h6 class="dropdown-header"><b>Dropdown header</b></h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a> -->
        </div>
    </li>
    {{-- <li class="nav-item dropdown">
        <a id="securityDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-shield-alt"></i>&nbsp;Security </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="securityDropdown">
            <a class="dropdown-item" href="#"><i class="fas fa-key"></i>&nbsp;Change Password</a>
        </div>
    </li> --}}

    <li class="nav-item dropdown">
        <a id="reportsDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-file-alt"></i>&nbsp;Reports</a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="reportsDropdown">
        <a class="dropdown-item" href="{{ url('/todaysRpt')}}"><i class="far fa-file-alt"></i>&nbsp;Today's Report</a>
            <a class="dropdown-item" href="{{ url('/rptAsOnDate')}}"><i class="far fa-file-alt"></i>&nbsp;Reports As on Date</a>
            <a class="dropdown-item" href="{{ url('/houseKeepingRpt/pdf') }}"><i class="far fa-file-alt"></i>&nbsp;House Keeping Report</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a id="maintainDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-tools"></i>&nbsp;Maintenance</a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="maintainDropdown">
            <a class="dropdown-item" href="#"><i class="fas fa-key"></i>&nbsp;Reset Password</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a id="settingsDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fas fa-cogs"></i>&nbsp;Settings</a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="settingsDropdown">
            <a class="dropdown-item" href="{{ url('/users') }}"><i class="fas fa-users"></i>&nbsp;Users</a>
            <a class="dropdown-item" href="{{ url('/roles') }}"><i class="fas fa-users-cog"></i>&nbsp;Role</a>
            <a class="dropdown-item" href="{{ url('/countries') }}"><i class="fas fa-flag-usa"></i>&nbsp;Country</a>
            <a class="dropdown-item" href="{{ url('/currencies') }}"><i class="fas fa-dollar-sign"></i>&nbsp;Currency</a>
            <a class="dropdown-item" href="{{ url('/exhouses') }}"><i class="fas fa-store"></i>&nbsp;Exhouse</a>
        </div>
    </li>
    <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#"><i class="fas fa-id-badge"></i>&nbsp;Profile</a>
                <a class="dropdown-item" href="#"><i class="fas fa-key"></i>&nbsp;Change Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>&nbsp;{{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
</ul>
