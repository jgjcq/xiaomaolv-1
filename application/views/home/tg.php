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
    .btn-left a{
        width: 5rem;
        border-radius: 1rem;
        background-color: #f5d809 !important;
        font-size: 0.5rem;
        height: 1.5rem;
        line-height: 1.5rem !important;
        color: #000 !important;
        width: 6rem;
    }
    .btn-right a{
        width: 5rem;
        border-radius: 1rem;
        background-color: #ea7a1a !important;
        font-size: 0.5rem;
        height: 1.5rem;
        line-height: 1.5rem !important;
        color: #fff !important;
        width: 6rem;
    }
    .btn-right{
        padding-left: 4rem;
    }
    .btn-left{
        padding-left: 0.5rem;

    }
</style>
</head>
<body>
<div class="page-group">
    <div class="page page-current">
        <!-- 标题栏 -->
        <header class="bar bar-nav">
            <a class="icon pull-right"></a>
            <h1 class="title">推广海报</h1>
        </header>
        <div class="content" style="background-color: #ffffff;padding-bottom: 1rem" >
            <div class="card" style="border-radius: 0.6rem;box-shadow:0 0.05rem 0.5rem rgba(0, 0, 0, 0.3);margin-top:2rem;margin-bottom: 2rem" >
                <div class="card-content">
                    <div class="card-content-inner" style="padding: 0px">
                        <div class="row">
                            <div class="col-100">
                                <img src="<?=$ad_image?>" width="100%"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <span style="float: left" class="btn-left"><a class="button button-fill" href="#" id="fx">分享海报</a></span>
                <span style="float: left" class="btn-right"><a class="button button-fill">邀请好友参团</a></span>
            </div>
        </div>


    </div>
</div>

    <?php
    include_once 'public/views/home/script.php';
    ?>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<script type="text/javascript" src="public/assets/js/jquery-2.0.3.min.js"></script>
<script type="text/javascript">

    function filterDeadline(time) {
        //获取当前时间
        var date = new Date();
        var now = date.getTime();
        //设置截止时间
        var end = time;

        //时间差
        var leftTime = end-now;
        //定义变量 d,h,m,s保存倒计时的时间
        var d,h,m,s;
        if (leftTime>=0) {
            d = Math.floor(leftTime/1000/60/60/24);
            h = Math.floor(leftTime/1000/60/60%24)+d*24;
            m = Math.floor(leftTime/1000/60%60);
            s = Math.floor(leftTime/1000%60);
        }
        function checkTime(time){
            return time = time < 10 ? `0${time}` : time
        }
        return ` ${checkTime(h)}:${checkTime(m)}:${checkTime(s)}`

    }
    $('.ptTime').each(function () {
        var ptTime = $(this).data('pttime');
        var str = filterDeadline(ptTime*1000);
        $(this).text("拼团进行中"+str);
        setTime(this)
    })
    function setTime(obj){
        setInterval(function () {
            var ptTime = $(obj).data('pttime');
            var str = filterDeadline(ptTime*1000);
            $(obj).text("拼团进行中"+str);
        }, 1000);
    }

    wx.config({
        debug: true,
        appId: "<?=$signPackage['appId']?>",
        timestamp: <?=$signPackage['timestamp']?>,
        nonceStr: "<?=$signPackage['nonceStr']?>",
        signature: "<?=$signPackage['signature']?>",
        jsApiList: ['onMenuShareAppMessage',
            'onMenuShareTimeline',
            'chooseWXPay',
            'showOptionMenu',
            "updateAppMessageShareData",
            "hideMenuItems",
            "showMenuItems",
            "onMenuShareTimeline",
            'onMenuShareAppMessage']
    });
    wx.ready(function() {
        wx.checkJsApi({
            jsApiList: [
                'updateAppMessageShareData'
            ],
            success: function(res) {
                console.log(res)
            }
        });
        $('#fx').click(function () {
            //分享到朋友圈
            wx.updateAppMessageShareData({
                title: "驴妈妈推广",
                desc: "驴妈妈推广",
                link: 'http://fineui.dye360.cn/Home/my/kdb/<?=$fx_id?>',
                imgUrl:"" ,
                success: function() {
                    alert("分享成功！")
                    // 用户确认分享后执行的回调函数
                },
                cancel: function() {
                    alert("取消分享！")
                    // 用户取消分享后执行的回调函数
                }
            });
        })

        //分享给朋友
        wx.onMenuShareAppMessage({
            title: "驴妈妈推广",
            desc: "驴妈妈推广",
            link: 'http://fineui.dye360.cn/Home/my/kdb/<?=$fx_id?>',
            imgUrl:"" ,
            success: function() {
                alert("分享成功！")
                // 用户确认分享后执行的回调函数
            },
            cancel: function() {
                alert("取消分享！")
                // 用户取消分享后执行的回调函数
            }
        });



    });

</script>
</body>
</html>
