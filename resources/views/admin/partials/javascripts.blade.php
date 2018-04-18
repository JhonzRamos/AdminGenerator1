<script>
    window.deleteButtonTrans = 'Delete';
    window.copyButtonTrans = 'Copy';
    window.csvButtonTrans = 'CSV';
    window.excelButtonTrans = 'Excel';
    window.pdfButtonTrans = 'PDF';
    window.printButtonTrans = 'Print';
    window.colvisButtonTrans = 'Columns';
</script>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
<!-- Bootstrap-Iconpicker Iconset -->
<script type="text/javascript" src="{{ url('adminlte/plugins/fa_picker/js/fontawesome-iconpicker.min.js') }}"></script>
<!-- Bootstrap-Iconpicker -->
<script type="text/javascript" src="{{ url('adminlte/plugins/fa_picker/js/fontawesome-iconpicker.min.js') }}"></script>
<!-- date-time-picker -->
<script src="{{asset('third_party/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('adminlte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- Bootstrap Toggle -->
<script src="{{asset('third_party/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js')}}"></script>
<!-- Bootstrap Color Picker-->
<script src="{{asset('adminlte/plugins/colorpicker/bootstrap-colorpicker.js')}}"></script>
<!-- Bootstrap Time Picker-->
<script src="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.js')}}"></script>
<script src="{{ url('/adminlte/js') }}/mapInput.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDS9Rw1-ETYlawypeBrNVJlM1k_r3vw038&amp;libraries=places&amp;callback=initialize" async="" defer=""></script>
<script src="{{ url('adminlte/js') }}/bootstrap.min.js"></script>
<script src="{{ url('adminlte/js') }}/select2.full.min.js"></script>
<script src="{{ url('adminlte/js') }}/main.js"></script>

<script src="{{ url('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ url('adminlte/js/app.min.js') }}"></script>
<script>
    window._token = '{{ csrf_token() }}';
</script>
<script>
    $.extend(true, $.fn.dataTable.defaults, {
        "language": {
            "url": "http://cdn.datatables.net/plug-ins/1.10.16/i18n/English.json"
        }
    });


    $('.datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        dateFormat: "{{ config('quickadmin.date_format_jquery') }}"
    });

    $('.datetimepicker').datetimepicker({
        autoclose: true,
        dateFormat: "{{ config('quickadmin.date_format_jquery') }}",
        timeFormat: "{{ config('quickadmin.time_format_jquery') }}"
    });



    $( ".select2" ).select2();

    $('#datatable').dataTable( {
        "language": {
            "url": "{{ trans('quickadmin::strings.datatable_url_language') }}"
        }
    });

    $('.colorpicker').colorpicker();

    //Timepicker
    $('.timepicker').timepicker({

    })
</script>

