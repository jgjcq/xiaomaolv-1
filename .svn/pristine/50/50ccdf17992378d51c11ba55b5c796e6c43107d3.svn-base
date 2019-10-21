<?php 
	class SendWxMessageBlog{}
	class SendWxMessage{
		private $template_id;
		private $touser;
		private $info;
		private $url;
		private $appid;
		private $appsecret;
		private $keyword_num;
		function __construct($template_id_p,$touser_p,$info_p,$url_p,$appid_p,$appsecret_p){
				$this->template_id=$template_id_p;
				$this->touser=$touser_p;
				$this->info=$info_p;
				$this->url=$url_p;
				$this->appid=$appid_p;
				$this->appsecret=$appsecret_p;
				$this->keyword_num=(count($info_p)-4)/2;
				// $this->sendMessage();
		}		
		public function sendMessage(){
			$ACCESS_TOKEN = $this->getToken();//ACCESS_TOKEN
			
			//模板消息请求URL
			$url1 = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $ACCESS_TOKEN;
			//获取求助信息
		
			//遍历发送微信消息
			foreach ($this->touser as $k=>$value) {
			    $data = $this->getDataArray($value);
			    $json_data = json_encode($data);//转化成json数组让微信可以接收
			    $res = $this->https_request($url1, urldecode($json_data));//请求开始
			    $res = json_decode($res, true);
			    // var_dump($ACCESS_TOKEN);
			    // var_dump($_SESSION['refresh']);
			    // var_dump($res);
			    // if ($res['errcode'] == 0 && $res['errcode'] == "ok") {
			    //     // echo "发送成功！<br/>";
			    // }
			}
		}

		 

		//获取发送数据数组
		private function getDataArray($value)
		{
		    $data = array(
		        'touser' => $value, //要发送给用户的openid
		        'template_id' => $this->template_id,//改成自己的模板id，在微信后台模板消息里查看
		        'url' => $this->url, //自己网站链接url
		        'data' => array()
		    );
		    $data['data']['first']= array(
		                'value' => $this->info['first'],
		                'color' => $this->info['first_color']
		            );
		    for ($i=1; $i <= $this->keyword_num; $i++) { 
		    	$data['data']['keyword'.$i]=array(
		    		'value'=>$this->info['keyword'.$i],
		    		'color'=>$this->info['color'.$i]
		    		);
		    }
		    $data['data']['remark']= array(
		                'value' => $this->info['remark'],
		                'color' => $this->info['remark_color']
		            );
		    return $data;
		}


		//curl请求函数，微信都是通过该函数请求
		private function https_request($url1, $data = null)
		{
		    $curl = curl_init();
		    curl_setopt($curl, CURLOPT_URL, $url1);
		    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		    if (!empty($data)) {
		        curl_setopt($curl, CURLOPT_POST, 1);
		        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		    }
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		    $output = curl_exec($curl);
		    curl_close($curl);
		    return $output;
		}

		//获取tkoken
		protected function getToken(){  
	          $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->appsecret;
	          $token = json_decode(file_get_contents($url));
	          return $token->access_token;
	   	}
}
?>