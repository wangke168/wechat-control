<?php $__env->startSection('title', '横店影视城微信管理平台－－－二维码管理'); ?>

<?php $__env->startSection('page-title','二维码管理'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')); ?>" rel="stylesheet" type="text/css"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-menu-title'); ?>
    二维码搜索
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-bar'); ?>
 <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="#">Home</a>
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
							<div class="caption">
								<i class="fa fa-globe"></i>搜索结果
							</div>
							<div class="tools">
							</div>
						</div>

						<div class="portlet-body">
                            <form method="GET" name="myform" action="qrsearch" class="navbar-form navbar-right">
                                <input class="m-wrap" type="text" name="keyword" class="form-control" placeholder="二维码关键字"
                                       id="keyword" value=""/>
                                <button type="submit"><span class="glyphicon glyphicon-search"></span></button>
                            </form>
							<table class="table table-striped table-bordered table-hover" id="sample_1">
							<thead>
							<tr>
								<th>
									 序号
								</th>
								<th>
									 名称
								</th>
								<th>
									 关注数
								</th>
								<th>
									 订单数
								</th>
								<th>
									 获取二维码
								</th>
							</tr>
							</thead>
							<tbody>
                            <?php foreach($rows as $row): ?>
                                <tr>
                                    <td>
                                        <?php echo e($row->qrscene_id); ?>

                                    </td>
                                    <td>
                                        <?php echo e($row->qrscene_name); ?>

                                    </td>
                                    <td>
                                        <?php
                                            $row_count=DB::table('wx_user_info')
                                            ->where('eventkey',$row->qrscene_id)
                                            ->where('esc','0')
                                            ->count();
                                            echo $row_count;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $row_count=DB::table('wx_order_send')
                                                ->where('eventkey',$row->qrscene_id)
                                                ->count();
                                        echo $row_count;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "<a class='getqrcode label label-primary' data-target=\"#long\" data-toggle=\"modal\" data-src=\"qrcode_create/" . $row->qrscene_id . "\"><i class=\"fa  fa-download\"></i>&nbsp;下载二维码</a>&nbsp;";

                                        echo "<a href='qrmodify?action=modify&id=" . $row->id . "' class='label label-success'><i class=\"fa fa-edit\"></i>&nbsp;修改</a>";

                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
							</tbody>
							</table>
                            <!--弹出层-->
                            <div id="long" class="modal fade " tabindex="-1" data-replace="true">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">二维码下载</h4>
                                </div>
                                <div class="modal-body">
                                    <?php /*<img id='qr'  src="../../../../../../i.imgur.com/KwPYo.jpg">*/ ?>
                                    <iframe id='qr' src="http://www.baidu.com" style="border:none; width:500px; height:500px;"></iframe>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn btn-default">关闭</button>
                                </div>
                            </div>
                            <!--结束弹出层-->
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