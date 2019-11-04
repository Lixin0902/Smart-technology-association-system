<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"F:\xampp\htdocs\chzu\public/../application/xt\view\index\login.html";i:1564967247;}*/ ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录</title>
    <link rel="stylesheet" type="text/css" href="/chzu/public/static/css/login.css">
</head>
<body>
<div id="wrapper" class="login-page">
    <div id="login_form" class="form">
        <form class="login-form">
            <h2>滁州科协科技智库系统</h2>
            <input type="text" placeholder="用户名" value="admin" id="user_name"/>
            <input type="password" placeholder="密码" id="password"/>
            <input id="remember_me" type="checkbox" name="remember_me" onkeydown="check_enter(event)">
            <span>记住密码</span>
            <button id="login">登　录</button>
        </form>
    </div>
</div>

<script src="/chzu/public/static/js/jquery.min.js"></script>
<script src="/chzu/public/static/lib/layui/layui.js"></script>
<script src="/chzu/public/static/js/jquery.cookie.js"></script>
<script type="text/javascript">
    function save(name, pass) {
        if ($("#remember_me").get(0).checked) {
            $.cookie("cookies", "true", {expires: 7});
            $.cookie("user_name", name, {expires: 7});
            $.cookie("password", pass, {expires: 7});
        } else {
            $.cookie("cookies", "false", {expire: -1});
            $.cookie("username", "", {expires: -1});
            $.cookie("password", "", {expires: -1});
        }
    }
    var layer = '';
    function check_login() {
        var name = $("#user_name").val();
        var pass = $("#password").val();
        $.post("xt/user/login", {account: name, password: pass}, function (result) {
            console.log(result);
            if (result.code === 200) {
                layer.msg("登录成功!", {
                    offset: '350px'
                });
                save(name, pass);
                $(location).attr('href', 'index');
            } else {
                layer.msg(result.msg, {
                    offset: '350px'
                });
                $("#login_form").removeClass('shake_effect');
                setTimeout(function () {
                    $("#login_form").addClass('shake_effect')
                }, 1);
            }
        }, 'json');
    }

    $(function () {
        layui.use('layer', function () {
            layer = layui.layer;
        });
        $("#create").click(function () {
            check_register();
            return false;
        })
        $("#login").click(function () {
            check_login();
            return false;
        })
        $('.message a').click(function () {
            $('form').animate({
                height: 'toggle',
                opacity: 'toggle'
            }, 'slow');

        });
        if ($.cookie("cookies") == "true") {
            $("#user_name").val($.cookie("user_name"));
            $("#password").val($.cookie("password"));
            $("#remember_me").prop("checked", true);
        }
    })
</script>
</body>
</html>