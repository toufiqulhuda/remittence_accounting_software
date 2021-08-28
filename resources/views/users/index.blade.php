@extends('layouts.withHF')

@section('content')
<!-- datatable js -->
    <script src="{{ asset('assets/DataTable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/DataTable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/DataTable/js/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('assets/DataTable/js/jszip.min.js')}}"></script>
    <script src="{{ asset('assets/DataTable/js/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/DataTable/js/vfs_fonts.js')}}"></script>
    <script src="{{ asset('assets/DataTable/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/DataTable/js/buttons.print.min.js')}}"></script>
    <!-- datatable css -->
    <link href="{{ asset('assets/DataTable/css/jquery.dataTables.min.css')}}" rel=stylesheet>
    <link href="{{ asset('assets/DataTable/css/buttons.dataTables.min.css')}}" rel=stylesheet>

<script>
    $(document).ready(function() {
        $('#userTable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );
    function fromSubmit(form){
        // if(!confirm("Do you really want to do this?")) {
        //     return false;
        // }
        this.form.submit();
    }
    function changeStatus(_this, id) {
        var status = $(_this).prop('checked') == true ? 1 : 0;

        if (window.confirm("Do you really want to change status?")) {

            let _token = $('meta[name="csrf-token"]').attr('content');
            let url = '/change-userstatus';
            let method = 'post';
            $.ajax({
                url: url,
                type: method,
                data: {
                    _token: _token,
                    id: id,
                    status: status
                },
                success: function (result) {
                    //alert(result.success);
                }
            });
        }else{
            if (status==1){
                $(_this).prop('checked', false);
            }else{
                $(_this).prop('checked', true);
            }
        }

    }
</script>
<style rel="stylesheet">

#userTable_wrapper .dt-button{
    color: #fff;
    background-color: #17a2b8;
    display: inline-block;
    padding: 0.25em 0.4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
    -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
}
</style>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header"><i class="fas fa-user-cog"></i>&nbsp;{{ __('User Management') }}</div>

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
                    <!-- / sidebar menu-->
                    <!-- content -->
                    <div class="col-md-12 p-1 float-left" >
                        <div class="card mb-3">
                            <div class="card-body">
                                <form onsubmit="return fromSubmit(this);" method="POST" action="{{ route('users.store') }}">
                                    @csrf
                                    @method('POST')

                                    <div class="form-group row">

                                        <label for="name" class="col-md-2 col-form-label text-md-left">{{ __('Full Name') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-4">
                                            <input id="name" type="text" class="form-control text-capitalize input-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="email" class="col-md-2 col-form-label text-md-left">{{ __('E-Mail Address') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-4">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-group row">

                                                <label for="exHouse" class="col-md-2 col-form-label text-md-left">{{ __('ExHouse') }}&nbsp;<span class="mandatory">*</span></label>

                                                <div class="col-md-4">
                                                    <!-- <input id="exHouse" type="exHouse" class="form-control @error('exHouse') is-invalid @enderror" name="exHouse" value="{{ old('exHouse') }}" required autocomplete="exHouse"> -->
                                                    <select id="exHouse" class="form-control @error('exHouse') is-invalid @enderror" name="exHouse" required autofocus>
                                                        <option value="">...</option>
                                                        @foreach ($exHouse as  $value)
                                                            <option value="{{ $value->ExHouseID }}" {{ old('exHouse')== $value->ExHouseID ? 'selected' : '' }}>{{ $value->ExHouseName }}</option>
                                                        @endforeach

                                                    </select>
                                                    @error('exHouse')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                    </div>
                                    <div class="form-group row">

                                        <label for="role" class="col-md-2 col-form-label text-md-left">{{ __('User Role') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-4">
                                            <!-- <input id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" required autocomplete="role" autofocus> -->
                                            <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required autofocus>
                                                <option>...</option>
                                                @foreach ($roles as $key => $value)
                                                    <option value="{{ $value->roleid }}" {{ old('role')== $value->roleid ? 'selected' : '' }}>{{ $value->role_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="username" class="col-md-2 col-form-label text-md-left">{{ __('Username') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-4">
                                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row">

                                        <label for="password" class="col-md-2 col-form-label text-md-left">{{ __('Password') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-4">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="password-confirm" class="col-md-2 col-form-label text-md-left">{{ __('Confirm Password') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-4">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-10 offset-md-2">
                                            <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-check"></i>
                                                {{ __('Save') }}
                                            </button>
                                            <button type="reset" class="btn btn-primary">
                                                <i class="fas fa-broom"></i>
                                                {{ __('Clear') }}
                                            </button>
                                        </div>
                                    </div>

                                    <!-- </fieldset> -->
                                </form>
                            </div>
                        </div>
                    </div>
                    &nbsp;<hr>&nbsp;
                    <!-- dataTable -->
                    <div class="table-responsive">
                        <table id="userTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>ExHouse</th>
                                    <th>Role</th>
                                    <th>Created By</th>
                                    <th>Create Date</th>
                                    <th>Updated By</th>
                                    <th>Updated Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($users) && (is_array($users) || is_object($users)))
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->ExHouseName }}</td>
                                <td>{{ $user->role_name }}</td>
                                <td>{{ $user->CreatedBy }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->UpdatedBy }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>

                                    <input type="checkbox"  name="isactive" id="isactive-{{$user->user_id}}" value="{{ $user->isactive }}"
                                    {{ ($user->isactive)? ' checked': '' }}
                                    onclick="changeStatus(event.target, {{ $user->user_id }});">


                                </td>
                                <td>
                                    <form action="{{ url('users/reset/'.$user->user_id) }}" method="POST">


                                        <a class="badge badge-primary" href="{{ route('users.edit',$user->user_id) }}">Edit</a>
                                        <a class="badge badge-success" href="{{ route('users.show',$user->user_id) }}">View</a>
                                        {{-- <a class="badge badge-warning" type="submit">Reset</a> --}}

                                        @csrf
                                        @method('PUT')

                                        <button type="submit" class="badge badge-warning">Reset</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                        {{-- {!! $users->links() !!} --}}
                    </div>
                    <div class="d-flex justify-content-center">
                        {!! $users->links() !!}
                    </div>
                    <!-- /dataTable -->
                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
<script>

</script>
@endsection
