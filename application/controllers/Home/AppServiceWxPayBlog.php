﻿
<?php
 
class AppServiceWxPayBlog{}
/*
 * app,小程序,网页端微信支付,生成支付凭证用于小程序 ，app端，web端吊起支付
 */
class AppServiceWxPay{
 
 
    protected $appid = 'wxce27b563db618734';
	protected $sub_appid = 'wxc84e8ca6616a9106';
    protected $openid;
    protected $mch_id = '1554057081';
	protected $sub_mch_id = '1558645861';
    protected $key = 'abcdefghijkABCDEFGHIJK1234567890'; //商户支付秘钥，需到商户平台获取
    protected $out_trade_no;
    protected $body;
    protected $total_fee;
    protected $notify_url;
    protected $transaction_id;
    protected $out_refund_no;
    function __construct($config) {
       // $this->appid = $config['appid'];
	//	$this->sub_appid=$config['sub_appid'];
        if(isset( $config['openid']))
        $this->openid = $config['openid'];
    //    $this->mch_id = $config['mch_id'];
	//	$this->sub_mch_id = $config['sub_mch_id'];
    //    $this->key = $config['key'];
        if(isset( $config['out_trade_no']))
        $this->out_trade_no = $config['out_trade_no'];
        if(isset( $config['body']))
        $this->body = $config['body'];
        if(isset( $config['total_fee']))
        $this->total_fee = $config['total_fee'];
        if(isset( $config['notify_url']))
        $this->notify_url = $config['notify_url'];

        if(isset( $config['transaction_id']))
            $this->transaction_id = $config['transaction_id'];
        if(isset( $config['out_refund_no']))
            $this->out_refund_no = $config['out_refund_no'];

        //TODO
        $this->total_fee = 0.01;
    }
 
 
    public function pay() {
        //统一下单接口
        $return = $this->weixinapp();
        return $return;
    }
    public function query(){
        $url = 'https://api.mch.weixin.qq.com/pay/orderquery';
        $parameters = array(
            'appid' => $this->appid, //商户公众账号ID
            'sub_appid' => $this->sub_appid, //子商户公众账号ID
            'mch_id' => $this->mch_id, //商户号
            'sub_mch_id' => $this->sub_mch_id, //子商户号
            'nonce_str' => $this->createNoncestr(), //随机字符串
            'out_trade_no'=> $this->out_trade_no,
        );
        $parameters['sign'] = $this->getSign($parameters);
        $xmlData = $this->arrayToXml($parameters);
        $return = $this->xmlToArray($this->postXmlCurl($xmlData, $url, 60));
        return $return;
    }

    public function refound(){
        $url = 'https://api.mch.weixin.qq.com/secapi/pay/refund';
        $parameters = array(
            'appid' => $this->appid, //商户公众账号ID
            'sub_appid' => $this->sub_appid, //子商户公众账号ID
            'mch_id' => $this->mch_id, //商户号
            'sub_mch_id' => $this->sub_mch_id, //子商户号
            'nonce_str' => $this->createNoncestr(), //随机字符串
            'out_trade_no'=> $this->out_trade_no,
            'transaction_id'=> $this->transaction_id,
            'out_refund_no'=> $this->out_refund_no,
            'fee_type'=>'CNY',//货币类型
            'total_fee' => floatval( $this->total_fee * 100),
            'refund_fee' => floatval( $this->total_fee * 100),
        );
        $parameters['sign'] = $this->getSign($parameters);
        $xmlData = $this->arrayToXml($parameters);
        $return = $this->xmlToArray($this->postXmlCurlSSL(__DIR__.'/cert/apiclient_cert.pem',__DIR__.'/cert/apiclient_key.pem',$xmlData, $url,true, 60));
        return $return;
    }
 
    //统一下单接口
    private function unifiedorder() {
        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $parameters = array(
            'appid' => $this->appid, //商户公众账号ID
			'sub_appid' => $this->sub_appid, //子商户公众账号ID
            'mch_id' => $this->mch_id, //商户号
			'sub_mch_id' => $this->sub_mch_id, //子商户号
            'nonce_str' => $this->createNoncestr(), //随机字符串
            'body' => $this->body,
            'out_trade_no'=> $this->out_trade_no,
            'total_fee' => floatval( $this->total_fee * 100), //总金额 单位 分
            'spbill_create_ip' => $_SERVER['REMOTE_ADDR'], //终端IP
            'notify_url' => $this->notify_url, //通知地址  确保外网能正常访问
            'sub_openid' => $this->openid, //用户id
            'trade_type' => 'JSAPI',//交易类型,
            'fee_type'=>'CNY',//货币类型
        );
        //统一下单签名
        $parameters['sign'] = $this->getSign($parameters);
        $xmlData = $this->arrayToXml($parameters);
        $return = $this->xmlToArray($this->postXmlCurl($xmlData, $url, 60));
        return $return;
    }

    private function getKey(){
        $url = "https://api.mch.weixin.qq.com/sandboxnew/pay/getsignkey";
        $params = array('mch_id'=>$this->mch_id,'nonce_str'=>$this->createNoncestr(),"sign_type"=>'MD5');
        $params['sign'] = $this->getSign($params);
        $xmlData = $this->arrayToXml($params);
        $return = $this->xmlToArray($this->postXmlCurl($xmlData, $url, 60));
       return $return['sandbox_signkey'];
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


    /**
     * 以post方式提交xml到对应的接口url
     *
     * @param WxPayConfigInterface $config  配置对象
     * @param string $xml  需要post的xml数据
     * @param string $url  url
     * @param bool $useCert 是否需要证书，默认不需要
     * @param int $second   url执行超时时间，默认30s
     * @throws WxPayException
     */
    private  function postXmlCurlSSL($sslCertPath,$sslKeyPath, $xml, $url, $useCert = false, $second = 30)
    {
        $ch = curl_init();
        $curlVersion = curl_version();
        $ua = "WXPaySDK/3.0.10 (".PHP_OS.") PHP/".PHP_VERSION." CURL/".$curlVersion['version']." "
            .$this->mch_id;

        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);

        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);//严格校验
        curl_setopt($ch,CURLOPT_USERAGENT, $ua);
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

            //设置证书
            //使用证书：cert 与 key 分别属于两个.pem文件
            //证书文件请放入服务器的非web目录下
            curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
            curl_setopt($ch,CURLOPT_SSLCERT, $sslCertPath);
            curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
            curl_setopt($ch,CURLOPT_SSLKEY, $sslKeyPath);
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        //运行curl
        $data = curl_exec($ch);var_dump($data);
        //返回结果
        if($data){
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            curl_close($ch);

        }
    }
    
    //数组转换成xml
    private function arrayToXml($arr) {
        $xml = "<xml>";
        foreach ($arr as $key=>$val)
        {
            if (is_numeric($val))
            {
                $xml.="<".$key.">".$val."</".$key.">";

            }
            else{
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }

        }
        $xml.="</xml>";
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
