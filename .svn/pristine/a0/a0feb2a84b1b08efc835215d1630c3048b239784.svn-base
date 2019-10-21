$.extend({myMethod:function(id,tagData,name,defaultData,default_callback,choose_callback,close_callback){
	var default_callback=default_callback||false;
	var choose_callback=choose_callback||false;
	var close_callback=close_callback||false;	
	$(id).css('border-radius','3px;').css('padding','8px');
	var html='<div class="layui-form-item">';
	html+='<div class="AD">';
	html+='</div>';
	html+='</div>';
	html+='<div class="layui-form-item">';
	html+='<div class="layui-input-inline fileId layui-form-select layui-form-selected">';
	html+='<input type="text" class="layui-input" placeholder="请输入搜索或选择" autocomplete="off">';
	html+='<dl style="display: none;"></dl>';
	html+='</div>';
	html+='</div>';
	$(id).append(html);
	$(id).find(".AD").parent().hide();
	//初始化数据
	// alert(defaultData.length);
	if(defaultData.length>0){
		for (var i =0; i < defaultData.length; i++) {
			$(id).find(".AD").append('<a href="javascript:;" class="label"><span lay-value="64">'+defaultData[i].name+'</span><input type="hidden" name="'+name+'" id="'+defaultData[i].name+'" value="'+defaultData[i].id+'"/><i class="icon-remove-circle close"></i></a>');
		}
		$(id).find(".AD").parent().show();
		if(default_callback){
			default_callback();
		}
	}

	$(id).find(".fileId").on("click","dl dd",function(){
		var this_id=$(this).attr("value");
		if(this_id!=undefined)
		{
			$(id).find(".AD").append('<a href="javascript:;" class="label"><span lay-value="64">'+$(this).html()+'</span><input type="hidden" name="'+name+'" id="'+$(this).html()+'" value="'+this_id+'"/><i class="icon-remove-circle close"></i></a>');
			$(id).find(".AD").parent().show();
			for(var i=0;i<tagData.length;i++)
			{
				if(tagData[i].id==this_id)
				{
					tagData.splice(i,1);
				}
			}
		}
		$(id).find(".fileId dl").hide();
		$(id).find(".fileId input").val("");
		if(choose_callback){
			choose_callback();
		}
	})
	function AD(name,id)
	{
		this.name=name;
		this.id=id;
	}
	$(id).find(".AD").on("click",".close",function(){
		$(this).parent().remove();
		var id=$(this).parent().children("input").val();
		var text=$(this).parent().children("input").attr("id");
		tagData.push(new AD(text,id));
		if(close_callback){
			close_callback();
		}
	})
	$(id).find(".fileId input").on("input propertychange",function(){
		$(id).find(".fileId dl dd").remove();$(id).find(".fileId dl").hide();
		if(tagData.length>0){
			$(id).find(".fileId dl").show();
			var sear=new RegExp($(this).val());
			var temp=0;
			for(var i=0;i<tagData.length;i++)
			{
				if(sear.test(tagData[i].name))
				{
					temp++;
					// alert(tagData[i].show);
					$(id).find(".fileId dl").append('<dd value="'+tagData[i].id+'" >'+tagData[i].name+'</dd>')
				}
			}
			if(temp==0){
				$(id).find(".fileId dl").append('<dd>暂无数据</dd>')
			}
		}
	})
	$(document).click(function(){
		$(id).find(".fileId dl").hide();
		$(id).find(".fileId input").val("");
	});
	$(id).find(".fileId input").click(function(event){
		$(id).find(".fileId dl dd").remove();
		if(tagData.length==0){
			$(this).val("暂无数据")
		}else{
			$(id).find(".fileId dl").show();
		}
		for(var i=0;i<tagData.length;i++)
		{
			$(id).find(".fileId dl").append('<dd value="'+tagData[i].id+'">'+tagData[i].name+'</dd>')
		}
		event.stopPropagation();
	});
}
});