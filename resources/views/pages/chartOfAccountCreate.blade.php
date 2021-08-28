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
        $('#coaAccTable').DataTable( {
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
</script>
<style rel="stylesheet">

    #coaAccTable_wrapper .dt-button{
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
                <div class="card-header"><i class="far fa-plus-square"></i>&nbsp;{{ __('Add Chart Of Account') }}</div>

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
                    {{-- <div id="inner-content" class="d-inline-flex p-3"> --}}
                        <div class="col-md-12 p-1 float-left" >
                            <div class="card mb-3">
                                <div class="card-body">
                                    <form onsubmit="return fromSubmit(this);" method="POST" action="{{ route('chartOfAccount.store') }}">
                                        @csrf
                                        @method('POST')

                                        <div class="form-group row">
                                            <label for="exhouseName" class="col-md-3 col-form-label text-md-left">{{ __('Exchange House Name') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-3">
                                                <select id="exhouseName" class="form-control @error('exhouseName') is-invalid @enderror" name="exhouseName" required autofocus>
                                                    <option value="">Choose...</option>
                                                    @foreach ($exHouse as  $value)
                                                        <option value="{{ $value->ExHouseID }}" {{ old('exhouseName')== $value->ExHouseID ? 'selected' : '' }}>{{ $value->ExHouseName }}</option>
                                                    @endforeach
                                                </select>
                                                @error('exhouseName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label for="subAccGroupType" class="col-md-3 col-form-label text-md-left">{{ __('Sub Account Group Type') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-3">
                                                <select id="subAccGroupType" class="form-control @error('subAccGroupType') is-invalid @enderror" name="subAccGroupType" required autofocus>
                                                    <option value="">Choose...</option>
                                                    @foreach ($accSubGroupType as  $value)
                                                        <option value="{{ $value->AccSbGrID }}" {{ old('subAccGroupType')== $value->AccSbGrID ? 'selected' : '' }}>{{ $value->AccSbGrName }}</option>
                                                    @endforeach
                                                </select>
                                                @error('subAccGroupType')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="AccountName" class="col-md-3 col-form-label text-md-left">{{ __('New COA Name') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-5">
                                                <input id="AccountName" type="text" class="form-control input-sm @error('AccountName') is-invalid @enderror" Name="AccountName" value="{{ old('AccountName') }}" required autocomplete="AccountName" autofocus>

                                                @error('AccountName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label for="initBalance" class="col-md-2 col-form-label text-md-left">{{ __('Initial Balance') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-2">
                                                <input id="initBalance" type="text" style="text-align: right" class="form-control input-sm @error('initBalance') is-invalid @enderror" Name="initBalance" value="{{ old('initBalance') }}" placeholder="0.00" required autocomplete="initBalance" autofocus>

                                                @error('initBalance')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-12 col text-center">
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
                            <table id="coaAccTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>COA Code</th>
                                        <th>Account Name</th>
                                        <th>SubGroup Name</th>
                                        <th>Group Name</th>
                                        <th>Account Head</th>
                                        <th>Balance</th>
                                        <th>Exchange Name</th>
                                        <th>Created By</th>
                                        <th>Create Date</th>
                                        <th>Updated By</th>
                                        <th>Updated Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(isset($coaAccs))
                                @foreach ($coaAccs as $coaAcc)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $coaAcc->COACode }}</td>
                                    <td>{{ $coaAcc->AccountName }}</td>

                                    <td>{{ $coaAcc->AccSbGrCode.'-'.$coaAcc->AccSbGrName }}</td>
                                    <td>{{ $coaAcc->AccGrCode.'-'.$coaAcc->AccGrName }}</td>
                                    <td>{{ $coaAcc->AcctHdName }}</td>
                                    <td>{{ $coaAcc->Balance }}</td>
                                    <td>{{ $coaAcc->ExHouseName }}</td>

                                    <td>{{ $coaAcc->CreatedBy }}</td>
                                    <td>{{ $coaAcc->created_at }}</td>
                                    <td>{{ $coaAcc->UpdatedBy }}</td>
                                    <td>{{ $coaAcc->updated_at }}</td>

                                    <td>
                                        <!--<form action="" method="POST">-->
                                            <a class="badge badge-primary" href="{{ route('chartOfAccount.edit',$coaAcc->COACode) }}">Edit</a>

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
                            {!! $coaAccs->links() !!}
                        </div>
                        <!-- /dataTable -->
                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
