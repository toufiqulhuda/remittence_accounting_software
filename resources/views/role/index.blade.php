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
</script>
<style rel="stylesheet">
    /* .layout-sidebar-large .sidebar-left .navigation-left .nav-item .nav-item-hold .nav-text {
    font-size: 13px;
    display: block;
    font-weight: 400;
}
.layout-sidebar-large .sidebar-left-secondary,
.layout-sidebar-large .sidebar-left {
    position: fixed;
    top: 80px;
    height: calc(100vh - 80px);
    background: #fff;
    box-shadow: 0 4px 20px 1px rgba(0, 0, 0, 0.06), 0 1px 4px rgba(0, 0, 0, 0.08); }

.layout-sidebar-large .sidebar-left {
    left: calc(-120px - 20px);
    z-index: 90;
    transition: all .24s ease-in-out; }
.layout-sidebar-large .sidebar-left.open {
    left: 0; }

.layout-sidebar-large .sidebar-left .navigation-left {
    list-style: none;
    text-align: center;
    width: 120px;
    height: 100%;
    margin: 0;
    padding: 0; }
.layout-sidebar-large .sidebar-left .navigation-left .nav-item {
    position: relative;
    display: block;
    width: 100%;
    color: #332e38;
    cursor: pointer;
    border-bottom: 1px solid #dee2e6; }

.layout-sidebar-large .sidebar-left .navigation-left .nav-item .nav-item-hold {
    display: block;
    width: 100%;
    padding: 9px 0;
    color: #47404f; } */
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
                <div class="card-header">{{ __('role Management') }}</div>

                <div class="card-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif -->
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <!-- sidebar menu  -->
                    <!-- / sidebar menu-->
                    <!-- content -->

                    <!-- dataTable -->
                        <table id="roleTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Role Name</th>
                                    <th>Created By</th>
                                    <th>Create Date</th>
                                    <th>Active</th>
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
                                <td>
                                    <form action="" method="POST">

                                        <a class="badge badge-light" href="{{ route('role-create',$role->id) }}">Create</a>
                                        <a class="badge badge-primary" href="{{ route('role-edit',$role->id) }}">Edit</a>

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
