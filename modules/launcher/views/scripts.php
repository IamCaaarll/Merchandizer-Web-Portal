<!-- BEGIN VENDOR JS-->

<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/vendors.min.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/sammy/sammy.js"></script>
<!-- BEGIN VENDOR JS-->


<!-- BEGIN PAGE VENDOR JS-->

<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/ui/jquery.sticky.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/forms/toggle/switchery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/tables/datatable/dataTables.select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/js/scripts/tooltip/tooltip.min.js"></script>

<!--<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/charts/raphael-min.js"></script>-->
<!--<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/charts/chart.min.js"></script>-->
<!--<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js"></script>-->
<!--<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js"></script>-->
<!--<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/extensions/moment.min.js"></script>-->
<!--<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/extensions/underscore-min.js"></script>-->
<!--<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/extensions/clndr.min.js"></script>-->
<!--<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/charts/echarts/echarts.js"></script>-->
<!--<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/extensions/unslider-min.js"></script>-->
<!-- END PAGE VENDOR JS-->

<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/ui/jquery.sticky.js"></script>
<!-- BEGIN ROBUST JS-->
<script src="<?php echo base_url(); ?>assets/robust/app-assets/js/core/app-menu.min.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/js/core/app.min.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/js/scripts/customizer.min.js"></script>
<!-- END ROBUST JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="<?php echo base_url(); ?>assets/robust/app-assets/js/scripts/tables/datatables-extensions/datatable-select.min.js"></script>

<!-- END PAGE LEVEL JS-->

<!-- BEGIN IZI TOAST -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
<!-- END IZI TOAST-->
<script>
    $(function () {
        $(this).find('.dropdown-toggle').dropdown();

        $('.rowlink').on('click', function (e) {
            $(this).find('.dropdown').toggleClass('open');
            e.stopPropagation();
        });
    });
</script>