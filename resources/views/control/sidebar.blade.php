<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                <form class="sidebar-search "
                      action="#"
                      method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>

                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
							<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
							</span>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>


            @if (Session::get('managelevel')=='2')
                <li class="tooltips" data-container="body" data-placement="right" data-html="true"
                    data-original-title="公告牌">
                    <a href="index">
                        <i class="icon-home"></i>
					<span class="title">
					公告牌 </span>
                    </a>
                </li>
                <!-- START MARKET MENU -->
                <li class="heading">
                    <h3 class="uppercase">Features</h3>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="icon-settings"></i>
                        <span class="title">文章管理</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="articlelist">
                                文章列表</a>
                        </li>
                        <li>
                            <a href="articleadd">
                                添加文章</a>
                        </li>
                    </ul>
                </li>
                <!-- END MARKET MENU-->
                @endif
            @if (Session::get('managelevel')=='4')
                <li class="tooltips" data-container="body" data-placement="right" data-html="true"
                    data-original-title="公告牌">
                    <a href="index">
                        <i class="icon-home"></i>
					<span class="title">
					公告牌 </span>
                    </a>
                </li>
                <!-- START MARKET MENU -->
                <li class="heading">
                    <h3 class="uppercase">Features</h3>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="icon-settings"></i>
                        <span class="title">文章管理</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="articlelist">
                                文章列表</a>
                        </li>
                        <li>
                            <a href="articleadd">
                                添加文章</a>
                        </li>
                    </ul>
                <li>
                    <a href="javascript:;">
                        <i class="icon-feed"></i>
                        <span class="title">景区相关</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="#">
                                景区管理</a>
                        </li>
                        <li>
                            <a href="showlist">
                                演艺秀管理</a>
                        </li>
                        <li>
                            <a href="pushproject">
                                演艺秀时间</a>
                        </li>
                    </ul>
                </li>
                </li>
                <!-- END MARKET MENU-->
                @endif
                @if (Session::get('managelevel')=='3')
                        <!-- BEGIN ANGULARJS LINK -->
                <li class="tooltips" data-container="body" data-placement="right" data-html="true"
                    data-original-title="公告牌">
                    <a href="index">
                        <i class="icon-home"></i>
					<span class="title">
					公告牌 </span>
                    </a>
                </li>
                <!-- END ANGULARJS LINK -->
                <!-- START MANGER MENU -->
                <li class="heading">
                    <h3 class="uppercase">Features</h3>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="icon-settings"></i>
                        <span class="title">文章管理</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="articlelist">
                                文章列表</a>
                        </li>
                        <li>
                            <a href="articleadd">
                                添加文章</a>
                        </li>
                        {{--                  <li>
                                              <a href="form_layouts.html">
                                                  Form Layouts</a>
                                          </li>
                                          <li>
                                              <a href="form_editable.html">
                                                  <span class="badge badge-roundless badge-warning">new</span>Form X-editable</a>
                                          </li>
                                          <li>
                                              <a href="form_wizard.html">
                                                  Form Wizard</a>
                                          </li>
                                          <li>
                                              <a href="form_validation.html">
                                                  Form Validation</a>
                                          </li>
                                          <li>
                                              <a href="form_image_crop.html">
                                                  <span class="badge badge-roundless badge-danger">new</span>Image Cropping</a>
                                          </li>
                                          <li>
                                              <a href="form_fileupload.html">
                                                  Multiple File Upload</a>
                                          </li>
                                          <li>
                                              <a href="form_dropzone.html">
                                                  Dropzone File Upload</a>
                                          </li>--}}
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="icon-book-open"></i>
                        <span class="title">回复管理</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="requesttxt">
                                文字回复</a>
                        </li>
                        <li>
                            <a href="requestvoice">
                                语音回复</a>
                        </li>
                        <li>
                            <a href="#">
                                图片回复</a>
                        </li>
                        <li>
                            <a href="request_se">
                                二次回复</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="icon-briefcase"></i>
                        <span class="title">数据统计</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="ordercount">

                                <span class="title">订单管理</span>
                            </a>
                        </li>

                        <li>
                            <a href="countmarket">
                                市场数据</a>
                        </li>
                        <li>
                            <a href="menuclickcount">
                                菜单点击数</a>
                        </li>
                        {{--          <li>
                                     <a href="table_managed.html">
                                         Managed Datatables</a>
                                 </li>
                                 <li>
                                     <a href="table_editable.html">
                                         Editable Datatables</a>
                                 </li>

                                 <li>
                                     <a href="table_ajax.html">
                                         Ajax Datatables</a>
                                 </li>--}}
                    </ul>
                </li>

                <li>
                    <a href="javascript:;">
                        <i class="icon-frame"></i>
                        <span class="title">二维码管理</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <?php
                        $rows = DB::table('wx_qrscene_class')
                                ->get();
                        foreach ($rows as $row) {
                            echo "<li><a href='qrlist?classid=" . $row->classid . "'>" . $row->class_name . "</a></li>";
                        }
                        ?>
                        <li>
                            <a href="qrtemp">
                                临时</a>
                        </li>
                        <li>
                            <a href="qradd">
                                登记二维码</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="icon-feed"></i>
                        <span class="title">景区相关</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="#">
                                景区管理</a>
                        </li>
                        <li>
                            <a href="showlist">
                                演艺秀管理</a>
                        </li>
                        <li>
                            <a href="pushproject">
                                演艺秀时间</a>
                        </li>
                    </ul>
                </li>

                {{--<li>
                    <a href="ordercount">
                        <i class="icon-present"></i>
                        <span class="title">订单管理</span>
                    </a>
                </li>--}}
                <li>
                    <a href="#">
                        <i class="icon-wallet"></i>
                        <span class="title">卡券管理</span>
                    </a>
                </li>
                <!--
                <li>
                    <a href="message">
                        <i class="icon-bubbles"></i>
                        <span class="title">消息管理</span>
                    </a>
                </li>
    -->
                <li>
                    <a href="javascript:;">
                        <i class="icon-notebook"></i>
                        <span class="title">其他 </span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="menulist">
                                菜单查询</a>
                        </li>
                        <li>
                            <a href="tag">
                                标签管理</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="icon-notebook"></i>
                        <span class="title">企业号管理 </span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="tglm">
                                推广联盟</a>
                        </li>
                        <li>
                            <a href="tglm?action=add">
                                登记企业号账号</a>
                        </li>
                    </ul>
                </li>
                <!-- END MARKET MENU -->
            @endif
            <li>
                <a href="changpassword">
                    <i class="icon-equalizer"></i>
                    <span class="title">修改密码</span>
                </a>
            </li>
            <li>
                <a href="logout">
                    <i class="icon-key"></i>
                    <span class="title">退出</span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<!-- END SIDEBAR -->
<!-- END SIDEBAR -->