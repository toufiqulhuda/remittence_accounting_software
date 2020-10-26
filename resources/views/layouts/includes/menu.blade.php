<ul class="navbar-nav">
    <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link active">Home</a></li>
    <li class="nav-item dropdown">
        <a id="houseKeepingDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">House Keeping</a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="houseKeepingDropdown">
            <a class="dropdown-item" href="#">Group Accounts</a>
            <a class="dropdown-item" href="#">Sub Group Accounts</a>
            <a class="dropdown-item" href="#">Chart of Accounts</a>
            <a class="dropdown-item" href="#">Auto Tranx Account</a>
            <a class="dropdown-item" href="#">Branch Info</a>
            <a class="dropdown-item" href="#">Employee Information</a>
            <!-- <div class="dropdown-divider"></div>
            <h6 class="dropdown-header"><b>Dropdown header</b></h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a> -->
        </div>
    </li>
    <li class="nav-item dropdown">
        <a id="securityDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Security </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="securityDropdown">
            <a class="dropdown-item" href="#">Change Password</a>
        </div>
    </li>

    <li class="nav-item dropdown">
        <a id="reportsDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports</a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="reportsDropdown">
            <a class="dropdown-item" href="#">Today's Report</a>
            <a class="dropdown-item" href="#">Reports As on Date</a>
            <a class="dropdown-item" href="#">House Keeping Report</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a id="maintainDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Maintenance</a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="maintainDropdown">
            <a class="dropdown-item" href="#">Reset Password</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a id="settingsDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">Settings</a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="settingsDropdown">
            <a class="dropdown-item" href="{{ url('/users') }}">Users</a>
            <a class="dropdown-item" href="{{ url('/role') }}">Role</a>
            <a class="dropdown-item" href="#">Country</a>
            <a class="dropdown-item" href="#">Currency</a>
        </div>
    </li>
    <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
</ul>
