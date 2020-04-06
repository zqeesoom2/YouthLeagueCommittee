<?php
namespace app;


trait PublicController{

    public function _initialize() {
        $this->autologin();
    }

    public function autologin() {
        if (isset($_COOKIE['aY4z_2132_auth']) && !empty($_COOKIE['aY4z_2132_auth'])) {
            Vendor('ThinkphpUcenter.UcApi');//载入UcApi扩展
            $key=md5(C('AUTH_KEY').$_COOKIE['aY4z_2132_saltkey']);//获取在本应用的配置文件config.php中的解密钥匙		
            $userMsg = explode("\t", uc_authcode($_COOKIE['aY4z_2132_auth'], 'DECODE', $key)); //得到加了密的password【$userMsg[0]】和uid【$userMsg[1]】
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
