//工具箱
//基础启动
window.onload = function() {
	//关闭自动提交
	$("form[class!='importForm']").submit(function() {
		return false;
	});
	//打开a标签tip
	$("a").tooltip();
	//btn的div便捷操作
	$(".xrbtn").click(function() {
		if($(this).data("href") == undefined) {
			return;
		}
		if($(this).data("toggle") == 'modal') {
			return;
		}
		div_to_url($(this).data("href"));
	});
};

var div_to_url = function(url) {
	location.href = url;
}

/******************************表单处理**************************************/
//数字及小数点输入
var clearNoNum = function(obj) {
	obj.value = obj.value.replace(/[^\d.]/g, ""); //清除“数字”和“.”以外的字符   
	obj.value = obj.value.replace(/\.{2,}/g, "."); //只保留第一个. 清除多余的   
	obj.value = obj.value.replace(".", "$#$").replace(/\./g, "").replace("$#$", ".");
	obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/, '$1$2.$3'); //只能输入两个小数   
	if(obj.value.indexOf(".") < 0 && obj.value != "") { //以上已经过滤，此处控制的是如果没有小数点，首位不能为类似于 01、02的金额  
		obj.value = parseFloat(obj.value);
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

//用于显示错误信息
var showMyError = function(errMsg) {
	$("#myError.Validform_checktip").show();
	$("#myError.Validform_checktip").html(errMsg);
};

//用于隐藏错误信息
var hideMyError = function() {
	$("#myError.Validform_checktip").hide();
};

//默认图片
var errorImg = function(obj) {
	obj.src = 'cust/images/default.png';
	obj.onerror = null;
};

/*
 * 下拉选择生成工具
 * param: 参数列表
 * 参数: 
 * 	isneedAll: 是否需要所有
 * 	ajaxUrl: ajax的URL地址
 * 	datas: ajax的data
 * 	valueStr: option标签对应的字段名
 * 	captionStr: option标签显示文本对应的字段名
 * 	realStr: option标签中data-v属性值的对应的字段名
 * 	selected: 要选中的option标签的value
 */
$.fn.bindCate = function(cType) {
	var transParam = {};
	transParam.ajaxUrl = "Comm/DDLCon/getCateList/" + cType;
	transParam.valueStr = "name";
	transParam.captionStr = "name";
	this.bindSelect(transParam);
};

$.fn.bindSelect = function(param) {
	if(param.isNeedAll == undefined) {
		param.isNeedAll = false;
	}
	if(param.ajaxUrl == undefined) {
		param.ajaxUrl = '';
	}
	if(param.datas == undefined) {
		param.datas = {};
	}
	if(param.valueStr == undefined) {
		param.valueStr = '';
	}
	if(param.captionStr == undefined) {
		param.captionStr = '';
	}
	if(param.realStr == undefined) {
		param.realStr = param.valueStr;
	}
	if(param.nullCaption == undefined) {
		param.nullCaption = "全部";
	}
	if(param.async == undefined) {
		param.async = true;
	}

	var dom = $(this);
	$.ajax({
		url: param.ajaxUrl,
		type: "post",
		data: param.datas,
		async: param.async,
		success: function(data) {
			var ret = JSON.parse(data);
			var options = "";
			if(param.isNeedAll) {
				options += "<option value=''>" + param.nullCaption + "</options>";
			}
			for(var i = 0; i < ret.length; i++) {
				options += "<option data-v='" + ret[i][param.realStr] + "' value='" + ret[i][param.valueStr] + "' ";
				if(param.selected != undefined && param.selected == ret[i][param.valueStr]) {
					options += " selected ";
				} else if(param.selected == undefined && dom.data("val") == ret[i][param.valueStr]) {
					options += " selected ";
				}
				options += ">";
				options += ret[i][param.captionStr];
				options += "</option>";
			}
			dom.empty();
			dom.append(options);
		}
	});
};

//选择搜索下拉框
$.fn.bindCombox = function(selected) {
	$(this).addClass("chosen-select");
	$(this).data("placeholder", "选择一个城市");
	var dom = $(this);
	$.ajax({
		url: "DDLCon/getCitys",
		type: "post",
		data: {},
		async: true,
		success: function(data) {
			var citys = eval(data);
			var options = "";
			for(var i = 0; i < citys.length; i++) {
				var city = citys[i];
				options += "<option value='" + city.name + "' ";
				if(selected != undefined && selected == city.name) {
					options += " selected ";
				}
				options += ">";
				options += city.city_cn + "(" + city.country + ")";
				options += "</option>";
			}
			dom.empty();
			dom.append(options);
			dom.chosen();
		}
	});
};

//文本搜索框
$.fn.bindTextbox = function(ajaxUrl, caption) {
	var dom = $(this);
	$.ajax({
		url: ajaxUrl,
		type: "post",
		data: {},
		async: true,
		success: function(data) {
			var rets = eval(data);
			var datas = [];
			for(var i = 0; i < rets.length; i++) {
				var t = {};
				t.label = rets[i][caption];
				datas.push(t);
			}
			dom.autocomplete({
				source: datas,
				delay: 10,
				select: function(event, ui) {}
			});
			dom.data("ui-autocomplete")._renderItem = function(ul, item) {
				return $("<li></li>")
					.append(item.label)
					.appendTo(ul);
			};
		}
	});
}

/******************************日期处理**************************************/
//日期格式化
Date.prototype.Format = function(fmt) {
	var o = {
		"M+": this.getMonth() + 1, //月份   
		"d+": this.getDate(), //日   
		"h+": this.getHours(), //小时   
		"m+": this.getMinutes(), //分   
		"s+": this.getSeconds(), //秒   
		"q+": Math.floor((this.getMonth() + 3) / 3), //季度   
		"S": this.getMilliseconds() //毫秒   
	};
	if(/(y+)/.test(fmt))
		fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
	for(var k in o)
		if(new RegExp("(" + k + ")").test(fmt))
			fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
	return fmt;
};

//用于判断多少分钟前,多少小时前,多少天前,显示日期用
function jsDateDiff(pTime) {
	var d_minutes, d_hours, d_days, d;
	var timeNow = parseInt(new Date().getTime() / 1000);
	pTime_new = new Date(pTime).getTime() / 1000;
	d = timeNow - pTime_new;
	d_days = parseInt(d / 86400);
	d_hours = parseInt(d / 3600);
	d_minutes = parseInt(d / 60);
	if(d_days > 0 && d_days < 4) {
		return d_days + "天前";
	} else if(d_days <= 0 && d_hours > 0) {
		return d_hours + "小时前";
	} else if(d_hours <= 0 && d_minutes > 0) {
		return d_minutes + "分钟前";
	} else if(d <= 60) {
		return "刚刚";
	} else {
		return new Date(pTime).Format("yyyy年MM月dd日");
	}
}

/***********************************数组及变量处理判断***************************/
//判断是否为空
IsNullOrEmpty = function(strVal) {
	if(strVal == undefined || strVal == null || $.trim(strVal) == '') {
		return true;
	} else {
		return false;
	}
};

//判断对象是否方法
function isFunction(fn) {
	return Object.prototype.toString.call(fn) === '[object Function]';
};

//删除空的对象
usefulArray = function(datas) {
	var nullArray = [];
	for(var i in datas) {
		if(IsNullOrEmpty(datas[i])) {
			nullArray.push(i);
		}
	}
	for(var i = 0; i < nullArray.length; i++) {
		delete datas[nullArray[i]];
	}
	return datas;
}

//使用post方式跳转页面
locationPost = function(URL, PARAMS) {
	var temp = document.createElement("form");
	temp.action = URL;
	temp.method = "post";
	temp.style.display = "none";
	for(var x in PARAMS) {
		var opt = document.createElement("textarea");
		opt.name = x;
		opt.value = PARAMS[x];
		// alert(opt.name)        
		temp.appendChild(opt);
	}
	document.body.appendChild(temp);
	temp.submit();
	return temp;
}

/***********************************页面效果处理***************************/
//iframe 自适应高度
function iFrameAutoHeight(obj) {
	var subWeb = document.frames ? document.frames[obj.id].document : obj.contentDocument;
	if(obj != null && subWeb != null) {
		obj.height = subWeb.body.scrollHeight;
		obj.width = subWeb.body.scrollWidth;
	}
};

//图片预览功能
function setImagePreview(docObj, imgObjPreview) {
	docObj = docObj.get(0);
	imgObjPreview.attr("display", "block");
	imgObjPreview.attr("width", "180px");
	imgObjPreview.attr("height", "150px");
	imgObjPreview.attr("src", window.URL.createObjectURL(docObj.files[0]));
	return true;
};

//详情页面group等高
var detailBasicGroupEqualHeight = function() {
	$(".basicGroup").each(function(index, ele) {
		if(index % 2 != 0) {
			return true;
		}
		var height1 = $(this).css("height").substring(0, $(this).css("height").indexOf('px'));
		var height2 = $(this).next().css("height").substring(0, $(this).next().css("height").indexOf('px'));
		if(height1 != height2) {
			$(this).css("height", (height1 > height2 ? height1 : height2) + "px");
			$(this).next().css("height", (height1 > height2 ? height1 : height2) + "px");
		}
	});
}

//$("...")部分表示通过样式名获得该类的a标签，该样式名没有具体的样式定义（也可以根据实际需要定义），只为为了便于查找同类标签而已。anchorGoWhere就是锚点跳转的实现方法，里面的target参数为跳转的类型，如果是1，则是纵向的；如果是2，则是横向的。
jQuery.fn.anchorGoWhere = function(options) {
	var obj = jQuery(this);
	var defaults = {
		target: 0,
		timer: 1000
	};
	var o = jQuery.extend(defaults, options);
	obj.each(function(i) {
		jQuery(obj[i]).click(function() {
			var _rel = jQuery(this).attr("href").substr(1);
			switch(o.target) {
				case 1:
					var _targetTop = jQuery("#" + _rel).offset().top;
					jQuery("html,body").animate({
						scrollTop: _targetTop
					}, o.timer);
					break;
				case 2:
					var _targetLeft = jQuery("#" + _rel).offset().left;
					jQuery("html,body").animate({
						scrollLeft: _targetLeft
					}, o.timer);
					break;
			}
			return false;
		});
	});
};

//json对象删除空对象
var blankObj = function(obj) {
	var nullArray = [];
	for(var i in obj) {
		if(IsNullOrEmpty(obj[i])) {
			nullArray.push(i);
		}
	}
	for(var i = 0; i < nullArray.length; i++) {
		delete obj[nullArray[i]];
	}
	return obj;
}

//获取json元素个数
var getJsonObjLength = function(jsonObj) {
	var Length = 0;
	for(var item in jsonObj) {
		Length++;
	}
	return Length;
}

//图片转base64
var toBase64 = function(input_file, get_data) {
	/*input_file：文件按钮对象*/
	/*get_data: 转换成功后执行的方法*/
	if(typeof(FileReader) === 'undefined') {
		alert("抱歉，你的浏览器不支持 FileReader，不能将图片转换为Base64，请使用现代浏览器操作！");
	} else {
		try {
			/*图片转Base64 核心代码*/
			var file = input_file.files[0];
			//这里我们判断下类型如果不是图片就返回 去掉就可以上传任意文件  
			if(!/image\/\w+/.test(file.type)) {
				alert("请确保文件为图像类型");
				return false;
			}
			if(file.size>1048576*5) {
				alert("请确保图片不超过5M");
				return false;
			}
			var reader = new FileReader();
			reader.onload = function() {
				get_data(this.result);
			}
			reader.readAsDataURL(file);
		} catch(e) {
			alert('图片转Base64出错啦！' + e.toString())
		}
	}
}

//字符串开始
String.prototype.startWith=function(str){     
  var reg=new RegExp("^"+str);     
  return reg.test(this);        
}  

//字符串结束
String.prototype.endWith=function(str){     
  var reg=new RegExp(str+"$");     
  return reg.test(this);        
}