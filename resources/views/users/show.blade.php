@extends('layouts.withHF')

@section('content')
<style rel="stylesheet">
    .layout-sidebar-large .sidebar-left .navigation-left .nav-item .nav-item-hold .nav-text {
    font-size: 13px;
    display: block;
    font-weight: 400;
}
.layout-sidebar-large .sidebar-left-secondary,
.layout-sidebar-large .sidebar-left {
    position: fixed;
    top: 80px;
    height: calc(100vh - 80px);
    background: #fff;
    box-shadow: 0 4px 20px 1px rgba(0, 0, 0, 0.06), 0 1px 4px rgba(0, 0, 0, 0.08); }

.layout-sidebar-large .sidebar-left {
    left: calc(-120px - 20px);
    z-index: 90;
    transition: all .24s ease-in-out; }
.layout-sidebar-large .sidebar-left.open {
    left: 0; }

.layout-sidebar-large .sidebar-left .navigation-left {
    list-style: none;
    text-align: center;
    width: 120px;
    height: 100%;
    margin: 0;
    padding: 0; }
.layout-sidebar-large .sidebar-left .navigation-left .nav-item {
    position: relative;
    display: block;
    width: 100%;
    color: #332e38;
    cursor: pointer;
    border-bottom: 1px solid #dee2e6; }

.layout-sidebar-large .sidebar-left .navigation-left .nav-item .nav-item-hold {
    display: block;
    width: 100%;
    padding: 9px 0;
    color: #47404f; }
        
</style>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">{{ __('User Management') }}</div>

                <div class="card-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif -->
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <!-- sidebar menu  -->
                    <div class=" layout-sidebar-large ">
                        <div class="sidebar-left open " >
                            <ul class="navigation-left">
                                
                                <li class="nav-item ">
                                    <a class="nav-item-hold" href="#">
                                        <i><img src="./Juz4x - Money Change &amp; Remittance Portal_files/deal.png"></i>
                                        <span class="nav-text">FxDeal</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-item-hold" href="#">
                                        <i><img src="./Juz4x - Money Change &amp; Remittance Portal_files/dd-tt.png"></i>
                                        <span class="nav-text">Remit Online</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>

                                <li class="nav-item ">
                                    <a class="nav-item-hold" href="#">
                                        <i><img src="./Juz4x - Money Change &amp; Remittance Portal_files/bs.png"></i>
                                        <span class="nav-text">Forex</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>


                                <li class="nav-item ">
                                    <a class="nav-item-hold " href="#">
                                        <i><img src="./Juz4x - Money Change &amp; Remittance Portal_files/customer.png"></i>
                                        <span class="nav-text">Cash Customer</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-item-hold " href="#">
                                        <i><img src="./Juz4x - Money Change &amp; Remittance Portal_files/customer.png"></i>
                                        <span class="nav-text">Corporate Customer</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>

                                <li class="nav-item ">
                                    <a class="nav-item-hold" href="#">
                                        <i><img src="./Juz4x - Money Change &amp; Remittance Portal_files/balance.png"></i>
                                        <span class="nav-text">Balance</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-item-hold" href="#" onclick="">
                                        <i><img src="./Juz4x - Money Change &amp; Remittance Portal_files/logout.jpg"></i>
                                        <span class="nav-text">Logout</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                            </ul>                  
                        </div>
                    </div>

                    <!-- / sidebar menu-->
                    <!-- content -->
                    {{ __('User show page') }}
                
                    
                    <!-- /contect -->
                    
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
