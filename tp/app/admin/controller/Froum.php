<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\BaseController;
use think\Request;
use think\facade\View;
use think\facade\Session;

class Froum extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($id = 1)
    {
            $group_id = Session::get('uid');

            $arr = ['group_id'=>['=',$group_id]];

            if ($group_id==1){
                $arr = ['1'=>['=',1]];
                if (!$id) {
                    $arr = ['status'=>['=',0]];
                }
            }

            $arrlist = (new \app\admin\model\Froum())->adminPage($arr,20);

            $count = $arrlist->total();
            $page = $arrlist->render();

            // $arrData =  $arrlist->toArray();

            View::assign(['arrlist'=>$arrlist,
                'page'=>$page,
                'count'=>$count
            ]);
            return  View::fetch();

    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create(Request $request)
    {
        if ($request->isPost()) {

            $data = $request->post();

            $data['group_id'] = Session::get('uid');

            $res = (new \app\admin\model\Froum())->add($data);
            $code = 0;
            if ($res->id)
                $code = 1;

            return json(['code'=>$code]);
        }


      return  View::fetch();
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
    public function editFroum(Request $request,$id=0)
    {

        if ($request->isPost()) {

            $data = $request->post();

            if ($request->post('Id')) {
                $id = $request->post('Id');//编辑审核状态
                unset($data['Id']);
            }

            (new \app\admin\model\Froum())->edit($id,$data);
            return ["code" => 1, "message" => "更新成功"];

            //return ["code" =>0, "message" => $e->getMessage()];

        }else{

            if ($id){
                $info = (new \app\admin\model\Froum())->getOne($id);
                View::assign('info',$info);
                return  View::fetch();
            }

        }

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
        if ($id) {
            $res = (new \app\admin\model\Froum())->del($id);
        }

        if ($res) {
            return json(['code'=>0,'message'=>'删除成功']);
        }
    }
}
