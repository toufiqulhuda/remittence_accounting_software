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
                <div class="card-header"><i class="fas fa-key"></i>&nbsp;{{ __('Change Password') }}</div>

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
                    <!-- <div id="inner-content" class="d-inline-flex p-2"> -->
                        <div class="col-md-12 p-1 float-left" >
                            <div class="card mb-3">
                                <div class="card-body">
                                    <form onsubmit="return fromSubmit(this);" method="POST" action="{{ route('user-changePass') }}">
                                        @csrf
                                        @method('POST')

                                        <div class="form-group row">
                                            <label for="oldpassword" class="col-md-2 col-form-label text-md-left">{{ __('Old Password') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-4">
                                                <input id="oldpassword" type="password" class="form-control @error('oldpassword') is-invalid @enderror" name="oldpassword" required autocomplete="new-password">

                                                @error('oldpassword')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="newpassword" class="col-md-2 col-form-label text-md-left">{{ __('New Password') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-4">
                                                <input id="newpassword" type="password" class="form-control @error('newpassword') is-invalid @enderror" name="newpassword" required autocomplete="new-password">

                                                @error('newpassword')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
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
                                    </form>
                                </div>
                            </div>
                        </div>



                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
