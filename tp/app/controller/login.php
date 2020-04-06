<?php
declare (strict_types = 1);

namespace app\controller;
use app\BaseController;
use app\PublicController;
use think\Request;
use app\ucenter\UcApi;
use think\facade\View;

class login extends BaseController
{
    use PublicController;
    //登录首页
    public function index() {
        if (!empty($_SESSION)){
            $this->assign("jumpUrl", __APP__);
            $this->success('登录成功');
        }else{
            $ucapi = new UcApi();

          return \view();
        }
    }

    //检查登录
    public function checklogin(Request $request) {
//
//        $check = $request->checkToken('__token__');
//        if(!$check){
//            return '重复提交';
//        }

        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $login = UcApi::login($_POST['username'], $_POST['password']);
            if ($login === FALSE) {
                echo (UcApi::getError());
            } else {
                $_SESSION['username'] = $login['username'];
                $_SESSION['user_id'] = $login['uid'];
                $_SESSION['email'] = $login['email'];
                echo $login['synlogin'];//输出同步登录代码 （这步很重要）
                $this->assign("jumpUrl", __APP__);
                $this->success('登录成功');
            }
        } else {
            $this->error('错误，用户名和密码不能为空');
        }
    }

    //注册
    public function register() {
        $this->display();
    }

    //检查注册
    public function check_register() {
        $reg = UcApi::reg($_POST['username'], $_POST['password'], $_POST['email']);
        if ($reg <= 0) {
            $this->error(UcApi::getError());
        } else {
            $this->success('注册成功');
        }
    }

    //退出登录
    public function logout() {
        session('[destroy]');
        echo UcApi::logout();	//输出同步登出的代码 （这步很重要）
        $this->assign('jumpUrl', __APP__.'/home/Login');
        $this->success('退出成功');
    }
}
