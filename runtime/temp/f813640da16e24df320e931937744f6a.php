<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"F:\xampp\htdocs\chzu\public/../application/index\view\html\expert_analysis.html";i:1567648967;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>专家信息统计分析</title>
    <link rel="stylesheet" type="text/css" href="/chzu/public/static/css/xadmin.css">
    <link rel="stylesheet" type="text/css" href="/chzu/public/static/css/font.css">
</head>
<body>
<!--包含内容:-->
<!--职称统计分析,性别统计分析,年龄段统计分析,所属行业统计分析,从事专业统计分析,地区统计分析-->
<div class="x-body">
    <blockquote class="layui-elem-quote">
        <span id="title"></span>
    </blockquote>
    <select id="analysisType" style="width: 200px;height:50px;font-size:20px;" onchange="change_analysis()">
        <!--<option selected value=0>职称</option>-->
        <option value=1 selected>性别</option>
        <option value=2>年龄</option>
        <option value=3>行业</option>
        <option value=4>专业</option>
        <option value=5>地区</option>
    </select>
    <div id="main" style="width: 600px;height:400px;margin: auto"></div>
</div>
<script src="https://cdn.bootcss.com/echarts/3.7.0/echarts.min.js"></script>
<script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
<script src="/chzu/public/static/js/bmap.min.js" type="text/javascript"></script>
<script type="text/javascript">
    change_analysis();

    function change_analysis() {
        var type = $("#analysisType").val();
//    console.log(type);
        expert_analysis(type);
    }

    function expert_analysis(type) {
//    var echart_body=$("#main");
        $.ajax({
            url: '/chzu/public/analysis',
            type: "get",
            dataType: "json",
            data: {
                type: type
            },
            success: function (res) {
                var title=document.getElementById("title");
                title.innerHTML=res.msg+"统计分析";
                var key = [];
                var val = [];
                var j = 0;
                for (var i in res.data) {
                    key[j] = i;
                    val[j] = res.data[i];
                    j++;
                }

                var myChart = echarts.init(document.getElementById('main'));
                myChart.clear();//清空绘画内容，清空后实例可用，因为并非释放示例的资源，释放资源我们需要dispose()
                var option;
                if (type == 1 || type == 2) {
                    var servicedata = [];
                    for (var i = 0; i < val.length; i++) {
                        var obj = new Object();
                        obj.name = key[i];
                        servicedata[i] = obj;
                    }
//           指定图表的配置项和数据
                    option = {
                        title: {
                            text: '专家信息统计分析'
                        },
                        tooltip: {},
                        legend: {
                            data: servicedata
                        },
                        xAxis: {
                            data: key
                        },
                        yAxis: {},
                        series: [{
                            name: res.msg,
                            type: 'bar',
                            barMaxWidth: '30%',
                            data: val
                        }]
                    };
                }

                if (type == 0 || type == 3 || type == 4 || type == 5) {
                    var servicedata = [];
                    for (var i = 0; i < val.length; i++) {
                        var obj = new Object();
                        obj.name = key[i];
                        obj.value = val[i];
                        servicedata[i] = obj;
                    }
                    option = {
                        legend: {
                            data: servicedata
                        },
                        series: [{
                            name: res.msg,
                            type: 'pie',
                            radius: '55%',
                            data: servicedata,
                            labelLine: {
                                normal: {
                                    show: true,
                                }
                            }
                        }],
                        tooltip: {
                            // trigger 设置触发类型，默认数据触发，可选值：'item' ¦ 'axis'
                            trigger: 'item',
                            showDelay: 20,   // 显示延迟，添加显示延迟可以避免频繁切换，单位ms
                            hideDelay: 20,   // 隐藏延迟，单位ms
                            backgroundColor: 'rgba(255,255,255,0.7)',  // 提示框背景颜色
                            textStyle: {
                                fontSize: '16px',
                                color: '#000'  // 设置文本颜色 默认#FFF
                            },
                            // formatter设置提示框显示内容
                            // {a}指series.name  {b}指series.data的name
                            // {c}指series.data的value  {d}%指这一部分占总数的百分比
                            formatter: '{a} <br/>{b} : {c}位 ({d}%)'
                        },
                    };

                }

                // 使用刚指定的配置项和数据显示图表。
                myChart.setOption(option);
            },
            error: function () {
                console.log('数据获取失败');
            }
        })
    }
    ;
</script>
</body>
</html>