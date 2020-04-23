<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\OrgActivity;
use app\BaseController;
use app\mobile\model\Org;
use think\facade\Session;
use think\Request;
use think\facade\View;

class Project extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        $arrlist = (new OrgActivity())->adminPage(['service_id'=>['like',Session::get('privil').'%']],20);

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
    public function create()
    {
        View::assign('list','');
        return View::fetch();
    }


    public function upimg($flag ='')
    {
       $strFlag = 'file';

       if($flag)
           $strFlag = $flag;

       $strUrl = upload_img($strFlag);


       return json([ 'code'=>0,'msg'=>'','data'=>[ 'src'=>'/storage/'.$strUrl]]);
    }

    public function upvideo() {

        $strUrl = upload_img('file','video');

        return json([ 'code'=>0,'msg'=>'','data'=>[ 'src'=>'/storage/'.$strUrl]]);
    }


    public function addArticle(Request $request)
    {

        $data = $request->post();

        $data = $this->handleData($data);

        $data['group_id'] = Session::get('uid');


        $res = (new OrgActivity())->add($data);
        $code = 0;
        if ($res->id)
            $code = 1;

        return json(['code'=>$code]);

    }
    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit(Request $request,$id=0)
    {

        if ($request->isPost()) {

            $data = $request->post();


            if($request->post('Id')){
                $id = $request->post('Id');//编辑审核状态
                unset($data['Id']);
            }else{
                $data = $this->handleData($data);
            }

            (new OrgActivity())->edit($id,$data);
            return ["code" => 1, "message" => "更新成功"];

            //return ["code" =>0, "message" => $e->getMessage()];

        }else{

            if ($id){
                $info = (new OrgActivity())->whichOne($id);
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
    public function handleData(&$data)
    {

        $dateRec = $data['recruit_time'];
        $dateAct = $data['activity_time'];
        list($time_rec_start,$time_rec_end) = explode(' - ',$dateRec);

        list($time_act_start,$time_act_end) = explode(' - ',$dateAct);
        unset($data['recruit_time']);
        unset($data['activity_time']);

        $data['recruit_time_start'] = strtotime(date($time_rec_start));
        $data['recruit_time_end'] = strtotime(date($time_rec_end));

        $data['activity_time_start'] = strtotime(date($time_act_start));
        $data['activity_time_end'] = strtotime(date($time_act_end));

        $data['service_id'] = (new Org())->splicingPath($data['service_id']);

        return $data;
    }

    public  function enrollList(){
        $list = (new OrgActivity())->enrollList();
        $count = $list ->total();
        $page = $list->render();
        View::assign(['list'=>$list,
                 'count'=>$count,
                 'page'=>$page
        ]);
       return View::fetch();
    }

    public function scoring($id) {

        $list = (new OrgActivity())->enrollList($id);

        $count = $list ->total();

        $page = $list->render();

        View::assign(['list'=>$list,
            'count'=>$count,
            'page'=>$page
        ]);

        return View::fetch();
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
