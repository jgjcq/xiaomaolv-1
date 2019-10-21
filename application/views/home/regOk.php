<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    include_once 'public/views/home/header.php';
    ?>
<style type="text/css">

</style>
</head>
<body>
<div class="page-group">
    <div class="page page-current">
        <!-- 标题栏 -->
        <header class="bar bar-nav">
            <a class="icon  pull-right"></a>
            <h1 class="title">个人中心</h1>
        </header>
        <!-- 工具栏 -->
        <nav class="bar bar-tab">
            <a class="tab-item external " href="Home">
                <span class="icon dh_sy" ></span>
                <span class="tab-label">首页</span>
            </a>
            <a class="tab-item external " href="Home/myCourse">
                <span class="icon dh_wdkc"></span>
                <span class="tab-label">我的课程</span>
            </a>
            <a class="tab-item external active" href="Home/my">
                <span class="icon dh_grzx1"></span>
                <span class="tab-label">个人中心</span>
            </a>
        </nav>

        <!-- 这里是页面内容区 -->
        <div class="content" style="background: #ffffff">
            <div class="content-block">
                <div style="display: flex;justify-content: center;">
                    <img src="cust/images/cwkdb.png" style="width: 60%;height: 60%"/>
                </div>
                <div style="margin: 1rem">
                    <div style="text-align: center;">你的申请正在审核中</div>
                    <div style="text-align: center;">请关注公众号及时查收消息</div>
                </div>
                <div style="display: flex;justify-content: center">
                <div id="qrcode" ></div>
                </div>
            </div>

        </div>
    </div>
</div>

    <?php
    include_once 'public/views/home/script.php';
    ?>
<script type="text/javascript" src="public/assets/js/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="public/assets/js/jquery.qrcode.min.js"></script>
<script type="text/javascript">
    jQuery(function(){
        jQuery('#qrcode').qrcode("Home/course");
    });
</script>
</body>
</html>
