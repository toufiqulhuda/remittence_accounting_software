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
        $('#exhouseTable').DataTable( {
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
            let url = '/change-exhousestatus';
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

#exhouseTable_wrapper .dt-button{
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
                <div class="card-header"><i class="fas fa-store"></i>&nbsp;{{ __('Exhouse Management') }}</div>

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
                    <?php //var_dump($exParent);?>
                    <!-- content -->
                    <div class="col-md-12 p-1 float-left" >
                        <div class="card mb-3">
                            <div class="card-body">
                                <form onsubmit="return fromSubmit(this);" method="POST" action="{{ route('exhouses.store') }}">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group row">

                                        <label for="exHouseName" class="col-md-2 col-form-label text-md-left">{{ __('Exhouse Name') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-4">
                                            <input id="exHouseName" type="text" class="form-control input-sm @error('exHouseName') is-invalid @enderror" name="exHouseName" value="{{ old('exHouseName') }}" required autocomplete="exHouseName" autofocus>

                                            @error('exHouseName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="country" class="col-md-2 col-form-label text-md-left">{{ __('Country') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-4">
                                            <!--<input id="country" type="text" class="form-control input-sm @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country" autofocus>-->
                                            <select id="country" class="form-control @error('country') is-invalid @enderror" name="country" required autofocus>
                                                <option value="">Choose...</option>
                                                @foreach ($country as $key => $value)
                                                    <option value="{{ $value->CountryID }}" {{ old('country')== $value->CountryID ? 'selected' : '' }}>{{ $value->CountryName }}</option>
                                                @endforeach
                                            </select>

                                            @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row">

                                        <label for="exParentCode" class="col-md-2 col-form-label text-md-left">{{ __('ExHouse Parent') }}&nbsp;<span class="mandatory">*</span></label>
                                        <div class="col-md-4">
                                            <select id="exParentCode" class="form-control @error('exParentCode') is-invalid @enderror" name="exParentCode" required autofocus>
                                                <option value="">Choose...</option>
                                                <option value="self">Self</option>
                                                @foreach ($exParent as  $key =>$valueParent)
                                                    <option value="{{ $valueParent->ExHouseID }}" {{ old('exParentCode') == $valueParent->ExHouseID ? 'selected' : '' }}>{{ $valueParent->ExHouseName }}</option>
                                                @endforeach

                                            </select>
                                            @error('exParentCode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="address" class="col-md-2 col-form-label text-md-left">{{ __('Address') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-4">
                                            {{-- <input id="address" type="text" class="form-control input-sm @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus> --}}
                                            <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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
                    &nbsp;<hr> &nbsp;
                    <!-- dataTable -->
                    <div class="table-responsive">
                        <table id="exhouseTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ExHouseID</th>
                                    <th>Exhouse Name</th>
                                    <th>Address</th>
                                    <th>Country</th>
                                    <th>TnxDate</th>
                                    <th>PrevDate</th>
                                    <th>ExParent</th>
                                    <th>RespExHouse</th>
                                    <th>Created By</th>
                                    <th>Create Date</th>
                                    <th>Updated By</th>
                                    <th>Updated Date</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($exhouses))
                            @foreach ($exhouses as $exhouse)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $exhouse->ExHouseID }}</td>
                                <td>{{ $exhouse->ExHouseName }}</td>
                                <td>{{ $exhouse->Address }}</td>
                                <td>{{ $exhouse->CountryName }}</td>
                                <td>{{ $exhouse->TnxDate }}</td>
                                <td>{{ $exhouse->PrevDate }}</td>
                                <td>{{ $exhouse->ExParentName }}</td>
                                <td>{{ $exhouse->RespExID }}</td>
                                <td>{{ $exhouse->CreatedBy }}</td>
                                <td>{{ $exhouse->created_at }}</td>
                                <td>{{ $exhouse->UpdatedBy }}</td>
                                <td>{{ $exhouse->updated_at }}</td>
                                <td>
                                    <input type="checkbox"  name="isactive" id="isactive-{{$exhouse->ExHouseID}}" value="{{ $exhouse->isactive }}"
                                    {{ ($exhouse->isactive)? ' checked': '' }}
                                    onclick="changeStatus(event.target,'{{ $exhouse->ExHouseID }}');">
                                </td>
                                <td>
                                    <form action="" method="POST">

                                        <a class="badge badge-primary" href="{{ route('exhouses.edit',$exhouse->ExHouseID) }}">Edit</a>



                                        <!-- @@method('DELETE') -->

                                        <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {!! $exhouses->links() !!}
                    </div>
                    <!-- /dataTable -->
                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
