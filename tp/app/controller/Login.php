<?php
declare (strict_types = 1);

namespace app\controller;
use app\BaseController;
use app\PublicController;
use think\facade\Config;
use think\facade\Cookie;
use think\facade\Db;
use think\Request;
use app\ucenter\UcApi;
use think\facade\View;
use think\facade\Session;

class Login
{
    use PublicController;
    //登录首页
    public function index() {

        if (Cookie::has('vszu_dc7c_visitedfid')){
            halt(Cookie::get());
            $this->assign("jumpUrl", __APP__);
            $this->success('登录成功');
        }else{
            $ucapi = new UcApi();

          return \view();
        }
    }

    //检查登录
    public function checklogin(Request $request) {
        /*$strSalt =  Config::get('cus.salt');
        $password = md5($request->param('password').$strSalt);

        $arrUser = Db::name('member')->where([
            'username'=>$_POST['username'],
            'password'=>$password
        ])->find();

        if ($arrUser){//登陆成功！

            $arrU['uId'] =$arrUser['id'];
            Session::set("userInfo",$arrU);

            return json(['state'=>0,'data'=>$arrU]);
        }else{//激活

            $arrU['password'] = $password;
            return json(['state'=>0,'data'=>$arrU]);
        }*/


//
//        $check = $request->checkToken('__token__');
//        if(!$check){
//            return '重复提交';
//        }

        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $login = UcApi::login($_POST['username'], $_POST['password']);
            if ($login === FALSE) {
                return json(['state'=>1,'data'=>UcApi::getError()]);
            } else {//得到UC

                $arrU = [
                    'username'=>$login['username'],
                    'user_id'=> $login['uid']
                ];

                $strSalt =  Config::get('cus.salt');
                $password = md5($request->param('password').$strSalt);

                $arrUser = Db::name('member')->where([
                    'username'=>$login['username'],
                    'password'=>$password
                ])->find();

                if ($arrUser){//登陆成功！

                    $arrU['uId'] =$arrUser['id'];

                }else{//激活

                    $arrU['password'] = $password;

                }
                Session::set("userInfo",$arrU);
                return json(['state'=>0,'data'=>$arrU]);
                //echo $login['synlogin'];//输出同步登录代码 （这步很重要）

            }
        } else {
            return json(['state'=>1,'data'=>'错误，用户名和密码不能为空']);
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
