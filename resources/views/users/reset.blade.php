@extends('layouts.withHF')

@section('content')
<script>
    function fromSubmit(form){
        if(!confirm("Do you really want to do this?")) {
            return false;
        }
        this.form.submit();
    }
</script>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header"><i class="fas fa-user-edit"></i>&nbsp;{{ __('Reset User') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('status') }}
                    </div>

                    @elseif(session('failed'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('failed') }}
                    </div>
                    @endif
                    <!-- sidebar menu  -->
                    <div class=" layout-sidebar-large d-inline-flex p-1 ">
                        <div class="sidebar-left open " >
                            <ul class="navigation-left">

                                <li class="nav-item ">
                                    <a class="nav-item-hold" href="{{ route('users.index') }}">
                                        <i class="fas fa-user-plus"></i>
                                        <span class="nav-text">Create User</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-item-hold" href="#">
                                        <i class="fas fa-user-edit"></i>
                                        <span class="nav-text">Edit User</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- / sidebar menu-->
                    <!-- content -->

                    <!-- <div id="inner-content" class="d-inline-flex p-3"> -->
                        <div class="col-md-10 p-1 float-left" >
                            <div class="card mb-3">
                                <div class="card-body">
                                    <form onsubmit="return fromSubmit(this);" method="POST" action="{{route('users-search')}}">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group row">
                                            <label for="username" class="col-md-2 col-form-label text-md-left">{{ __('User Name') }}&nbsp;<span class="mandatory">*</span></label>
                                            <div class="col-md-4">
                                                <input id="username" type="text" class="form-control input-sm @error('username') is-invalid @enderror" name="username" value="" required autocomplete="username" autofocus>

                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-check"></i>
                                                    {{ __('Search') }}
                                                </button>
                                                <button type="reset" class="btn btn-primary">
                                                    <i class="fas fa-broom"></i>
                                                    {{ __('Clear') }}
                                                </button>
                                            </div>
                                        </div>

                                        
                                    </form>
                                </div>
                            </div>
                        </div>
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
                        <form action="{{ url('users/reset/'.$users->user_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-md-10 p-1 float-left" >
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="form-group row mb-0">
                                            <div class="col-md-10 offset-md-2">
                                                <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-check"></i>
                                                    {{ __('Reset') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endif



                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
