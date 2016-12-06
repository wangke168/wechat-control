<?php $__env->startSection('title', '横店影视城微信管理平台－－－二维码管理'); ?>

<?php $__env->startSection('css'); ?>
        <!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css"
      href="<?php echo e(asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.css')); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/global/plugins/select2/select2.css')); ?>"/>
<link rel="stylesheet" type="text/css"
      href="<?php echo e(asset('assets/global/plugins/jquery-multi-select/css/multi-select.css')); ?>"/>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title','二维码管理'); ?>
<?php $__env->startSection('page-menu-title', '修改二维码信息'); ?>

<?php $__env->startSection('page-bar'); ?>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="index-2.html">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">二维码管理</a>
            </li>
        </ul>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    @parent
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box green-haze">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-comments"></i>修改信息</div>

                    <div class="tools">

                        <a href="javascript:;" class="collapse"></a>

                    </div>

                </div>

                <div class="portlet-body form">

                    <?php echo Form::open(['url'=>'control/qrsave?action=modify','files'=>true,'class'=>'form-horizontal form-bordered','id'=>'postForm']); ?>


                    <input type="text" name="id" hidden value="<?php echo $row->id; ?>">


                        <div class="form-body">

                            <div class="form-group">

                                <label class="control-label  col-md-1">名称</label>

                                <div class="col-md-11">
                                    <input type="text" class="form-control input-large"
                                           name="qrscene_name" value="<?php echo $row->qrscene_name; ?>"/>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="control-label  col-md-1">联系人</label>

                                <div class="col-md-11">

                                    <input id="Modal1in" type="text" value="<?php echo $row->qrscene_person_name; ?>" class="form-control input-large"
                                           name="qrscene_person_name"/>

                                </div>

                            </div>

                            <div class="form-group">

                                <label class="control-label  col-md-1">联系电话</label>

                                <div class="col-md-11">

                                    <input id="Text1" type="text" value="<?php echo $row->qrscene_person_phone; ?>" class="form-control input-large"
                                           name="qrscene_person_phone"/>


                                </div>

                            </div>

                            <div class="form-group">

                                <label class="control-label  col-md-1">UID</label>

                                <div class="col-md-11">

                                    <input id="Text2" type="text" value="<?php echo $row->uid; ?>" class="form-control input-large"
                                           name="qrscene_uid"/>

                                </div>

                            </div>

                            <div class="form-group">

                                <label class="control-label  col-md-1">类型</label>

                                <div class="col-md-11">

                                    <select class="form-control input-medium select2me" name="classid"
                                            data-placeholder="选择所属类别">
                                        <option value=""></option>
                                        <?php
                                        $Usage = new \App\WeChat\Usage();
                                        $Usage->check_qr_classid($row->classid);
                                        ?>


                                    </select>

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

                            <!--END TABS-->
                        </div>
                    <?php echo Form::close(); ?>


                </div>

            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
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
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('control.blade.data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>