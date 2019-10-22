<?phpdefined('BASEPATH') OR exit('No direct script access allowed');?><!DOCTYPE html><html><head>    <?php    include_once 'public/views/home/header.php';    ?><style type="text/css">    .span-active{        position: relative;        color: black;    }    .span{        line-height: 40px;        display: inline-block;        height: 100%;    }    .span-active:before{        content: '';        width: 100%;        height: 3px;        background: #f9d30a;        position: absolute;        bottom: 0;    }    .item-media>img{        width: 100% !important;    }    .item-media{        margin: unset !important;    }    .bottom_li{        border-bottom: 1px solid #d4d4d4;    }    .item-content{        border-bottom: unset;    }    .my-course-list-price{        padding-bottom: 1rem !important;    }    .item-title{        color: black;    }</style></head><body><div class="page-group">    <div class="page page-current">        <!-- 标题栏 -->        <header class="bar bar-nav">            <a class="icon icon-refresh pull-right"></a>            <h1 class="title">我的拼团</h1>        </header>        <!-- 工具栏 -->        <nav class="bar bar-tab">            <a class="tab-item external " href="Home">                <span class="icon dh_sy" ></span>                <span class="tab-label">首页</span>            </a>            <a class="tab-item external " href="Home/myCourse">                <span class="icon dh_wdkc"></span>                <span class="tab-label">我的课程</span>            </a>            <a class="tab-item external active" href="Home/my">                <span class="icon dh_grzx1"></span>                <span class="tab-label">个人中心</span>            </a>        </nav>        <!-- 这里是页面内容区 -->        <div class="content" style="background: #ffffff;padding-top: 0 !important">            <div class="buttons-tab" style="line-height: 40px">                <a href="#tab1" style="border-bottom: unset" class="tab-link button active">                    <span class=" span span-active">全部</span>                </a>                <a href="#tab2" style="border-bottom: unset" class="tab-link button">                    <span class="span">拼团中</span>                </a>                <a href="#tab3" style="border-bottom: unset" class="tab-link button">                    <span class="span">拼团失败</span>                </a>                <a href="#tab4" style="border-bottom: unset" class="tab-link button">                    <span class="span">已完成</span>                </a>            </div>            <div class="content-block">                <div class="tabs">                    <div id="tab1" class="tab active">                        <div class="content-block">                            <div class="row">                                <div class="col-100">                                    <div class="list-block media-list" style="margin-top: 0rem">                                        <?php                                            foreach ($course_all as $all){                                                $type = $all['order_type'] == 1?'三人团':'单人团';                                                $isPtTime = "";                                                $ptTime = 0;                                                $mod ="";                                                if($all['order_type'] == 1 ){                                                    if($all['order_status'] == 1){                                                        $isPtTime = "ptTime";                                                        $ptTime = $all['end_time'];                                                        $mod = "还差".(3-$all['total'])."人";                                                    }elseif($all['order_status'] == 4){                                                        $mod = "已完成";                                                    }else{                                                        $mod = "拼团失败(已退款)";                                                    }                                                }else{                                                    if($all['order_status'] == 4){                                                        $mod = "已完成";                                                    }else{                                                        $mod = "拼团失败(已退款)";                                                    }                                                }                                                echo <<<EOF                                            <ul>                                                <li style="border-bottom: 1px solid #d4d4d4">                                                    <div class="item-content" style="border-bottom: unset">                                                        <div class="item-media"><img src="{$all['article_image']}" style="width: 100%;height: 100%;border-radius: 15px;"></div>                                                        <div class="item-inner">                                                            <div class="item-title-row">                                                                <div class="item-title" style="white-space: normal">{$all['title']}</div>                                                            </div>                                                            <div style="padding-top: 25px">                                                                <span style="color:red;font-size: 20px;font-weight: bold">￥{$all['price']}</span><span style="font-size:14px;color: #d9d9d9;padding-left: 0.5rem">{$type}</span>                                                            </div>                                                            <div   style="padding-top: 0.7rem;font-size: 14px;">                                                                <span style="color: #d9d9d9;">$mod</span>                                                            </div>                                                        </div>                                                    </div>                                                    <div class="my-course-list-price" style="padding-top: 0rem;padding-bottom: 0.5rem"><span style="font-size: 14px;color: black;transform: translate(0,8px);" class="$isPtTime" data-pttime="$ptTime" >                                                        </span> <a href="Home/my/myGroupDetail/{$all['did']}" class="button button-round button-fill external" style="background: #FFBA00;color:#000">查看详情</a></div>                                                </li>                                            </ul>EOF;                                            }                                        ?>                                    </div>                                </div>                            </div>                        </div>                    </div>                    <div id="tab2" class="tab">                        <div class="content-block">                            <div class="row">                                <div class="col-100">                                    <div class="list-block media-list" style="margin-top: 0rem">                                        <?php                                        foreach ($course_ing as $all1){                                            $type = $all1['order_type'] == 1?'三人团':'单人团';                                            $isPtTime = "";                                            $ptTime = 0;                                            $mod ="";                                            if($all1['order_type'] == 1 ){                                                if($all1['order_status'] == 1){                                                    if($all1['total'] >= 3){                                                        $mod = "已完成";                                                    }else{                                                        $isPtTime = "ptTime";                                                        $ptTime = $all1['end_time'];                                                        $mod = "还差".(3-$all1['total'])."人";                                                    }                                                }elseif($all['order_status'] == 4){                                                    $mod = "已完成";                                                }else{                                                    $mod = "拼团失败(已退款)";                                                }                                            }else{                                                if($all1['status'] == 1){                                                    $mod = "已完成";                                                }else{                                                    $mod = "拼团失败(已退款)";                                                }                                            }                                            echo <<<EOF                                            <ul>                                                <li style="border-bottom: 1px solid #d4d4d4">                                                    <div class="item-content" style="border-bottom: unset">                                                        <div class="item-media"><img src="{$all1['article_image']}" style="width: 100%;height: 100%;border-radius: 15px;"></div>                                                        <div class="item-inner">                                                            <div class="item-title-row">                                                                <div class="item-title" style="white-space: normal">{$all1['title']}</div>                                                            </div>                                                            <div style="padding-top: 25px">                                                                <span style="color:red;font-size: 20px;font-weight: bold">￥{$all1['price']}</span><span style="font-size:14px;color: #d9d9d9;padding-left: 0.5rem">{$type}</span>                                                            </div>                                                            <div   style="padding-top: 0.7rem;font-size: 14px;">                                                                <span style="color: #d9d9d9;">$mod</span>                                                            </div>                                                        </div>                                                    </div>                                                    <div class="my-course-list-price" style="padding-top: 0rem;padding-bottom: 0.5rem"><span style="font-size: 14px;color: black;transform: translate(0,8px);" class="$isPtTime" data-pttime="$ptTime" >                                                        </span> <a href="Home/my/myGroupDetail/{$all1['did']}" class="button button-round button-fill external" style="background: #FFBA00;color:#000">查看详情</a></div>                                                </li>                                            </ul>EOF;                                        }                                        ?>                                    </div>                                </div>                            </div>                        </div>                    </div>                    <div id="tab3" class="tab">                        <div class="content-block">                            <div class="row">                                <div class="col-100">                                    <div class="list-block media-list" style="margin-top: 0rem">                                        <?php                                        foreach ($course_fail as $all){                                            $type = $all['order_type'] == 1?'三人团':'单人团';                                            $isPtTime = "";                                            $ptTime = 0;                                            $mod ="";                                            if($all['order_type'] == 1 ){                                                if($all['order_status'] == 1){                                                    if($all['total'] >= 3){                                                        $mod = "已完成";                                                    }else{                                                        $isPtTime = "ptTime";                                                        $ptTime = $all['end_time'];                                                        $mod = "还差".(3-$all['total'])."人";                                                    }                                                }elseif($all['order_status'] == 4){                                                    $mod = "已完成";                                                }else{                                                    $mod = "拼团失败(已退款)";                                                }                                            }else{                                                if($all['status'] == 1){                                                    $mod = "已完成";                                                }else{                                                    $mod = "拼团失败(已退款)";                                                }                                            }                                            echo <<<EOF                                            <ul>                                                <li style="border-bottom: 1px solid #d4d4d4">                                                    <div class="item-content" style="border-bottom: unset">                                                        <div class="item-media"><img src="{$all['article_image']}" style="width: 100%;height: 100%;border-radius: 15px;"></div>                                                        <div class="item-inner">                                                            <div class="item-title-row">                                                                <div class="item-title" style="white-space: normal">{$all['title']}</div>                                                            </div>                                                            <div style="padding-top: 25px">                                                                <span style="color:red;font-size: 20px;font-weight: bold">￥{$all['price']}</span><span style="font-size:14px;color: #d9d9d9;padding-left: 0.5rem">{$type}</span>                                                            </div>                                                                                                               </div>                                                    </div>                                                    <div class="my-course-list-price" style="padding-top: 0rem;padding-bottom: 0.5rem"><span style="font-size: 14px;color: black;transform: translate(0,8px);" class="$isPtTime" data-pttime="$ptTime" >                                                        </span> <a href="Home/my/myGroupDetail/{$all['did']}" class="button button-round button-fill external" style="background: #FFBA00;color:#000">查看详情</a></div><div   style="font-size: 14px;position:  absolute;bottom: .8rem;color: black;">                                                                <span >$mod</span>                                                            </div>                                                </li>                                            </ul>EOF;                                        }                                        ?>                                    </div>                                </div>                            </div>                        </div>                    </div>                    <div id="tab4" class="tab">                        <div class="content-block">                            <div class="row">                                <div class="col-100">                                    <div class="list-block media-list" style="margin-top: 0rem">                                        <?php                                        foreach ($course_success as $all){                                            $type = $all['order_type'] == 1?'三人团':'单人团';                                            $isPtTime = "";                                            $ptTime = 0;                                            $mod ="";                                            if($all['order_type'] == 1 ){                                                if($all['order_status'] == 1){                                                    if($all['total'] >= 3){                                                        $mod = "已完成";                                                    }else{                                                        $isPtTime = "ptTime";                                                        $ptTime = $all['end_time'];                                                        $mod = "还差".(3-$all['total'])."人";                                                    }                                                }elseif($all['order_status'] == 4){                                                    $mod = "已完成";                                                }else{                                                    $mod = "拼团失败(已退款)";                                                }                                            }else{                                                if($all['status'] == 1){                                                    $mod = "已完成";                                                }else{                                                    $mod = "拼团失败(已退款)";                                                }                                            }                                            echo <<<EOF                                            <ul>                                                <li style="border-bottom: 1px solid #d4d4d4">                                                    <div class="item-content" style="border-bottom: unset">                                                        <div class="item-media"><img src="{$all['article_image']}" style="width: 100%;height: 100%;border-radius: 15px;"></div>                                                        <div class="item-inner">                                                            <div class="item-title-row">                                                                <div class="item-title" style="white-space: normal">{$all['title']}</div>                                                            </div>                                                            <div style="padding-top: 25px">                                                                <span style="color:red;font-size: 20px;font-weight: bold">￥{$all['price']}</span><span style="font-size:14px;color: #d9d9d9;padding-left: 0.5rem">{$type}</span>                                                            </div>                                                            <div   style="padding-top: 0.7rem;font-size: 14px;">                                                                <span style="color: #d9d9d9;">$mod</span>                                                            </div>                                                        </div>                                                    </div>                                                    <div class="my-course-list-price" style="padding-top: 0rem;padding-bottom: 0.5rem"><span style="font-size: 14px;color: black;transform: translate(0,8px);" class="$isPtTime" data-pttime="$ptTime" >                                                        </span> <a href="Home/my/myGroupDetail/{$all['did']}" class="button button-round button-fill external" style="background: #FFBA00;color:#000">查看详情</a></div>                                                </li>                                            </ul>EOF;                                        }                                        ?>                                    </div>                                </div>                            </div>                        </div>                    </div>                    <div class="log" style="text-align: center;margin-top: 2rem;margin-bottom: 2rem">                        <img width="30%" src="cust/images/logo.png" alt="">                    </div>                </div>            </div>        </div>    </div></div>    <?php    include_once 'public/views/home/script.php';    ?><script type="text/javascript">    function d(){        var tab_link=document.querySelectorAll('.tab-link')        for(var i =0;i<tab_link.length;i++){            tab_link[i].index=i            tab_link[i].onclick=function () {                for( var j=0 ;j<tab_link.length;j++ ){                    tab_link[j].getElementsByTagName('span')[0].className='span'                }                tab_link[this.index].getElementsByTagName('span')[0].className=' span span-active'            }        }    }d()    function filterDeadline(time) {        //获取当前时间        var date = new Date();        var now = date.getTime();        //设置截止时间        var end = time;        //时间差        var leftTime = end-now;        //定义变量 d,h,m,s保存倒计时的时间        var d,h,m,s;        if (leftTime>=0) {            d = Math.floor(leftTime/1000/60/60/24);            h = Math.floor(leftTime/1000/60/60%24)+d*24;            m = Math.floor(leftTime/1000/60%60);            s = Math.floor(leftTime/1000%60);        }        function checkTime(time){            return time = time < 10 ? `0${time}` : time        }        return ` ${checkTime(h)}:${checkTime(m)}:${checkTime(s)}`    }    $('.ptTime').each(function () {        var ptTime = $(this).data('pttime');        var str = filterDeadline(ptTime*1000);        $(this).text("拼团进行中"+str);        setTime(this)    })    function setTime(obj){        setInterval(function () {            var ptTime = $(obj).data('pttime');            var str = filterDeadline(ptTime*1000);            $(obj).text("拼团进行中"+str);        }, 1000);    }</script></body></html>