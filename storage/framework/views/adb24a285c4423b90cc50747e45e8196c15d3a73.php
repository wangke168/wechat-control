<?php $__env->startSection('title', '横店影视城微信管理平台－－－菜单管理'); ?>

<?php $__env->startSection('css'); ?>

    <link rel="stylesheet" type="text/css"
          href="<?php echo e(asset('assets/global/plugins/jquery-nestable/jquery.nestable.css')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-menu-title', '菜单管理'); ?>



<?php $__env->startSection('page-bar'); ?>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">菜单管理</a>
            </li>
        </ul>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>




    <div class="row">
        <div class="col-md-3">
            <div class="portlet box yellow">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-comments"></i>常规菜单
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="dd" id="nestable_list_3">
                        <ol class="dd-list">

                            <?php if(array_key_exists ( 'menu', $menu_list)): ?>
                            <?php foreach($menu_list['menu']['button'] as  $key=> $menu): ?>


                                <li class="dd-item dd3-item" data-id="15">
                                    <div class="dd-handle dd3-handle">
                                    </div>
                                    <div class="dd3-content">
                                        <?php echo $menu['name']; ?>

                                    </div>
                                    <ol class="dd-list">
                                        <?php foreach($menu['sub_button'] as $key=>$menu_name): ?>
                                            <li class="dd-item dd3-item" data-id="16">
                                                <div class="dd-handle dd3-handle">
                                                </div>
                                                <div class="dd3-content">
                                                    <?php echo $menu_name['name']; ?>

                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ol>
                                </li>
                            <?php endforeach; ?>
                                <?php endif; ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <?php if(array_key_exists ( 'conditionalmenu', $menu_list)): ?>
        <?php foreach($menu_list['conditionalmenu'] as $key=> $menu): ?>
            <div class="col-md-3">
                <div class="portlet box yellow">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-comments"></i>
                            <?php
                            $usage = new \App\WeChat\Usage();
                            echo $usage->get_tag_info($menu['matchrule']['group_id'])->tag_name.'('.$usage->get_tag_info($menu['matchrule']['group_id'])->eventkey.')'; ?>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="dd" id="nestable_list_3">
                            <ol class="dd-list">

                                <?php foreach($menu['button'] as $key=>$menu_button): ?>


                                    <li class="dd-item dd3-item" data-id="15">
                                        <div class="dd-handle dd3-handle">
                                        </div>
                                        <div class="dd3-content">
                                            <?php echo $menu_button['name']; ?>

                                        </div>
                                        <ol class="dd-list">
                                            <?php foreach($menu_button['sub_button'] as $menu_name): ?>
                                                <li class="dd-item dd3-item" data-id="16">
                                                    <div class="dd-handle dd3-handle">
                                                    </div>
                                                    <div class="dd3-content">
                                                        <?php echo $menu_name['name']; ?>

                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ol>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
            <?php endif; ?>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script src="<?php echo e(asset('assets/global/plugins/jquery-nestable/jquery.nestable.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('init'); ?>
    UINestable.init();
<?php $__env->stopSection(); ?>


<?php echo $__env->make('control.blade.data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>