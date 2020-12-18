@extends('layouts.withHF')

@section('content')
<!-- datatable js -->
    {{-- <script src="{{ asset('assets/DataTable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/DataTable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/DataTable/js/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('assets/DataTable/js/jszip.min.js')}}"></script>
    <script src="{{ asset('assets/DataTable/js/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/DataTable/js/vfs_fonts.js')}}"></script>
    <script src="{{ asset('assets/DataTable/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/DataTable/js/buttons.print.min.js')}}"></script>
    <!-- datatable css -->
    <link href="{{ asset('assets/DataTable/css/jquery.dataTables.min.css')}}" rel=stylesheet>
    <link href="{{ asset('assets/DataTable/css/buttons.dataTables.min.css')}}" rel=stylesheet> --}}

<script>
    function fromSubmit(form){
        if(!confirm("Do you really want to do this?")) {
            return false;
        }
        this.form.submit();
    }
    // $(document).ready(function() {
    //     $('#roleTable').DataTable( {
    //         dom: 'Bfrtip',
    //         buttons: [
    //             'copy', 'csv', 'excel', 'pdf', 'print'
    //         ]
    //     } );

    // } );
    // function changeStatus(_this, id) {
    //     var status = $(_this).prop('checked') == true ? 1 : 0;

    //     if (window.confirm("Do you really want to change status?")) {

    //         // let _token = $('meta[name="csrf-token"]').attr('content');
    //         // let url = '/change-rolestatus';
    //         // let method = 'post';
    //         // $.ajax({
    //         //     url: url,
    //         //     type: method,
    //         //     data: {
    //         //         _token: _token,
    //         //         id: id,
    //         //         status: status
    //         //     },
    //         //     success: function (result) {
    //         //         alert(result.success);
    //         //     }
    //         // });
    //     }else{
    //         // if (status==1){
    //         //     $(_this).prop('checked', false);
    //         // }else{
    //         //     $(_this).prop('checked', true);
    //         // }
    //         return false;
    //     }

    // }
    $.fn.extend({
    treed: function (o) {

      var openedClass = 'glyphicon-minus-sign';
      var closedClass = 'glyphicon-plus-sign';

      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };

        /* initialize each of the top levels */
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this);
            branch.prepend("");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        /* fire event from the dynamically added icon */
        tree.find('.branch .indicator').each(function(){
            $(this).on('click', function () {
                $(this).closest('li').click();
            });
        });
        /* fire event to open branch if the li contains an anchor instead of text */
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        /* fire event to open branch if the li contains a button instead of text */
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});
/* Initialization of treeviews */
$('#tree1').treed();
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
.tree, .tree ul {
    margin:0;
    padding:0;
    list-style:none
}
.tree ul {
    margin-left:1em;
    position:relative
}
.tree ul ul {
    margin-left:.5em
}
.tree ul:before {
    content:"";
    display:block;
    width:0;
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    border-left:1px solid
}
.tree li {
    margin:0;
    padding:0 1em;
    line-height:2em;
    color:#369;
    font-weight:700;
    position:relative
}
.tree ul li:before {
    content:"";
    display:block;
    width:10px;
    height:0;
    border-top:1px solid;
    margin-top:-1px;
    position:absolute;
    top:1em;
    left:0
}
.tree ul li:last-child:before {
    background:#fff;
    height:auto;
    top:1em;
    bottom:0
}
.indicator {
    margin-right:5px;
}
.tree li a {
    text-decoration: none;
    color:#369;
}
.tree li button, .tree li button:active, .tree li button:focus {
    text-decoration: none;
    color:#369;
    border:none;
    background:transparent;
    margin:0px 0px 0px 0px;
    padding:0px 0px 0px 0px;
    outline: 0;
}
</style>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header"><i class="fas fa-users-cog"></i>&nbsp;{{ __('Menu Management') }}</div>

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
                                <div class="row">
                                    <div class="col-md-6">
                                        <form onsubmit="return fromSubmit(this);" method="POST" action="{{ route('menus.store') }}">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group row">
                                                <label for="title" class="col-md-2 col-form-label text-md-left">{{ __('Title') }}&nbsp;<span class="mandatory">*</span></label>
                                                <div class="col-md-10">
                                                    <input id="title" type="text" class="form-control input-sm @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                                    @error('title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="parent_id" class="col-md-2 col-form-label text-md-left">{{ __('Parent') }}&nbsp;<span class="mandatory">*</span></label>
                                                <div class="col-md-10">
                                                    <select id="parent_id" class="form-control @error('parent_id') is-invalid @enderror" name="parent_id" required autofocus>
                                                        <option selected disabled>Select Parent Menu</option>
                                                        @foreach($allMenus as $key => $value)
                                                            <option value="{{ $key }}" {{ old('parent_id')== $key ? 'selected' : '' }}>{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('parent_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="url" class="col-md-2 col-form-label text-md-left">{{ __('URL') }}&nbsp;<span class="mandatory">*</span></label>
                                                <div class="col-md-10">
                                                    <input id="url" type="text" class="form-control input-sm @error('url') is-invalid @enderror" name="url" value="{{ old('url') }}" required autocomplete="url" autofocus>
                                                    @error('url')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="icon" class="col-md-2 col-form-label text-md-left">{{ __('Icon') }}&nbsp;<span class="mandatory">*</span></label>
                                                <div class="col-md-10">
                                                    <input id="icon" type="text" class="form-control input-sm @error('icon') is-invalid @enderror" name="icon" value="{{ old('icon') }}"  autocomplete="icon" autofocus>
                                                    @error('icon')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="role" class="col-md-2 col-form-label text-md-left">{{ __('Role') }}&nbsp;<span class="mandatory">*</span></label>
                                                <div class="col-md-4">
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
                                                <label for="order" class="col-md-2 col-form-label text-md-left">{{ __('Order') }}&nbsp;<span class="mandatory">*</span></label>
                                                <div class="col-md-4">
                                                    <input id="order" type="text" class="form-control input-sm @error('order') is-invalid @enderror" name="order" value="{{ old('order') }}" required autocomplete="order" autofocus>
                                                    @error('order')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row mb-0">
                                                <div class="col-md-10 offset-2">
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
                                    <div class="col-md-6">
                                        <ul id="tree1">
                                            @foreach($menus as $menu)
                                            <li>
                                                {{ $menu->title }}
                                                @if(count($menu->children))
                                                    @include('menu.manageChild',['childs' => $menu->children])
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- dataTable -->
                    {{-- &nbsp;<hr>&nbsp;
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
                    </div> --}}
                    <!-- /dataTable -->
                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
