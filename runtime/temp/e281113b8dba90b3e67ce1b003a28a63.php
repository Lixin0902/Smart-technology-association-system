<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"F:\xampp\htdocs\chzu\public/../application/index\view\html\expert_info_add.html";i:1567669513;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台登录</title>
    <link rel="stylesheet" type="text/css" href="/chzu/public/static/css/xadmin.css">
    <link rel="stylesheet" type="text/css" href="/chzu/public/static/css/font.css">
    <script src="/chzu/public/static/js/jquery.min.js"></script>
    <script src="/chzu/public/static/lib/layui/layui.js"></script>
    <script src="/chzu/public/static/js/xadmin.js"></script>
    <style>
        body{
            background-color: #F9F9F9 !important;
        }
    </style>
</head>
<body>
<div class="x-body">
    <div class="layui-form layui-form-pane">
        <div class="layui-form-item pane">
            <label for="name" class="layui-form-label">
                <span class="x-red">*</span>姓名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="name" name="name" lay-verify="required" placeholder="请输入"
                       autocomplete="off" class="layui-input">
            </div>

            <label class="layui-form-label">
                个人证件照
            </label>
            <img src="/chzu/public/static/images/no-photo.jpg" name="img" id="img" width="110px" height="150px">
            <input type="file" value="上传图片" name="file"  id="file" onchange="change()" style="display: inline-block">
            <div class="layui-form-mid" style="color: red;">注意：建议上传295*413像素照片<br>
                <ol>
                    <li>1、请上传100KB以内，近期一寸蓝底照片。</li>
                    <li>2、照片尺寸5:7，建议上传295*413像素照片。</li>
                    <li>3、此照片将用于证书头像照，请保证图片清晰度。</li>
                    <li>4、右侧图片预览，需要求IE8及以上浏览器。</li>
                </ol>
                </div>
        </div>
        <hr style="background-color: #989DA0">

        <div class="layui-form-item pane">
            <label for="fk_code_bank_type_id" class="layui-form-label">
                开户行
            </label>
            <div class="layui-input-inline">
                <input type="text" id="fk_code_bank_type_id" name="fk_code_bank_type_id" placeholder="请输入"
                       autocomplete="off" class="layui-input">
            </div>
            <label for="bank_code" class="layui-form-label">
                银行账户
            </label>
            <div class="layui-input-inline">
                <input type="text" id="bank_code" name="bank_code" placeholder="请输入"
                       autocomplete="off" class="layui-input">
            </div>
            <label for="social_security_cards_code" class="layui-form-label" style="width: 123px;">
                社会保障卡号
            </label>
            <div class="layui-input-inline">
                <input type="text" id="social_security_cards_code" name="social_security_cards_code" placeholder="请输入"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <hr style="background-color: #989DA0">



        <div class="layui-form-item">
            <label class="layui-form-label">
                <span class="x-red">*</span>性别
            </label>
            <div class="layui-input-inline">
                <select name="fk_code_gender_id" id="fk_code_gender_id" lay-verify="required">
                    <option value="">请选择性别</option>
                </select>
            </div>
            <label class="layui-form-label">
                <span class="x-red">*</span>证件类型
            </label>
            <div class="layui-input-inline">
                <select name="fk_certificate_type_id" id="fk_certificate_type_id" lay-search lay-verify="required" lay-filter="sfType">
                    <option value="">请选择或搜索</option>
                </select>
            </div>
            <label for="cerificate_code" class="layui-form-label">
                <span class="x-red">*</span>证件号码
            </label>
            <div class="layui-input-inline">
                <input type="text" id="cerificate_code" name="cerificate_code" onblur="ExtractionBirthday('cerificate_code','birthday')"; lay-verify="required" placeholder="请输入"
                       autocomplete="off" class="layui-input" style="width: 203px;">
            </div>
        </div>
        <hr style="background-color: #989DA0">

        <div class="layui-form-item">
            <label class="layui-form-label">
                职称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="fk_code_title_id" name="fk_code_title_id" placeholder="请输入"
                       autocomplete="off" class="layui-input">
            </div>
            <label for="title_certificate_code" class="layui-form-label">
                职称证书号
            </label>
            <div class="layui-input-inline">
                <input type="text" id="title_certificate_code" name="title_certificate_code" placeholder="请输入"
                       autocomplete="off" class="layui-input">
            </div>
            <label for="position" class="layui-form-label">
                职务
            </label>
            <div class="layui-input-inline">
                <input type="text" id="position" name="position" placeholder="请输入"
                       autocomplete="off" class="layui-input" style="width: 203px;">
            </div>
        </div>
        <hr style="background-color: #989DA0">

        <div class="layui-form-item">
            <label class="layui-form-label">
                执业资格
            </label>
            <div class="layui-input-inline">
                <input type="text" id="qualification" name="qualification" placeholder="请输入"
                       autocomplete="off" class="layui-input">
            </div>
            <label for="first_graduate_school_and_major" class="layui-form-label" style="width: 145px;">
                执业资格证书编号
            </label>
            <div class="layui-input-inline" style="width: 477px;">
                <input type="text" id="qualification_code" name="qualification_code" placeholder="请输入"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <hr style="background-color: #989DA0">

        <div class="layui-form-item">
            <label class="layui-form-label" style="width: 180px;">
                <span class="x-red">*</span>是否愿意参加科普讲座
            </label>
            <div class="layui-input-inline" style="width: 120px;">
                <select name="is_willing_attend_lectures" id="is_willing_attend_lectures" lay-verify="required">
                    <option value="">请选择</option>
                    <option value="0">否</option>
                    <option value="1" selected>是</option>
                </select>
            </div>
            <label class="layui-form-label" style="width: 138px;">
                是否为应急专家
            </label>
            <div class="layui-input-inline" style="width: 162px;">
                <select name="is_emergency" id="is_emergency">
                    <option value="">请选择</option>
                    <option value="0">否</option>
                    <option value="1">是</option>
                </select>
            </div>
        </div>
        <hr style="background-color: #989DA0">

        <div class="layui-form-item">
            <label for="age" class="layui-form-label">
                <span class="x-red">*</span>年龄
            </label>
            <div class="layui-input-inline">
                <input type="text" id="age" name="age" placeholder="请输入" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
            <label class="layui-form-label">
                政治面貌
            </label>
            <div class="layui-input-inline">
                <select name="fk_code_politics_status_id" id="fk_code_politics_status_id" lay-search>
                    <option value="">请选择或搜索</option>
                </select>
            </div>
            <label class="layui-form-label">
                <span class="x-red">*</span>出生日期
            </label>
            <div class="layui-input-inline" style="width: 203px;">
                <input class="layui-input" placeholder="请选择出生日期" name="birthday" id="birthday" lay-verify="required">
            </div>

        </div>
        <hr style="background-color: #989DA0">

        <div class="layui-form-item">
            <label class="layui-form-label">
                <span class="x-red">*</span>所属行业
            </label>
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
        </div>
        <hr style="background-color: #989DA0">

        <div class="layui-form-item">
            <label class="layui-form-label">
                最高学位
            </label>
            <div class="layui-input-inline">
                <select name="fk_code_highest_degree_id" id="fk_code_highest_degree_id" lay-search>
                    <option value="">请选择或搜索</option>
                </select>
            </div>
            <label class="layui-form-label">
                <span class="x-red">*</span>从事专业
            </label>
            <div class="layui-input-inline">
                <select name="fk_code_major_id" id="fk_code_major_id" lay-search lay-verify="required">
                    <option value="">请选择或搜索</option>
                </select>
            </div>
            <label for="marjor_age" class="layui-form-label" style="width: 123px;">
                <span class="x-red">*</span>从事专业年限
            </label>
            <div class="layui-input-inline" style="width: 123px;">
                <input type="text" id="marjor_age" name="marjor_age" placeholder="请输入" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid" style="color: red;">（年） 只能输入数字</div>

        </div>
        <hr style="background-color: #989DA0">

        <div class="layui-form-item">
            <label class="layui-form-label">
                第一学历
            </label>
            <div class="layui-input-inline">
                <select name="fk_code_first_education_id" id="fk_code_first_education_id" lay-search>
                    <option value="">请选择或搜索</option>
                </select>
            </div>
            <label for="first_graduate_school_and_major" class="layui-form-label" style="width: 195px;">
                第一学历毕业院校及专业
            </label>
            <div class="layui-input-inline" style="width: 500px;">
                <input type="text" id="first_graduate_school_and_major" name="first_graduate_school_and_major" placeholder="请输入"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <hr style="background-color: #989DA0">

        <div class="layui-form-item">
            <label class="layui-form-label">
                最高学历
            </label>
            <div class="layui-input-inline">
                <select name="fk_code_highest_education_id" id="fk_code_highest_education_id" lay-search>
                    <option value="">请选择或搜索</option>
                </select>
            </div>
            <label for="highest_graduate_school_and_major" class="layui-form-label" style="width: 195px;">
                最高学历毕业院校及专业
            </label>
            <div class="layui-input-inline" style="width: 500px;">
                <input type="text" id="highest_graduate_school_and_major" name="highest_graduate_school_and_major" placeholder="请输入"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <hr style="background-color: #989DA0">

        <div class="layui-form-item">
            <label class="layui-form-label">
                <span class="x-red">*</span>所属单位
            </label>
            <div class="layui-input-inline">
                <input type="text" id="fk_org_id" name="fk_org_id" placeholder="请输入"
                       autocomplete="off" class="layui-input" lay-verify="required">
            </div>
            <label for="working_age" class="layui-form-label">
                工龄
            </label>
            <div class="layui-input-inline">
                <input type="text" id="working_age" name="working_age" placeholder="请输入"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid" style="color: red;">（年） 只能输入数字</div>
        </div>
        <hr style="background-color: #989DA0">

        <div class="layui-form-item">
                <label class="layui-form-label"><span class="x-red">*</span>所属区域</label>
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
        </div>
        <hr style="background-color: #989DA0">

        <div class="layui-form-item">
            <label for="phone" class="layui-form-label">
                <span class="x-red">*</span>移动电话
            </label>
            <div class="layui-input-inline">
                <input type="text" id="phone" name="phone" lay-verify="number" placeholder="请输入" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
            <label for="email_address" class="layui-form-label">
                电子邮箱
            </label>
            <div class="layui-input-inline">
                <input type="text" id="email_address" name="email_address" placeholder="请输入"
                       autocomplete="off" class="layui-input">
            </div>
            <label for="post_code" class="layui-form-label">
                邮政编码
            </label>
            <div class="layui-input-inline">
                <input type="text" id="post_code" name="post_code" placeholder="请输入"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <hr style="background-color: #989DA0">


        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">
                <span class="x-red">*</span>专业技术特长
            </label>
            <textarea name="professional_technical_expertise" placeholder="请输入" class="layui-textarea" lay-verify="required"></textarea>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">
                个人简历
            </label>
            <textarea name="resume" id="resume" placeholder="请输入" class="layui-textarea" lay-verify="content" style="background-color: white;"></textarea>
        </div>


        <div class="layui-form-item" style="text-align: center">
            <button class="layui-btn" lay-filter="add" lay-submit="" style="background-color: #FF5722;">
                添加此专家信息
            </button>
        </div>
    </div>
</div>

<script type="text/javascript">


    /**
     * 初始化Form渲染，以便获取下拉框的值
     */
    function renderFrom() {
        layui.use('form', function () {
            var form = layui.form;
            form.render();
        })
    }

//    var sfcode = $("#fk_certificate_type_id").text();
//    console.log(sfcode)

//    根据身份证号自动填入出生日期和年龄
    function ExtractionBirthday(oneText,twoText) {
        var options=$("#fk_certificate_type_id option:selected"); //获取选中的项
//        alert(options.val()); //拿到选中项的值
//        alert(options.text()); //拿到选中项的文本
        if (options.text() == "身份证"){
            var txtparm = document.getElementById(oneText).value;
            if(txtparm.length==18) {
                var year = txtparm.substring(6,10);
                var month = txtparm.substring(10,12);
                var date=txtparm.substring(12,14);
                document.getElementById(twoText).value=year+"-"+month+"-"+date;
                var date = new Date();
                var year = date.getFullYear();
                var birthday_year = parseInt(txtparm.substr(6, 4));
                var userage = year - birthday_year;
                $('#age').val(userage);
            }
            else {
                layer.msg("输入的身份证号不正确，请重新输入");
//            document.getElementById(oneText).focus();
                document.getElementById(oneText).value="";
            }
        }else {
//            document.getElementById(oneText).value="";
//            $("#age").val(" ");
//            $("#birthday").val(" ");
//            return false;
        }

    }

    /**
     * 表单中带下拉框的内容查询
     */
    layui.use(['form'], function () {
        var form = layui.form;
        var $ = layui.jquery;
//        若用户输入证件号后又将证件类型改为别的，则清空证件号码、出生日期、年龄等信息
        form.on('select(sfType)', function (data) {
            var options=$("#fk_certificate_type_id option:selected"); //获取选中的项
            if (options.text()!="身份证"){
                $("#age").val(" ");
                $("#birthday").val(" ");
                $("#cerificate_code").val(" ");
            }
        });
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
                                $('#province').val(18066);
                                renderFrom();
                            });
                        }
                    });

//                    /**
//                     * 从数据库获取银行类型填入到开户行下拉框中
//                     */
//                    $.ajax({
//                        type: "GET",
//                        url: "/chzu/public/xt/baseCodes/?flag=bank_type&level=1",
//                        data: {},
//                        dataType: "json",
//                        success: function (data) {
//                            var da = data.data;
//                            $.each(da, function (i, json) {
//                                var $option = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
//                                $("#fk_code_bank_type_id").append($option);
////                                $("#fk_code_bank_type_id").val(790);
//                                renderFrom();
//                            });
//                        }
//                    });

//                    /**
//                     * 从数据库获取所属单位填入到所属单位下拉框中
//                     */
//                    $.ajax({
//                        type: "GET",
//                        url: "/chzu/public/xt/organises",
//                        data: {},
//                        dataType: "json",
//                        success: function (data) {
//                            var da = data.data;
//                            $.each(da, function (i, json) {
//                                var $option = $("<option value='" + json["key_id"] + "'>" + json["dept_name"] + "</option>");
//                                $("#fk_org_id").append($option);
//                                $("#fk_org_id").val(786);
//                                renderFrom();
//                            });
//                        }
//                    });

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
                                $("#fk_code_gender_id").val(751);
                                renderFrom();
                            });
                        }
                    });

                    /**
                     * 从数据库获取证件类型填入到证件类型下拉框中
                     */
                    $.ajax({
                        type: "GET",
                        url: "/chzu/public/xt/baseCodes/?flag=certificateType&level=1",
                        data: {},
                        dataType: "json",
                        success: function (data) {
                            var da = data.data;
                            $.each(da, function (i, json) {
                                var $option = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
                                $("#fk_certificate_type_id").append($option);
                                $("#fk_certificate_type_id").val(767);
                                renderFrom();
                            });
                        }
                    });

//                    /**
//                     * 从数据库获取职称名称填入到职称下拉框中
//                     */
//                    $.ajax({
//                        type: "GET",
//                        url: "/chzu/public/xt/baseCodes/?flag=title&level=1",
//                        data: {},
//                        dataType: "json",
//                        success: function (data) {
//                            var da = data.data;
//                            $.each(da, function (i, json) {
//                                var $option = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
//                                $("#fk_code_title_id").append($option);
//                                $("#fk_code_title_id").val(774);
//                                renderFrom();
//                            });
//                        }
//                    });

                    /**
                     * 从数据库获取政治面貌填入到政治面貌下拉框中
                     */
                    $.ajax({
                        type: "GET",
                        url: "/chzu/public/xt/baseCodes/?flag=politicsStatus&level=1",
                        data: {},
                        dataType: "json",
                        success: function (data) {
                            var da = data.data;
                            $.each(da, function (i, json) {
                                var $option = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
                                $("#fk_code_politics_status_id").append($option);
//                                $("#fk_code_politics_status_id").val(755);
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
                                $("#fk_code_profession_id1").val(744);
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
                                $("#fk_code_major_id").val(775);
                                renderFrom();
                            });
                        }
                    });

                    /**
                     * 从数据库获取学历信息填入到第一学历和最高学历下拉框中
                     */
                    $.ajax({
                        type: "GET",
                        url: "/chzu/public/xt/baseCodes/?flag=degree&level=1",
                        data: {},
                        dataType: "json",
                        success: function (data) {
                            var da = data.data;
                            $.each(da, function (i, json) {
                                var $option1 = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
                                var $option2 = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
                                $("#fk_code_first_education_id").append($option1);
                                renderFrom();
                                $("#fk_code_highest_education_id").append($option2);
                                renderFrom();
                            });
                        }
                    });

                    /**
                     * 从数据库获取学位信息填入到最高学位下拉框中
                     */
                    $.ajax({
                        type: "GET",
                        url: "/chzu/public/xt/baseCodes/?flag=education&level=1",
                        data: {},
                        dataType: "json",
                        success: function (data) {
                            var da = data.data;
                            $.each(da, function (i, json) {
                                var $option = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
                                $("#fk_code_highest_degree_id").append($option);
                                renderFrom();
                            });
                        }
                    });

                    /**
                     * 获取已存在的省份地区信息填入地区下拉框中
                     */
                    $.ajax({
                        type: 'GET',
                        url: "/chzu/public/xt/areas?parent_id=18066",
                        data: {},
                        dataType: "json",
                        success: function (data) {
                            var da = data.data;
                            //遍历json，json数组中每一个json，都对应一个省的信息，都应该在省的下拉列表框下面添加一个<option>
                            $.each(da, function (i, json) {
                                var $option = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
                                $("#city").append($option);
                                $('#city').val(18156);
                                renderFrom();
                            });
                        }
                    });

                    /**
                     * 获取已存在的地区信息填入市区下拉框中
                     */
                    $.ajax({
                        type: 'GET',
                        url: "/chzu/public/xt/areas?parent_id=18156",
                        data: {},
                        dataType: "json",
                        success: function (data) {
                            var da = data.data;
                            $.each(da, function (i, json) {
                                var $option = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
                                $("#area").append($option);
                                $('#area').val(19626);
                                renderFrom();
                            });
                        }
                    });

                    /**
                     * 根据已存在的行业信息自动填入二级行业信息
                     */
                    $.ajax({
                        type: 'GET',
                        url: "/chzu/public/xt/baseCodes/?flag=profession&parent_id=744",
                        data: {},
                        dataType: "json",
                        success: function (data) {
                            var da = data.data;
                            //遍历json，json数组中每一个json，都对应一个省的信息，都应该在省的下拉列表框下面添加一个<option>
                            $.each(da, function (i, json) {
                                var $option = $("<option value='" + json["key_id"] + "'>" + json["name"] + "</option>");
                                $("#fk_code_profession_id").append($option);
                                $('#fk_code_profession_id').val(746);
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


</script>
<script>
    function change(){
        var img=document.getElementById("img");
        var file=document.getElementById("file");
        img.src=window.URL.createObjectURL(file.files[0]);
    }

    layui.use('laydate', function () {
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#birthday' //指定元素
        });
    });
    layui.use(['form', 'layer', 'layedit'], function () {
        var form = layui.form
                , layer = layui.layer,
                layedit = layui.layedit;
        /**
         * 富文本编辑器初始化
         */
            var index = layedit.build('resume', {tool: [
            'strong' //加粗
            ,'italic' //斜体
            ,'underline' //下划线
            ,'del' //删除线
            ,'|' //分割线
           , 'left' //左对齐
            ,'center' //居中对齐
            ,'right' //右对齐
            ,'link' //超链接
            ,'unlink' //清除链接
            ,'face' //表情
            ]}
        );
        form.verify({
            //content富文本域中的lay-verify值
            content: function(value) {
                return layedit.sync(index);
            }
        });

        //监听提交
        form.on('submit(add)', function (data) {
            console.log(data)
//            if (data.field.fk_code_bank_type_id == null){
//                data.field.fk_code_bank_type_id = " ";
//            }
            var formData = new FormData();
            formData.append("picture",$("#file")[0].files[0]);
            formData.append("resume",data.field.resume);
            formData.append("name",data.field.name);
            formData.append("phone",data.field.phone);
            formData.append("fk_code_gender_id",data.field.fk_code_gender_id);
            formData.append("fk_code_bank_type_id",data.field.fk_code_bank_type_id);
            formData.append("bank_code",data.field.bank_code);
            formData.append("fk_certificate_type_id",data.field.fk_certificate_type_id);
            formData.append("cerificate_code",data.field.cerificate_code);
            formData.append("age",data.field.age);
            formData.append("is_emergency",data.field.is_emergency);
//            formData.append("is_trained",data.field.is_trained);
            formData.append("fk_code_politics_status_id",data.field.fk_code_politics_status_id);
            formData.append("birthday",data.field.birthday);
            formData.append("social_security_cards_code",data.field.social_security_cards_code);
            formData.append("fk_code_highest_degree_id",data.field.fk_code_highest_degree_id);
            formData.append("fk_code_title_id",data.field.fk_code_title_id);
            formData.append("title_certificate_code",data.field.title_certificate_code);
            formData.append("position",data.field.position);
            formData.append("fk_code_first_education_id",data.field.fk_code_first_education_id);
            formData.append("first_graduate_school_and_major",data.field.first_graduate_school_and_major);
            formData.append("fk_code_highest_education_id",data.field.fk_code_highest_education_id);
            formData.append("highest_graduate_school_and_major",data.field.highest_graduate_school_and_major);
            formData.append("fk_code_major_id",data.field.fk_code_major_id);
            formData.append("fk_code_profession_id",data.field.fk_code_profession_id);
            formData.append("marjor_age",data.field.marjor_age);
            formData.append("fk_org_id",data.field.fk_org_id);
            formData.append("fk_area_id",data.field.fk_area_id);
            formData.append("working_age",data.field.working_age);
            formData.append("is_willing_attend_lectures",data.field.is_willing_attend_lectures);
//            formData.append("address",data.field.address);
            formData.append("post_code",data.field.post_code);
            formData.append("email_address",data.field.email_address);
            formData.append("professional_technical_expertise",data.field.professional_technical_expertise);
            //发异步，把数据提交给php
            $.ajax({
                url: '/chzu/public/experInfo',
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData:false,  //使数据不作处理，以便向后台传输文件流
                contentType:false,  //不要设置Content-Type请求头
                success: function (data) {
                    var returnCode = data.code;
                    if (returnCode == 200) {
                        layer.closeAll('loading');
                        layer.load(2);
                        layer.msg("添加成功", {icon: 6});
                        setTimeout(function () {
                            window.parent.location.reload();//修改成功后刷新父界面
                        }, 1000);
                        //加载层-风格
                    } else {
                        console.log(returnCode);
                        layer.msg("添加失败，请检查信息是否符合要求", {icon: 5});
                    }
                }
            });
            return false;
        });
    });
</script>
</body>
</html>