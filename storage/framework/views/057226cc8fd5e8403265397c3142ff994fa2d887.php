<?php $__env->startSection('title', '横店影视城微信管理平台－－－回复管理'); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')); ?>" rel="stylesheet" type="text/css"/>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-menu-title', '文字回复'); ?>

<?php $__env->startSection('page-title', '回复管理'); ?>

<?php $__env->startSection('page-bar'); ?>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">文字回复</a>
            </li>
        </ul>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue-hoki">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>文字回复列表
                    </div>
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body">

                    <ul class="nav nav-pills">

                        <form method="POST" name="myform" action="requesttxt" class="navbar-form navbar-right">
                            <input class="m-wrap" type="text" name="keyword" class="form-control" placeholder="关键字"
                                   id="keyword" value=""/>
                            <button type="submit"><span class="glyphicon glyphicon-search"></span></button>
                        </form>
                    </ul>
                    <div class="tab-content">


                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>
                                    序号
                                </th>
                                <th>
                                    标题
                                </th>
                                <th>
                                    排序
                                </th>
                                <th>
                                    展示对象
                                </th>
                                <th>
                                    点击数
                                </th>
                                <th>
                                    不重复点击数
                                </th>
                                <th>
                                    转发数
                                </th>
                                <th>
                                    状态
                                </th>
                                <th>
                                    显示时间
                                </th>
                                <th>
                                    操作
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($rows as $row): ?>
                                <tr>
                                    <td>
                                        <?php echo e($row->id); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->content); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->keyword); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->eventkey); ?>

                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <?php
                                        if ($row->online == 1) {
                                        echo "<span class='label label-success'>显示</span>";
                                        } else {
                                        echo "<span class='label label-danger'>不显示</span>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo e($row->start_date); ?>--<?php echo $row->end_date; ?>

                                    </td>
                                    <td>
                                        <?php
                                        echo "<a href='#' class='label label-success'><i class=\"fa fa-edit\"></i>&nbsp;修改</a>&nbsp;";
                                       if ($row->online == 1) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要下线'))return false;\"  href='#' class='label label-warning'><i class=\"fa  fa-arrow-circle-o-down\"></i>&nbsp;下线</a>";
                                        } elseif ($row->online == 0) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要上线'))return false;\"  href='#' class='label label-success'><i class=\"fa  fa-arrow-circle-o-up\"></i>&nbsp;上线</a>";

                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                        <?php echo $rows->render(); ?>





                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>




<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/admin/pages/scripts/ui-extended-modals.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('init'); ?>


    <?php $__env->stopSection(); ?>


<?php echo $__env->make('control.blade.data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>