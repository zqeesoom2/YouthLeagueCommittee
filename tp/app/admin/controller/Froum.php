<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\BaseController;
use think\Request;
use think\facade\View;
use think\facade\Session;
use think\facade\Db;

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
     *  添加新闻
     *
     *
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

    /**
     * 添加幻灯片
     *
     */
    public function addSlide(Request $request)
    {
        if ($request->isPost()){

            $code = 0;

            $data = $request->post();

            $nRows = Db::name('slide')->insert($data);

            if ($nRows) {
                $code = 1;
            }

            return json(['code'=>$code]);
        }

        return  View::fetch();

    }

    /**
     * 查看幻灯片
     * */
    public function slideList(){

        $arrRes = Db::name('slide')->order('rank','desc')->select()->toArray();

        View::assign('arrlist',$arrRes);

        return  View::fetch();

    }

    /**
     * 编辑幻灯片
     *
     */
    public function editSlide(Request $request,$id=0)
    {
        if ($request->isPost()) {

            if ($id) {

               $data = $request->post();

               $nRes =  Db::name('slide')->where('id',$id)->update($data);
               if ($nRes) {
                   return ["code" => 1, "message" => "更新成功"];
               }
                return ["code" => 0, "message" => "更新失败"];
            }

        }else{

            if ($id) {
                $info = Db::name('slide')->find($id);
                View::assign('info',$info);
                return  View::fetch();
            }

        }

    }

}
