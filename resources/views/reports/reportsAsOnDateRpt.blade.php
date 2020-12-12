@extends('layouts.withHF')

@section('content')


<script>


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
                <div class="card-header"><i class="fas fa-file-alt"></i>&nbsp;{{ __('Reports As On Date') }}</div>

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
                                <form method="POST" action="{{ route('exhouses.store') }}">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Date &nbsp;<span class="mandatory">*</span></label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control datepicker input-sm @error('frmDate') is-invalid @enderror" name="frmDate" data-date-format="mm/dd/yyyy">
                                            @error('frmDate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                      </div>
                                    <fieldset class="form-group">
                                        <div class="row">
                                          <legend class="col-form-label col-sm-2 pt-0">Select One &nbsp;<span class="mandatory">*</span></legend>
                                          <div class="col-sm-10">
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                              <label class="form-check-label" for="gridRadios1">
                                                Trail Balance
                                              </label>
                                            </div>
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                              <label class="form-check-label" for="gridRadios2">
                                                Statement Of Affairs (Detail)
                                              </label>
                                            </div>
                                            <div class="form-check ">
                                              <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" >
                                              <label class="form-check-label" for="gridRadios3">
                                                Statement Of Affairs
                                              </label>
                                            </div>
                                          </div>
                                        </div>
                                      </fieldset>
                                    <hr>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-10 offset-md-2">
                                            <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-download"></i>
                                                {{ __('Export PDF') }}
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

                    <!-- /dataTable -->
                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
