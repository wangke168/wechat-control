<?php $__env->startSection('title', '横店影视城微信管理平台－－－消息管理'); ?>
<?php $__env->startSection('page-menu-title', '消息管理'); ?>

<?php $__env->startSection('page-title', '消息管理'); ?>

<?php $__env->startSection('css'); ?>
        <!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css"
      href="<?php echo e(asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.css')); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/global/plugins/select2/select2.css')); ?>"/>
<link rel="stylesheet" type="text/css"
      href="<?php echo e(asset('assets/global/plugins/jquery-multi-select/css/multi-select.css')); ?>"/>


<link href="<?php echo e(asset('lib/bootstrap-tagsinput.css')); ?>" rel="stylesheet">

<link href="<?php echo e(asset('assets/admin/pages/css/timeline.css')); ?>" rel="stylesheet" type="text/css"/>
<!--日历-->

<link rel="stylesheet" type="text/css"
      href="<?php echo e(asset('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css')); ?>"/>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-bar'); ?>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">消息管理</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">消息列表</a>
            </li>
        </ul>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="timeline">
        <?php foreach($rows as $row): ?>
                <!-- TIMELINE ITEM -->
        <div class="timeline-item">
            <div class="timeline-badge">
                <?php
                $usage = new \App\WeChat\Usage();
                echo  "<img class=\"timeline-badge-userpic\" src=\"".$usage->get_openid_info($row->wx_openid)->headimgurl."\">";
                ?>
                <?php /*<img class="timeline-badge-userpic" src="../../assets/admin/pages/media/users/avatar80_1.jpg">*/ ?>
            </div>
            <div class="timeline-body">
                <div class="timeline-body-arrow"></div>
                <div class="timeline-body-head">
                    <div class="timeline-body-head-caption">
                        <a href="#" class="timeline-body-title font-blue-madison">
                            <?php
                            $usage = new \App\WeChat\Usage();
                                echo $usage->get_openid_info($row->wx_openid)->nickname;

                            ?></a>
                        <span class="timeline-body-time font-grey-cascade">Replied at 7:45 PM</span>
                    </div>
                    <div class="timeline-body-head-actions">
                        <div class="btn-group">
                            <button class="btn btn-circle green-haze btn-sm dropdown-toggle" type="button"
                                    data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                Actions <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#">Action </a></li>
                                <li><a href="#">Another action </a></li>
                                <li><a href="#">Something else here </a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="timeline-body-content">
							<span class="font-grey-cascade">
							
							</span>
                </div>
            </div>
        </div>

        <!-- END TIMELINE ITEM -->
        <?php endforeach; ?>


    </div>
    <?php echo $rows->render(); ?>

    <?php $__env->stopSection(); ?>


    <?php $__env->startSection('js'); ?>
            <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript"
            src="<?php echo e(asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/global/plugins/select2/select2.min.js')); ?>"></script>
    <script type="text/javascript"
            src="<?php echo e(asset('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js')); ?>"></script>
    <!-- END PAGE LEVEL PLUGINS -->


    <script src="<?php echo e(asset('lib/bootstrap-tagsinput.min.js')); ?>" type="text/javascript"></script>

    <!--日历-->
    <script type="text/javascript"
            src="<?php echo e(asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/pages/scripts/components-pickers.js')); ?>"></script>


    <!--上传-->
    <script src="<?php echo e(asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/admin/pages/scripts/timeline.js" type="text/javascript')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('init'); ?>
    ComponentsPickers.init();

    Timeline.init();
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control.blade.data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>