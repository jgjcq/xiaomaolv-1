<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 微信前端 JavaScript 签名SDK
 * 
 * @author Anyon <zoujingli@qq.com>
 * @date 2016/06/28 11:24
 */
require_once(BASEPATH.'libraries/Wechat/lib/Wechat_common.php');

class CI_Wechat_script extends CI_Wechat_common {

    private $jsapi_ticket;

    /**
     * 删除JSAPI授权TICKET
     * @param string $appid 用于多个appid时使用
     */
    public function resetJsTicket($appid = '') {
        $this->jsapi_ticket = '';
        $authname = 'wechat_jsapi_ticket_' . empty($appid) ? $this->appid : $appid;
        $this->removeCache();
        return true;
    }

    /**
     * 获取JSAPI授权TICKET
     * @param string $appid 用于多个appid时使用,可空
     * @param string $jsapi_ticket 手动指定jsapi_ticket，非必要情况不建议用
     */
    public function getJsTicket($appid = '', $jsapi_ticket = '') {
        if (!$this->access_token && !$this->checkAuth()) {
            return false;
        }
        if (empty($appid)) {
            $appid = $this->appid;
        }
        # 手动指定token，优先使用
        if ($jsapi_ticket) {
            $this->jsapi_ticket = $jsapi_ticket;
            return $this->jsapi_ticket;
        }
        # 尝试从缓存中读取
        $jt = $this->getCache();
        if ($jt) {
            return $this->jsapi_ticket = $jt;
        }
        # 调接口获取
        $result = $this->http_get(self::API_URL_PREFIX . self::GET_TICKET_URL . 'access_token=' . $this->access_token . '&type=jsapi');
        if ($result) {
            $json = json_decode($result, true);
            if (!$json || !empty($json['errcode'])) {
                $this->errCode = $json['errcode'];
                $this->errMsg = $json['errmsg'];
                return $this->checkRetry(__FUNCTION__, func_get_args());
            }
            $this->jsapi_ticket = $json['ticket'];
            $this->setCache($this->jsapi_ticket);
            return $this->jsapi_ticket;
        }
        return false;
    }
    private function getJsApiTicket() {
        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
        $jt = $this->getCache();
        if (!$jt) {
            $accessToken = $this->getAccessToken();
            // 如果是企业号用以下 URL 获取 ticket
            // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
            $res = json_decode($this->httpGet($url));
            $jt = $res->ticket;
            $this->setCache($jt);
        }

        return $jt;
    }


    /**
     * 获取JsApi使用签名
     * @param string $url 网页的URL，自动处理#及其后面部分
     * @param string $timestamp 当前时间戳 (为空则自动生成)
     * @param string $noncestr 随机串 (为空则自动生成)
     * @param string $appid 用于多个appid时使用,可空
     * @return array|bool 返回签名字串
     */
    public function getJsSign($url='', $timestamp = 0, $noncestr = '', $appid = '') {

        $jsapi_ticket  = $this->getJsApiTicket();
        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket={$jsapi_ticket}&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);
        $signPackage = array(
            "appId"     => empty($appid) ? $this->appid : $appid,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;

//        $data = array(
//            "jsapi_ticket" => $this->jsapi_ticket,
//            "timestamp"    => empty($timestamp) ? time() : $timestamp,
//            "noncestr"     => '' . empty($noncestr) ? $this->createNoncestr(16) : $noncestr,
//            "url"          => trim($url),
//        );
//        return array(
//            # 'debug' => true,
//            "appId"     => empty($appid) ? $this->appid : $appid,
//            "nonceStr"  => $data['noncestr'],
//            "timestamp" => $data['timestamp'],
//            "signature" => $this->getSignature($data, 'sha1'),
//            'jsApiList' => array(
//                'onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo', 'onMenuShareQZone',
//                'hideOptionMenu', 'showOptionMenu', 'hideMenuItems', 'showMenuItems', 'hideAllNonBaseMenuItem', 'showAllNonBaseMenuItem',
//                'chooseImage', 'previewImage', 'uploadImage', 'downloadImage', 'closeWindow', 'scanQRCode', 'chooseWXPay',
//                'translateVoice', 'getNetworkType', 'openLocation', 'getLocation',
//                'openProductSpecificView', 'addCard', 'chooseCard', 'openCard',
//                'startRecord', 'stopRecord', 'onVoiceRecordEnd', 'playVoice', 'pauseVoice', 'stopVoice', 'onVoicePlayEnd', 'uploadVoice', 'downloadVoice',
//            )
//        );
    }


}
