<?phpdefined('BASEPATH') OR exit('No direct script access allowed');?><!DOCTYPE html><html><head>    <?php    include_once 'public/views/home/header.php';    ?><style type="text/css"></style></head><body><div class="page-group">    <div class="page page-current">        <!-- 标题栏 -->        <header class="bar bar-nav">            <a class="icon pull-right"></a>            <h1 class="title">累计奖学金</h1>        </header>        <div class="content" style="background-color: #ffffff;padding-bottom: 1rem;padding-top: 0" >            <div class="content-block" style="margin: 0px;margin-top:0.5rem;color: black;padding: unset;margin-left: 0.5rem">                累计奖学金            </div>            <?php            if(isset($list)){                foreach ($list as $sub) {                    ?>                    <div class="card" style="margin: 0.8rem 0.5rem;border-radius: 0.6rem;box-shadow:0 0.05rem 0.3rem rgba(0, 0, 0, 0.3)">                        <div class="card-content">                            <div class="card-content-inner">                                <div class="row">                                    <div style="margin-left: 1rem">                                        <span style="color: #acacac">订单号：<?= $sub['order_number'] ?></span>                                        <span style="float: right;color: black">                                            <?php                                                if(in_array($sub['type'],array("hhr_tc","yj_lmm_tc","ej_lmm_tc"))){                                                    echo '直属';                                                }else{                                                    echo '下级';                                                }                                            ?>                                        </span>                                    </div>                                    <div style="margin-left: 1rem;margin-top: .6rem;color: #acacac;text-align: center">                                        <span style="float: left">订单额￥<?= $sub['price'] ?></span><span                                               >比例<?= $sub['tc'] ?>%</span><span                                                style="float:right;color: black">奖学金 ￥<?= $sub['tc_price'] ?></span>                                    </div>                                </div>                            </div>                        </div>                    </div>                    <?php                }}            ?>        </div>    </div></div>    <?php    include_once 'public/views/home/script.php';    ?><script type="text/javascript">    function filterDeadline(time) {        //获取当前时间        var date = new Date();        var now = date.getTime();        //设置截止时间        var end = time;        //时间差        var leftTime = end-now;        //定义变量 d,h,m,s保存倒计时的时间        var d,h,m,s;        if (leftTime>=0) {            d = Math.floor(leftTime/1000/60/60/24);            h = Math.floor(leftTime/1000/60/60%24)+d*24;            m = Math.floor(leftTime/1000/60%60);            s = Math.floor(leftTime/1000%60);        }        function checkTime(time){            return time = time < 10 ? `0${time}` : time        }        return ` ${checkTime(h)}:${checkTime(m)}:${checkTime(s)}`    }    $('.ptTime').each(function () {        var ptTime = $(this).data('pttime');        var str = filterDeadline(ptTime*1000);        $(this).text("拼团进行中"+str);        setTime(this)    })    function setTime(obj){        setInterval(function () {            var ptTime = $(obj).data('pttime');            var str = filterDeadline(ptTime*1000);            $(obj).text("拼团进行中"+str);        }, 1000);    }</script></body></html>