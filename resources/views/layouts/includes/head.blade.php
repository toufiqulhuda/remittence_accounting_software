<!-- Scripts -->

<!-- <script src="{{ asset('assets/js/jquery.min.js') }}"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="{{ asset('assets/js/popper.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.meanmenu.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
	<script src="{{ asset('assets/js/slick.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.appear.min.js') }}"></script>
	<script src="{{ asset('assets/js/odometer.min.js') }}"></script>
	<script src="{{ asset('assets/js/parallax.min.js') }}"></script>
	<script src="{{ asset('assets/js/wow.min.js') }}"></script>
	<script src="{{ asset('assets/js/form-validator.min.js') }}"></script>
	<script src="{{ asset('assets/js/contact-form-script.js') }}"></script>
	<script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

    <!-- Styles -->
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel=stylesheet>
    <link href="{{ asset('assets/css/animate.min.css') }}" rel=stylesheet>
    <link href="{{ asset('assets/css/fontawesome.min.css') }}" rel=stylesheet>
    <link href="{{ asset('assets/css/flaticon.css') }}" rel=stylesheet>
    <link href="{{ asset('assets/css/magnific-popup.min.css') }}" rel=stylesheet>
    <link href="{{ asset('assets/css/nice-select.css') }}" rel=stylesheet>
    <link href="{{ asset('assets/css/slick.min.css') }}" rel=stylesheet>
    <link href="{{ asset('assets/css/meanmenu.css') }}" rel=stylesheet>
    <link href="{{ asset('assets/css/odometer.min.css') }}" rel=stylesheet>
    <link href="{{ asset('assets/css/style.css') }}" rel=stylesheet>
    <link href="{{ asset('assets/css/responsive.css') }}" rel=stylesheet>

    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel=stylesheet>
<link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel=stylesheet>
<!-- https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css -->
<!-- <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel=stylesheet> -->
<script>
    $(document).ready(function() {
        $('#userTable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );
</script>