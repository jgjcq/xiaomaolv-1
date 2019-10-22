<?phpdefined('BASEPATH') OR exit('No direct script access allowed');?><!DOCTYPE html><html><head>    <?php    include_once 'public/views/home/header.php';    ?></head><body><div class="page-group">    <div class="page page-current" id="index">        <!-- 标题栏 -->        <header class="bar bar-nav">            <h1 class="title">首页</h1>        </header>        <form id="top_search">            <div class="bar bar-header-secondary">                <div class="searchbar" style="background-color: #ffffff">                    <a class="searchbar-cancel">取消</a>                    <div class="search-input">                        <label class="icon icon-search" for="search"></label>                            <input type="search" id='search' placeholder='请输入课题名称'/>                    </div>                </div>            </div>        </form>        <!-- 工具栏 -->        <nav class="bar bar-tab">            <a class="tab-item external active" href="Home">                <span class="icon dh_sy1" ></span>                <span class="tab-label">首页</span>            </a>            <a class="tab-item external" href="Home/myCourse">                <span class="icon dh_wdkc"></span>                <span class="tab-label">我的课程</span>            </a>            <a class="tab-item external" href="Home/my">                <span class="icon dh_grzx"></span>                <span class="tab-label">个人中心</span>            </a>        </nav>        <!-- 这里是页面内容区 -->        <div class="content native-scroll" style="background-color: #ffffff">            <div class="content-padded" style="margin-top: 40px">                <div class="row">                    <div class="col-100">                        <!-- Slider -->                        <div class="swiper-container" data-space-between='10' style="padding-bottom: 20px!important;">                            <div class="swiper-wrapper ">                                <?php                                    foreach($banner_list as $banner){                                ?>                                        <div class="swiper-slide" style="width: 354px; height:182px;margin-right: 10px;">                                            <a href="<?=estr($banner,'cust_url')?>">                                            <img style="width: 100%;height: 100%;border-radius: 15px" src="<?=estr($banner,'banner_image')?>" alt="">                                            </a>                                        </div>                                <?php                                    }                                ?>                            </div>                            <div class="swiper-pagination" style="left: 38%!important;bottom:25px!important;"></div>                        </div>                    </div>                </div>                <div class="row course_type_list">                    <?php                    $count = 0;                    foreach($course_type_list as $k=>$v){                        $count ++;                    ?>                    <div class="col-25">                        <a href="Home/Course/typeList/<?=$k?>" class="typeListLink">                            <div style="display: flex;justify-content: center;align-items: center"><img src="cust/images/course_type_<?=$k?>.png" /></div>                            <div style="text-align: center;font-size: 14px;padding: 5px 0"><?=$v?></div>                        </a>                    </div>                    <?php if($count == 4) {?>                </div>                <div class="row course_type_list list2">                    <?php } }?>                </div>                <div class="row" style="margin-top:20px;height: 30px ">                       <div class="col-100 qkc" style="font-weight: bold;height: 100%;line-height: 30px;font-size: 20px">                           好课天天抢                       </div>                </div>                <div class="row">                    <div class="col-100">                        <div class="list-block media-list" style="margin-top: 0rem">                            <?php                            foreach($hot_course_list as $course){                                ?>                                <ul>                                    <li onclick="toCourseDetail('<?=estr($course,'id')?>')">                                        <div class="item-content">                                            <div class="item-media"><img src="<?=estr($course,'article_image')?>" style="width: 100%;height:100%;border-radius: 15px"></div>                                            <div class="item-inner">                                                <div class="item-title-row">                                                    <div class="item-title" style="white-space: normal"><?=estr($course,'title')?></div>                                                </div>                                                <div style="padding-top:80px;color:#ea1742;font-weight: bold;font-size: 18px;line-height: 10px">                                                    ￥<?=estr($course,'price')?>                                                </div>                                                <div   class="my-course-list-price" style="padding-top: 0rem">                                                    <span style="text-decoration:line-through;color: #7e7e7e;font-size: 14px">￥<?=estr($course,'old_price')?></span>                                                    <a href="Home/Course/buy/<?=estr($course,'id')?>" class="button button-round button-fill external" style="background: #fab510;color: black;transform: translate(0,-10px);width: 70px">购买</a>                                                </div>                                            </div>                                        </div>                                    </li>                                </ul>                                <?php                            }                            ?>                        </div>                    </div>                </div>                <div class="row" style="margin-top:20px;height: 30px ">                    <div class="col-100 qkc jtkc" style="font-weight: bold;height: 100%;line-height: 30px;font-size: 20px">                        精挑细选                    </div>                </div>                <div class="row">                    <div class="col-100">                        <div class="list-block media-list" style="margin-top: 0rem">                            <?php                            foreach($jt_course_list as $course){                                ?>                                <ul>                                    <li onclick="toCourseDetail('<?=estr($course,'id')?>')">                                        <div class="item-content" style="    display: block;">                                            <div class="item-media" style="    width: 100%;    height: 145px;"><img src="<?=estr($course,'article_image')?>" style="width: 100%;height:100%;border-radius: 15px"></div>                                            <div class="item-inner" style="    margin-left: unset;">                                                <div class="item-title-row" style="    margin-top: .5rem;">                                                    <div class="item-title" style="white-space: normal"><?=estr($course,'title')?></div>                                                </div>                                                <div style="padding-top: .5rem;color:#ea1742;font-weight: bold;font-size: 18px;line-height: 10px;display: inline-block;">                                                    ￥<?=estr($course,'price')?>                                                </div>                                                <div   class="my-course-list-price" style="padding-top: 0rem;width: 74%;float: right;margin-left: .5rem;">                                                    <span style="text-decoration:line-through;color: #7e7e7e;font-size: 14px">￥<?=estr($course,'old_price')?></span>                                                    <a href="Home/Course/buy/<?=estr($course,'id')?>" class="button button-round button-fill external" style="background: #fab510;color: black;transform: translate(0,-5px);width: 70px">购买</a>                                                </div>                                            </div>                                        </div>                                    </li>                                </ul>                                <?php                            }                            ?>                        </div>                    </div>                </div>            </div>        </div>    </div><div class="page " id="courseList">    <!-- 标题栏 -->    <header class="bar bar-nav">        <a class="button button-link button-nav pull-left back" >            <span class="icon icon-left"></span>            返回        </a>        <h1 class='title'>课程列表</h1>    </header>    <form id="course_top_search">        <div class="bar bar-header-secondary">            <div class="searchbar" >                <a class="searchbar-cancel">取消</a>                <div class="search-input">                    <label class="icon icon-search" for="search"></label>                    <input type="search" id='course_search' placeholder='输入关键字...'/>                </div>            </div>        </div>    </form>    <!-- 这里是页面内容区 -->    <div class="content searchResultBk" id="searchResultBk" style="background-color: #ffffff">        <div class="content-block">            <div class="list-block media-list"  id="searchResult">            </div>        </div>    </div></div><?phpinclude_once 'public/views/home/script.php';?><script type="text/javascript">    $(function() {        $(".swiper-container").swiper();        $('#top_search').submit(function () {            if($('#search').val()){                window.location.href="Home/course/index/"+$('#search').val();            }            return false;        });    });</script></body></html>