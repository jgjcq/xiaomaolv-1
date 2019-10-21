<?php
class TencentEmailLoginBlog{}
class TencentEmailLogin{
    private $corpid;
    private $corpsecret;
    private $mail;
    function __construct($config){
        $this->corpid=$config['corpid'];
        $this->corpsecret=$config['corpsecret'];
        $this->mail=$config['mail'];
    }

    //单点登录       
    public function doLogin(){
        $access_token=$this->getToken();
        if(!$access_token){
            exit('获取access_token失败，请联系管理员');
        }
        $login_url='https://api.exmail.qq.com/cgi-bin/service/get_login_url?access_token='.$access_token.'&userid='.$this->mail;
        $login_url_json = json_decode(file_get_contents($login_url));
        // var_dump($login_url_json);
        // exit();
        if($login_url_json->errmsg!="ok")
        {
            exit('获取登录地址失败，请联系管理员');    
        }
        header("location:".$login_url_json->login_url);
    }

    //获取access_token
    public function getToken(){
        $get_access_token_url = 'https://api.exmail.qq.com/cgi-bin/gettoken?corpid='.$this->corpid.'&corpsecret='.$this->corpsecret;
        $access_token_json = json_decode(file_get_contents($get_access_token_url));
        // var_dump($access_token_json);
        // exit();
        $state= $access_token_json->errmsg;
        if($state == "ok"){
            return $access_token_json->access_token;
        }
        else{
            return false;
        }
    }       

}

?>