<?php
namespace app;

use app\ucenter\UcApi;
use think\facade\Cookie;

trait PublicController{

    public function __construct() {
        $this->autologin();
    }

    public function autologin() {
        halt(Cookie::get());
        if (Cookie::has('vszu_dc7c_auth')) {
            //discuz $_config['security']['authkey'] = 'ce1f2cLQg1D6J6xn';
            $key=md5('ce1f2cLQg1D6J6xn'.Cookie::get('vszu_dc7c_saltkey'));//获取在本应用的配置文件config.php中的解密钥匙
            $userMsg = explode("\t", uc_authcode(Cookie::get('vszu_dc7c_auth'), 'DECODE', $key)); //得到加了密的password【$userMsg[0]】和uid【$userMsg[1]】
            $userInfo = uc_get_user($userMsg[1], 1);//通过uid获取username
			$_SESSION['user_id'] = $userMsg[1];
            $_SESSION['username'] = $userInfo[1];
            $_SESSION['email'] = $userInfo[2];
        } else {
            session('[destroy]');
        }
    }
	
    public function isLogin() {
        //是否登录判断方法
        $login = isset($_SESSION['user_id']) ? $_SESSION['user_id']:"";
        if (empty($login)) {
            $this->assign("jumpUrl", __APP__.'/home/Login');
            $this->error('请先登录！');
		}
    }
	
}
?>
