<?php /*a:3:{s:54:"D:\phpstudy_pro\WWW\YLC\tp\view\mobile\index\news.html";i:1599291204;s:60:"D:\phpstudy_pro\WWW\YLC\tp\view\mobile\public\index_ext.html";i:1599291185;s:55:"D:\phpstudy_pro\WWW\YLC\tp\view\mobile\public\head.html";i:1599128251;}*/ ?>
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
    
<div class="ub">
    <div class="nav-btn" id="nav-left">
        <div class="fa fa-1g ub-img1 fa-angle-left fa-2x bc-text-head">
        </div>
    </div>
    <h1 class="ut ub-f1 ulev-3 ut-s tx-c bc-text-head" tabindex="0">志愿动态</h1>
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

<div class="tab_pane active" style="min-height:3em;"></div>

<div class="sc-bg"  id="ScrollContent_Pa34I9">
    
    <div id="celltemplate" style="display:none">
        <li  class="ubb ub bc-border t-bla ub-ac lis uof" data-index="0">
            <ul class="ub ub ub-ver #urlimg#" >
                <li class="">
                    <div class="lazy lis-icon ub-img" data-original="css/res/appcan_s.png" ><img width="100%" src="#url#"></div>
                    <div class="ulev-1 bc-text umar-t"></div>
                </li>
            </ul>
            <ul class="ub-f1 ub ub-pj ub-ac">
                <a class="ub ub-ver ub-f1" href="/mobile/index/#details#/?id=#id#">
                    <ul class="ub-f1 ub ub-ver marg-l">
                        <li class="bc-text ub ub-ver uof ut-m line1">#title#</li>
                        <li class="ulev-1 uof sc-text1 uinn3 line1 h38" >#summary#</li>
                        <li class="ulev-2  sc-text1 uinn3 service_id" ><div class="ufl">#service_id#</div><div class="ufr">#create_time#</div></li>
                    </ul>
                </a>
            </ul>
            <ul><li class="#class#"></li></ul>
        </li>
    </div>
    <!--<ul id="org_templte" style="display:none">
      <li class="ubb ub bc-border bc-text ub-ac lis"  data-index="0"><div class="checkbox2 umar-r #umar-l#"><input type="checkbox" class="uabs ub-con"></div><div class="lv_title ub-f1 marg-l ub ub-ver ut-m line1">#org_name#</div></li>
    </ul>-->
    <ul id="divscroll">

    </ul>
    
</div>

<div class="tab_pane" data-control="PANE" id="Pane_1">
    
</div>

<div class="tab_pane " data-control="PANE" id="Pane_2" style="margin-top:3.3em">
    
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

<style>#divscroll   .ub-img{ width: 10em !important;}</style>
<div class="mores" id="mores" > 加载更多</div>
<script>

    window.onload = function () {
        mobanhtml = $('#celltemplate').html();
        UseIScrollHelper.fillList = FillList;
        UseIScrollHelper.url = "/mobile/readNews";
        UseIScrollHelper.datas = "";
        UseIScrollHelper.getData();
       // UseIScrollHelper.loadSroll();

    }

    function FillList(listdata) {
        var l =listdata.length;

        for (var i = 0; i < l ; i++) {
            var datas = listdata[i];

            var inserthtml = mobanhtml.replace("#title#", datas.title);
            inserthtml = inserthtml.replace("#summary#", datas.summary);
            inserthtml = inserthtml.replace("#details#", 'content');
            inserthtml = inserthtml.replace("#id#", datas.Id)
            if(datas.image){
                inserthtml = inserthtml.replace("#url#", datas.image);
            }else{
                inserthtml = inserthtml.replace("#urlimg#", 'urlimg');
            }

            $('#divscroll').append(inserthtml);
        }
    }



    (function($) {

        $('.service_id').hide();
        $('#mores').click(function(){
            UseIScrollHelper.getData();
        });
    })($);
</script>

</body>
</html>
