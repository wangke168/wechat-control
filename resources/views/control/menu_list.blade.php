@extends('control.blade.data')

@section('title', '横店圆明新园微信管理平台－－－菜单管理')

@section('css')

    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/global/plugins/jquery-nestable/jquery.nestable.css')}}"/>
@stop

@section('page-menu-title', '菜单管理')



@section('page-bar')
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
@stop

@section('content')




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

                            @if($menus->menu)
                            @foreach ($menus->menu['button'] as  $key=> $menu)


                                <li class="dd-item dd3-item" data-id="15">
                                    <div class="dd-handle dd3-handle">
                                    </div>
                                    <div class="dd3-content">
                                        {!! $menu['name'] !!}
                                    </div>
                                    <ol class="dd-list">
                                        @foreach ($menu['sub_button'] as $key=>$menu_name)
                                            <li class="dd-item dd3-item" data-id="16">
                                                <div class="dd-handle dd3-handle">
                                                </div>
                                                <div class="dd3-content">
                                                    {!! $menu_name['name'] !!}
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                </li>
                            @endforeach
                                @endif
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @if($menus->conditionalmenu)
        @foreach($menus['conditionalmenu'] as $key=> $menu)
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

                                @foreach ($menu['button'] as $key=>$menu_button)


                                    <li class="dd-item dd3-item" data-id="15">
                                        <div class="dd-handle dd3-handle">
                                        </div>
                                        <div class="dd3-content">
                                            {!! $menu_button['name'] !!}
                                        </div>
                                        <ol class="dd-list">
                                            @foreach ($menu_button['sub_button'] as $menu_name)
                                                <li class="dd-item dd3-item" data-id="16">
                                                    <div class="dd-handle dd3-handle">
                                                    </div>
                                                    <div class="dd3-content">
                                                        {!! $menu_name['name'] !!}
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
            @endif
    </div>



@stop

@section('js')

    <script src="{{asset('assets/global/plugins/jquery-nestable/jquery.nestable.js')}}"></script>
@stop

@section('init')
    UINestable.init();
@stop

