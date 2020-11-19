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
        $('#countryTable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );

    } );
    function changeStatus(_this, id) {
        var status = $(_this).prop('checked') == true ? 1 : 0;

        if (window.confirm("Do you really want to change status?")) {

            let _token = $('meta[name="csrf-token"]').attr('content');
            let url = '/change-countrystatus';
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

#countryTable_wrapper .dt-button{
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
                <div class="card-header"><i class="fas fa-flag-usa"></i>&nbsp;{{ __('Country Management') }}</div>

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
                    <div class="col-md-12 p-1 float-left" >
                        <div class="card mb-3">
                            <div class="card-body">
                                <form method="POST" action="{{ route('countries.store') }}">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group row">

                                        <label for="countryName" class="col-md-3 col-form-label text-md-left">{{ __('Country Name') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-4">
                                            <input id="countryName" type="text" class="form-control text-capitalize input-sm @error('countryName') is-invalid @enderror" Name="countryName" value="{{ old('countryName') }}" required autocomplete="countryName" autofocus>

                                            @error('countryName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="countryCode" class="col-md-3 col-form-label text-md-left">{{ __('Country Code') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-2">
                                            <input id="countryCode" type="text" class="form-control input-sm @error('countryCode') is-invalid @enderror" name="countryCode" value="{{ old('countryCode') }}" required autocomplete="countryCode" autofocus>

                                            @error('countryCode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row">

                                        <label for="countryID" class="col-md-3 col-form-label text-md-left">{{ __('Currency') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-4">
                                            <select id="currencyID" class="form-control @error('currencyID') is-invalid @enderror" name="currencyID" required autofocus>
                                                <option value="">...</option>
                                                @foreach ($currency as $key => $value)
                                                    <option value="{{ $value->CurrencyID }}" {{ old('currencyID')== $value->currencyID ? 'selected' : '' }}>{{ $value->CurrencyName }}</option>
                                                @endforeach
                                            </select>
                                            @error('currencyID')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="isoCode" class="col-md-3 col-form-label text-md-left">{{ __('ISO Code') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-2">
                                            <input id="isoCode" type="text" class="form-control text-uppercase input-sm @error('isoCode') is-invalid @enderror" name="isoCode" value="{{ old('isoCode') }}" required autocomplete="isoCode" autofocus>

                                            @error('isoCode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-10 offset-md-3">
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
                    <!-- content -->
                    &nbsp;<hr>&nbsp;
                    <!-- dataTable -->
                        <table id="countryTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Country Name</th>
                                    <th>Currency</th>
                                    <th>Created By</th>
                                    <th>Create Date</th>
                                    <th>Updated By</th>
                                    <th>Updated Date</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($countries))
                            @foreach ($countries as $country)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $country->CountryName }}</td>
                                <td>{{ $country->CurrencyName }}</td>
                                <td>{{ $country->CreatedBy }}</td>
                                <td>{{ $country->created_at }}</td>
                                <td>{{ $country->UpdatedBy }}</td>
                                <td>{{ $country->updated_at }}</td>
                                <td>
                                    <input type="checkbox"  name="isactive" id="isactive-{{$country->CountryID}}" value="{{ $country->isactive }}"
                                    {{ ($country->isactive)? ' checked': '' }}
                                    onclick="changeStatus(event.target, {{ $country->CountryID }});">
                                </td>
                                <td>
                                    <form action="" method="POST">

                                        {{-- <a class="badge badge-light" href="{{ route('show',$country->id) }}">View</a> --}}
                                        <a class="badge badge-primary" href="{{ route('countries.edit',$country->CountryID) }}">Edit</a>
                                        {{-- <a class="badge badge-primary" href="{{ route('country-edit',$country->id) }}">Reset</a> --}}

                                        @csrf
                                        <!-- @@method('DELETE') -->

                                        <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>

                    <!-- /dataTable -->
                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
