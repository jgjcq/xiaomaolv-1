<?php
/**
 * Native（原生）支付-模式二-demo
 * ====================================================
 * 商户生成订单，先调用统一支付接口获取到code_url，
 * 此URL直接生成二维码，用户扫码后调起支付。
 * 	
*/

	// var_dump($_POST);
	include_once("../WxPayPubHelper/WxPayPubHelper.php");

	//使用统一支付接口
	$unifiedOrder = new UnifiedOrder_pub();
	
	//设置统一支付接口参数 
	//设置必填参数
	//appid已填,商户无需重复填写
	//mch_id已填,商户无需重复填写
	//noncestr已填,商户无需重复填写
	//spbill_create_ip已填,商户无需重复填写
	//sign已填,商户无需重复填写
	$unifiedOrder->setParameter("body",$_POST['goodsname']);//商品描述
	//自定义订单号，此处仅作举例
	$timeStamp = time();
	$out_trade_no = $_POST['ordernumber'];
	$unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号 
	$unifiedOrder->setParameter("total_fee",$_POST['trueamount']*100);//总金额
	$unifiedOrder->setParameter("notify_url",WxPayConf_pub::NOTIFY_URL);//通知地址 
	$unifiedOrder->setParameter("trade_type","NATIVE");//交易类型
	//非必填参数，商户可根据实际情况选填
	$unifiedOrder->setParameter("sub_mch_id","1489937312");//子商户号  
	//$unifiedOrder->setParameter("device_info","XXXX");//设备号 
	$unifiedOrder->setParameter("attach",$_POST['orderid'].'-'.$_POST['usebalance'].'-'.$_POST['paymethodid'].'-'.$_POST['userid']);//附加数据 
	$unifiedOrder->setParameter("time_start",date("YmdHis"));//交易起始时间
	$unifiedOrder->setParameter("time_expire",date("YmdHis", time() + 600));//交易结束时间 
	//$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记 
	//$unifiedOrder->setParameter("openid","XXXX");//用户标识
	$unifiedOrder->setParameter("product_id",$_POST['goodsid']);//商品ID
	
	//获取统一支付接口结果
	$unifiedOrderResult = $unifiedOrder->getResult();
	
	//商户根据实际情况设置相应的处理流程
	if ($unifiedOrderResult["return_code"] == "FAIL") 
	{
		//商户自行增加处理流程
		echo "通信出错：".$unifiedOrderResult['return_msg']."<br>";
	}
	elseif($unifiedOrderResult["result_code"] == "FAIL")
	{
		//商户自行增加处理流程
		echo "错误代码：".$unifiedOrderResult['err_code']."<br>";
		echo "错误代码描述：".$unifiedOrderResult['err_code_des']."<br>";
	}
	elseif($unifiedOrderResult["code_url"] != NULL)
	{
		//从统一支付接口获取到code_url
		$code_url = $unifiedOrderResult["code_url"];
		//商户自行增加处理流程
		//......
	}

?>


<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>微信安全支付</title>
	<script src="http://96211.365xue.vip/public/assets2/js/jquery-1.12.4.min.js"></script>
    <style>
		.contant{
			width:60%;
			margin:auto;
			
		}
		.header{
			font-weight: bold;
			font-size:25px;
			text-indent: 25px;
		}
		.erwei{
			text-align: center;
		}
		.foot{
			font-weight: bold;
			font-size:15px;
			text-align: center;

		}
    </style>
</head>
<body>
	<div align="center" class="header">
		<p>订单号：<?php echo $_POST['ordernumber']; ?></p>
	</div>
	</br>
	<div align="center" id="qrcode">
	</div>
	</br>
	<div class="foot">请扫描上面的二维码进行支付</div>
	<br>
	
</body>
	<script src="./qrcode.js"></script>
	<script>
		if(<?php echo $unifiedOrderResult["code_url"] != NULL; ?>)
		{
			var url = "<?php echo $code_url;?>";
			//参数1表示图像大小，取值范围1-10；参数2表示质量，取值范围'L','M','Q','H'
			var qr = qrcode(10, 'M');
			qr.addData(url);
			qr.make();
			var wording=document.createElement('p');
			wording.innerHTML = "扫我，扫我";
			var code=document.createElement('DIV');
			code.innerHTML = qr.createImgTag();
			var element=document.getElementById("qrcode");
			element.appendChild(wording);
			element.appendChild(code);
		}



		function autoChange(){
			$.post("<?php echo 'http://96211.365xue.vip/Mobile/Order/autoChange'; ?>",{orderid:<?php echo $_POST['orderid'] ?>},
		             function(ret,err){
		               if(ret.status)
		                      {
		                      	   var t=JSON.parse(ret.v);
		                           if(t.paymethodid>0)
		                           {
		                           	location.href="http://96211.365xue.vip/Mobile/Order/success";
		                           }
		                           // alert(t.paymethodid);
		                      }
		                      else
		                      {
		                           alert(ret.msg);
		                           
		                      }
		             },
		             "json");//这里返回的类型有：json,html,xml,text
		}


		setInterval("autoChange()","2000");
	</script>
</html>