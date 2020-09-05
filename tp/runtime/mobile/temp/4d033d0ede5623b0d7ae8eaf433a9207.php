<?php /*a:3:{s:57:"D:\phpstudy_pro\WWW\YLC\tp\view\mobile\index\details.html";i:1594872073;s:55:"D:\phpstudy_pro\WWW\YLC\tp\view\mobile\public\head.html";i:1599128251;s:57:"D:\phpstudy_pro\WWW\YLC\tp\view\mobile\public\footer.html";i:1589168462;}*/ ?>
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
<link rel="stylesheet" href="/static/css/content.css">
</head>
<body class="" ontouchstart>
<div class="bc-bg" tabindex="0" data-control="PAGE" id="Page">
    <div class="uh bc-head  ubb bc-border" data-control="HEADER" id="Header">
        <div class="ub">
            <div class="nav-btn" id="nav-left">
                <div class="fa fa-1g ub-img1 fa-angle-left fa-2x bc-text-head"></div>
            </div>
            <h1 class="ut ub-f1 ulev-3 ut-s tx-c" tabindex="0">湘西志愿者服务平台</h1>
            <div class="nav-btn" id="nav-right">
                <div class="fa  fa-1g  ub-img1"></div>
            </div>
        </div>
    </div>
    <div class="" data-control="CONTENT" id="ScrollContent">
        <div class="scrollbox">

            <div class="ub ub-ver ub-fv">
                <div class="ub ub-ver ub-fh detban">
                        <img src="<?php echo htmlentities($info['image']); ?>" width="100%">
                </div>
                <div class="ubb bc-border uinn-a1 c-wh ulev0" style="text-align:center;"><b  class="title"><?php echo htmlentities($info['title']); ?></b></div>
                <div class="ubb ubt bc-border umar-at1 uinn-a1 c-wh">
                    <div class=" line-hei ulev-1 t-gra-4e">状态:<?php $ps = projectStatus($info['status'],$info['recruit_time_start'],$info['recruit_time_end'],$info['activity_time_start'],$info['activity_time_end']);?><?php echo htmlentities($ps); ?></div>
                </div>
                <div class="ub ub-ver ubt ubb bc-border umar-at1 uinn-a2 c-wh">
                    <div class="ub  bc-border uinn-det3 ub-ac">
                        <div class="t-gra-4e ulev-1 ub-f1">招募时间:<?php echo htmlentities($info['recruit_time_start']); ?> - <?php echo htmlentities($info['recruit_time_end']); ?></div>
                    </div>
                    <div class="ub  uinn-det3 ub-ac">
                        <div class="t-gra-4e ulev-1 ub-f1">活动时间:<?php echo htmlentities($info['activity_time_start']); ?> - <?php echo htmlentities($info['activity_time_end']); ?></div>
                    </div>
                </div>

                <div class="ub ubb ubt bc-border umar-at1 uinn-det2 c-wh ub-ac">
                    <div class="t-gra-4e ulev-1 ub-f1">服务类型：<?php echo htmlentities($info['service_id']); ?></div>
                </div>

                <div class="ub ubb ubt bc-border umar-at1 uinn-det2 c-wh ub-ac">
                    <div class="t-gra-4e ulev-1 ub-f1">团队组织：<?php echo htmlentities($info['group_id']); ?></div>
                </div>


                <div class=" ubt bc-border umar-at1 uinn-a1 c-wh">
                    <div class=" line-hei ulev-1 t-gra-4e">详细内容：<?php echo htmlspecialchars_decode($info['content']); ?></div>
                </div>
            </div>
        </div>
    </div>
    <?php if($ps=="招募中"): ?>
    <div class="uf sc-bg ubt sc-border-tab"  style="border:0;padding-bottom:0.3em;">
        <div class="button  bc-text-head bc-btn" id="button" style="width:96%;line-height:2.2em;margin:0 auto;border:0;">我要报名</div>
    </div>
    <?php endif; ?>
</div>
<script src="/static/js/appcan.js">
</script>
<script src="/static/js/appcan.control.js">
</script>
<script src="/static/js/appcan.scrollbox.js">
</script>
<script src="/static/js/template.import.js">
</script>
<script >

    appcan.button("#nav-left", "btn-act", function() {
        window.history.back()
    });
    var _u = JSON.parse(appcan.locStorage.val('userInfo'));

</script>
<script>
    appcan.button("#button", "ani-act", function() {

        var _id = <?php echo htmlentities($info['Id']); ?>;

       if (_u!=null) {

           if (typeof(_u.org_name)=='undefined' && typeof(_u.uId)!='undefined') {
               $.ajax({
                   type: "GET",
                   url: "/mobile/index/enroll",
                   data: { 'uid':_u.uId,'id':_id,'service':'<?php echo htmlentities($info['service_id']); ?>','group':'<?php echo htmlentities($info['group_id']); ?>' },
                   success: function(data){

                       if (data.code) {
                           appcan.window.alert({
                               title: "提示",
                               content: data.data
                           });
                       }else{
                           appcan.window.alert({
                               title : "提示",
                               content : "报名成功"
                           });
                       }
                   },
                   error:function(e){
                       appcan.window.alert({
                           title : "提示",
                           content : "报名失败"
                       });
                   }
               });

           }else{
               appcan.window.alert({
                   title : "提示",
                   content : "组织团队账号不能报名"
               });
           }

       }else{
           appcan.window.alert({
               title : "提示",
               content : "请登陆账号报名"
           });
       }

    });
</script>
</body>
</html>