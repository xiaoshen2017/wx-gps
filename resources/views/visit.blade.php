@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                 @if (session('tips'))
                    @if(session('tips')['status'])
                        <div class="alert alert-success">
                    @else
                        <div class="alert alert-danger">
                    @endif
                            {{ session('tips')['message'] }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <script>
                        setTimeout(function () {
                            $(".alert").alert('close');
                        }, 2000);
                    </script>
                @endif

                <div class="card">
                    <div class="card-header"><span class="float-left">会员中心</span><a class="float-right" href="javascript:void(0)" onclick="history.back();">返回</a></div>

                    <div class="card-body">
                        欢迎您的回来，如有需要授权码，请联系代理商！
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">定位中心 > 定位链接 > 定位记录 > 公共详情</div>

                    <div class="card-body">
                        <p><strong>IP地址：</strong><span class="text-danger">{{$visit->ip}}</span></p>
                        <p>
                            <strong>运营商：</strong>
                            <span class="text-danger">
                                @if(isset($visit->location['message']))
                                    获取失败，该IP地址可能为私有IP
                                @else
                                    {{$visit->service}}
                                @endif
                            </span>
                        </p>
                        <p><strong>UA信息：</strong><span class="text-danger">{{$visit->user_agent}}</span></p>
                    </div>
                </div>
                @if($visit->auth_data)
                <div class="card mt-4">
                    <div class="card-header">定位中心 > 定位链接 > 定位记录 > 腾讯定位</div>

                    <div class="card-body">

                        <p>
                            <strong>经度：</strong>
                            <span class="text-danger">
                                @if(isset($visit->auth_data->longitude))
                                    {{$visit->auth_data->longitude}}
                                @else
                                    未能获取
                                @endif
                            </span>
                        </p>
                        <p>
                            <strong>纬度：</strong>
                            <span class="text-danger">
                                @if(isset($visit->auth_data->latitude))
                                    {{$visit->auth_data->latitude}}
                                @else
                                    未能获取
                                @endif
                            </span>
                        </p>
                        <p>
                            <strong>移动速度：</strong>
                            <span class="text-danger">
                                @if(isset($visit->auth_data->speed) && $visit->auth_data->speed > -1)
                                    {{$visit->auth_data->speed}} 米
                                @else
                                    静止状态
                                @endif
                            </span>
                        </p>
                        <p>
                            <strong>准确度：</strong>
                            <span class="text-danger">
                                @if(isset($visit->auth_data->accuracy))
                                    {{$visit->auth_data->accuracy}}%
                                @else
                                    未能获取
                                @endif
                            </span>
                        </p>
                    </div>
                </div>
                @endif
                <div class="card mt-4">
                    <div class="card-header">定位中心 > 定位链接 > 定位记录 > 百度定位</div>

                    <div class="card-body">
                        <p>
                            <strong>IP位置：</strong>
                            <span class="text-danger">
                                @if(isset($visit->location['message']))
                                    定位失败，该IP地址可能为私有IP
                                @else
                                    {{$visit->location['content']['address_detail']['province']}}{{$visit->location['content']['address_detail']['city']}}{{$visit->location['content']['address_detail']['district']}}{{$visit->location['content']['address_detail']['street']}}{{$visit->location['content']['address_detail']['street_number']}}
                                @endif
                            </span>
                        </p>
                        @if(!isset($visit->location['message']))
                            <p><strong>坐标信息：</strong><span class="text-danger">{{$visit->location['content']['point']['x']}},{{$visit->location['content']['point']['y']}}</span></p>
                            <iframe style="width:100%;height:300px" frameborder="0" src="{{ url('/visit/map/'  . $visit->location['content']['point']['x'] .  '/' . $visit->location['content']['point']['y']) }}"></iframe>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
