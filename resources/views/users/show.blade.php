@extends('layouts.withHF')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">{{ __('User Information') }}</div>

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
                    

                    <!-- / sidebar menu-->
                    <!-- content -->
                    <!-- <div id="inner-content" class="d-inline-flex p-2"> -->
                    @if(isset($users))
                        <div class="col-md-10 p-1 float-left" >
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $users->name }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $users->email }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                        <h6 class="mb-0">Exhouse</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $users->ExHouseName }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                        <h6 class="mb-0">Role</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $users->role_name }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                        <h6 class="mb-0">Status</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ ($users->isactive==0) ?'In-Active' : 'Active' }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                        <h6 class="mb-0">Username</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $users->username }}
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    @endif


                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
