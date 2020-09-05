<?php /*a:5:{s:54:"D:\phpstudy_pro\WWW\YLC\tp\view\admin\index\index.html";i:1594610557;s:62:"D:\phpstudy_pro\WWW\YLC\tp\view\admin\public\admin_public.html";i:1586400114;s:56:"D:\phpstudy_pro\WWW\YLC\tp\view\admin\public\header.html";i:1587194796;s:56:"D:\phpstudy_pro\WWW\YLC\tp\view\admin\public\topbar.html";i:1596508323;s:56:"D:\phpstudy_pro\WWW\YLC\tp\view\admin\public\footer.html";i:1586400965;}*/ ?>
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
        
<div class="mdui-m-a-1 mdui-typo">
    <div class="mdui-col-xs-12 mdui-col-sm-6 mf-panel">
        <div class="mf-panel-hd">
            <h3>系统信息</h3>
        </div>

        <div class="mf-panel-bd" style="width:806px;">
            <?php if($privil=='-'): ?>
            <ul style="width:370px;float: left">
                <li>动态新闻待审核 :<a href="/admin/froum.html?id=0"><?php echo htmlentities($noAuditNews); ?></a> 条</li>
                <li>组织活动待审核 :<a href="/admin/Project.html?id=1"><?php echo htmlentities($noAuditActiv); ?></a> 条</li>
            </ul>
            <?php else: ?>
            <ul style="width:370px;float: left;">
                <li>已发布动态新闻 :<a href="/admin/froum.html"><?php echo htmlentities($noAuditNews); ?></a> 条</li>
                <li>已发布组织活动 :<a href="/admin/Project.html"><?php echo htmlentities($noAuditActiv); ?></a> 条</li>
            </ul>
            <?php endif; ?>
            <ul style="width:370px;float: right">
                <li>待审核人员:<a href="/admin/notVolunteer.html"><?php echo htmlentities($notExamine); ?></a> 条</li>
                <li>待审核组织:<a href="/admin/examineOrg.html"><?php echo htmlentities($notOrg); ?></a> 条</li>
            </ul>
        </div>
    </div>
    <div class="mdui-col-xs-12 mdui-col-sm-6 mf-panel" style="display:none;">
        <div class="mf-panel-hd">
            <h3>关于MlTree Forum</h3>
        </div>

        <div class="mf-panel-bd">
            <h2>MlTree Forum 1.0.0</h2>
            <ul>
                <li>主页：
                    <a href="https://forum.mltree.top">https://forum.mltree.top</a>
                </li>
                <li>Coding：
                    <a href="https://coding.net/u/Mllb_Kingsr/p/MlTree-Forum/">https://coding.net/u/Mllb_Kingsr/p/MlTree-Forum/</a>
                </li>
                <li>许可证：<a href="https://choosealicense.com/licenses/gpl-3.0/">GNU General Public License v3.0</a></li>
                <li>其他：
                    <a href="https://t.me/joinchat/Hewif0uvElMgVnAK_WrFJw
">https://t.me/joinchat/Hewif0uvElMgVnAK_WrFJw
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>



    </div>
</div>
<footer class="mdui-bottom-nav">
    <div>湘西志愿者系统</div>
</footer> 
</body>

</html>