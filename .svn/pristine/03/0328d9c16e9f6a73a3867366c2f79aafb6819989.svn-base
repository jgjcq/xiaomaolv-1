
<?php
 
class AppWxPayBlog{}
/*
 * app,小程序,网页端微信支付,生成支付凭证用于小程序 ，app端，web端吊起支付
 */
class AppWxPay {
 
 
    protected $appid;
    protected $openid;
    protected $mch_id;
    protected $key; //商户支付秘钥，需到商户平台获取
    protected $out_trade_no;
    protected $body;
    protected $total_fee;
    protected $notify_url;
    function __construct($config) {
        $this->appid = $config['appid'];
        $this->openid = $config['openid'];
        $this->mch_id = $config['mch_id'];
        $this->key = $config['key'];
        $this->out_trade_no = $config['out_trade_no'];
        $this->body = $config['body'];
        $this->total_fee = $config['total_fee'];
        $this->notify_url = $config['notify_url'];
    }
 
 
    public function pay() {
        //统一下单接口
        $return = $this->weixinapp();
        return $return;
    }
 
 
    //统一下单接口
    private function unifiedorder() {
        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $parameters = array(
            'appid' => $this->appid, //小程序ID
            'mch_id' => $this->mch_id, //商户号
            'nonce_str' => $this->createNoncestr(), //随机字符串
//            'body' => 'test', //商品描述
            'body' => $this->body,
//            'out_trade_no' => '2015450806125348', //商户订单号
            'out_trade_no'=> $this->out_trade_no,
//            'total_fee' => floatval(0.01 * 100), //总金额 单位 分
            'total_fee' => $this->total_fee,
            'spbill_create_ip' => $_SERVER['REMOTE_ADDR'], //终端IP
            //'spbill_create_ip' => $this->spbill_create_ip, //终端IP
            'notify_url' => $this->notify_url, //通知地址  确保外网能正常访问
            'openid' => $this->openid, //用户id
            'trade_type' => 'JSAPI'//交易类型
        );
        //统一下单签名
        $parameters['sign'] = $this->getSign($parameters);
        $xmlData = $this->arrayToXml($parameters);
        $return = $this->xmlToArray($this->postXmlCurl($xmlData, $url, 60));
        // var_dump($return);
        // exit();
        return $return;
    }
 
 
    private static function postXmlCurl($xml, $url, $second = 30) 
    {
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); //严格校验
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
 
 
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        set_time_limit(0);
 
 
        //运行curl
        $data = curl_exec($ch);
        //返回结果
        if ($data) {
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            curl_close($ch);
            throw new WxPayException("curl出错，错误码:$error");
        }
    }
    
    
    
    //数组转换成xml
    private function arrayToXml($arr) {
        $xml = "<root>";
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                $xml .= "<" . $key . ">" . arrayToXml($val) . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            }
        }
        $xml .= "</root>";
        return $xml;
    }
 
 
    //xml转换成数组
    private function xmlToArray($xml) {
 
 
        //禁止引用外部xml实体 
 
 
        libxml_disable_entity_loader(true);
 
 
        $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
 
 
        $val = json_decode(json_encode($xmlstring), true);
 
 
        return $val;
    }
 
 
    //微信小程序接口
    private function weixinapp() {
        //统一下单接口
        $unifiedorder = $this->unifiedorder();
        // $myfile=fopen("log.txt",'w'); 
        // $txt = json_encode($unifiedorder);
        // fwrite($myfile, $txt);
        // fclose($myfile); 
        // log_info($unifiedorder);
//        print_r($unifiedorder);
        $parameters = array(
            'appId' => $this->appid, //小程序ID
            'timeStamp' => '' . time() . '', //时间戳
            'nonceStr' => $this->createNoncestr(), //随机串
            'package' => 'prepay_id=' . $unifiedorder['prepay_id'], //数据包
            'signType' => 'MD5'//签名方式
        );
        //签名
        $parameters['paySign'] = $this->getSign($parameters);
        return $parameters;
    }
 
 
    //作用：产生随机字符串，不长于32位
    private function createNoncestr($length = 32) {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
 
 
    //作用：生成签名
    private function getSign($Obj) {
        foreach ($Obj as $k => $v) {
            $Parameters[$k] = $v;
        }
        //签名步骤一：按字典序排序参数
        ksort($Parameters);
        $String = $this->formatBizQueryParaMap($Parameters, false);
        //签名步骤二：在string后加入KEY
        $String = $String . "&key=" . $this->key;
        //签名步骤三：MD5加密
        $String = md5($String);
        //签名步骤四：所有字符转为大写
        $result_ = strtoupper($String);
        return $result_;
    }
 
 
    ///作用：格式化参数，签名过程需要使用
    private function formatBizQueryParaMap($paraMap, $urlencode) {
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v) {
            if ($urlencode) {
                $v = urlencode($v);
            }
            $buff .= $k . "=" . $v . "&";
        }
        $reqPar;
        if (strlen($buff) > 0) {
            $reqPar = substr($buff, 0, strlen($buff) - 1);
        }
        return $reqPar;
    }
 
 
}

//回调
// $postXml = $GLOBALS["HTTP_RAW_POST_DATA"]; //接收微信参数
//   if (empty($postXml)) {
//       return false;
//   }
   
//   //将xml格式转换成数组
//   function xmlToArray($xml) {
   
//       //禁止引用外部xml实体 
//       libxml_disable_entity_loader(true);
   
//       $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
   
//       $val = json_decode(json_encode($xmlstring), true);
   
//       return $val;
//   }
   
//   $attr = xmlToArray($postXml);
   
//   // $total_fee = $attr[total_fee];
//   // $open_id = $attr[openid];
//   // $out_trade_no = $attr[out_trade_no];
//   // $time = $attr[time_end];
//   header("location:https://www.toocool-ar.com/Api/CommonPay/wxPayNotify?notify=".base64_encode(serialize($attr)));




  
 
  
//   web  js吊起支付
/****
    function jsApiCall()
    {
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            <?php echo $jsApiParameters; ?>,//pay方法返回的数组
            function(res){
                if(res.err_msg == "get_brand_wcpay_request:ok"){  
                       window.location.href="http://47.244.33.106/cbeta/Goods/Success2";//成功页面
                   }else{  
                       window.location.href="http://47.244.33.106/cbeta/Goods/Fail2"; //失败页面
                           
                   }

            }
        );      
    }


    function callpay()
    {
        if (typeof WeixinJSBridge == "undefined"){
            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', jsApiCall); 
                document.addEventListener('onWeixinJSBridgeReady', jsApiCall);
            }else if (document.attachEvent){    
                document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
            }
        }else{
            jsApiCall();
        }
    }

    window.onload = function(){      
        callpay();     
    };
*****/
