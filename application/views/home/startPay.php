<?php
?>
<html>
<head>
    <?php

    include_once 'public/views/home/header.php';

    ?>
	<script type="text/javascript">

		//调用微信JS api 支付
		function jsApiCall()
		{
			WeixinJSBridge.invoke(
				'getBrandWCPayRequest',
				<?php echo $jsApiParameters; ?>,
				function(res){
                    if(res.err_msg == "get_brand_wcpay_request:ok" ){
                        var url = "Home/order/queryResult/<?=$order_number?>";
                        $.getJSON(url,function (data) {
                            if(data.return_code == 'SUCCESS' &&data.result_code == 'SUCCESS' && data.trade_state == 'SUCCESS'){
                                window.location.href='Home/myCourse'
                            }
                        })
                    }else{

                        alert('支付失败');
                        window.location.href='Home/myCourse'
                    }
                }
			);
		}

		function callpay()
		{
			if (typeof WeixinJSBridge == "undefined"){
			    if( document.addEventListener ){
			        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
			    }else if (document.attachEvent){
			        document.attachEvent('WeixinJSBridgeReady', jsApiCall);
			        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
			    }
			}else{
			    jsApiCall();
			}
		}
	</script>
</head>
<body>
	</br></br></br></br>
	<div align="center">

	</div>
</body>
<?php

include_once 'public/views/home/script.php';

?>
<script type="text/javascript">

    callpay();
</script>
</html>
