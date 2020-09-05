<?php /*a:2:{s:55:"D:\phpstudy_pro\WWW\YLC\tp\view\mobile\index\login.html";i:1594605924;s:55:"D:\phpstudy_pro\WWW\YLC\tp\view\mobile\public\head.html";i:1599128251;}*/ ?>
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
<link rel="stylesheet" href="/static/css/m_lgoin.css">
</head>
    <body class="" ontouchstart>
        <div class="bc-bg" tabindex="0" data-control="PAGE" id="Page_w8VKMG">
            <div class="uh bc-head  ubb bc-border" data-control="HEADER" id="Header_XnidYV">
                <div class="ub">
                    <div class="nav-btn" id="nav-left">
                        <div class="fa fa-1g ub-img1 fa-angle-left fa-2x bc-text-head"></div>
                    </div>
                    <h1 class="ut ub-f1 ulev-3 ut-s tx-c bc-text-head" tabindex="0">志愿者登陆</h1>
                    <div class="nav-btn" id="nav-right">
                        <div class="fa  fa-1g  ub-img1">
                        </div>
                    </div>
                </div>
            </div>
            <em style="position:absolute;top:3.2em;left:0.5em;color:gray;">提示：使用生活网账号可以直接登陆</em>
            <div class="bc-bg ub ub-ver ub-ac ub-con" data-control="FLEXBOXVER" id="ContentFlexVer_LyILCL">
                <div class="ub-f1" data-control="BOX" id="Box_kGb775">
                    <div class="uinput ub bc-border uba ub-ac" data-control="ICONINPUT" id="iconInput_5tYUWA">
                        <div class="uinn fa sc-text fa-user" data-control-icon="">
                        </div>
                        <input placeholder="" type="text" class="ub-f1" data-control-scope="iconInput_5tYUWA" data-bind="value:username">
                    </div>
                </div>
                <div class="ub-f1 " data-control="BOX" id="Box_Flzy73">
                    <div class="uinput ub bc-border uba ub-ac" data-control="ICONINPUT" id="iconInput_5mMwJ4">
                        <div class="uinn fa sc-text fa-lock" data-control-icon="">
                        </div>
                        <input placeholder="" type="password" class="ub-f1" data-control-scope="iconInput_5mMwJ4" data-bind="value:password">
                    </div>
                </div>

                <div class="ub-f1" data-control="BOX" id="Box_9Gq22l">
                    <div class="button ub ub-ac bc-text-head ub-pc bc-btn" id="Button_5f65Bo">确定</div>
                </div>
                <div class="ub-f1" style="position:absolute;right:1em;" data-control="BOX" id="Box_IABGkC">
                    <a href="https://share.0743sh.com/wap/login/register?url=http://zyz.07430743.com/mobile/moblielogin.html" class="umar-r">志愿者注册</a>
                    &nbsp;
                    <a href="javascript:findpsw();" >忘记密码</a>
                </div>
            </div>
        </div>
        <script src="/static/js/appcan.js">
        </script>
        <script src="/static/js/appcan.control.js">
        </script>
        <script src="/static/js/appcan.scrollbox.js">
        </script>
        <script src="/static/js/template.import.js">
        </script>
        <script src="/static/js/mvvm_login.js">
        </script>
        <script >
            function findpsw(){
                appcan.window.alert({
                    title : "提示",
                    content : "请下载客户端前去找回?",
                    buttons : ['前去下载', '我再看看'],
                    callback : function(err, data, dataType, optId) {
                        if(!data){
                            window.location.href='https://share.0743sh.com/wap/download/index';
                        }
                    }
                });
            }
            appcan.button("#nav-left", "btn-act", function() {
                window.history.back()
            });
        </script>

    </body>
</html>