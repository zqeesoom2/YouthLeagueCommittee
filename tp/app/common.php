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