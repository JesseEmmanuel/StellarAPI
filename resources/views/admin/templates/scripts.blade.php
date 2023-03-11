<!-- START: Template JS-->
<script src="{{ url('dist/vendors/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ url('dist/vendors/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ url('dist/vendors/moment/moment.js') }}"></script>
<script src="{{ url('dist/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('dist/vendors/slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- END: Template JS-->

<!-- START: APP JS-->
<script src="{{ url('dist/js/app.js') }}"></script>
<!-- END: APP JS-->

<!-- START: Page Vendor JS-->
<script src="{{ url('dist/vendors/raphael/raphael.min.js') }}"></script>
<script src="{{ url('dist/vendors/morris/morris.min.js') }}"></script>
<script src="{{ url('dist/vendors/chartjs/Chart.min.js') }}"></script>
<script src="{{ url('dist/vendors/starrr/starrr.js') }}"></script>
<script src="{{ url('dist/vendors/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ url('dist/vendors/select2/js/select2.full.min.js') }}"></script>
<script src="{{ url('dist/vendors/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('dist/vendors/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('dist/vendors/quill/quill.min.js') }}"></script>
<script src="{{ url('dist/js/mail.script.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- START: Page JS-->
<script src="{{ url('dist/js/footable.script.js') }}"></script>
<script src="{{ url('dist/js/select2.script.js') }}"></script>
<script src="{{ url('dist/js/home.script.js') }}"></script>
<script src="{{ url('dist/js/datatable.script.js') }}"></script>
<!-- END: Page JS-->
</body>
<!-- END: Body-->
<script>
    @if(Session::has('message'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : false,
    }
            toastr.success("{{ session('message') }}");
    @endif

    @if(Session::has('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
    }
            toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
    }
            toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.warning("{{ session('warning') }}");
    @endif
  </script>
</html>
