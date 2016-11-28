<?php $__env->startSection('title', '横店影视城微信管理平台－－－数据统计'); ?>

<?php $__env->startSection('page-menu-title', '订单统计'); ?>

<?php $__env->startSection('page-title', '数据统计'); ?>

<?php $__env->startSection('css'); ?>
        <!--日历-->
<link rel="stylesheet" type="text/css"
      href="<?php echo e(asset('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css')); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-bar'); ?>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="index">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">数据统计</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">订单统计</a>
            </li>
        </ul>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    @parent
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box red-intense">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>订单统计
                    </div>
                </div>
                <div class="portlet-body">
                    <form method="GET" name="myform" action="/control/ordercountsearch" class="navbar-form navbar-right">
                    <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012"
                         data-date-format="yyyy/mm/dd">
                        <input type="text" class="form-control" name="from"
                               value="<?php if (Session::has('from')) echo Session::get('from') ?>">
												<span class="input-group-addon">
												to </span>
                        <input type="text" class="form-control" name="to"
                               value="<?php if (Session::has('to')) echo Session::get('to') ?>">
                    </div>

                    <button type="submit" class="btn green"><i class="fa fa-search"></i> 提 交</button>
                    </form>

                            <!-- /input-group -->


                    <table class="table table-striped table-bordered table-hover" id="sample_6">
                        <thead>
                        <tr>
                            <th>
                                订单号
                            </th>
                            <th>
                                预达日期
                            </th>
                            <th>
                                姓名
                            </th>
                            <th>
                                手机号
                            </th>
                            <th>
                                提交时间
                            </th>
                            <th>
                                状态
                            </th>
                            <th>
                                关注时间
                            </th>
                            <th>
                                来源
                            </th>
                            <th>
                                点击菜单
                            </th>
                            <th>
                                支付时间
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($rows as $row): ?>
                            <tr>
                                <td>
                                    <?php echo $row->sellid; ?>

                                </td>
                                <td>
                                    <?php echo $row->arrive_date; ?>

                                </td>
                                <td>
                                    <?php echo $row->order_name; ?>

                                </td>
                                <td>
                                    <?php echo $row->tel; ?>

                                </td>
                                <td>
                                    <?php echo $row->adddate; ?>

                                </td>
                                <td>
                                    <?php
                                    $order = new \App\WeChat\Count();
                                    if ($order->check_payed($row->sellid)) {
                                        echo "<span class='label label-success'>已付款</span>";
                                    } else {
                                        echo "<span class='label label-danger'>未付款</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php echo $row->focusdate; ?>

                                </td>
                                <td>
                                    <?php
                                    if ($row->eventkey) {
                                        $usage = new \App\WeChat\Usage();
                                        echo $usage->getQrsecneinfo($row->eventkey)->qrscene_name;
                                    }
                                    ?>
                                </td>
                                <td>

                                </td>
                                <td>
                                    <?php if($order->check_payed($row->sellid)): ?>
                                        <?php echo $order->check_payed($row->sellid)->adddate; ?>

                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php echo $rows->appends(["from"=>$from,'to'=>$to])->render(); ?>

                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('js'); ?>

            <!--日历-->
    <script type="text/javascript"
            src="<?php echo e(asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/pages/scripts/components-pickers.js')); ?>"></script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('init'); ?>
    ComponentsPickers.init();



<?php $__env->stopSection(); ?>
<?php echo $__env->make('control.blade.data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>