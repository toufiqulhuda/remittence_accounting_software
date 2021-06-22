
<ul class="navbar-nav">
    @foreach(App\Models\Menu::where('roleid',Auth::user()->roleid)->orderBy('order','asc')->get() as $menuItem)
    @if( $menuItem->parent_id == 0 )

    <li class="nav-item ">
        <a id="{{ $menuItem->title }}Dropdown" class="nav-link {{ ($menuItem->title=='Home') ? 'active' : ''}} {{ $menuItem->children->isEmpty() ? '' : 'dropdown-toggle'}}" href="{{ $menuItem->children->isEmpty() ? $menuItem->url : "#" }}" {{ $menuItem->children->isEmpty() ? '' : 'role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"'}}><i class="{{$menuItem->icon}}"></i>&nbsp;{{ $menuItem->title }}</a>
    @endif
    @if( ! $menuItem->children->isEmpty() )
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="{{ $menuItem->title }}Dropdown">
            @foreach($menuItem->children as $subMenuItem)
            <a class="dropdown-item" href="{{ $subMenuItem->url }}"><i class="{{$subMenuItem->icon}}"></i>&nbsp;{{ $subMenuItem->title }}</a>
            @endforeach
        </div>
    @endif
    </li>
    @endforeach
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{route('user-profile')}}"><i class="fas fa-id-badge"></i>&nbsp;Profile</a>
            <a class="dropdown-item" href="{{route('user-changePass')}}"><i class="fas fa-key"></i>&nbsp;Change Password</a>
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
    @php
        $TnxDate = App\Models\Exhouse::select('TnxDate')->where('ExHouseID',Auth::user()->ExHouseID)->first();
    @endphp
    <li class="nav-item ">
        <a  class="nav-link active" href="#"><i class=""></i>&nbsp;{{ 'Transaction Date: '.date_format(date_create($TnxDate->TnxDate),"d/m/Y")}}</a>
    </li>
</ul>


