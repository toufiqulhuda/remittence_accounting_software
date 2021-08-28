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
        $('#subGrpAccTable').DataTable( {
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

    #subGrpAccTable_wrapper .dt-button{
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
                <div class="card-header"><i class="far fa-plus-square"></i>&nbsp;{{ __('Add Sub Group Account') }}</div>

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
                                    <form onsubmit="return fromSubmit(this);" method="POST" action="{{ route('subGroupAccount.index') }}">
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
                                            <label for="accountGroupType" class="col-md-3 col-form-label text-md-left">{{ __('Account Group Type') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-9">
                                                <select id="accountGroupType" class="form-control @error('accountGroupType') is-invalid @enderror" name="accountGroupType" required autofocus>
                                                    <option value="">Choose...</option>
                                                    @foreach ($accGroupType as  $value)
                                                        <option value="{{ $value->AccGrID }}" {{ old('accountGroupType')== $value->AccGrID ? 'selected' : '' }}>{{ $value->AccGrName }}</option>
                                                    @endforeach
                                                </select>
                                                @error('accountGroupType')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="AccSbGrName" class="col-md-3 col-form-label text-md-left">{{ __('Sub Account Group Name') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-3">
                                                <input id="AccSbGrName" type="text" class="form-control input-sm @error('AccSbGrName') is-invalid @enderror" Name="AccSbGrName" value="{{ old('AccSbGrName') }}" required autocomplete="AccSbGrName" autofocus>

                                                @error('AccSbGrName')
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
                            <table id="subGrpAccTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>SubGroup Code</th>
                                        <th>SubGroup Name</th>
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
                                @if(isset($subGrpAccs))
                                @foreach ($subGrpAccs as $subGrpAcc)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $subGrpAcc->AccSbGrCode }}</td>
                                    <td>{{ $subGrpAcc->AccSbGrName }}</td>
                                    <td>{{ $subGrpAcc->AccGrName }}</td>
                                    <td>{{ $subGrpAcc->AcctHdName }}</td>
                                    <td>{{ $subGrpAcc->ExHouseName }}</td>

                                    <td>{{ $subGrpAcc->CreatedBy }}</td>
                                    <td>{{ $subGrpAcc->created_at }}</td>
                                    <td>{{ $subGrpAcc->UpdatedBy }}</td>
                                    <td>{{ $subGrpAcc->updated_at }}</td>

                                    <td>
                                        <!--<form action="" method="POST">-->
                                            <a class="badge badge-primary" href="{{ route('subGroupAccount.edit',$subGrpAcc->AccSbGrID) }}">Edit</a>

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
                            {!! $subGrpAccs->links() !!}
                        </div>

                        <!-- /dataTable -->
                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
