<?php

include_once("WxPayPubHelper/WxPayPubHelper.php");
class CI_JsPay
{
    public function getJsApiParameters($openid){
        //使用jsapi接口
        $jsApi = new JsApi_pub();

        // echo $openid;
        // $openid='oFHrCw4OyfuZU4w7BEWuZ19MZAO0';

        //=========步骤2：使用统一支付接口，获取prepay_id============
        //使用统一支付接口

        $unifiedOrder = new UnifiedOrder_pub();

        //设置统一支付接口参数
        //设置必填参数
        //appid已填,商户无需重复填写
        //mch_id已填,商户无需重复填写
        //noncestr已填,商户无需重复填写
        //spbill_create_ip已填,商户无需重复填写
        //sign已填,商户无需重复填写
        //$openid='oFHrCw4OyfuZU4w7BEWuZ19MZAO0';
        $unifiedOrder->setParameter("sub_openid","$openid");//商品描述
        $unifiedOrder->setParameter("body","1fen");//商品描述
        //自定义订单号，此处仅作举例
        $timeStamp = 'order'.time();
        $out_trade_no = "$timeStamp";
        $unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号
        $unifiedOrder->setParameter("total_fee","1");//总金额
        $unifiedOrder->setParameter("notify_url",WxPayConf_pub::NOTIFY_URL);//通知地址
        $unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
        //非必填参数，商户可根据实际情况选填
       // $unifiedOrder->setParameter("sub_appid","wx104c99601d8695e2");//子商户号
      //  $unifiedOrder->setParameter("sub_mch_id","1489937312");//子商户号
        //$unifiedOrder->setParameter("device_info","XXXX");//设备号
        $unifiedOrder->setParameter("attach","XXXX");//附加数据
        $unifiedOrder->setParameter("time_start",date("YmdHis"));//交易起始时间
        $unifiedOrder->setParameter("time_expire",date("YmdHis", time() + 600));//交易结束时间
        //$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记
        //$unifiedOrder->setParameter("openid","XXXX");//用户标识
        $unifiedOrder->setParameter("product_id","1");//商品ID

        $prepay_id = $unifiedOrder->getPrepayId();
        //=========步骤3：使用jsapi调起支付============
        $jsApi->setPrepayId($prepay_id);

        $jsApiParameters = $jsApi->getParameters();
    }
}