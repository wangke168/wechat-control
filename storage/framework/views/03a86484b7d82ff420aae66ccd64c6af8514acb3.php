<?php $__env->startSection('title', '横店影视城微信管理平台－－－二维码管理'); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')); ?>" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')); ?>" rel="stylesheet"
          type="text/css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title', '文章列表'); ?>

<?php $__env->startSection('page-bar'); ?>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">文章列表</a>
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
                        <i class="fa fa-globe"></i>文章列表
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
                                    索引图
                                </th>
                                <th>
                                    链接
                                </th>
                                <th>
                                    展示对象
                                </th>
                                <th>
                                    发送数
                                </th>
                                <th>
                                    打开数
                                </th>
                                <th>
                                    点击数
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
                                        <?php echo e($row->title); ?>

                                    </td>
                                    <td>
                                        <?php
                                        if ($row->pic_url) {
                                            echo '<img src=' . $row->pic_url . ' width=150>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e($row->article_url); ?>" target="_blank"> <?php echo e($row->article_url); ?></a>
                                    </td>
                                    <td>
                                        <?php if($row->is_all=='1'): ?>
                                            <span class='label label-success'>全部</span>
                                        <?php else: ?>
                                            <?php if($row->zone): ?>
                                                <span class='label label-success'><?php echo $row->zone; ?></span>
                                            <?php endif; ?>
                                            <?php if($row->hotel): ?>
                                                <span class='label label-success'><?php echo $row->hotel; ?></span>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $count=new \App\WeChat\Count();
                                            echo $count->se_request_count($row->id);
                                        ?>

                                    </td>
                                    <td>
                                        <?php echo $count->se_request_read_count($row->id); ?>

                                        
                                    </td>
                                    <td>
                                        <?php echo e($row->hits); ?>

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

                                    </td>
                                    <td>
                                        <?php
                                        echo "<a href='#' class='label label-success'><i class=\"icon-edit\"></i>修改</a>&nbsp;";
                                        if ($row->online == 1) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要下线'))return false;\"  href='#' class='label label-warning'>下线</a>";
                                        } elseif ($row->online == 0) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要上线'))return false;\"  href='#' class='label label-success'>上线</a>";

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