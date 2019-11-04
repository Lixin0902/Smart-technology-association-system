<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"F:\xampp\htdocs\chzu\public/../application/index\view\html\expert_info_list.html";i:1569578263;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>专家信息</title>
    <link rel="stylesheet" type="text/css" href="/chzu/public/static/lib/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/chzu/public/static/css/xadmin.css">
    <link rel="stylesheet" type="text/css" href="/chzu/public/static/css/font.css">
    <link rel="stylesheet" type="text/css" href="/chzu/public/static/css/layer.css">
    <style type="text/css">
        body{
            /*position:fixed;*/
            /*top:0;*/
            /*height: 100%;*/
            /*overflow: hidden;*/
        }
        .layui-btn-primary:hover{
            border: 1px solid RGB(66, 184, 241);
        }
        a:hover{
            color: red;!important;
        }
    </style>
</head>

<!--包含内容:-->
<!--专家信息列表, 查询,新增,编辑,删除,导出-->
<body class="form-wrap">
<script src="/chzu/public/static/js/jquery.min.js"></script>
<script src="/chzu/public/static/lib/layui/layui.js"></script>
<script src="/chzu/public/static/js/xadmin.js"></script>
<script type="text/javascript">
    /**
     * 初始渲染
     */
    $(document).ready(function () {
        getTable();
    });
    /**
     * 根据条件查询和渲染表格
     */
    function getTable() {
        var name = $("#name").val();
        var age_min = $('#age_min').val(),
                age_max = $('#age_max').val(),
//                fk_code_title_id = $('#fk_code_title_id').val(),
                fk_code_profession_id = $('#fk_code_profession_id').val(),
                fk_code_major_id = $('#fk_code_major_id').val(),
                is_willing_attend_lectures = $('#is_willing_attend_lectures').val(),
                fk_area_id = $('#area').val(),
                fk_code_gender_id = $('#fk_code_gender_id').val();
        layui.use('table', function () {
            var table = layui.table,
                    $ = layui.jquery;
            //第一个实例
            var demoIns = table.render({
                elem: '#demo'
                ,
                method: 'Get'
                ,
                height: 'full-200'
                ,
                even: true,
                contentType: 'json',
                url: '/chzu/public/experInfo?name=' + name + '&age_min=' + age_min + '&age_max=' + age_max + '&fk_code_gender_id=' + fk_code_gender_id
                + '&fk_code_profession_id=' + fk_code_profession_id + '&fk_code_major_id=' + fk_code_major_id
                + '&is_willing_attend_lectures=' + is_willing_attend_lectures + '&fk_area_id=' + fk_area_id
                ,
                page: true,
                limits: [5, 10, 15,20], //显示
                limit: 10 ,//每页默认显示的数量
//                async: true
                id: 'demoTable'/* 重载表格时要用到的id ,最好别和标签的id一样*/
                ,
                response: {
                    statusName: 'code',
                    statusCode: 200 //规定成功的状态码，默认：0
                    , countName: 'count' //规定数据总数的字段名称，默认：count
                    , dataName: 'data' //规定数据列表的字段名称，默认：data
                    ,msgName: 'msg'
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
                    {checkbox: true, fixed: true}
                    , {field: 'key_id', title: 'ID', sort: true, width: 60}
                    , {field: 'name', title: '姓名'}
                    , {field: 'fk_code_gender_id', title: '性别', sort: true}
                    , {field: 'fk_code_title_id', title: '职称'}
                    , {field: 'age', title: '年龄', sort: true}
                    , {field: 'fk_code_profession_id', title: '所属行业'}
                    , {field: 'fk_code_major_id', title: '从事专业'}
                    , {field: 'is_willing_attend_lectures', title: '是否愿意参加科普讲座'}
                    , {field: 'fk_area_id', title: '所在地区'}
                    , {fixed: 'right', title: '操作', align: 'center', toolbar: '#barDemo', width: 202}
                ]]
            });

            layui.use('layer', function () {
                layer = layui.layer;
            });
//        每行后面的操作栏功能实现
            table.on('tool(user)', function (obj) { //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
                var data = obj.data; //获得当前行数据
                console.log(data);
                var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
                var tr = obj.tr; //获得当前行 tr 的DOM对象
                var checkStatus = table.checkStatus('demo');
//                判断是否为null，为null则显示空
                if (layEvent === 'detail') { //查看
                    if (data.fk_code_bank_type_id == null){
                        data.fk_code_bank_type_id = " ";
                    }
                    if (data.fk_code_politics_status_id == null){
                        data.fk_code_politics_status_id = " ";
                    }
                    if (data.fk_code_highest_degree_id == null){
                        data.fk_code_highest_degree_id = " ";
                    }
                    if (data.fk_code_title_id == null){
                        data.fk_code_title_id = " ";
                    }
                    if (data.fk_code_first_education_id == null){
                        data.fk_code_first_education_id = " ";
                    }
                    if (data.fk_code_highest_education_id == null){
                        data.fk_code_highest_education_id = " ";
                    }
                    if (data.fk_org_id == null){
                        data.fk_org_id = " ";
                    }
                    if (data.qualification == undefined){
                        data.qualification = " ";
                    }
                    if (data.qualification_code == undefined){
                        data.qualification_code = " ";
                    }
                    layer.open({
                        type: 1,
                        title: '详细信息',
                        area: '1000px',
                        content: '<table class="layui-table">' +
                        '<thead>' +
                        '<tr>' +
                        '<th>' + '<b>' + '条件' + '</b>' + '</th>' +
                        '<th>' + '<b>' + '信息' + '</b>' + '</th>' +
                        '<th>' + '<b>' + '条件' + '</b>' + '</th>' +
                        '<th>' + '<b>' + '信息' + '</b>' + '</th>' +
                        '</thead>' +
                        '<tbody>' +
                        '<tr>' +
                        '<td>' + '姓名' + '</td>' +
                        '<td>' + data.name + '</td>' +
                        '<td rowspan="5">' + '个人照片' + '</td>' +
                        '<td rowspan="5"><img src="/chzu/public/' + data.picture + '"></td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>' + '性别' + '</td>' +
                        '<td>' + data.fk_code_gender_id + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>' + '职务' + '</td>' +
                        '<td>' + data.position + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>' + '年龄' + '</td>' +
                        '<td>' + data.age + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>' + '所属行业' + '</td>' +
                        '<td>' + data.fk_code_profession_id + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>' + '移动电话' + '</td>' +
                        '<td>' + data.phone + '</td>' +
                        '<td>' + '从事专业' + '</td>' +
                        '<td>' + data.fk_code_major_id + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>' + '开户行' + '</td>' +
                        '<td>' + data.fk_code_bank_type_id + '</td>' +
                        '<td>' + '银行账户' + '</td>' +
                        '<td>' + data.bank_code + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>' + '证件类型' + '</td>' +
                        '<td>' + data.fk_certificate_type_id + '</td>' +
                        '<td>' + '证件号码' + '</td>' +
                        '<td>' + data.cerificate_code + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>' + '是否为应急专家' + '</td>' +
                        '<td>' + data.is_emergency + '</td>' +
                        '<td>' + '是否愿意参加科普讲座' + '</td>' +
                        '<td>' + data.is_willing_attend_lectures + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>' + '政治面貌' + '</td>' +
                        '<td>' + data.fk_code_politics_status_id + '</td>' +
                        '<td>' + '出生日期' + '</td>' +
                        '<td>' + data.birthday + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>' + '社会保障卡号' + '</td>' +
                        '<td>' + data.social_security_cards_code + '</td>' +
                        '<td>' + '最高学位' + '</td>' +
                        '<td>' + data.fk_code_highest_degree_id + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>' + '职称' + '</td>' +
                        '<td>' + data.fk_code_title_id + '</td>' +
                        '<td>' + '职称证书号' + '</td>' +
                        '<td>' + data.title_certificate_code + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>' + '执业资格' + '</td>' +
                        '<td>' + data.qualification + '</td>' +
                        '<td>' + '执业资格证书编号' + '</td>' +
                        '<td>' + data.qualification_code + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>' + '第一学历' + '</td>' +
                        '<td>' + data.fk_code_first_education_id + '</td>' +
                        '<td>' + '第一学历毕业院校及专业' + '</td>' +
                        '<td>' + data.first_graduate_school_and_major + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>' + '最高学历' + '</td>' +
                        '<td>' + data.fk_code_highest_education_id + '</td>' +
                        '<td>' + '最高学历毕业院校及专业' + '</td>' +
                        '<td>' + data.highest_graduate_school_and_major + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>' + '从事专业年限' + '</td>' +
                        '<td>' + data.marjor_age + '年' + '</td>' +
                        '<td>' + '工龄' + '</td>' +
                        '<td>' + data.working_age + '年' + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>' + '所属单位' + '</td>' +
                        '<td>' + data.fk_org_id + '</td>' +
                        '<td>' + '所属区域' + '</td>' +
                        '<td>' + data.fk_area_id + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<tr>' +
                        '<td>' + '家庭邮编' + '</td>' +
                        '<td>' + data.post_code + '</td>' +
                        '<td>' + '电子邮箱' + '</td>' +
                        '<td>' + data.email_address + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>' + '专业技术特长' + '</td>' +
                        '<td colspan="3" >' + data.professional_technical_expertise + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td >' + '个人简历' + '</td>' +
                        '<td colspan="3">' + data.resume + '</td>' +
                        '</tr>' +
                        '</tbody>' +
                        '</table>'
                    })
                } else if (layEvent === 'del') { //删除
                    layer.confirm('确定要删除吗？', function (index) {
                        obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                        layer.close(index);
                        //向服务端发送删除指令
                        $.ajax({
                            url: "/chzu/public/experInfo/" + data['key_id'],
                            data: {
                                '_method': 'delete'
                            },
                            type: "post",
                            dataType: 'json',
                            success: function (data) {
                                if (data.code == 200) {
                                    console.log(data)
                                    layer.msg("删除成功");
//                                location.reload();
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
                        title: '编辑专家信息',
                        type: 2,
                        shade: false,
                        maxmin: true,
                        shade: 0.5,
                        scrollbar: false,   //阻止屏幕滚动条滚动
                        area: ['95%', '90%'],
                        content: 'expertInfoEdit',
                        zIndex: layer.zIndex,
                        success: function (layer, index) {
                            var body = layui.layer.getChildFrame('body', index);
                        },
                        end: function () {
                        }
                    });
                }
            });

//        实现批量删除
            $(".delAll_btn").click(function () {
                var checkStatus = table.checkStatus('demoTable'),
                        data = checkStatus.data,
                        employeesId = "";
                console.log(data)
                if (data.length > 0) {
                    layer.confirm('确定要删除这' + data.length + '条数据吗？', function () {
                        for (var i = 0; i < data.length; i++) {
                            employeesId = data[i].key_id;
                            console.log(employeesId);
                            function ddd() {
                                $.ajax({
                                    url: "/chzu/public/experInfo/" + employeesId,
                                    data: {
                                        '_method': 'delete'
                                    },
                                    type: "post",
                                    dataType: 'json',
                                    success: function (data) {
                                        if (data.code == 200) {
                                            console.log(data)
                                        } else {
                                            layer.msg("删除失败");
                                        }
                                    }
                                })
                            }
                            ddd();
                            layer.msg("删除成功");
                            demoIns.reload();
                        }
                    })
                } else {
                    layer.msg('请选择需要删除的数据');
                }
            })
//获取导出为word时的key_id值
            $("#doc").click(function () {
                var checkStatus = table.checkStatus('demoTable'),
                        data = checkStatus.data;
//                console.log(data[0]['key_id']);
                if (data.length == 1){
                    document.getElementById("unique").value=data[0].key_id;
                    $("#fom").submit();
                }else if(data.length > 1){
                    layer.msg("word只能导出单个信息，请重新选择")
                }else {
                    layer.msg("请先选择需要导出的信息");
                }

            })
        });
    }

    //    添加回车事件，输入后，按回车即可查询
    document.onkeydown=function(event) {
        e = event ? event :(window.event ? window.event : null);
        if(e.keyCode==13){
//执行的方法
//            alert('回车检测到了');
            getTable();
            return false;
        }
    }
</script>

<!--<script type="text/javascript" src="/chzu/public/static/js/xcity.js"></script>-->
<script>
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
//                    从数据库获取省份名称填入到下拉框中
            var str = '';
            $.ajax({
                type: "GET",
                url: "/chzu/public/xt/areas?parent_id=0",
                data: {},
                dataType: "json",
                success: function (data) {
                    var da = data.data;
//                这种方法也可以获取到值
//                for (i = 0; i < da.length; i++) {
//                    str += "<option value='" + da[i].key_id + "'>" + da[i].name + "</option>"
//                    console.log(da[i].name)
//                }
//                $("#province").append(str);
//                console.log(str)
                    $.each(da, function (i, json) {
                        var $option = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
                        $("#province").append($option);
                        renderFrom();
                    });
                }
            });

            /**
             * 从数据库获取性别填入到性别下拉框中
             */
            $.ajax({
                type: "GET",
                url: "/chzu/public/xt/baseCodes/?flag=gender&level=1",
                data: {},
                dataType: "json",
                success: function (data) {
                    var da = data.data;
                    $.each(da, function (i, json) {
                        var $option = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
                        $("#fk_code_gender_id").append($option);
                        renderFrom();
                    });
                }
            });

            /**
             * 从数据库获取职称名称填入到职称下拉框中
             */
            $.ajax({
                type: "GET",
                url: "/chzu/public/xt/baseCodes/?flag=title&level=1",
                data: {},
                dataType: "json",
                success: function (data) {
                    var da = data.data;
                    $.each(da, function (i, json) {
                        var $option = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
                        $("#fk_code_title_id").append($option);
                        renderFrom();
                    });
                }
            });

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

            /**
             * 从数据库获取所属行业填入到所属行业下拉框中
             */
            $.ajax({
                type: "GET",
                url: "/chzu/public/xt/baseCodes/?flag=profession&level=1",
                data: {},
                dataType: "json",
                success: function (data) {
                    var da = data.data;
                    $.each(da, function (i, json) {
                        var $option = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
                        $("#fk_code_profession_id1").append($option);
                        renderFrom();
                    });
                }
            });


        });
        //        点击省份后，从数据库获取对应的市填入到下拉框中
        form.on('select(first)', function(){
            //页面加载完成，将省的信息加载完成
            //下拉列表框标签对象的val()方法就是选中的option标签的value的属性值
            var parent_id = $("#province").val();
            console.log(parent_id)
            $.ajax({
                type: 'GET',
                url: "/chzu/public/xt/areas?parent_id="+parent_id,
                data: {},
                dataType: "json",
                success: function (data) {
                    var da = data.data;
                    //清空城市下拉列表框的内容
                    $("#city").html("<option value=''>-- 请选择或搜索市 --</option>");
                    $("#area").html("<option value=''>-- 请选择或搜索区/县 --</option>");
                    //遍历json，json数组中每一个json，都对应一个省的信息，都应该在省的下拉列表框下面添加一个<option>
                    $.each(da, function (i, json) {
                        var $option = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
                        $("#city").append($option);
                        renderFrom();
//                        form.render('select', 'second');
                    });
                }
            });
        });

//        点击市后，从数据库获取对应的区、县填入到下拉框中
        form.on('select(second)', function(){
            var parent_id = $("#city").val();
            $.ajax({
                type: 'GET',
                url: "/chzu/public/xt/areas?parent_id="+parent_id,
                data: {},
                dataType: "json",
                success: function (data) {
                    var da = data.data;
                    //清空城市下拉列表框的内容
                    $("#area").html("<option value=''>-- 请选择或搜索区/县 --</option>");
                    //遍历json，json数组中每一个json，都对应一个省的信息，都应该在省的下拉列表框下面添加一个<option>
                    $.each(da, function (i, json) {
                        var $option = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
                        $("#area").append($option);
                        renderFrom();
                    });
                }
            });
        });

        /**
         * 点击一级行业，对应的出来下一级行业
         */
        form.on('select(next)', function(){
            var parent_id = $("#fk_code_profession_id1").val();
            $.ajax({
                type: 'GET',
                url: "/chzu/public/xt/baseCodes/?flag=profession&parent_id="+parent_id,
                data: {},
                dataType: "json",
                success: function (data) {
                    var da = data.data;
                    //清空城市下拉列表框的内容
                    $("#fk_code_profession_id").html("<option value=''>-- 请选择或搜索 --</option>");
                    //遍历json，json数组中每一个json，都对应一个省的信息，都应该在省的下拉列表框下面添加一个<option>
                    $.each(da, function (i, json) {
                        var $option = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
                        $("#fk_code_profession_id").append($option);
                        renderFrom();
                    });
                }
            });
        });

    });

    //    layui.use(['form', 'code'], function () {
//        form = layui.form;
//        layui.code();
//        $('#x-city').xcity('安徽', '滁州市', '琅琊区');
//    });
</script>
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-header">专家信息</div>
        <div class="layui-card-body" style="padding: 15px;">
            <form class="layui-form  x-so">
                <label class="layui-form-label">个人信息：</label>
                <input type="text" name="name" id="name" placeholder="请输入姓名" autocomplete="off" class="layui-input">
                <div class="layui-input-inline">
                    <select id="fk_code_gender_id" name="fk_code_gender_id">
                        <option value="">请选择性别</option>
                    </select>
                </div>
                <!--<div class="layui-input-inline">-->
                    <!--<select name="fk_code_title_id" id="fk_code_title_id">-->
                        <!--<option value="">请选择职称</option>-->
                    <!--</select>-->
                <!--</div>-->
                <div class="layui-input-inline">
                    <label class="layui-form-label">年龄段：</label>
                    <input type="text" name="age_min" id="age_min" placeholder="请输入最小年龄" autocomplete="off"
                           class="layui-input">-
                    <input type="text" name="age_max" id="age_max" placeholder="请输入最大年龄" autocomplete="off"
                           class="layui-input">
                </div>
                <br><br>

                <div class="layui-input-inline">
                    <label class="layui-form-label">所属行业：</label>
                </div>
                <div class="layui-input-inline">
                    <select name="fk_code_profession_id1" id="fk_code_profession_id1" lay-filter="next" lay-search lay-verify="required">
                        <option value="">请选择或搜索</option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="fk_code_profession_id" id="fk_code_profession_id" lay-search lay-verify="required">
                        <option value="">请选择或搜索</option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <label class="layui-form-label">从事专业：</label>
                </div>
                <div class="layui-input-inline" style="margin-left: -9px;">
                    <select name="fk_code_major_id" id="fk_code_major_id" lay-filter="next" lay-search lay-verify="required">
                        <option value="">请选择或搜索</option>
                    </select>
                </div>


                <div class="layui-input-inline" style="width: 167px;">
                    <label class="layui-form-label" style="width: 154px;">是否愿意参加科普讲座：</label>
                </div>
                <div class="layui-input-inline">
                    <select name="is_willing_attend_lectures" id="is_willing_attend_lectures">
                        <option value="">请选择</option>
                        <option value="0">否</option>
                        <option value="1">是</option>
                    </select>
                </div>
                <br><br>
                <div id="x-city">
                    <label class="layui-form-label">所在地区：</label>
                    <div class="layui-input-inline">
                        <select name="province" id="province" lay-filter="first" lay-search lay-verify="required">
                            <option value="">请选择或搜索省</option>
                        </select>
                    </div>
                    <div class="layui-input-inline">
                        <select name="city" id="city" lay-filter="second" lay-search>
                            <option value="">请选择或搜索市</option>
                        </select>
                    </div>
                    <div class="layui-input-inline">
                        <select name="fk_area_id" id="area" lay-search>
                            <option value="">请选择或搜索县/区</option>
                        </select>
                    </div>
                    <button class="layui-btn" onclick="getTable()" type="button"
                            style="position: absolute; right: 389px;top: 141px;"><i class="layui-icon">查询</i>
                    </button>
                    <button class="layui-btn" style="position: absolute; right: 276px;"><i
                            class="layui-icon layui-icon-refresh-1">重置</i>
                    </button>
                </div>

            </form>
            <!--<button class="layui-btn" onclick="getTable()"-->
                    <!--style="position: absolute; right: 389px;top: 161px;"><i class="layui-icon">查询</i>-->
            <!--</button>-->

            <div class="x-body" style="position: relative;">

                <xblock >
                    <button class="layui-btn layui-btn-danger delAll_btn"><i class="layui-icon"></i>批量删除</button>
                    <form action="../export" method="get" style="display: inline-block">
                        <input type="hidden" value="0" name="type">
                        <button type="submit" class="layui-btn layui-btn-normal export" id="exc">批量导出为Excel</button>
                    </form>
                    <form action="../export" method="get" style="display: inline-block" id="fom">
                        <input type="hidden" value="1" name="type">
                        <input type="hidden" name="id" value="" id="unique">
                        <button type="button" class="layui-btn layui-btn-normal" id="doc">单个导出为Word</button>
                    </form>
                    <button class="layui-btn" onclick="x_admin_show('添加专家信息','expertInfoAdd','1250')"><i
                            class="layui-icon"></i>添加专家信息
                    </button>
                    <button type="button" class="layui-btn" style="margin-left: 0;!important;" onclick="x_admin_show('专家资格证书管理','certificateList','1250')">
                        <i class="layui-icon layui-icon-username"></i>专家资格证书管理
                    </button>
                    <!--下载模板-->
                    <a href="/chzu/public/export?type=2" type="submit" id="1" style="float: right;line-height: 38.4px;margin-left: 10px;color: RGB(66, 184, 241);font-size: 13px;">下载表格模板</a>
                    <!--模板导入-->
                    <form action="/chzu/public/import" method="post" style="display: inline-block;position: absolute;right: 120px;" enctype="multipart/form-data" id="uploadtable">
                        <!-- 给这个input 设置样式隐藏，切忌不可用display控制隐藏,可能不能跨浏览器 -->
                        <input type="file" name="excel" id="file" onchange="getFilePath()"
                               style="filter:alpha(opacity=0);opacity:0;width: 0;height: 0;" />
                        <button type="button" class="layui-btn layui-btn-primary" style="float: right;display: inline-block;height: 38px;line-height: 38px;vertical-align: top;
                        padding: 0 15px;background-color: #fcfdfd;white-space: nowrap;text-align: center;font-size: 14px;border-radius: 5px;cursor: pointer;
                    .layui-btn-primary:hover" onclick="selectFile()">导入表格</button>
                        <!--<button onclick="getFilePath()">get FilePath</button>-->
                    </form>


                </xblock>
                <!--表格声明-->
                <table class="layui-table" id="demo" lay-filter="user"/>
            </div>
        </div>
    </div>
</div>
<script src="/chzu/public/static/js/xcity.js"></script>
<script type="text/javascript">
    function selectFile(){
        //触发 文件选择的click事件
        $("#file").trigger("click");    //因为trigger()函数在IE中是同步执行的，可以点击按钮进行选择后提交文件
                                        //但是在火狐谷歌中是异步执行的，所以当点击按钮后其实下一步执行的是getFilePath()函数，需要在这个函数里
                                        //进行下一步业务处理，如提交表单
        //其他code如 alert($("#file").attr("value"))
    }

    /* 获取 文件的路径 ，用于测试*/
    function getFilePath(){
//        alert($("#file").attr("value"));
        layer.msg("导入成功");
        $('#uploadtable').submit(); //执行提交表单
        setTimeout(function () {
            window.location.reload();
        },500);
//        window.location.reload();
//        setTimeout(function () {
//
//            alert(111)
//        }, 2000);
//        window.location.reload(true);
//        this.setState();
    }

//    $('.layui-btn').onclick = function () {
//        document.body.style.overflowY = "hidden";
//    }
    $(".export").mouseover(function(){
        layer.tips('导出Excel表格为导出全部专家信息，若想导出单个专家信息，请选择导出为word会更加详细', '#exc',{
            tips: [1, '#3595CC'],
            time: 50000
        });
    });
    $(".export").mouseout(function(){
        layer.closeAll();
    });
</script>
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="detail" style="background-color: #dddddd;color: black;">查看</a>
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
</body>
</html>