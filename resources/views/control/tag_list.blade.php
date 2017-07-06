@extends('control.blade.data')

@section('title', '横店圆明新园微信管理平台－－－菜单管理')

@section('css')

    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/global/plugins/jquery-nestable/jquery.nestable.css')}}"/>
@stop

@section('page-menu-title', '标签管理')



@section('page-bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">标签管理</a>
            </li>
        </ul>

    </div>
@stop

@section('content')




    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-comments"></i>标签列表
                    </div>
                </div>
                <div class="portlet-body">
                    <ul class="nav">

                        <button type="button" class="btn btn-success"
                                onclick="javascript:window.location.href='tag?action=add';">添加标签(Tag)
                        </button>

                    </ul>

                    <div class="row">
                        @foreach ($tags as  $key=> $tag)
                            <div class="col-md-3">

                                <div class="portlet-body">
                                    <div class="dd" id="nestable_list_3">
                                        <ol class="dd-list">

                                            @for($j=0;$j<$row;$j++)
                                                <li class="dd-item dd3-item" data-id="15">
                                                    <div class="dd-handle dd3-handle">
                                                    </div>
                                                    <a href="tag?action=edit&id=<?php echo $tag[$j]['id'] ?>&tag=<?php echo $tag[$j]['name'] ?>">
                                                        <div class="dd3-content">

                                                            <?php echo '<span class="label label-sm label-success">' . $tag[$j]['id'] . '</span>&nbsp;';
                                                            echo $tag[$j]['name']?>

                                                        </div>
                                                    </a>
                                                </li>
                                            @endfor
                                        </ol>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-3">

                                <div class="portlet-body">
                                    <div class="dd" id="nestable_list_3">
                                        <ol class="dd-list">


                                            {{--                                @foreach($tag as $key=>$tag_detail)--}}
                                            @for($j=$row;$j<($row*2);$j++)
                                                <li class="dd-item dd3-item" data-id="15">
                                                    <div class="dd-handle dd3-handle">
                                                    </div>
                                                    <div class="dd3-content">
                                                        <?php echo '<span class="label label-sm label-success">' . $tag[$j]['id'] . '</span>&nbsp;';
                                                        echo $tag[$j]['name']?>
                                                    </div>

                                                </li>
                                            @endfor
                                            {{--@endforeach--}}


                                        </ol>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-3">

                                <div class="portlet-body">
                                    <div class="dd" id="nestable_list_3">
                                        <ol class="dd-list">


                                            {{--                                @foreach($tag as $key=>$tag_detail)--}}
                                            @for($j=($row*2);$j<($row*3);$j++)
                                                <li class="dd-item dd3-item" data-id="15">
                                                    <div class="dd-handle dd3-handle">
                                                    </div>
                                                    <div class="dd3-content">
                                                        <?php echo '<span class="label label-sm label-success">' . $tag[$j]['id'] . '</span>&nbsp;';
                                                        echo $tag[$j]['name']?>
                                                    </div>

                                                </li>
                                            @endfor
                                            {{--@endforeach--}}


                                        </ol>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-3">

                                <div class="portlet-body">
                                    <div class="dd" id="nestable_list_3">
                                        <ol class="dd-list">


                                            {{--                                @foreach($tag as $key=>$tag_detail)--}}
                                            @for($j=($row*3);$j<$tags_count;$j++)
                                                <li class="dd-item dd3-item" data-id="15">
                                                    <div class="dd-handle dd3-handle">
                                                    </div>
                                                    <div class="dd3-content">
                                                        <?php echo '<span class="label label-sm label-success">' . $tag[$j]['id'] . '</span>&nbsp;';
                                                        echo $tag[$j]['name']?>
                                                    </div>

                                                </li>
                                            @endfor
                                            {{--@endforeach--}}


                                        </ol>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>



@stop

@section('js')

    <script src="{{asset('assets/global/plugins/jquery-nestable/jquery.nestable.js')}}"></script>
@stop

@section('init')
    UINestable.init();
@stop

