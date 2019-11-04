<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"F:\xampp\htdocs\chzu\public/../application/index\view\html\certificate_list.html";i:1567390902;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>专家资格证书管理</title>
    <link rel="stylesheet" type="text/css" href="/chzu/public/static/css/xadmin.css">
    <link rel="stylesheet" type="text/css" href="/chzu/public/static/css/font.css">
    <script src="/chzu/public/static/js/jquery.min.js"></script>
    <script src="/chzu/public/static/lib/layui/layui.js"></script>
    <script src="/chzu/public/static/js/xadmin.js"></script>
    <style type="text/css">
        .laytable-cell-1-image {
            height: 100%;
            max-width: 100%;
        }

        .layui-table-cell {
            text-align: center;
            height: auto;
            white-space: normal;
        }
    </style>
</head>
<body>
<div class="x-body">
    <div class="layui-form layui-form-pane">
        <div class="layui-form-item pane" style="margin-left: 253px;">
            <label class="layui-form-label">
                专家姓名：
            </label>
            <div class="layui-input-inline">
                <select id="name" lay-filter="expertname" lay-search>
                    <option value="" selected>全部资格证书</option>
                </select>
            </div>
            <label class="layui-form-label" style="width: 131px;">
                专家从事专业：
            </label>
            <div class="layui-input-inline">
                <select id="fk_code_major_id" lay-filter="profession" lay-search>
                    <option value="" selected>全部资格证书</option>
                </select>
            </div>
        </div>
    </div>
    <xblock>
        <button class="layui-btn" onclick="x_admin_show('添加资格证书信息','certificateAdd')"><i
                class="layui-icon"></i>添加资格证书
        </button>
    </xblock>


    <table class="layui-table" id="demo" lay-filter="user"/>

</div>

<script type="text/javascript">
    var expert_info_id = '';
    /**
     * 初始渲染
     */
    $(document).ready(function () {
        getTable();
    });
    /**
     * 根据专家不同重载表格
     */
    layui.use('form', function () {
        var form = layui.form;
        form.on('select(expertname)', function (data) {
            expert_info_id = data.value;
            getTable();
        })
    });

    /**
     * 根据专业不同重载表格
     */
    layui.use('form', function () {
        var form = layui.form;
        form.on('select(profession)', function (data) {
            type = data.value;
            getTable1();
        })
    });
    /**
     * 获取表格信息
     */
    function getTable() {
        layui.use('table', function () {
            var table = layui.table,
                    $ = layui.jquery;
            //第一个实例
            var demoIns = table.render({
                elem: '#demo'
                ,
                method: 'Get'
                ,
                even: true,
                contentType: 'json',
                url: '/chzu/public/experCertificate?expert_info_id=' + expert_info_id
                ,
                page: true,
                limits: [5, 10, 15, 20], //显示
                limit: 10,//每页默认显示的数量
//                async: true
                id: 'demoTable'/* 重载表格时要用到的id ,最好别和标签的id一样*/
                ,
                response: {
                    statusName: 'code',
                    statusCode: 200 //规定成功的状态码，默认：0
                    , countName: 'count' //规定数据总数的字段名称，默认：count
                    , dataName: 'data' //规定数据列表的字段名称，默认：data
                    , msgName: 'msg'
                }
                ,
                parseData: function (res) { //res 即为原始返回的数据
                    return {
                        "code": res.code, //解析接口状态
                        "msg": res.msg, //解析提示文本
                        "count": res.count, //解析数据长度
                        "data": res.data //解析数据列表
                    }
                }
                ,
                cols: [[ //表头
                    {field: 'key_id', title: 'ID', sort: true, width: 60}
                    , {field: 'name', title: '证书名称'}
                    , {field: 'sort', title: '证书排序'}
                    , {field: 'code', title: '证书编号', sort: true}
                    , {field: 'fk_expert_info_id', title: '所属专家ID'}
                    , {field: 'fk_expert_info_name', title: '所属专家姓名'}
                    , {
                        field: 'image',
                        title: '资格证书图片',
                        templet: '<div><img src="/chzu/public/{{d.image}}" onclick="previewImg(this)" style="cursor: pointer;"></div>'
                    }
                    , {title: '操作', align: 'center', toolbar: '#barDemo'}
                ]]
            });

            //        每行后面的操作栏功能实现
            table.on('tool(user)', function (obj) { //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
                var data = obj.data; //获得当前行数据
                console.log(data);
                var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
                var tr = obj.tr; //获得当前行 tr 的DOM对象
                var checkStatus = table.checkStatus('demo');
                if (layEvent === 'del') { //删除
                    layer.confirm('确定要删除吗？', function (index) {
                        layer.close(index);
                        //向服务端发送删除指令
                        $.ajax({
                            url: "/chzu/public/experCertificate/" + data['key_id'],
                            data: {
                                '_method': 'delete'
                            },
                            type: "post",
                            dataType: 'json',
                            success: function (data) {
                                if (data.code == 200) {
                                    obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                                    console.log(data)
                                    layer.msg("删除成功");
                                } else {
                                    layer.msg("删除失败");
                                }
                            }
                        })
                    });
                } else if (layEvent === 'edit') { //编辑
                    console.log(data);
                    json = JSON.stringify(data);
                    console.log(json)
                    layer.open({
                        title: '编辑资格证书信息',
                        type: 2,
                        shade: false,
                        maxmin: true,
                        shade: 0.5,
                        scrollbar: false,   //阻止屏幕滚动条滚动
                        area: ['70%', '90%'],
                        content: 'certificateEdit',
                        zIndex: layer.zIndex,
                        success: function (layero, index) {
                            var body = layui.layer.getChildFrame('body', index);
                        }
                    });
                }
            });

        })
    }

    function getTable1() {
        layui.use('table', function () {
            var table = layui.table,
                    $ = layui.jquery;
            //第一个实例
            var demoIns = table.render({
                elem: '#demo'
                ,
                method: 'Get'
                ,
                even: true,
                contentType: 'json',
                url: '/chzu/public/experCertificate/major?type=' + type
                ,
                page: true,
                limits: [5, 10, 15, 20], //显示
                limit: 10,//每页默认显示的数量
//                async: true
                id: 'demoTable'/* 重载表格时要用到的id ,最好别和标签的id一样*/
                ,
                response: {
                    statusName: 'code',
                    statusCode: 200 //规定成功的状态码，默认：0
                    , countName: 'count' //规定数据总数的字段名称，默认：count
                    , dataName: 'data' //规定数据列表的字段名称，默认：data
                    , msgName: 'msg'
                }
                ,
                parseData: function (res) { //res 即为原始返回的数据
                    return {
                        "code": res.code, //解析接口状态
                        "msg": res.msg, //解析提示文本
                        "count": res.count, //解析数据长度
                        "data": res.data //解析数据列表
                    }
                }
                ,
                cols: [[ //表头
                    {field: 'key_id', title: 'ID', sort: true, width: 60}
                    , {field: 'name', title: '证书名称'}
                    , {field: 'sort', title: '证书排序'}
                    , {field: 'code', title: '证书编号', sort: true}
                    , {field: 'fk_expert_info_id', title: '所属专家ID'}
                    , {field: 'fk_expert_info_name', title: '所属专家姓名'}
                    , {
                        field: 'image',
                        title: '资格证书图片',
                        templet: '<div><img src="/chzu/public/{{d.image}}" onclick="previewImg(this)" style="cursor: pointer;"></div>'
                    }
                    , {title: '操作', align: 'center', toolbar: '#barDemo'}
                ]]
            });
        })
    }

    /**
     * 点击放大图片
     */
    function previewImg(obj) {
        var img = new Image();
        img.src = obj.src;
        var height = img.height + 50; //获取图片高度
        var width = img.width; //获取图片宽度
        var imgHtml = "<img src='" + obj.src + "' width='700px' height='500px'/>";
        //弹出层
        layer.open({
            type: 1,
            shade: 0.8,
            offset: 'auto',
            area: [700 + 'px', 550 + 'px'],
            shadeClose: true,//点击外围关闭弹窗
            scrollbar: false,//不现实滚动条
            title: "图片预览", //不显示标题
            content: imgHtml, //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
            cancel: function () {
                //layer.msg('捕获就是从页面已经存在的元素上，包裹layer的结构', { time: 5000, icon: 6 });
            }
        });
    }

    /**
     * 初始化Form渲染，以便获取下拉框的值
     */
    function renderFrom() {
        layui.use('form', function () {
            var form = layui.form;
            form.render();
        })
    }
    /**
     * 表单中带下拉框的内容查询
     */
    layui.use(['form'], function () {
        var form = layui.form;
        var $ = layui.jquery;
        $(function () {
//                    从数据库获取专家信息名称填入到下拉框中
            var str = '';
            $.ajax({
                type: "GET",
                url: "/chzu/public/experInfo",
                data: {},
                dataType: "json",
                success: function (data) {
                    var da = data.data;
                    $.each(da, function (i, json) {
                        var $option = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
                        $("#name").append($option);
                        renderFrom();
                    });
                }
            });
        })

        /**
         * 从数据库获取从事专业填入到从事专业下拉框中
         */
        $.ajax({
            type: "GET",
            url: "/chzu/public/xt/baseCodes/?flag=major&level=1",
            data: {},
            dataType: "json",
            success: function (data) {
                var da = data.data;
                $.each(da, function (i, json) {
                    var $option = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
                    $("#fk_code_major_id").append($option);
                    renderFrom();
                });
            }
        });
    })


</script>
<script type="text/html" id="barDemo">
    <!--<a class="layui-btn layui-btn-xs" lay-event="detail" style="background-color: #dddddd;color: black;">查看</a>-->
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
</body>
</html>