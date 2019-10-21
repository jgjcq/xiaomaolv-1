<?phpdefined('BASEPATH') OR exit('No direct script access allowed');?><!DOCTYPE html><html><head>    <?php    include_once 'public/views/home/header.php';    ?><style type="text/css"></style></head><body><div class="page-group">    <div class="page page-current">        <!-- 标题栏 -->        <header class="bar bar-nav">            <a class="icon pull-right"></a>            <h1 class="title">我邀请的课代表</h1>        </header>        <div class="content" style="background-color: #ffffff;padding-bottom: 1rem;padding-top: 0" >            <div class="content-block" style="margin: 0px;margin-top:0.5rem;background: url('cust/images/wyqdkdb1.png') no-repeat left center;background-size: 1.4rem 1.4rem;padding-left: 1.2rem;margin-left:4%;height: 2rem;">                <span style="margin-left: .6rem;display: inline-block;color: black;margin-top: .5rem">                我邀请的课代表</span>            </div>            <?php            if(isset($sub_list)){                foreach ($sub_list as $sub){            ?>            <div class="card" style="border-radius: 0.6rem;box-shadow:0 0.05rem 0.5rem rgba(0, 0, 0, 0.3)">                <div class="card-content">                    <div class="card-content-inner">                        <div class="row">                            <div style="margin-left: 1rem">                                <img src="<?=$sub['head_img']?>" style="width: 1.5rem;height: 1.5rem;border-radius: 50%;" />                                <?=$sub['nickname']?>                            </div>                            <div style="margin-left: 1rem;margin-top: 1rem">                                <span><?=$sub['reg_time']?></span><span style="float:right">卖出<?=$sub['count']?></span>                            </div>                        </div>                    </div>                </div>            </div>            <?php                }}                ?>        </div>    </div></div>    <?php    include_once 'public/views/home/script.php';    ?><script type="text/javascript">    function filterDeadline(time) {        //获取当前时间        var date = new Date();        var now = date.getTime();        //设置截止时间        var end = time;        //时间差        var leftTime = end-now;        //定义变量 d,h,m,s保存倒计时的时间        var d,h,m,s;        if (leftTime>=0) {            d = Math.floor(leftTime/1000/60/60/24);            h = Math.floor(leftTime/1000/60/60%24)+d*24;            m = Math.floor(leftTime/1000/60%60);            s = Math.floor(leftTime/1000%60);        }        function checkTime(time){            return time = time < 10 ? `0${time}` : time        }        return ` ${checkTime(h)}:${checkTime(m)}:${checkTime(s)}`    }    $('.ptTime').each(function () {        var ptTime = $(this).data('pttime');        var str = filterDeadline(ptTime*1000);        $(this).text("拼团进行中"+str);        setTime(this)    })    function setTime(obj){        setInterval(function () {            var ptTime = $(obj).data('pttime');            var str = filterDeadline(ptTime*1000);            $(obj).text("拼团进行中"+str);        }, 1000);    }</script></body></html>