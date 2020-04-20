<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\BaseController;
use app\mobile\model\Member;
use think\facade\Session;
use think\Request;
use think\facade\View;

class Index extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {

        $serverinfo =[
            "操作系统"    =>PHP_OS,
            "运行环境"    =>($request->server())["SERVER_SOFTWARE"],
            "主机名"      =>$request->host(),
            "WEB服务端口" =>$request->port(),
            "网站文档目录" =>$request->root(),
            "浏览器信息"  =>($request->server())["HTTP_USER_AGENT"],
            "通信协议"    => $request->protocol(),
            "请求方法"    => $request->method(),
            "手机端"=>  $request->isMobile() ? 'true'  :  'false'

        ];


        View::assign([
            "serverinfo" => $serverinfo,
            'privil' => Session::get('privil')
        ]);
        return  View::fetch();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function volunteer()
    {
        $objMember = new Member();


        $strPri = Session::get('privil');

        $arrVolunteer =  $objMember->list($strPri);

        View::assign([
            'privil' => $strPri,
            'arrVolunteer'=>$arrVolunteer
        ]);
        return View::fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
