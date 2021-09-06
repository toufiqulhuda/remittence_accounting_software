<div class="container" style="margin-top: 5px">
    <div class="card" style="background-color:#f7fafd">

        <div class="row">
            <div class="col-md-12">
                <img src="{{asset('assets/img/banner.jpeg')}}" style="width: 100%;
                /* margin: 5px;float: left;*/"/>
                <div style="color: #000065;
                font-weight: bolder;
                font-size: 540%;
                text-align: center;
                letter-spacing: 0px;font-family: Microsoft YaHei;line-height: 122px;"></div>
            </div>
        </div>
    </div>
</div>
<div class="container">

<div class="navbar-area">
    <div class="luvion-responsive-nav">
        <div class="container">
            <div class="luvion-responsive-menu">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                        {{-- <img src="{{asset('assets/img/logo.png')}}" alt="logo"> --}}
                        {{-- <img src="{{asset('assets/img/black-logo.png')}}" alt="logo"> --}}
                    </a>
                </div>
            </div>
        </div>
    </div>
    @php
    $isSameData = DB::select("select count(ex.ExHouseID) as samedate from exhouse as ex where ex.PrevDate < ex.TnxDate and ex.ExHouseID='".Auth::user()->ExHouseID."'");
    //dd($isSameData[0]->samedate)
    @endphp
    @if ($isSameData[0]->samedate > 0)
    <div class="luvion-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- <img src="{{asset('assets/img/logo.png')}}" alt=logo> --}}
                    {{-- <img src="{{asset('assets/img/black-logo.png')}}" alt="logo"> --}}
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">

                    @include('layouts.includes.menu')
                </div>
            </nav>
        </div>
    </div>
    @else
        <script>window.location = "/startDay";</script>
    @endif
</div>
</div>

