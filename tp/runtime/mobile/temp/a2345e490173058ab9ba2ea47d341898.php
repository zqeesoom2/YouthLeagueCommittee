<?php /*a:3:{s:55:"D:\phpstudy_pro\WWW\YLC\tp\view\mobile\reg\ranking.html";i:1599290662;s:60:"D:\phpstudy_pro\WWW\YLC\tp\view\mobile\public\index_ext.html";i:1599290597;s:55:"D:\phpstudy_pro\WWW\YLC\tp\view\mobile\public\head.html";i:1599128251;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <title>志愿者服务平台</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="/static/css/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/static/css/ui-box.css">
    <link rel="stylesheet" href="/static/css/ui-base.css">
    <link rel="stylesheet" href="/static/css/ui-color.css">
    <link rel="stylesheet" href="/static/css/appcan.icon.css">
    <link rel="stylesheet" href="/static/css/appcan.control.css">
<link rel="stylesheet" href="/static/css/index.css">
<style>#divscroll{display: block;}#loginOut{width: 80%;margin: 0 auto;margin-top: 1em;}</style>
<script src="https://cdn.bootcss.com/vConsole/3.3.4/vconsole.min.js"></script>
<script>
    // 初始化
    var vConsole = new VConsole();
    console.log('Hello world');
</script>

</head>
<body ontouchstart>
<div class="uh bc-head  ubb bc-border header" data-control="HEADER" id="Header_0">
    
<link rel="stylesheet" href="/static/css/ranking.css">
<div class="ub">
    <div class="nav-btn" id="nav-left">
        <div class="fa fa-1g ub-img1 fa-angle-left fa-2x bc-text-head">
        </div>
    </div>
    <h1 class="ut ub-f1 ulev-3 ut-s tx-c bc-text-head" tabindex="0">数据展示</h1>
    <div class="nav-btn" id="nav-right">
        <div class="fa  fa-1g  ub-img1">
        </div>
    </div>
</div>

</div>
<div class="uh ub ub-f1 ub-pc ub-ac uhide header bc-head" data-control="HEADERBOX" id="Header_1" style="position:fixed;">
    
        <div class="uinput ub bc-border uba ub-f1 umar-l umar-r" data-control="SEARCH" id="Search">
            <div class="uinn fa fa-search sc-text"></div>
            <input placeholder="请输入关键词" type="search" class="ub-f1 ub ub-pc ub-ac" id="Search_1" data-control-scope="Search">
        </div>
        <div class="ub ub-ac ub-pc ub-img1 umar-r" data-control="" id="fa-search">
            <div class="fa  fa-1g  ub-img1 fa-search" data-control-icon=""></div>
        </div>
    
</div>

<div class="uh bc-head  ubb bc-border uhide header" data-control="HEADER" id="Header_2">
    
    <div class="ub">
        <div class="nav-btn" id="nav-left">
            <div class="fa fa-1g ub-img1"></div>
        </div>
        <h1 class="ut ub-f1 ulev-3 ut-s tx-c" tabindex="0">我的账户</h1>
        <div class="nav-btn loginOut"  id="nav-right">
            <div class="fa ub-img1 fa-sign-out a-1g  ulev2"></div>
        </div>
    </div>
    
</div>
<div class="uh ub ub-pc ub-ac uhide header bc-head" data-control="HEADERBOX" id="Header_3">
    
    <div class="ub-f1 ub-ac ub-pc uinn">
        <div class="ub uc-a1  b-wh uba1 tx-c">
            <input type="radio" name="rdi1" class="uhide" value="" checked="true">
            <div onClick="appcan.elementFor(event)" class="uinn-a15 ub-f1 rdi ubb-pic ulev-4 t-blu2 bc-head" style="margin-left:.2em">
                招募中
            </div>
            <input type="radio" name="rdi1" class="uhide" value="">
            <div onClick="appcan.elementFor(event)" class="uinn-a15 c-blu ub-f1 rdi ulev-4 t-wh ubb-pic b-wh bc-head">
                进行中
            </div>
            <input type="radio" name="rdi1" class="uhide" value="">
            <div onClick="appcan.elementFor(event)" class="uinn-a15 c-blu ub-f1 rdi ulev-4 t-wh bc-head" style="margin-right:.2em">
                已完成
            </div>
        </div>
    </div>
    
</div>

<div class="tab_pane active" style="min-height:3.5em;"></div>

<div class="sc-bg"  id="ScrollContent_Pa34I9">
    
</div>

<div class="tab_pane" data-control="PANE" id="Pane_1">
    
</div>

<div class="tab_pane " data-control="PANE" id="Pane_2" style="margin-top:3.3em">
    
<div class="ub ub-ver">
    <div class="ub ub-ver uinn-a1">
        <div class="ub-img-rank rank-bg uinn-t-rank">
            <div class="ub c-blu-rank uinn-a1 t-blu-rank umar-fr1" id="ranking">
                <div class="ub-f1 stab" id="1">
                     总数据
                </div>
                <div class="ub-f1" id="2">
                    年度数据
                </div>
                <div class="ub-f1" id="3">
                    季度数据
                </div>
            </div>
            <div id="username">
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?>
                <div class="ub c-wh uinn-a1 ubb bc-border">
                        <div class="ub-f1">
                            &nbsp;&nbsp;&nbsp;<?php echo htmlentities($i); ?>&nbsp;&nbsp;&nbsp;
                        </div>
                        <div class="ub-f1">
                            &nbsp;&nbsp;&nbsp;<?php echo htmlentities($s['real_name']); ?>
                        </div>
                        <div class="ub-f1">
                            &nbsp;&nbsp;&nbsp;<?php echo htmlentities($s['length_ser']); ?>小时
                        </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
    </div>


</div>
<style>.zhy_bg{opacity:1 !important;}.loader_confirm{height: 200% !important;position:absolute !important;}</style>


</div>
<div class="uf sc-bg ubt sc-border-tab ub-f1 ub" data-control="FOOTER" id="Footer">
    <div class="ub-f1 ub" data-control="TAB" id="Tab"></div>
</div>

<script src="/static/js/appcan.js"></script>
<script src="/static/js/appcan.control.js"></script>
<script src="/static/js/appcan.listview.js"></script>
<script src="/static/js/template.import.js"></script>
<script src="/static/js/appcan.tab.js"></script>
<script src="/static/js/appcan.slider.js"></script>
<script src="/static/js/iscroll.js"></script>
<script src="/static/js/index.js"></script>
<!--<script>alert('<-');</script>-->


<script>
    function _temple(listdata) {

        var s='',datas = [],inserthtml='',l =listdata.length,temple = '<div class="ub c-wh uinn-a1 ubb bc-border"><div class="ub-f1">&nbsp;&nbsp;&nbsp;#id#&nbsp;&nbsp;&nbsp;</div><div class="ub-f1">&nbsp;&nbsp;&nbsp;#name#</div><div class="ub-f1">&nbsp;&nbsp;&nbsp;#hours#小时</div></div>';

        for (var i = 0; i < l ; i++) {
           datas = listdata[i];
            inserthtml = temple.replace("#id#", i+1);
            inserthtml = inserthtml.replace("#name#", datas.real_name);
            inserthtml = inserthtml.replace("#hours#", datas.length_ser);
        }

        if(!l)
            s = '没有数据!';
        $('#username').html(s).append(inserthtml);

    }


    (function($) {
        $('#ranking div').click(function () {
            $('#ranking .stab').removeClass('stab');
            var div = $(this),type_ = 0;
            div.addClass('stab');

            type_ =  div.attr('id');
            $.ajax({
                type: "POST",
                url: "/mobile/Reg/ranking",
                data: {'type_':type_},
                success: function(data){
                    if(data.state);
                      _temple(data.list);
                }
            });


        });
        $('#Pane_2').removeAttr('data-control').removeClass('tab_pane').attr('style','');

    })($);
</script>

</body>
</html>
