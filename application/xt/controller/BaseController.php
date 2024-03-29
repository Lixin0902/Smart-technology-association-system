<?php

namespace app\xt\controller;

use app\xt\validate\BaseValidate;
use think\App;
use think\Config;
use think\Controller;
use think\Debug;
use think\Log;
use think\Request;
use think\Session;

/**
 * Created by IntelliJ IDEA.
 * User: 谢灿
 * Date: 2019/6/12
 * Time: 18:31
 * Function：所有api接口的基类，定义一些公共的方法
 * @modify xc,2019-6-18 16:58:55  白名单和验证都移到模块config中, 公共方法移动到应用common中.
 */
class BaseController extends Controller
{
    /**
     * 控制器初始化访问钩子
     */
    protected function _initialize()
    {
        // TODO: Change the autogenerated stub
        Log::record("=================有访问进来了!===================");
        parent::_initialize();
        $ModuleName = $this->request->module();
        $controllerName = $this->request->controller();
        //TP5.1需要输入参数true 才会返回驼峰格式ActionName
        $actionName = $this->request->action(true);
        Log::record("=================访问>>" . $ModuleName . "\\" . $controllerName . "\\" . $actionName . "===================");
        Log::record($ModuleName . '.' . $controllerName);
        $controllerActions = Config::get("login_white_list." . $ModuleName . '.' . $controllerName);
        // 访问的Action是否在登录白名单中
        $isInWhiteList = isset($controllerActions) && in_array($actionName, $controllerActions);
        // 不在登录白名单中需要进行登录验证
        if (!$isInWhiteList) {
            getLoginedUser($this);
        }
        $request = Request::instance();
        $this->request = $request;
        $this->params = $this->checkParams($request->except(['time', 'token', 'version']));
    }

    /**
     * 验证请求参数/数据
     * @param array $arr 去除time和token以外的参数
     * @return mixed 经过过滤后的参数数据
     */
    private function checkParams($arr)
    {
        $ModuleName = $this->request->module();
        $controllerName = $this->request->controller();
        //TP5.1需要输入参数true 才会返回驼峰格式ActionName
        $actionName = $this->request->action(true);
        //读取xt模块的配置 里面有参数规则
        Config::load(APP_PATH."xt/config.php");
        $rules = Config::get("rules." . $ModuleName . '.' . $controllerName);
        if ($rules && array_key_exists($actionName, $rules)) {
            $rule = $rules[$actionName];
            $message = [];
            if ($rule && array_key_exists('_msg', $rule)) {
                $message = $rule['_msg'];
            }
            $validate = new BaseValidate();
            $validateResult = $this->validate($arr, $rule, $message);
            if ($validateResult !== true) {
                returnJson(400, $validateResult);
            }
        }
        return $arr;
    }


}