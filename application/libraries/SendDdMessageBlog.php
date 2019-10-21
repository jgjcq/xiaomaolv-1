<?php 
	class SendDdMessageBlog{}
	class SendDdMessage{
		private $corpid;
		private $corpsecret;
		private $phone;
		private $agentid;
		private $content;
		function __construct($corpid_p,$corpsecret_p,$phone_p,$agentid_p,$content_p){
				$this->corpid=$corpid_p;
				$this->corpsecret=$corpsecret_p;
				$this->phone=$phone_p;
				$this->agentid=$agentid_p;
				$this->content=$content_p;
		}		
		public function sendMessage(){
			$corpid=$this->corpid;
            $corpsecret=$this->corpsecret;
            $userlist=array();

            $url="https://oapi.dingtalk.com/gettoken?corpid=".$corpid."&corpsecret=".$corpsecret;//获取access_token的方法
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $output=curl_exec($ch);
            curl_close($ch);
//        dump($output);die;
            $out_array = json_decode($output,true);
            // var_dump($out_array);
            // exit();
            $access_token = $out_array["access_token"];

            $url="https://oapi.dingtalk.com/department/list?access_token=".$access_token;
            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $output=curl_exec($ch);
            $out_array = json_decode($output,true);
            // var_dump($out_array);
            // exit();
            foreach ($out_array["department"] as $DPID){
                //echo $DPID["id"];
                //echo "\n";
                $url="https://oapi.dingtalk.com/user/list?access_token=".$access_token."&department_id=".$DPID["id"];
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $output=curl_exec($ch);
                $out_array = json_decode($output,true);
                //var_dump($out_array);
                foreach ($out_array["userlist"] as $USR){
                    $userlist[$USR["mobile"]]=$USR["userid"];
                    //$tem_array('$USR["mobile"]'=>'$USR["userid"]');
                    //array_merge($userlist,$tmp_array]);
                }
            }
            // var_dump($userlist);
            // exit();
            $new_user=array();
            foreach ($userlist as $k => $v) {
            	if(in_array($k,$this->phone))
            	{
            		$new_user[]=$v;
            	}	
            }
            $url="https://oapi.dingtalk.com/message/send?access_token=".$access_token;
            $post_array=array("touser" => implode('|',$new_user),"agentid" => $this->agentid, "msgtype" => "text", "text" => array("content" => $this->content));

            $post_string=json_encode($post_array);

            // var_dump($post_string);

            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($post_string))
            );
            $output = curl_exec($ch);
            curl_close($ch);
            $out_array = json_decode($output,true);
            return $out_array;

		}

	}
?>