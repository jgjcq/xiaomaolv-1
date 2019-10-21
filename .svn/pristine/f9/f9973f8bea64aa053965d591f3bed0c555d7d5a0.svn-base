var d;
var demo;
 
$(function() {
	//开启验证
	demo = $("#editForm").Validform({
		tiptype: 3
	});
	addDialogButton("保存",save);

	$("#upload_button").click(function() {
		$(this).next().click();
	});

	$("input[type='file']").change(function() {
		// var img = $(this).prev();
		var ret = toBase64(this, function(data) {
			// alert(data);
			$('#head_img').val(data);
			$('#head_img_img').attr('src',data);
		});
		if(!ret){
			$(this).val("");
		}
	});
});

var toBase64 = function(input_file, get_data) {
	/*input_file：文件按钮对象*/
	/*get_data: 转换成功后执行的方法*/
	if(typeof(FileReader) === 'undefined') {
		if(dialog){
		    return dialog.show();
		}
		window.parent.topMessagePrompt('error',"抱歉，你的浏览器不支持 FileReader，不能将图片转换为Base64，请使用现代浏览器操作！");
	} else {
		try {
			/*图片转Base64 核心代码*/
			var file = input_file.files[0];
			//这里我们判断下类型如果不是图片就返回 去掉就可以上传任意文件  
			if(!/image\/\w+/.test(file.type)) {
				if(dialog){
				    return dialog.show();
				}
				window.parent.topMessagePrompt('error',"请确保文件为图像类型");
				return false;
			}
			if(file.size>2097152) { 
				if(dialog){
				    return dialog.show();
				}
				window.parent.topMessagePrompt('error',"请确保图片不超过2M");
				return false;
			}
			var reader = new FileReader();
			reader.onload = function() {
				get_data(this.result);
			}
			reader.readAsDataURL(file);
		} catch(e) {
				if(dialog){
				    return dialog.show();
				}
				window.parent.topMessagePrompt('error','图片转Base64出错啦！' + e.toString());
		}
	}
}

var save = function() { 
	if(!demo.check()) {
		$('.Validform_error:first').focus();
		return;
	}
	
	if($('#head_img').val()==''){
		window.parent.topMessagePrompt('error','请上传头像');
		return;
	}
	
	d = dialog({
		title: '',
		content: "数据保存中,请稍后...",
	});
	d.showModal();

	$.ajax({
		url: "Admin/Login/doChangeHeadImg",
		type: "post",
		data: {head_img:$('#head_img').val()},
		success: function(data) {
			if(d != undefined)
				d.close().remove();
			var ret = $.parseJSON(data);
			if(ret.status) {
				window.parent.topMessagePrompt('success',ret.msg);
				window.parent.refreshTable();
				hideDialogModal();
			} else {
				window.parent.topMessagePrompt('error',ret.msg);
			}
		}
	});
}