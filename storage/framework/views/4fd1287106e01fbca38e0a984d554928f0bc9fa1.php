<!DOCTYPE html>
<html lang="zh-hans">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="测试页面">
    <title>横店影视城微信管理平台 - <?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/style.css')); ?>">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.useso.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/global/plugins/uniform/css/uniform.default.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/global/plugins/fullcalendar/fullcalendar.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/global/plugins/jqvmap/jqvmap/jqvmap.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="<?php echo e(asset('assets/admin/pages/css/tasks.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
    <link href="<?php echo e(asset('assets/global/css/components.css')); ?>" id="style_components" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/global/css/plugins.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/admin/layout/css/layout.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/admin/layout/css/themes/darkblue.css')); ?>" rel="stylesheet" type="text/css" id="style_color" />
    <link href="<?php echo e(asset('assets/admin/layout/css/custom.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- END THEME STYLES -->

</head>

<body class="page-header-fixed page-quick-sidebar-over-content page-style-square">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="index-2.html">
                <img src="<?php echo e(asset('assets/admin/layout/img/logo.png')); ?>" alt="logo" class="logo-default"/>
            </a>
            <div class="menu-toggler sidebar-toggler hide">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
     <?php echo $__env->make('control.top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <?php echo $__env->make('control.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
       
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title">
                <?php echo $__env->yieldContent('page-title'); ?>
            </h3>
            
            <?php echo $__env->yieldContent('page-bar'); ?>
            
           
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS -->
        <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
    <!-- END CONTENT -->
 
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        2014 &copy; Metronic by keenthemes.
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo e(asset('assets/global/plugins/respond.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/global/plugins/excanvas.min.js')); ?>"></script>
<![endif]-->
<script src="<?php echo e(asset('assets/global/plugins/jquery.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/jquery-migrate.min.js')); ?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo e(asset('assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/jquery.blockui.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/jquery.cokie.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/uniform/jquery.uniform.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')); ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo e(asset('assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/flot/jquery.flot.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/flot/jquery.flot.resize.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/flot/jquery.flot.categories.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/jquery.pulsate.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/bootstrap-daterangepicker/moment.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js')); ?>" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?php echo e(asset('assets/global/plugins/fullcalendar/fullcalendar.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/global/plugins/jquery.sparkline.min.js')); ?>" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo e(asset('assets/global/scripts/metronic.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/admin/layout/scripts/layout.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/admin/layout/scripts/quick-sidebar.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/admin/layout/scripts/demo.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/admin/pages/scripts/index.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/admin/pages/scripts/tasks.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('lib/function.js')); ?>"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
        Index.init();
        Index.initDashboardDaterange();
        Index.initJQVMAP(); // init index page's custom scripts
        Index.initCalendar(); // init index page's custom scripts
        Index.initCharts(); // init index page's custom scripts
        Index.initChat();
        Index.initMiniCharts();
        Tasks.initDashboardWidget();

        menuchushi();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>

</html>