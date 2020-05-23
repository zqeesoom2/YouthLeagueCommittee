<?php
declare (strict_types = 1);

namespace app\mobile\model;

use app\mobile\validate\Org as OrgVal;
use think\facade\Db;
use think\Model;

/**
 * @mixin think\Model
 */
class Org extends Model
{
    function add ($data){

        $validate =new OrgVal();
        $res = $validate->check($data);

        if (!$res) {
            $error = $validate ->getError();
            return ['state'=>1,'error'=>$error];
        }

        try{

            $objOrg = self::create($data);

            return ['state'=>0,'data'=>['logo_url'=>$objOrg->logo_url,'status'=>'审核中','org_name'=>$data['org_name'],'org_id'=>$objOrg->id]];
        }catch(\Exception $e){
            return ['state'=>1,'message'=>$e->getMessage()];
        }
    }

    function orgByName($name) {
        $obj = self::where('org_name',$name)->find();
        if ($obj) {
            return $obj->toArray();
        }
        return null;
    }

    function splicingPath($id) {

        $arrPerOrg = self::field('path')->find($id);

       return $strPath = $arrPerOrg->path.$id.'-';
    }

    function getStatusById($id) {
        return self::field('status')->find($id);
    }

    //$action = inc | dec
    function incReleaseQuan($id,$action){

        $nRows =self::where('id',$id)->{$action}('release_quan')->update();
        return $nRows;

    }

    function incMembers($id,$action){

        $nRows =self::where('id',$id)->{$action}('members')->update();
        return $nRows;

    }


    function getOrgByPath($arr){
        return self::where('path','like',$arr,'OR')->select()->toArray();
    }

    function orgByService($service_id) {
        return self::where('service',$service_id)->select();
    }
}
