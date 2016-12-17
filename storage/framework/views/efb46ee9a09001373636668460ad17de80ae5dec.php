<?php $__env->startSection('title', '横店影视城微信管理平台－－－景区演艺秀推送'); ?>
<?php $__env->startSection('page-menu-title', '添加演艺秀信息'); ?>

<?php $__env->startSection('page-title', '景区演艺秀推送'); ?>

<?php $__env->startSection('css'); ?>
        <!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css"
      href="<?php echo e(asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.css')); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/global/plugins/select2/select2.css')); ?>"/>
<link rel="stylesheet" type="text/css"
      href="<?php echo e(asset('assets/global/plugins/jquery-multi-select/css/multi-select.css')); ?>"/>


<link href="<?php echo e(asset('lib/bootstrap-tagsinput.css')); ?>" rel="stylesheet">

<!--上传-->
<link href="<?php echo e(asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')); ?>" rel="stylesheet">

<!--日历-->

<link rel="stylesheet" type="text/css"
      href="<?php echo e(asset('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css')); ?>"/>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('vendor.ueditor.assets', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startSection('page-bar'); ?>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">景区演艺秀推送</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">添加演艺秀</a>
            </li>
        </ul>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXTRAS PORTLET-->
            <div class="portlet box blue-hoki">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>添加演艺秀
                    </div>

                </div>
                <div class="portlet-body form">

                    <?php echo Form::open(['url'=>'control/pushproject?action=save','class'=>'form-horizontal form-bordered',
                    'id'=>'postForm','onkeydown'=>'if(event.keyCode==13){return false;}']); ?>

                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-1">演艺秀名称</label>

                            <div class="col-md-11"><input type="text" name="id" hidden value="<?php echo $row->id; ?>">
                                <select class="form-control input-medium select2me" name="show_name" disabled>
                                    <option value=""></option>

                                    <?php
                                    $Push = new \App\WeChat\Push();
                                    $Push->showMenuList($row->id);
                                    ?>


                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-1">时间</label>

                            <div class="col-md-11">
                                <input name="show_time"   value="<?php echo $row->show_time; ?>" data-role="tagsinput"
                                       placeholder="请输入回复关键字"/>
                                <span class="help-inline">每一个时间段用回车隔开</span>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-1">演艺秀地点</label>
                            <div class="col-md-11">
                                <input name="location_name"   value="<?php echo $row->location_name; ?>" class="form-control  input-inline input-xlarge">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-1">演艺秀地理位置</label>
                            <div class="col-md-11">
                                <input name="location_url"  value="<?php echo $row->location_url; ?>" class="form-control  input-inline input-xlarge">
                            </div>
                        </div>

                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green"><i class="fa fa-check"></i> 提 交</button>
                                <button type="button" class="btn default">Cancel</button>
                            </div>
                        </div>
                    </div>

                    <?php echo Form::close(); ?>

                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>


    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('js'); ?>
            <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript"
            src="<?php echo e(asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/global/plugins/select2/select2.min.js')); ?>"></script>
    <script type="text/javascript"
            src="<?php echo e(asset('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js')); ?>"></script>
    <!-- END PAGE LEVEL PLUGINS -->


    <script src="<?php echo e(asset('lib/bootstrap-tagsinput.min.js')); ?>"
            type="text/javascript"></script>

    <!--日历-->
    <script type="text/javascript"
            src="<?php echo e(asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/pages/scripts/components-pickers.js')); ?>"></script>


    <!--上传-->
    <script src="<?php echo e(asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')); ?>"></script>


    <!--下拉框-->
    <script src="<?php echo e(asset('assets/admin/pages/scripts/components-dropdowns.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('init'); ?>
    ComponentsPickers.init();
    ComponentsDropdowns.init();

<?php $__env->stopSection(); ?>


<?php echo $__env->make('control.blade.data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>