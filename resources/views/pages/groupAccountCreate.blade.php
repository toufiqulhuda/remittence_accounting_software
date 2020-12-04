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
        $('#grpAccTable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );

    } );
</script>
<style rel="stylesheet">

    #grpAccTable_wrapper .dt-button{
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
                <div class="card-header"><i class="far fa-plus-square"></i>&nbsp;{{ __('Create Group Account') }}</div>

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
                    {{-- <div class=" layout-sidebar-large d-inline-flex p-1 ">
                        <div class="sidebar-left open " >
                            <ul class="navigation-left">

                                <li class="nav-item active">
                                    <a class="nav-item-hold" href="{{ route('groupAccount.index') }}">
                                        <i class="far fa-plus-square"></i>
                                        <span class="nav-text">Create New</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-item-hold" href="#">
                                        <i class="far fa-edit"></i>
                                        <span class="nav-text">Edit</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                            </ul>
                        </div>
                    </div> --}}

                    <!-- / sidebar menu-->
                    <!-- content -->
                    {{-- <div id="inner-content" class="d-inline-flex p-3"> --}}
                        <div class="col-md-12 p-1 float-left" >
                            <div class="card mb-3">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('groupAccount.store') }}">
                                        @csrf
                                        @method('POST')

                                            <div class="form-group row">
                                                <label for="exhouseName" class="col-md-3 col-form-label text-md-left">{{ __('Exchange House Name') }}&nbsp;<span class="mandatory">*</span></label>

                                                <div class="col-md-9">
                                                    <select id="exhouseName" class="form-control @error('exhouseName') is-invalid @enderror" name="exhouseName" required autofocus>
                                                        <option value="">Choose...</option>
                                                        @foreach ($exHouse as  $value)
                                                            <option value="{{ $value->ExHouseID }}" {{ old('exHouse')== $value->ExHouseID ? 'selected' : '' }}>{{ $value->ExHouseName }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('exhouseName')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                    <label for="AccGrName" class="col-md-3 col-form-label text-md-left">{{ __('Account Group Name') }}&nbsp;<span class="mandatory">*</span></label>

                                                    <div class="col-md-3">
                                                        <input id="AccGrName" type="text" class="form-control input-sm @error('AccGrName') is-invalid @enderror" name="AccGrName" value="{{ old('AccGrName') }}" required autocomplete="AccGrName" autofocus>

                                                        @error('AccGrName')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <label for="accountHeadType" class="col-md-3 col-form-label text-md-left">{{ __('Account Head Type') }}&nbsp;<span class="mandatory">*</span></label>

                                                    <div class="col-md-3">
                                                        <select id="accountHeadType" class="form-control @error('accountHeadType') is-invalid @enderror" name="accountHeadType" required autofocus>
                                                            <option value="">Choose...</option>
                                                            @foreach ($accHeadType as  $value)
                                                                <option value="{{ $value->AccHdID }}" {{ old('accountHeadType')== $value->AccHdID ? 'selected' : '' }}>{{ $value->AcctHdName }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('accountHeadType')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row mb-0">
                                                <div class="col-md-9 offset-md-3">
                                                    <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-check"></i>
                                                        {{ __('Save') }}
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
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
                            <table id="grpAccTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Group Code</th>
                                        <th>Group Name</th>
                                        <th>Account Head</th>
                                        <th>Exchange Name</th>
                                        <th>Created By</th>
                                        <th>Create Date</th>
                                        <th>Updated By</th>
                                        <th>Updated Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(isset($grpAccs))
                                @foreach ($grpAccs as $grpAcc)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $grpAcc->AccGrCode }}</td>
                                    <td>{{ $grpAcc->AccGrName }}</td>
                                    <td>{{ $grpAcc->AcctHdName }}</td>
                                    <td>{{ $grpAcc->ExHouseName }}</td>

                                    <td>{{ $grpAcc->CreatedBy }}</td>
                                    <td>{{ $grpAcc->created_at }}</td>
                                    <td>{{ $grpAcc->UpdatedBy }}</td>
                                    <td>{{ $grpAcc->updated_at }}</td>

                                    <td>
                                        <!--<form action="" method="POST">-->
                                            <a class="badge badge-primary" href="{{ route('groupAccount.edit',$grpAcc->AccGrID) }}">Edit</a>

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
                            {!! $grpAccs->links() !!}
                        </div>
                        <!-- /dataTable -->
                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
