<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\OrgActivity;
use think\facade\Session;
use think\Request;
use think\facade\View;

class Project
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
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

        $dateRec = $request->post('recruit_time');
        $dateAct = $request->post('activity_time');
        list($time_rec_start,$time_rec_end) = explode(' - ',$dateRec);

        list($time_act_start,$time_act_end) = explode(' - ',$dateAct);
        unset($data['recruit_time']);
        unset($data['activity_time']);

        $data['recruit_time_start'] = strtotime(date($time_rec_start));
        $data['recruit_time_end'] = strtotime(date($time_rec_end));

        $data['activity_time_start'] = strtotime(date($time_act_start));
        $data['activity_time_end'] = strtotime(date($time_act_end));

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
