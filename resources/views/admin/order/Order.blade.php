
@extends('admin.layouts.app')

@section('pageTitle','维护派单系统—工单统计')

@section('pageStyle')

@stop

@section('pageScript')
    <script src="//cdn.bootcss.com/axios/0.18.0/axios.min.js"></script>
    <script src="/admin/js/echarts.js"></script>
    <script>
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
        option = {
            title : {
                text: '维护派单系统任务统计',
                x:'center'
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                left: 'left',
                data: ['工单完成量','工单未完成量','工单总量']
            },
            series : [
                {
                    name: '访问来源',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:[
                        {value:33, name:'工单完成量'},
                        {value:31, name:'工单未完成量'},
                        {value:88, name:'工单总量'},
                    ],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
@stop

@section('pageContent')
    <body class="skin-blue sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper" id="list" style="min-height: 976px; background-color: #ecf0f5;
            display: block">
    <div id="main" style="width: 100%;height:600px;background-color: white" ></div>
        </div>
    </div>
    </body>
@stop


