<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
</footer>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>/assets/theme/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>/assets/theme/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>/assets/theme/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>/assets/theme/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>/assets/theme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>/assets/theme/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>/assets/theme/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>/assets/theme/dist/js/demo.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url(); ?>/assets/theme/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>/assets/theme/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>/assets/theme/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url(); ?>/assets/theme/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/theme/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>/assets/theme/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url(); ?>/assets/theme/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url(); ?>/assets/theme/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url(); ?>/assets/theme/plugins/iCheck/icheck.min.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="<?php echo base_url(); ?>/assets/theme/bower_components/Flot/jquery.flot.categories.js"></script>
<!-- FLOT CHARTS -->
<script src="<?php echo base_url(); ?>/assets/theme/bower_components/Flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?php echo base_url(); ?>/assets/theme/bower_components/Flot/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?php echo base_url(); ?>/assets/theme/bower_components/Flot/jquery.flot.pie.js"></script>


<!-- page script -->
<script>
    $(function () {
        $('#example1').DataTable({
            "language": {
                "lengthMenu": "Zobraziť _MENU_ záznamov na stránku",
                "search": "Vyhľadať:",
                "zeroRecords": "Nothing found - sorry",
                "info": "Strana _PAGE_ z _PAGES_",
                "infoEmpty": "Žiadne záznamy k dispozícii",
                "zeroRecords": "Nenašiel sa žiadny záznam",
                "paginate": {
                    "first": "Prvý",
                    "last": "Posledný",
                    "next": "Nasledujúca",
                    "previous": "Predošla"
                },
                "infoFiltered": "(filtered from _MAX_ total records)"
            }
        });
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'})
        //Date picker
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        })

        $('#datepicker2').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        })
    });
</script>
<script>
    new Morris.Bar({
        // ID of the element in which to draw the chart.
        element: 'myfirstchart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        // The name of the data record attribute that contains x-values.
        data: <?php echo $help; ?>,
        xkey: 'datum',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['counts'],
        barColors: ['#f39c12','#f0ad4e','#bf892b', '#ffb73a'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['counts'],
        resize: true
    });
</script>
<script>
    Morris.Donut({
        element: 'myfirstdonut',
        data: <?php echo $donut; ?>,
        colors: ['#f39c12','#f0ad4e','#bf892b', '#ffb73a']
    });
</script>
<script>
    Morris.Line({
        element: 'line-example',
        data: <?php echo $linechart; ?>,
        xkey: 'Rok',
        ykeys: ['plat1'],
        labels: ['Priemerná mzda'],
        behaveLikeLine: true,
        resize: true,
        lineColors: ['#f39c12','#f0ad4e','#bf892b', '#ffb73a']
    });
</script>
</body>
</html>
