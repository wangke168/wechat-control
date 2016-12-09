<?php $__env->startSection('title', '横店影视城微信管理平台－－－文章管理'); ?>
<?php $__env->startSection('page-menu-title', '搜索文章'); ?>

<?php $__env->startSection('page-title', '文章管理'); ?>

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
                <a href="#">搜索文章</a>
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

                        <li><a href="/control/articlelist">全部</a></li>

                        <li><a href="/control/articlelist?classid=2">最新活动</a>
                        </li>

                        <li><a href="/control/articlelist?classid=19">横店攻略</a>
                        </li>

                        <li><a href="/control/articlelist?classid=7">门票预定</a>
                        </li>

                        <li><a href="/control/articlelist?classid=8">门票酒店预定组合</a>
                        </li>
                        <li><a href="/control/articlelist?classid=9">酒店预定</a>
                        </li>
                        <li><a href="/control/articlelist?classid=14">景区节目时间表</a>
                        </li>
                        <li><a href="/control/articlelist?classid=15">剧组拍摄动态</a>
                        </li>
                        <li><a href="/control/articlelist?classid=16">交通速查/出租/导航</a>
                        </li>
                        <li><a href="/control/articlelist?classid=97">其他</a>
                        </li>
                        <li><a href="/control/articlelist?classid=audit">待审核</a></li>
                        <li><a href="/control/articlelist?classid=1">市场</a></li>
                        <li><a href="/control/articlelist?classid=del">回收站</a></li>

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

                                    </td>
                                    <td>
                                        <?php echo e($row->hits); ?>

                                    </td>
                                    <td>

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
                                        ?>
                                        <?php
                                        if ($row->del == 1) {

                                            echo "<span class='label label-danger'>已删除</span>";
                                        }
                                        ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->adddate); ?>

                                    </td>
                                    <td>
                                        <?php
                                        echo "<a class='label label-primary' href=\"#Qrcodemodel\" data-toggle=\"modal\" data-src=\"http://weix2.hengdianworld.com/control/qrcode/getqrcode.php?id=" . $row->id . "\">预览</a>&nbsp;";
                                        echo "<a href='articlemodify?action=modify&id=" . $row->id . "' class='label label-success'><i class=\"icon-edit\"></i>修改</a>&nbsp;";

                                        if ($row->del == 0) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要删除'))return false;\"  href='articlemodify?action=del&id=" . $row->id . "'\" class='label label-danger'><i class=\"icon-remove\"></i>删除</a>&nbsp;";
                                        } elseif($row->del==1) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要还原'))return false;\"  href='articlemodify?action=return&id=" . $row->id . "'\" class='label label-success'><i class=\"icon-remove\"></i>还原</a>&nbsp;";
                                        }

                                        if ($row->online == 1) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要下线'))return false;\"  href='articlemodify?action=offline&id=" . $row->id . "'\" class='label label-danger'>下线</a>";
                                        } elseif ($row->online == 0) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要上线'))return false;\"  href='articlemodify?action=online&id=" . $row->id . "'\" class='label label-success'>上线</a>";

                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>

                        <?php echo $rows->appends(["keyword"=>$keyword])->render(); ?>



                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <script>
        $(".nav li").on("click", function () {
            $(".nav li").removeClass("active");
            $(this).addClass("active");
        });


    </script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('control.blade.data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>