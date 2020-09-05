<?php /*a:5:{s:55:"D:\phpstudy_pro\WWW\YLC\tp\view\admin\froum\create.html";i:1594785143;s:62:"D:\phpstudy_pro\WWW\YLC\tp\view\admin\public\admin_public.html";i:1586400114;s:56:"D:\phpstudy_pro\WWW\YLC\tp\view\admin\public\header.html";i:1587194796;s:56:"D:\phpstudy_pro\WWW\YLC\tp\view\admin\public\topbar.html";i:1596508323;s:56:"D:\phpstudy_pro\WWW\YLC\tp\view\admin\public\footer.html";i:1586400965;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>湘西志愿者管理后台</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="湘西志愿者管理后台" />
    <meta name="description" content="湘西志愿者管理后台" />
    <!-- 设置Theme -->
    <meta name="setPrimary" content="">
    <meta name="setAccent" content="">
    <meta name="setLayout" content="">

    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/css/mdui.min.css">
    <link rel="stylesheet" href="/static/css/admin_common.css">
    <link rel="shortcut icon" href="//at.alicdn.com/t/font_579119_2arllyqcj9p8ehfr.css" type="image/x-icon">
    <script src="/static/layui/layui.js"></script>
    <script src="/static/layui/lay/modules/Content/ace/ace.js"></script>
    <script src="/static/js/mdui.min.js"></script>
</head>
<body class="mdui-theme-primary-pink mdui-theme-accent-pink mdui-drawer-body-left mdui-appbar-with-toolbar">
<script src="/static/js/theme.js"></script>
<header class="mdui-appbar mdui-appbar-fixed">
    <div class="mdui-toolbar mdui-color-theme">
        <a href="javascript:;" class="mdui-btn mdui-btn-icon" mdui-drawer="{target: '#left-menu'}">
            <i class="mdui-icon material-icons"><font color="#f0f8ff">menu</font></i>
        </a>
        <a href="/" class="mdui-typo-headline"><font color="#f0f8ff">湘西志愿者管理后台</font></a>
        <div class="mdui-toolbar-spacer"></div>
        <a href="javascript:;" class="mdui-btn mdui-btn-icon" onclick="location.reload()">
            <i class="mdui-icon material-icons"><font color="#f0f8ff">refresh</font></i>
        </a>

        <a href="javascript:;" class="mdui-btn mdui-btn-icon" mdui-menu="{target: '#more'}">
            <i class="mdui-icon material-icons"><font color="#f0f8ff">more_vert</font></i>
        </a>
        <ul class="mdui-menu mdui-menu-cascade" id="more">
            <li class="mdui-menu-item">
                <a href="<?php echo url('out'); ?>" class="mdui-ripple"><?php echo htmlentities($admin); ?>&nbsp;&nbsp;&nbsp;退出后台</a>
            </li>
        </ul>

    </div>
</header>



<div class="mdui-drawer" id="left-menu">
    <ul class="mdui-list mdui-collapse" id="collapse" mdui-collapse="{accordion:true}">

        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">home</i>
            <div class="mdui-list-item-content">
                <a href="<?php echo url('index/index'); ?>">后台首页</a>
            </div>
        </li>

        <li class="mdui-collapse-item" id="sys">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">settings</i>
                <div class="mdui-list-item-content">志愿项目管理</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <?php if(session('service')): ?>
                <a href="<?php echo url('addProject'); ?>">
                    <li class="mdui-list-item mdui-ripple" id="addProject">添加志愿项目</li>
                </a>
                <?php endif; ?>
                <a href="<?php echo url('Project'); ?>">
                    <li class="mdui-list-item mdui-ripple" id="Project">查看志愿项目</li>
                </a>
                <a href="<?php echo url('enrollList'); ?>">
                    <li class="mdui-list-item mdui-ripple" id="enroll">查看报名情况</li>
                </a>
                <!--<a href="<?php echo url('set/baseMail'); ?>">
                    <li class="mdui-list-item mdui-ripple" id="baseMail">设置</li>
                </a>-->
            </ul>
        </li>

        <li class="mdui-collapse-item" id="froum">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">forum</i>
                <div class="mdui-list-item-content">最新动态</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>


            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="<?php echo url('addFroum'); ?>">
                    <li class="mdui-list-item mdui-ripple" id="addFroum">添加动态</li>
                </a>
                <a href="<?php echo url('froum'); ?>">
                    <li class="mdui-list-item mdui-ripple" id="froumList">查看动态</li>
                </a>

                <a href="<?php echo url('addSlide'); ?>">
                    <li class="mdui-list-item mdui-ripple" id="addSlide">添加幻灯片</li>
                </a>
                <a href="<?php echo url('slideList'); ?>">
                    <li class="mdui-list-item mdui-ripple" id="slideList">查看幻灯片</li>
                </a>
            </ul>
        </li>

        <li class="mdui-collapse-item" id="user">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">layers</i>
                <div class="mdui-list-item-content">组织人员管理</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>


            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="<?php echo url('adminAdminOrgs'); ?>">
                    <li class="mdui-list-item mdui-ripple" id="setOrgs">团队组织结构</li>
                </a>

                <a href="<?php echo url('volunteer'); ?>">
                    <li class="mdui-list-item mdui-ripple" id="setAuth">志愿者管理</li>
                </a>

            </ul>
        </li>
        <?php if($privil=='-'): ?>
        <li class="mdui-collapse-item" id="adminuser">
            <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">group</i>
                <div class="mdui-list-item-content">管理员管理</div>
                <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>

            <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                <a href="<?php echo url('adduser'); ?>">
                    <li class="mdui-list-item mdui-ripple" id="adduser">添加服务组织管理员</li>
                </a>
            </ul>
        </li>
        <?php endif; ?>

    </ul>
</div>
<div class="mdui-container-fluid">
    <div class="mdui-row mdui-center">
        
<div class="mdui-m-a-1 mdui-typo mdui-table-fluid">

    <h1 class="mdui-m-l-3">添加最新动态</h1>
    <div class="mdui-dialog-content">
    <form id="addForm" class="layui-form layui-form-pane mdui-m-y-1">
        <div class="layui-form-item">
            <label class="layui-form-label">标题</label>

            <div class="layui-input-block">
                <input type="text" name="title" required lay-verify="required" placeholder="请输入文章标题" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">摘要</label>
            <div class="layui-input-block">
                <input type="text" name="summary" required lay-verify="required" placeholder="请输入文章摘要" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">项目内容</label>
            <div class="layui-input-block">
                <textarea id="artcontent" class="layui-textarea" ></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">项目封面</label>
            <div class="layui-input-block">
                <button type="button"  class="layui-btn" id="upimage">
                    <i class="layui-icon">&#xe67c;</i>上传图片
                </button>
                <input type="hidden" name="image" id="imageurl" value="">
            </div>
        </div>
        <div class="layui-form-item">
            <div id="img" class="layui-input-block">
            </div>
        </div>
        <div class="layui-form-item">
                <center>
                <button class="layui-btn"  lay-submit lay-filter="formSubmit">保&nbsp;存</button></center>
        </div>
    </form></div>

</div>



    </div>
</div>
<footer class="mdui-bottom-nav">
    <div>湘西志愿者系统</div>
</footer> 
<script>

    var $$ = mdui.JQ

    layui.use(['layedit','form','upload','laydate'], function(){
         form = layui.form;

        layedit = layui.layedit;
        layedit.set({
            uploadImage:{
                url:"<?php echo url('articleUpimage'); ?>",
            }, uploadVideo: {
                url: "<?php echo url('articleUpVideo'); ?>",
                size: '204800'
            },
            tool: [
                'html','code'
                , 'strong', 'italic', 'underline', 'del',
                ,'addhr' //添加水平线
                ,'|', 'fontFomatt','colorpicker' //段落格式，字体颜色
                , 'face', '|', 'left', 'center', 'right', '|', 'link', 'unlink'
                , 'image_alt', 'altEdit', 'video'
                ,'anchors' //锚点
                , '|', 'fullScreen'
            ]
        })

        content = layedit.build('artcontent', {
            height: 600
        });

        var upload = layui.upload;

        var uploadInst = upload.render({
            elem: '#upimage'
            ,field:"image"
            ,url: "<?php echo url('articleUpimage/image'); ?>"
            ,done: function(res){
                var path = res.data.src;
                var img = "<img src='"+path+"' />";
                $$("#imageurl").val(path);
                $$("#img").html(img);
            }
        });

        laydate = layui.laydate;

        laydate.render({
            elem: '#recruit_time',range: true
        });

        laydate.render({
            elem: '#activity_time',
            type: 'datetime'
            ,range: true
        });

        form.on('submit(formSubmit)', function(data){

            var JsonVal =data.field;

            JsonVal.content = layedit.getContent(content);

            $$.ajax({
                method: 'POST',
                url: "<?php echo url('addFroum'); ?>",
                data: JsonVal,
                dataType: 'json',
                success: function (res) {
                    var str = '提交成功';
                    if (!res.code) {
                        mdui.snackbar('提交失败', {
                            timeout: 2000,
                            position: 'top'
                        });

                    }else{
                        mdui.snackbar(str, {
                            timeout: 2000,
                            position: 'top',
                            onClose: function () {
                                ;
                            },
                            onClosed: function () {
                                window.history.back();
                            }
                        });
                    }


                }
            })

            return false;
        });

    });

    $$('#froum').addClass('mdui-collapse-item-open');
    $$('#addFroum').addClass('mdui-list-item-active');

</script> 
</body>

</html>