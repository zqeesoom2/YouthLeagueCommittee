<?php
// 应用公共文件

function make_tree($data,$parent_id = 0,$level = 1)
{
    static $newData = [];
    foreach ($data as $d) {
        if ($d["parent_id"] == $parent_id) {
            $d["level"] = $level;
            $newData[] = $d;
            make_tree($data,$d["Id"],$level+1);
        }
    }
    return $newData;
}

function upload_img($field , $catalog = 'images'){

    $file = request()->file($field);

    try {
        validate(['file' => [
            'fileSize' => 8388608, 'fileExt' => 'gif,jpg,png,mp4']])->check(['file'=>$file]);

        $savename= \think\facade\Filesystem::disk('public')->putFile($catalog, $file);

        return $savename;
    } catch (\think\exception\ValidateException $e) {
        return  $e->getMessage();
    }
}
