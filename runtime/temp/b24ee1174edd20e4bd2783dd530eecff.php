<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"F:\xampp\htdocs\chzu\public/../application/xt\view\html\admin_code.html";i:1566890091;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>基础代码管理</title>
    <link rel="stylesheet" type="text/css" href="/chzu/public/static/lib/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/chzu/public/static/css/xadmin.css">
    <link rel="stylesheet" type="text/css" href="/chzu/public/static/css/font.css">
    <script src="/chzu/public/static/js/jquery.min.js"></script>
    <script src="/chzu/public/static/js/xadmin.js"></script>
</head>
<body>
<!--树状结构,双击进入下一级.-->
<!--按钮: 新增 编辑 删除.-->
<form class="layui-form">
    <div class="layui-form-item" style="margin-top: 17px;margin-left: 14px;">
        <div class="layui-input-inline">
            <input type="text" id="codename" name="" placeholder="请输入代码名称" autocomplete="off" class="layui-input">
        </div>
        <button class="layui-btn" type="button" id="search">查询</button>
    </div>
</form>
<xblock>
    <button class="layui-btn" onclick="x_admin_show('新增基础代码信息','adminCodeAdd')"><i
            class="layui-icon"></i>新增基础代码信息
    </button>
</xblock>
<!--表格引用-->
<table class="layui-table layui-form" id="tree-table" lay-filter="table1"></table>
<script src="/chzu/public/static/lib/layui/layui.js"></script>
<script type="text/javascript">
    layui.use(['element', 'form'], function () {
        element = layui.element;
        form = layui.form;

    });
    layui.config({
        base: '/chzu/public/static/css/module/'
    }).extend({
        treetable: 'treetable-lay/treetable'
    }).use(['layer', 'table', 'treetable'], function () {
        var $ = layui.jquery;
        var table = layui.table;
        var layer = layui.layer;
        var treetable = layui.treetable;
        //        每行后面的操作栏功能实现
        table.on('tool(table1)', function (obj) { //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
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
                        url: "/chzu/public/xt/baseCodes/" + data['key_id'],
                        data: {
                            '_method': 'delete'
                        },
                        type: "post",
                        dataType: 'json',
                        success: function (data) {
                            if (data.code == 200) {
                                layer.msg("删除成功");
                                obj.del();//删除对应行（tr）的DOM结构，并更新缓存
//                                location.reload();
                            } else {
                                layer.msg("删除失败，存在下级数据");
                            }
                        }
                    })
                });
            } else if (layEvent === 'edit') { //编辑
                console.log(data);
                json = JSON.stringify(data);
                console.log(json)
                layer.open({
                    title: '编辑基础代码信息',
                    type: 2,
                    shade: false,
                    maxmin: true,
                    shade: 0.5,
                    area: ['50%', '90%'],
                    content: 'adminCodeEdit',
                    zIndex: layer.zIndex,
                    success: function (layero, index) {
                        var body = layui.layer.getChildFrame('body', index);
                    },
                    end: function () {
                    }
                });
            }
        });

        // 渲染树形表格
        function renderTable1() {
            var getName = $('#codename').val();
            var tableReload = treetable.render({
                treeColIndex: 1,
                treeSpid: 0,
                treeIdName: 'key_id',
                treePidName: 'parent_id',
                treeDefaultClose: true,
                treeLinkage: false,
                elem: '#tree-table',
                url: "/chzu/public/xt/baseCodes/" + getName,
                page: false,
                response: {
                    statusCode: 200 //规定成功的状态码，默认：0
//                    , countName: 'count' //规定数据总数的字段名称，默认：count
                    , dataName: 'data' //规定数据列表的字段名称，默认：data
                },
                cols: [[
                    {type: 'numbers'},
                    {field: 'key_id', title: 'ID'},
                    {field: 'name', title: '基础代码名'},
                    {field: 'flag', title: '代码类型'},
                    {field: 'level', title: '排序'},
                    {fixed: 'right', title: '操作', align: 'center', toolbar: '#barDemo'}
                ]]
            });
        }

        renderTable1();

        // 搜索按钮点击事件 根据输入内容突出显示符合条件的文本
        $('#search').click(function reload() {
            var keyword = $('#codename').val();
            var $tds = $('#tree-table').next('.treeTable').find('.layui-table-body tbody tr td');
            if (!keyword) {
                $tds.css('background-color', 'transparent');
                layer.msg("请输入关键字", {icon: 5});
                return;
            }
            var searchCount = 0;
            $tds.each(function () {
                $(this).css('background-color', 'transparent');
                if ($(this).text().indexOf(keyword) >= 0) {
                    $(this).css('background-color', 'rgba(250,230,160,0.5)');
                    if (searchCount == 0) {
                        $('body,html').stop(true);//火狐 ie不支持body,谷歌支持的是body，所以为了兼容写body和html   stop()方法停止当前正在运行的动画
                        $('body,html').animate({scrollTop: $(this).offset().top - 150}, 500);
                    }
                    searchCount++;
                }
            });
            if (searchCount == 0) {
                layer.msg("没有匹配结果", {icon: 5});
            } else {
                treetable.expandAll('#tree-table');
            }
        });

        //    添加回车事件，输入后，按回车即可查询
        document.onkeydown=function(event) {
            e = event ? event :(window.event ? window.event : null);
            if(e.keyCode==13){
//执行的方法
//            alert('回车检测到了');
                var keyword = $('#codename').val();
                var $tds = $('#tree-table').next('.treeTable').find('.layui-table-body tbody tr td');
                if (!keyword) {
                    $tds.css('background-color', 'transparent');
                    layer.msg("请输入关键字", {icon: 5});
                    return;
                }
                var searchCount = 0;
                $tds.each(function () {
                    $(this).css('background-color', 'transparent');
                    if ($(this).text().indexOf(keyword) >= 0) {
                        $(this).css('background-color', 'rgba(250,230,160,0.5)');
                        if (searchCount == 0) {
                            $('body,html').stop(true);//火狐 ie不支持body,谷歌支持的是body，所以为了兼容写body和html   stop()方法停止当前正在运行的动画
                            $('body,html').animate({scrollTop: $(this).offset().top - 150}, 500);
                        }
                        searchCount++;
                    }
                });
                if (searchCount == 0) {
                    layer.msg("没有匹配结果", {icon: 5});
                } else {
                    treetable.expandAll('#tree-table');
                }
                return false;
            }
        }
    });
</script>

<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>

</body>
</html>