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
        $('#currencyTable').DataTable( {
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
            let url = '/change-currencystatus';
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

#currencyTable_wrapper .dt-button{
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
                <div class="card-header"><i class="fas fa-dollar-sign"></i>&nbsp;{{ __('Currency Management') }}</div>

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
                                <form onsubmit="return fromSubmit(this);" method="POST" action="{{ route('currencies.store') }}">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group row">

                                        <label for="currencyName" class="col-md-3 col-form-label text-md-left">{{ __('Currency Name') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-9">
                                            <input id="currencyName" type="text" class="form-control input-sm @error('currencyName') is-invalid @enderror" Name="currencyName" value="{{ old('currencyName') }}" required autocomplete="currencyName" autofocus>

                                            @error('currencyName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row">

                                        <label for="isoCode" class="col-md-3 col-form-label text-md-left">{{ __('ISO Code') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-3">
                                            <input id="isoCode" type="text" class="form-control input-sm @error('isoCode') is-invalid @enderror" Name="isoCode" value="{{ old('isoCode') }}" required autocomplete="isoCode" autofocus>

                                            @error('isoCode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="shortName" class="col-md-2 col-form-label text-md-left">{{ __('Short Name') }}&nbsp;<span class="mandatory">*</span></label>
                                        <div class="col-md-4">
                                            <input id="shortName" type="text" class="form-control input-sm @error('shortName') is-invalid @enderror" Name="shortName" value="{{ old('shortName') }}" required autocomplete="shortName" autofocus>

                                            @error('shortName')
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
                        <table id="currencyTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Currency Name</th>
                                    <th>ISO Code</th>
                                    <th>ShortName</th>
                                    <th>Created By</th>
                                    <th>Create Date</th>
                                    <th>Updated By</th>
                                    <th>Updated Date</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($currencies))
                            @foreach ($currencies as $currency)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $currency->CurrencyName }}</td>
                                <td>{{ $currency->ISO_CODE }}</td>
                                <td>{{ $currency->ShortName }}</td>
                                <td>{{ $currency->CreatedBy }}</td>
                                <td>{{ $currency->created_at }}</td>
                                <td>{{ $currency->UpdatedBy }}</td>
                                <td>{{ $currency->updated_at }}</td>
                                <td>
                                    <input type="checkbox"  name="isactive" id="isactive-{{$currency->CurrencyID}}" value="{{ $currency->isactive }}"
                                    {{ ($currency->isactive)? ' checked': '' }}
                                    onclick="changeStatus(event.target, {{ $currency->CurrencyID }});">
                                </td>
                                <td>
                                    <form action="" method="POST">

                                        {{-- <a class="badge badge-light" href="{{ route('show',$currency->id) }}">View</a> --}}
                                        <a class="badge badge-primary" href="{{ route('currencies.edit',$currency->CurrencyID) }}">Edit</a>
                                        {{-- <a class="badge badge-primary" href="{{ route('currency-edit',$currency->CurrencyID) }}">Reset</a> --}}

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
                        <div class="d-flex justify-content-center">
                            {!! $currencies->links() !!}
                        </div>
                    <!-- /dataTable -->
                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
