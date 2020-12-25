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
        $('#roleTable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );

    } );
    function fromSubmit(form){
        if(!confirm("Do you really want to do this?")) {
            return false;
        }
        this.form.submit();
    }
    function changeStatus(_this, id) {
        var status = $(_this).prop('checked') == true ? 1 : 0;

        if (window.confirm("Do you really want to change status?")) {

            let _token = $('meta[name="csrf-token"]').attr('content');
            let url = '/change-rolestatus';
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
                    alert(result.success);
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

#roleTable_wrapper .dt-button{
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
                <div class="card-header"><i class="fas fa-users-cog"></i>&nbsp;{{ __('Role Management') }}</div>

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
                                <form onsubmit="return fromSubmit(this);" method="POST" action="{{ route('roles.store') }}">
                                    @csrf
                                    @method('POST')

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="role_name" class="col-md-12 col-form-label text-md-left">{{ __('Role Name') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-12">
                                                <input id="role_name" type="text" class="form-control input-sm @error('role_name') is-invalid @enderror" name="role_name" value="{{ old('role_name') }}" required autocomplete="role_name" autofocus>

                                                @error('role_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="form-group mb-0">
                                        <div class="col-md-12 ">
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

                    <!-- dataTable -->
                    &nbsp;<hr>&nbsp;
                    <div class="table-responsive">
                        <table id="roleTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Role Name</th>
                                    <th>Created By</th>
                                    <th>Create Date</th>
                                    <th>Updated By</th>
                                    <th>Updated Date</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($roles))
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $role->role_name }}</td>
                                <td>{{ $role->CreatedBy }}</td>
                                <td>{{ $role->created_at }}</td>
                                <td>{{ $role->UpdatedBy }}</td>
                                <td>{{ $role->updated_at }}</td>
                                <td>
                                    <input type="checkbox"  name="isactive" id="isactive-{{$role->roleid}}" value="{{ $role->isactive }}"
                                    {{ ($role->isactive)? ' checked': '' }}
                                    onclick="changeStatus(event.target, {{ $role->roleid }});">
                                </td>
                                <td>
                                    <!--<form action="" method="POST">-->
                                        <a class="badge badge-primary" href="{{ route('roles.edit',$role->roleid) }}">Edit</a>

                                        @csrf
                                        <!-- @@method('DELETE') -->

                                        <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                                    <!--</form>-->
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {!! $roles->links() !!}
                    </div>
                    <!-- /dataTable -->
                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
