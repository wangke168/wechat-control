<?php $__env->startSection('title', '横店影视城微信管理平台－－－景区演艺秀推送'); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')); ?>" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')); ?>" rel="stylesheet"
          type="text/css"/>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-menu-title', '景区演艺秀推送'); ?>

<?php $__env->startSection('page-title', '景区演艺秀推送'); ?>

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
                        <i class="fa fa-globe"></i>时间列表
                    </div>
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body">

                    <ul class="nav nav-pills navbar-left">


                        <button type="button" class="btn btn-success" onclick="javascript:window.location.href='pushproject?action=add';">添加推送演艺秀</button>

                    </ul>
                    <div class="tab-content">


                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>
                                    序号
                                </th>
                                <th>
                                    演艺秀名称
                                </th>
                                <th>
                                    演艺秀时间
                                </th>
                                <th>
                                    演艺秀地点
                                </th>

                                <th>
                                    地理位置
                                </th>
                                <th>
                                    所属景区
                                </th>
                                <th>
                                    状态
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
                                        <?php echo e($row->show_name); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->show_time); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->location_name); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->location_url); ?>

                                    </td>
                                    <td>
                                    <?php
                                    $usage = new \App\WeChat\Usage();
                                    echo "<span class='label bg-grey-cascade'>" . $usage->getArticleShowQrsecne($row->eventkey) . "</span>";
                                    ?>

                                    <td>
                                        <?php
                                       /* if ($row->online == 1) {
                                            echo "<span class='label label-success'>显示</span>";
                                        } else {
                                            echo "<span class='label label-danger'>不显示</span>";
                                        }*/
                                        if ($row->is_push == 1) {
                                            echo "&nbsp;<span class='label label-success'>推送</span>";
                                        } else {
                                            echo "&nbsp;<span class='label label-danger'>不推送</span>";
                                        }
                                        ?>

                                    </td>
                                    <td>
                                        <?php
                                        echo "<a href='pushproject?action=modify&id={$row->id}' class='label label-success'><i class=\"icon-edit\"></i>修改</a>&nbsp;";
                                        if ($row->is_push == 1) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要取消推送'))return false;\"  href='pushproject?action=notpush&id={$row->id}' class='label label-warning'>取消推送</a>";
                                        } elseif ($row->is_push == 0) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要推送'))return false;\"  href='pushproject?action=push&id={$row->id}' class='label label-success'>自动推送</a>";

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
    <script src="<?php echo e(asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')); ?>"
            type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')); ?>"
            type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/admin/pages/scripts/ui-extended-modals.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('init'); ?>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('control.blade.data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>