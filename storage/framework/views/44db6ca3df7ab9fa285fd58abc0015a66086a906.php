<?php $__env->startSection('title', '横店影视城微信管理平台－－－数据统计'); ?>

<?php $__env->startSection('page-menu-title', '菜单点击数'); ?>

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
                <a href="#">菜单点击数</a>
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
                        <i class="fa fa-globe"></i>菜单点击数
                    </div>
                </div>
                <div class="portlet-body">
                        <?php echo Form::open(['url'=>'/control/menuclickcount?action=menu','files'=>true,'class'=>'navbar-form navbar-right','id'=>'postForm']); ?>


                        <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012"
                             data-date-format="yyyy/mm/dd">
                            <input type="text" class="form-control" name="from" value="<?php if(Session::has('from')) echo Session::get('from') ?>">
												<span class="input-group-addon">
												to </span>
                            <input type="text" class="form-control" name="to" value="<?php if(Session::has('to')) echo Session::get('to') ?>">
                        </div>

                        <button type="submit" class="btn green"><i class="fa fa-search"></i> 提 交</button>
                    <?php echo Form::close(); ?>


                    <!-- /input-group -->


                    <table class="table table-striped table-bordered table-hover" id="sample_6">
                        <thead>
                        <tr>
                            <th>
                                菜单名
                            </th>
                            <th>
                                点击数
                            </th>
                            <th>
                                不重复点击数
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($rows as $row): ?>
                            <tr>
                                <td>
                                    <?php
                                    $usage=new \App\WeChat\Usage();
                                      echo  $usage->get_menu_info($row->click,'name')->menu_name;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $count=new \App\WeChat\Count();
                                    echo $count->count_menu_click($row->click,'all',$from,$to);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        $count=new \App\WeChat\Count();
                                        echo $count->count_menu_click($row->click,'notrepeat',$from,$to);
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
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