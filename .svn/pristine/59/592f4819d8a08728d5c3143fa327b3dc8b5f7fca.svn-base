//截取字符串
function sub_str(str, len,code) {
    var code=code||'...';
    if (str.length > len) {
        var _str = str.substring(0, len);
        return _str + code;
    } else {
        return str;
    }
}
//保留两位小数(非四舍五入，直接截取)
function toDecimal2(x) {
    var s_x=Math.floor(x*100)/100;
    return s_x;
}

//验证货币格式
function checkDecimal(number){
	var patt =/^(([1-9][0-9]*)|(([0]\.\d{1,2}|[1-9][0-9]*\.\d{1,2})))$/ ;
	var result= patt.test(number);
	if(result)
	{
		return true;
	}
	else{
		return false;
	}
}
//将form中的值转换为键值对。
var getFormJson = function(frm) {
	if(frm == undefined)
		frm = "form";
	var o = {};
	var a = $(frm).serializeArray();
	$.each(a, function() {
		if(o[this.name] !== undefined) {
			if(!o[this.name].push) {
				o[this.name] = [o[this.name]];
			}
			o[this.name].push(this.value || '');
		} else {
			o[this.name] = this.value || '';
		}
	});

	return o;
};

//判断值是否为空或null
var IsNullOrEmpty = function(strVal) {
	if(strVal == undefined || strVal == null || $.trim(strVal) == '') {
		return true;
	} else {
		return false;
	}
};


//图片转base64
var toBase64 = function(input_file, get_data) {
	/*input_file：文件按钮对象*/
	/*get_data: 转换成功后执行的方法*/
	if(typeof(FileReader) === 'undefined') {
    window.parent.topMessagePrompt('error',"抱歉，你的浏览器不支持 FileReader，不能将图片转换为Base64，请使用现代浏览器操作！");
	} else {
		try {
			/*图片转Base64 核心代码*/
			var file = input_file.files[0];
			//这里我们判断下类型如果不是图片就返回 去掉就可以上传任意文件  
			if(!/image\/\w+/.test(file.type)) {
        window.parent.topMessagePrompt('error',"请确保文件为图像类型");
				return false;
			}
			if(file.size>1048576*5) {
        window.parent.topMessagePrompt('error',"请确保图片不超过5M");
				return false;
			}
			var reader = new FileReader();
			reader.onload = function() {
				get_data(this.result);
			}
			reader.readAsDataURL(file);
		} catch(e) {
      // window.parent.topMessagePrompt('error','图片转Base64出错啦！' + e.toString());
		}
	}
}
//使用方法
// var ret = toBase64(this, function(data) {
// 			changeHeadimg(data);
// 		});
// 		if(!ret){
// 			$(this).val("");
// 		}



//js html转义html标签
function HtmlEncode(text) {
    return text.replace(/&/g, '&').replace(/\"/g, '"').replace(/</g, '<').replace(/>/g, '>')
}

//js html还原html标签
function HtmlDecode(text) {
    return text.replace(/&/g, '&').replace(/"/g, '\"').replace(/</g, '<').replace(/>/g, '>')
}

//判断是否为数字
function isNumber(chars) {
  var re=/^\d*$/;
  if (chars.match(re) == null)
    return false;
  else
    return true;
}

//判断是否为浮点数
function isFloat(str) {
  for(i=0;i<str.length;i++)  {
     if ((str.charAt(i)<"0" || str.charAt(i)>"9")&& str.charAt(i) != '.'){
      return false;
     }
  }
  return true;
}

//是否邮编
function isPost(chars) {
  var re=/^\d{6}$/;
  if (chars.match(re) == null)
    return false;
  else
    return true;
}

//checkbox 全选与全不选
function checkAll(allid,itemname) {
  var selectall = document.getElementById(allid);
  var allbox = document.getElementsByName(itemname);
  if (selectall.checked) {
    for (var i = 0; i < allbox.length; i++) {
      allbox[i].checked = true;
    }
  } else {
    for (var i = 0; i < allbox.length; i++) {
      allbox[i].checked = false;
    }
  }
}


//判断是否移动端
function isMobile(){
  if (typeof this._isMobile === 'boolean'){
    return this._isMobile;
  }
  var screenWidth = this.getScreenWidth();
  var fixViewPortsExperiment = rendererModel.runningExperiments.FixViewport || rendererModel.runningExperiments.fixviewport;
  var fixViewPortsExperimentRunning = fixViewPortsExperiment && (fixViewPortsExperiment.toLowerCase() === "new");
  if(!fixViewPortsExperiment){
    if(!this.isAppleMobileDevice()){
      screenWidth = screenWidth/window.devicePixelRatio;
    }
  }
  var isMobileScreenSize = screenWidth < 600;
  var isMobileUserAgent = false;
  this._isMobile = isMobileScreenSize && this.isTouchScreen();
  return this._isMobile;
}

//是否苹果
function isAppleMobileDevice(){
  return (/iphone|ipod|ipad|Macintosh/i.test(navigator.userAgent.toLowerCase()));
}

//是否安卓
function isAndroidMobileDevice(){
  return (/android/i.test(navigator.userAgent.toLowerCase()));
}

//按钮id返回顶部
function backTop(btnId) {
  var btn = document.getElementById(btnId);
  var d = document.documentElement;
  var b = document.body;
  window.onscroll = set;
  btn.style.display = "none";
  btn.onclick = function() {
    btn.style.display = "none";
    window.onscroll = null;
    this.timer = setInterval(function() {
      d.scrollTop -= Math.ceil((d.scrollTop + b.scrollTop) * 0.1);
      b.scrollTop -= Math.ceil((d.scrollTop + b.scrollTop) * 0.1);
      if ((d.scrollTop + b.scrollTop) == 0) clearInterval(btn.timer, window.onscroll = set);
    },
    10);
  };
  function set() {
    btn.style.display = (d.scrollTop + b.scrollTop > 100) ? 'block': "none"
  }
}


//js获取get参数
function getGet(){
  querystr = window.location.href.split("?")
  if(querystr[1]){
    GETs = querystr[1].split("&")
    GET =new Array()
    for(i=0;i<GETs.length;i++){
      tmp_arr = GETs[i].split("=")
      key=tmp_arr[0]
      GET[key] = tmp_arr[1]
    }
  }
  return querystr[1];
}


//打开小窗口
function openWindow(url,windowName,width,height){
    var x = parseInt(screen.width / 2.0) - (width / 2.0);
    var y = parseInt(screen.height / 2.0) - (height / 2.0);
    var isMSIE= (navigator.appName == "Microsoft Internet Explorer");
    if (isMSIE) {
     var p = "resizable=1,location=no,scrollbars=no,width=";
     p = p+width;
     p = p+",height=";
     p = p+height;
     p = p+",left=";
     p = p+x;
     p = p+",top=";
     p = p+y;
        retval = window.open(url, windowName, p);
    } else {
        var win = window.open(url, "ZyiisPopup", "top=" + y + ",left=" + x + ",scrollbars=" + scrollbars + ",dialog=yes,modal=yes,width=" + width + ",height=" + height + ",resizable=no" );
        eval("try { win.resizeTo(width, height); } catch(e) { }");
        win.focus();
    }
}

//判断是否有列表中的危险字符
function isDangerChar(chars){
  var re=/<|>|\[|\]|\{|\}|『|』|※|○|●|◎|§|△|▲|☆|★|◇|◆|□|▼|㊣|﹋|⊕|⊙|〒|ㄅ|ㄆ|ㄇ|ㄈ|ㄉ|ㄊ|ㄋ|ㄌ|ㄍ|ㄎ|ㄏ|ㄐ|ㄑ|ㄒ|ㄓ|ㄔ|ㄕ|ㄖ|ㄗ|ㄘ|ㄙ|ㄚ|ㄛ|ㄜ|ㄝ|ㄞ|ㄟ|ㄢ|ㄣ|ㄤ|ㄥ|ㄦ|ㄧ|ㄨ|ㄩ|■|▄|▆|\*|@|#|\^|\\/;
  if (re.test( chars) == true) {
    return true;
  }else{
    return false;
  }
}


//判断字符串是否大于长度
function isCharLength(chars, len) {
  if (chars.length < len) {
    return false;
  }
  return true;
}


//alert插件自定义loading函数
function loadAlert(msg,is_img){
  var is_img=is_img||false;
  if(dialog2){
                    return dialog2.show();
                }
                if(!is_img){
                  var dialog2 = jqueryAlert({
                      // 'icon'    : getRootPath()+'/public/home/images/loading.gif',
                      'modal'   : true,
                      'content' : '<i class="icon-spinner icon-spin icon-3x" style="margin-bottom:8px;"></i></br>'+msg,
                      'closeTime' : 60000,
                  })
                }
                else{
                  var dialog2 = jqueryAlert({
                      'icon'    : getRootPath()+'/public/home/images/loading.gif',
                      'modal'   : true,
                      'content' : msg,
                      'closeTime' : 60000,
                  })
                }
    return dialog2;
}

//alert插件自定义支付loading函数
function payAlert(){
  if(dialog2){
                    return dialog2.show();
                }
                var dialog2 = jqueryAlert({
                    'icon'    : getRootPath()+'/public/home/images/pay_load.png',
                    'modal'   : true,
                    'content' : '支付中...',
                    'closeTime' : 60000,
                })
    return dialog2;
}

//关闭load
function closeAlert(dialog){
    dialog.close();
    dialog.destroy()
}

//alert插件自定义成功函数
function rightAlert(msg){
  if(dialog2){
                    return dialog2.show();
                }
                var dialog2 = jqueryAlert({
                    'icon'    : getRootPath()+'/public/home/images/right.png',
                    'modal'   : true,
                    'content' : msg,
                    'closeTime' : 2000,
                })
}

//alert插件自定义失败函数
function errorAlert(msg){
  if(dialog2){
                    return dialog2.show();
                }
                var dialog2 = jqueryAlert({
                    'icon'    : getRootPath()+'/public/home/images/error.png',
                    'modal'   : true,
                    'content' : msg,
                    'closeTime' : 2000,
                })
}

//配合alert js包快捷alert函数（最基础的），包含上面两种，只是可以自定义图片
function alertInfo(msg,type,image){
  var image=image||false;
  if(image)
  {
    if(dialog){
        return dialog.show();
    }
    var dialog = jqueryAlert({
        'icon'    : image,
        'content' : msg,
        'closeTime' : 2000,
    })
  }
  else{
    
      if(dialog){
                              return dialog.show();
                          }
                          var dialog = jqueryAlert({
                              'icon'    : getRootPath()+'/public/home/alert/img/'+type+'.png',
                              'content' : ret.msg,
                              'closeTime' : 2000,
                          })
    }
  
  
}


//fly插件加入购物车小红点效果
function flyToCart(start_obj,end_obj) {
    var offset_s = $(start_obj).offset();
    var offset_e = $(end_obj).offset();
    var flyer = $('<div style="display:block; height:16px; width:16px; background-color:#dd2727; border:none; border-radius:8px; position: fixed; z-index:13;"><div>');
    flyer.fly({
      start: {
        left: offset_s.left,
        top: offset_s.top
      },
      end: {
        left: offset_e.left,
        top: offset_e.top,
        width: 16,
        height: 16
      },
      onEnd: function() {
        this.destory(); //销毁抛物体
      }
    });
}

//二维码插件生成二维码函数
function getQr(obj,str,width,height){
   new QRCode(obj, {
        text: str,
        width: width,
        height: height,
        colorDark : '#000000',
        colorLight : '#ffffff',
        correctLevel : QRCode.CorrectLevel.H
      }); 
}

//图片放大img_big插件函数
function imgBig(img_class){
  PostbirdImgGlass.init({
            domSelector:"."+img_class,
            animation:true
        });
}

//cryptojs插件 实现加密解密
//aes-256-cbc加密解密
//** 加密 **
//var ciphertext = CryptoJS.AES.encrypt(message, key, cfg);
//params: 注意参数key为WordArray对象
//return: 密码对象 或者 密码对象Base64字符串
function aesEncrypt(message, key, iv, is_str) {
    var is_str=is_str||true;
    var ciphertext = CryptoJS.AES.encrypt(message, key, {
        iv: CryptoJS.enc.Utf8.parse(iv),
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7
    });
    if (is_str) {
        return ciphertext.toString(); //密码对象的Base64字符串
    } else {
        return ciphertext; //密码对象(Obejct类型，非WordArray类型)，Base64编码。
    }

    //return ciphertext.toString();//密码对象的Base64字符串

}

//** 解密 **
//var plaintext  = CryptoJS.AES.decrypt(ciphertext, key, cfg);
//params: 注意参数ciphertext 必须为 Base64编码的对象或者字符串。
function aesDecrypt(ciphertext, key, iv) {
    var decrypted = CryptoJS.AES.decrypt(ciphertext, key, {
        iv: CryptoJS.enc.Utf8.parse(iv),
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7
    });
    return decrypted.toString(CryptoJS.enc.Utf8); //WordArray对象转utf8字符串
}

//数组元素交换位置
//swapArray(vue.loadareas, index, index-1)上移
function swapArray(arr, index1, index2) {
   arr[index1] = arr.splice(index2, 1, arr[index1])[0];
    return arr;
}
//取出数组中的空项
function clearArrTrim(array) {
    for(var i = 0 ;i<array.length;i++)
    {
        if(array[i] == "" || typeof(array[i]) == "undefined")
        {
            array.splice(i,1);
            i= i-1;
        }
    }
    return array;
}

function getRootPath(){ 
    var strFullPath=window.document.location.href; 
    var strPath=window.document.location.pathname; 
    var pos=strFullPath.indexOf(strPath); 
    var prePath=strFullPath.substring(0,pos); 
    var postPath=strPath.substring(0,strPath.substr(1).indexOf('/')+1); 
    return(prePath+postPath); 
  } 

function jsDataToPhpDate(date) { //Fri Oct 31 18:00:00 UTC+0800 2008
    date=new Date(date);
    var date_value = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
    return date_value;
}



