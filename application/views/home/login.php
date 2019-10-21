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


        <!-- 这里是页面内容区 -->
        <div class="content" style="background: #ffffff">
            <form action="home/login/doLogin">
                用户id:<input type="text" id="uid">
                <button type="button" id="login">登陆</button>
            </form>
        </div>
    </div>
</div>

    <?php
    include_once 'public/views/home/script.php';
    ?>
<script type="text/javascript">
    $('#login').click(function () {
       var url = "Home/Login/doLogin/"+$('#uid').val();
       $.get(url,function (ret) {
           if(ret == 1){
               alert('登陆成功');
               window.location.href= 'Home/Index';
           }else{
               alert('登陆失败');
           }
       })
    })
</script>
</body>
</html>
