<?php $__env->startSection('title', '横店影视城微信管理平台－－－二维码管理'); ?>

<?php $__env->startSection('css'); ?>
        <!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css"
      href="<?php echo e(asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.css')); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/global/plugins/select2/select2.css')); ?>"/>
<link rel="stylesheet" type="text/css"
      href="<?php echo e(asset('assets/global/plugins/jquery-multi-select/css/multi-select.css')); ?>"/>

<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo e(asset('lib/summernote.css')); ?>" rel="stylesheet">
<!-- END PAGE LEVEL STYLES -->

<link href="<?php echo e(asset('lib/bootstrap-tagsinput.css')); ?>" rel="stylesheet">

<!--上传-->
<link href="<?php echo e(asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')); ?>" rel="stylesheet">

<!--日历-->

<link rel="stylesheet" type="text/css"
      href="<?php echo e(asset('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css')); ?>"/>
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
            <!-- BEGIN EXTRAS PORTLET-->
            <div class="portlet box blue-hoki">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Bootstrap Summernote WYSIWYG Editor
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                        <a href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">

                    <?php echo Form::open(['url'=>'control/articlesave?action=add','files'=>true,'class'=>'form-horizontal form-bordered','id'=>'postForm']); ?>

                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-1">所属栏目</label>

                            <div class="col-md-11">
                                <select class="form-control input-medium select2me" name="classid"
                                        data-placeholder="选择显示栏目">
                                    <option value=""></option>

                                    <?php
                                    $Usage = new \App\WeChat\Usage();
                                    $Usage->menuList();
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">文章标题</label>

                            <div class="col-md-11">
                                <input name="title" class="form-control input-xlarge" placeholder="请在这里输入标题">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">关键字</label>

                            <div class="col-md-11">
                                <input name="keyword" type="text" value="" data-role="tagsinput"
                                       placeholder="请输入回复关键字"/>
                                <span class="help-inline">每一个关键字用回车隔开</span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">索引图</label>

                            <div class="col-md-11">

                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 225px; height: 125px;">
                                    </div>
                                    <div>
													<span class="btn default btn-file">
													<span class="fileinput-new">
													选择图片 </span>
													<span class="fileinput-exists">
													更换图片 </span>
													<input type="file" name="pic_url">
													</span>
                                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                            移除 </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
												<span class="label label-danger">
												注意! </span>
                                    微信推送的图，如果排序为1的建议900*500，之后的建议200*200.
                                </div>


                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">转发朋友圈图</label>

                            <div class="col-md-11">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 100px; height: 100px;">
                                    </div>
                                    <div>
													<span class="btn default btn-file">
													<span class="fileinput-new">
													选择图片 </span>
													<span class="fileinput-exists">
													更换图片 </span>
													<input type="file" name="pyq_pic">
													</span>
                                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                            移除 </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
												<span class="label label-danger">
												注意! </span>

                                    选择图片转发朋友圈时的小图，建议尺寸200*200
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">朋友圈标题</label>

                            <div class="col-md-11">
                                <input name="pyq_title" class="form-control  input-inline input-xlarge">
                                <label class="help-inline">如果不填，则默认转发文章标题</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">内容</label>

                            <div class="col-md-11">
                                <textarea class="input-block-level" id="summernote" name="content" rows="18"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">链接</label>

                            <div class="col-md-11">
                                <input name="url" class="form-control  input-inline input-xlarge">
                                <label class="help-inline">除非该内容是直接链接到其他网页，否则不需要填写，文章内容和链接只需要在一处填写</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">开始日期</label>

                            <div class="col-md-11">
                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd"
                                     data-date-start-date="+0d">
                                    <input type="text" class="form-control" readonly name="startdate">
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i>
                                                </button>
												</span>
                                </div>
                                <span class="help-inline">如果不选默认马上生效</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">结束日期</label>

                            <div class="col-md-11">
                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd"
                                     data-date-start-date="+0d">
                                    <input type="text" class="form-control input-inline" name="enddate" readonly>
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i>
                                                </button>
												</span>
                                </div>
                                <span class="help-inline">如果不选默认永久有效</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">排序</label>

                            <div class="col-md-11">
                                <select name="priority" class="form-control input-medium select2me"
                                        data-placeholder="Select...">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">

                            <label class="control-label col-md-1">是否需要审核</label>

                            <div class="col-md-11">

                                <label class="checkbox">

                                    <input type="checkbox" name="audit" id="audit" value="yes"/>
                                    <span class="help-inline">如果勾选，则需审核后发布。</span>
                                </label>


                            </div>

                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-1">是否关注显示</label>

                            <div class="col-md-11">

                                <label class="checkbox">

                                    <input type="checkbox" name="focus" id="focus" value="yes"/>
                                    <span class="help-inline">如果勾选，则客人关注时接收到此条信息。</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-1">是否允许复制</label>

                            <div class="col-md-11">

                                <label class="checkbox">

                                    <input type="checkbox" name="allow_copy" value="yes"/>
                                    <span class="help-inline">如果勾选，则允许所有市场人员复制修改。</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">是否在底部显示二维码</label>

                            <div class="col-md-11">

                                <label class="checkbox">

                                    <input type="checkbox" name="show_qr" value="yes"/>
                                    <span class="help-inline">如果勾选，则允许所有市场人员复制修改。</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">是否属于市场</label>

                            <div class="col-md-4">

                                <input type="hidden" name="marketid" id="select2_sample5"
                                       class="form-control select2" value="全部显示">


                            </div>
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

                    <?php echo Form::close(); ?>

                </div>
            </div>
            <!-- END PORTLET-->
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
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script src="<?php echo e(asset('lib/summernote.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/lang/summernote-zh-CN.js')); ?>"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    <script src="<?php echo e(asset('lib/bootstrap-tagsinput.min.js')); ?>"
            type="text/javascript"></script>

    <!--日历-->
    <script type="text/javascript"
            src="<?php echo e(asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/pages/scripts/components-pickers.js')); ?>"></script>


    <!--上传-->
    <script src="<?php echo e(asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')); ?>"></script>


    <!--下拉框-->
    <script src="<?php echo e(asset('assets/admin/pages/scripts/components-dropdowns.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('init'); ?>
    ComponentsPickers.init();
    $('#summernote').summernote({
    lang:'zh-CN',
    width:800,
    height: 500,                 // set editor height
    minHeight: null,             // set minimum height of editor
    maxHeight: null,             // set maximum height of editor
    focus: true                  // set focus to editable area after initializing summernote

    });

    var postForm = function() {
    var content = $('textarea[name="content"]').html($('#summernote').code());
    }
    ComponentsDropdowns.init();


<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script>

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('control.blade.data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>