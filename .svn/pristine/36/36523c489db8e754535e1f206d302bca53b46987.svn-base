<?php
class JsSdkBlog{}
class JsSdk {
  private $CI;
  private $appId;
  private $appSecret;

  public function __construct($appId, $appSecret) {
    $this->CI = &get_instance();
    $this->CI->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
    $this->appId = $appId;
    $this->appSecret = $appSecret;
  }

  public function getSignPackage($url=false) {
    $jsapiTicket = $this->getJsApiTicket();

    // 注意 URL 一定要动态获取，不能 hardcode.
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    
    if($url){
      $url=$url;
    }
    else{
      $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }
    

    $timestamp = time();
    $nonceStr = $this->createNonceStr();

    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

    $signature = sha1($string);

    $signPackage = array(
      "appId"     => $this->appId,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "signature" => $signature,
      "rawString" => $string
    );
    return $signPackage; 
  }

  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }

  private function getJsApiTicket() {
    // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
    // $data = json_decode($this->get_php_file("jsapi_ticket.php"));
    // if ($data->expire_time < time()) {
    $accessToken = $this->getAccessToken();

    if(!$jssdk_ticket = $this->CI->cache->get('jssdk_ticket'))
    {
      $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
      $res = json_decode(file_get_contents($url));
      log_info(json_encode($res));
      // var_dump($res);
      // exit();
      $ticket = $res->ticket;
      $this->CI->cache->save('jssdk_ticket',$res,($res->expires_in-60));
    }
    else{
      $jssdk_ticket = $this->CI->cache->get('jssdk_ticket');
      $ticket=$jssdk_ticket->ticket;
    }
     
    return $ticket;
  }

  private function getAccessToken() {
    // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
    // $data = json_decode($this->get_php_file("access_token.php"));
    // if ($data->expire_time < time()) {
      // 如果是企业号用以下URL获取access_token
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
      if(!$jssdk_access_token = $this->CI->cache->get('jssdk_access_token'))
      {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
        $res = json_decode(file_get_contents($url));
        log_info(json_encode($res));
        
        $access_token = $res->access_token;
        $this->CI->cache->save('jssdk_access_token',$res,($res->expires_in-60));
      }
      else{
        $jssdk_access_token = $this->CI->cache->get('jssdk_access_token');
        $access_token=$jssdk_access_token->access_token;
      }

      // if ($access_token) {
      //   $data->expire_time = time() + 7000;
      //   $data->access_token = $access_token;
      //   // $this->set_php_file("access_token.php", json_encode($data));
      // }
    // } else {
    //   $access_token = $data->access_token;
    // }
    return $access_token;
  }

  private function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
    // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);
    curl_close($curl);

    return $res;
  }

  private function get_php_file($filename) {
    return trim(substr(file_get_contents('cache/'.$filename), 15));
  }
  private function set_php_file($filename, $content) {
    $fp = fopen('cache/'.$filename, "w");
    fwrite($fp, "<?php exit();?>" . $content);
    fclose($fp);
  }
}

