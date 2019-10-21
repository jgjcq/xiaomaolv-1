var layerIconType={'success':'1','error':'2','confirm':'3','lock':'4','cry':'5','smile':'6','surprise':'7'};
var showDialogModal = function(url,width,height,func) {
	var width=width||700;
	var height=height||400;
	var func=func||false;
	top.layer.open({
	    type: 2,
	    shadeClose: true,
	    shade: 0,
	    skin: 'layui-layer-rim', 
	    maxmin: true, //开启最大化最小化按钮
	    area: [width+'px', height+'px'],
	    content: url,
	    zIndex: layer.zIndex, //重点1
	    btn: ['取消'],
	    success: function(layero,index){
	    	// layero 自己 效果同$(obj)
	    	// top.layer.getChildFrame('body', index) 获取自己下面页面的body 效果同obj
	       	top.layer.setTop(layero); //重点2 点击置顶

	       	//改变标题
	       	layero.find('.layui-layer-title').html($(top.layer.getChildFrame('body', index)).find('#modal_title').val());
	    	if(func){
	    		func();	
	    	}
	    }
	});

	
}


var showPageDialogModal = function(url,width,height,func) {
	var width=width||700;
	var height=height||400;
	var func=func||false;
	layer.open({
	    type: 2,
	    shadeClose: true,
	    shade: 0.5,
	    skin: 'layui-layer-rim', 
	    maxmin: false, //开启最大化最小化按钮
	    area: [width+'px', height+'px'],
	    content: url,
	    zIndex: layer.zIndex, //重点1
	    btn: ['取消'],
	    success: function(layero,index){
	    	// layero 自己 效果同$(obj)
	    	// top.layer.getChildFrame('body', index) 获取自己下面页面的body 效果同obj
	       	layer.setTop(layero); //重点2 点击置顶

	       	//改变标题
	       	layero.find('.layui-layer-title').html($(layer.getChildFrame('body', index)).find('#modal_title').val());
	    	if(func){
	    		func();	
	    	}
	    }
	});

	
}

//捕获页面元素  obj 为jq对象
var showObjDialogModal = function(obj,callback) {
	var callback=callback||false;
    layer.open({
        type: 1,
        shade: false,
        title: false, //不显示标题
        content: obj, //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
        cancel: function() {
        	if(callback){
        		callback();
        	}  
        }
    });
}

//confirm
var showDialogModalConfirm=function(type,title,text,btn1,btn2,callback1,callback2){
	var callback1=callback1||false;
	var callback2=callback2||false;
	var btn1=btn1||'确认';
	var btn2=btn2||'取消'; 
	layer.confirm(text, {icon: layerIconType[type], title:title,btn: [btn1,btn2]}, 
	function(index){
	  if(callback1){
	  	callback1();
	  }
	  layer.close(index);
	}, function(index){
	  if(callback2){
	  	callback2();
	  } 
	  layer.close(index);  
	});
}


//多媒体弹出，一般为视频
var showDialogModalVideo=function(url){
	top.layer.open({
	  type: 2,
	  title: false,
	  area: ['630px', '360px'],
	  shade: 0.8,
	  closeBtn: 0,
	  shadeClose: true,
	  content: url
	});
}

//相册弹出,传入图片地址组成的json数据,
//json结构：
// var obj={
//   "data": [
//     {
//       "alt": "layer",
//       "pid": 109,
//       "src": "http://d.hiphotos.baidu.com/image/h%3D300/sign=636760ba04f79052f01f413e3cf2d738/caef76094b36acaf6d1e855571d98d1000e99c98.jpg",
//       "thumb": ""
//     },
//     {
//       "alt": "说好的，一起Fly",
//       "pid": 110,
//       "src": "http://d.hiphotos.baidu.com/image/h%3D300/sign=ee28098e7ef082023292973f7bfafb8a/63d9f2d3572c11dfea8f528e6e2762d0f603c2c5.jpg",
//       "thumb": ""
//     }
//   ]
// }
var showDialogModalPhoto=function(json){
	layer.photos({
	    photos: json, //格式见API文档手册页
	    anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机
	});
}

//带输入框的confirm
var showDialogModalPrompt=function(title,callback,formType){
	var formType=formType||2;
	// 1:input password   2:textarea
	layer.prompt({title: title, formType: formType}, function(text, index){
		layer.close(index);
	    callback(text);
	});
}

//tab标签的提示框
var showDialogModalTab=function(tab,width,height){
	var width=width||600;
	var height=height||300;
	top.layer.tab({
	  area: [width+'px', height+'px'],
	  tab: tab
	});
}

//捕获页，将html中的元素用layer包裹起来 弹出，此处传参obj为jq中的$('.aa')
var showDialogModalGet=function(obj,callback){
	var callback=callback||false;
	layer.open({
	  type: 1,
	  shade: false,
	  title: false, //不显示标题
	  content: obj, //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
	  cancel: function(){
	    // layer.msg('捕获就是从页面已经存在的元素上，包裹layer的结构', {time: 5000, icon:6});
	    if(callback){
	    	callback();
	    }
	  }
	});
}

//tip   obj 同jq $('.aa')
var showDialogModalTip=function(text,obj,color){
	var color=color||'#3595CC';
	layer.tips(text, obj, {
	  tips: [1,color],
	  time: 4000
	});
}




var hideDialogModal = function() {
	// parentDialog.close();
	var index = parent.layer.getFrameIndex(window.name);
	parent.layer.close(index);
}

var fullDialogModal=function(){
	var index = parent.layer.getFrameIndex(window.name);
	parent.layer.full(index);
}


// var refreshTable = function() {
// 	var parent_id=parseInt(parentDialog.ID);
// 	var now_id=parent_id-1;
// 	if(parent_id==0){
// 		alert($(".xrTable" , parent.document).html());
// 		$(".xrTable" , parent.document).refresh();
// 		// $(window.parent.document).find('#table').refresh();
// 	}
// 	else{
// 		if($('#_DialogFrame_'+now_id,top.window.document).contents().find(".xrTable").length > 0) {
// 		    $('#_DialogFrame_'+now_id,top.window.document).contents().find(".xrTable").refresh();
// 		} 
// 	}
// 	// $("#table").refresh();
// }
var refreshTable = function() {
	if($("#table").length>0){
		$("#table").refresh();
	}
	$('iframe',window.top.document).each(function(){
		if($(this).contents().find(".xrTable").length > 0) {
		    $(this)[0].contentWindow.$(".xrTable").refresh();
		} 
	});
}
//顶部消息提示
// var topMessagePrompt = function(type,msg,func) {
// 	var type=type||'success';
// 	var func=func||false;
// 	if(!func){
// 			$.message({
// 	            message:msg,
// 	            type:type
// 	        });
// 		}
// 		else{
// 			$.message({
// 	            message:ret.msg,
// 	            type:type,
// 	            onClose:function(){
// 	                func();
// 	            }
// 	        });
// 		}
// }

var topMessagePrompt = function(type,msg,func,group) {
	var type=type||'success';
	var func=func||false;
	var group=group||'web-top-message';
	if(!func){
		spop({
			template: msg,
			position  : 'top-center',
			style: type,
			group: group,
			autoclose: 2000
		});
	}
	else{
		spop({
			template: msg,
			position  : 'top-center',
			style: type,
			group: group,
			autoclose: 2000,
			onClose: function() {
				func();
			}
		});
	}
	
}

// 添加按钮
var addDialogButton=function(name, callback,class_name){
	// var setButton=setInterval(function(){
	// 	if(typeof(parentDialog)=='object')
	// 	{
	// 		parentDialog.addButton(param,name,function(){
	// 			dofunc();
	// 		});
	// 		clearInterval(setButton);
	// 	}
	// },10);
	
	var class_name=class_name||'';
	var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
	var layerBtnOutdiv_ = parent.$("#layui-layer"+index);
	var layerBtnDiv_ = layerBtnOutdiv_.find(".layui-layer-btn");
	if(class_name==''){
		var button_ = $('<a></a>',{
		text:name,
		"class":"layui-layer-btn0",
		'style':'background-color:#EC6C62; border-color:#EC6C62;'
		});
	}
	else{
		var button_ = $('<a></a>',{
		text:name,
		"class":"layui-layer-btn0 "+class_name,
		'style':'background-color:#EC6C62; border-color:#EC6C62;'
		});
	}
	
	button_.click(function() {callback(index)});
	if(layerBtnDiv_.length==0){
	var s = "<div class=\"layui-layer-btn\"></div>";
	layerBtnOutdiv_.append(s);
	layerBtnDiv_ = layerBtnOutdiv_.find(".layui-layer-btn");
	}
	button_.prependTo(layerBtnDiv_);

}

var removeDialogButton=function(class_name){
	var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
	var layerBtnOutdiv_ = parent.$("#layui-layer"+index);
	layerBtnOutdiv_.find(".layui-layer-btn").find('.'+class_name).remove();
}


//网站消息提示框
var showMessageRemind=function(message,title){
	var title=title||'新消息';
	spop({
		template: '<h4 style="margin-top:-0.4em;">'+title+'</h4>'+message,
		position  : 'bottom-right',
		style: 'info'
	});
}
