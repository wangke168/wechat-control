<?php $__env->startSection('title', '横店影视城微信管理平台－－－文章管理'); ?>
<?php $__env->startSection('page-menu-title', '文章列表'); ?>

<?php $__env->startSection('page-title', '文章管理'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')); ?>" rel="stylesheet" type="text/css"/>
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
                <a href="#">文章管理</a>
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

                        <li <?php if (!$classid) echo 'class=active'; ?> ><a href="/control/articlelist">全部</a></li>

                        <li <?php if ($classid == 2) echo 'class=active'; ?>><a href="/control/articlelist?classid=2">最新活动</a>
                        </li>

                        <li <?php if ($classid == 19) echo 'class=active'; ?>><a href="/control/articlelist?classid=19">横店攻略</a>
                        </li>

                        <li <?php if ($classid == 7) echo 'class=active'; ?>><a href="/control/articlelist?classid=7">门票预定</a>
                        </li>

                        <li <?php if ($classid == 8) echo 'class=active'; ?>><a href="/control/articlelist?classid=8">门票酒店预定组合</a>
                        </li>
                        <li <?php if ($classid == 9) echo 'class=active'; ?>><a href="/control/articlelist?classid=9">酒店预定</a>
                        </li>
                        <li <?php if ($classid == 14) echo 'class=active'; ?>><a href="/control/articlelist?classid=14">景区节目时间表</a>
                        </li>
                        <li <?php if ($classid == 15) echo 'class=active'; ?>><a href="/control/articlelist?classid=15">剧组拍摄动态</a>
                        </li>
                        <li <?php if ($classid == 16) echo 'class=active'; ?>><a href="/control/articlelist?classid=16">交通速查/出租/导航</a>
                        </li>
                        <li <?php if ($classid == 97) echo 'class=active'; ?>><a href="/control/articlelist?classid=97">其他</a>
                        </li>
                        <li <?php if ($classid == 'audit') echo 'class=active'; ?>><a
                                    href="/control/articlelist?classid=audit">待审核</a></li>
                        <li <?php if ($classid == 1) echo 'class=active'; ?>><a
                                    href="/control/articlelist?classid=1">市场</a></li>
                        <li <?php if ($classid == 'del') echo 'class=active'; ?>><a
                                    href="/control/articlelist?classid=del">回收站</a></li>

                        <form method="GET" name="myform" action="articlesearch" class="navbar-form navbar-right">
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
                                    上线时间
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
                                        <?php echo e($row->priority); ?>

                                    </td>
                                    <td>
<?php
                                        $usage=new \App\WeChat\Usage();
                                            echo "<span class='label bg-grey-cascade'>".$usage->getArticleShowQrsecne($row->eventkey)."</span>";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $count=new \App\WeChat\Count();
                                        echo $count->count_hits_article($row->id);
                                        ?>
                                    </td>
                                    <td>
                                        <?php

                                            echo $count->count_hits_norepeat($row->id)->total;
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo e($row->resp); ?>

                                    </td>
                                    <td>
                                        <?php
                                        if ($row->online == 1) {
                                        echo "<span class='label label-success'>显示</span>";
                                        } else {
                                        echo "<span class='label label-danger'>不显示</span>";
                                        }
                                        if ($row->audit == 0) {
                                            echo "&nbsp;<a OnClick=\"javascript:if (!confirm('是否真的要审核'))return false;\"  href='articlemodify?action=audit&id=" . $row->id . "'\" class='label label-danger'>待审核</span>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo e($row->adddate); ?>

                                    </td>
                                    <td>
                                        <?php
                                        echo "<a class='getqrcode label label-primary' data-target=\"#long\" data-toggle=\"modal\" data-src=\"qrcreat/" . $row->id . "\">预览</a>&nbsp;";
                                        echo "<a href='articlemodify?action=modify&id=" . $row->id . "' class='label label-success'><i class=\"icon-edit\"></i>修改</a>&nbsp;";
                                        if ($row->del == 0) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要删除'))return false;\"  href='articlemodify?action=del&id=" . $row->id . "'\" class='label label-danger'><i class=\"icon-remove\"></i>删除</a>&nbsp;";
                                        } elseif($row->del==1) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要还原'))return false;\"  href='articlemodify?action=return&id=" . $row->id . "'\" class='label label-success'><i class=\"icon-remove\"></i>还原</a>&nbsp;";
                                        }                                        if ($row->online == 1) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要下线'))return false;\"  href=\"'articlemodify?action=offline&id=" . $row->id . "'\" class='label label-warning'>下线</a>";
                                        } elseif ($row->online == 0) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要上线'))return false;\"  href='articlemodify?action=online&id=" . $row->id . "'\" class='label label-success'>上线</a>";

                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>

                        <?php echo $rows->appends(["classid"=>$classid])->render(); ?>


                        <!--弹出层-->
                        <div id="long" class="modal fade modal-scroll" tabindex="-1" data-replace="true">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">微信扫描二维码预览</h4>
                            </div>
                            <div class="modal-body">
                                <!--				<img id='qr' style="height: 500px" src="../../../../../../i.imgur.com/KwPYo.jpg">-->
                                <iframe id='qr' src="http://www.baidu.com" style="border:none; width:150px; height:250px;"></iframe>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-default">关闭</button>
                            </div>
                        </div>
                        <!--结束弹出层-->

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

    $(".getqrcode").click(function () {
    //     alert($(this).attr('data-src'));
    $("#qr").attr({"src": $(this).attr("data-src")});
    });

    <?php $__env->stopSection(); ?>


<?php echo $__env->make('control.blade.data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>