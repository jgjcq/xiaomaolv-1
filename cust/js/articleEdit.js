var d;
var demo;

$(function() {
	ue.addListener("ready", function () { 
	UE.getEditor('editor').setContent($('#content').val());
	});
	
	
	//开启验证
	demo = $("#editForm").Validform({
		tiptype: 3
	});
	addDialogButton("保存",save);

	//关闭页面是执行操作
	
});

var save = function() { 
	
	if(!demo.check()) {
		$('.Validform_error:first').focus();
		return;
	}

	d = dialog({
		title: '',
		content: "数据保存中,请稍后...",
	});
	d.showModal();
	var id=$('#id').val();
	var title=$('#title').val();
	var subtitle=$('#subtitle').val();
	var article_image=$('#article_image').val();
	var content=UE.getEditor('editor').getContent();
	var datas = {id:id,title:title,subtitle:subtitle,article_image:article_image,content:content}


	$.ajax({
		url: "Admin/Article/save",
		type: "post",
		data: datas,
		success: function(data) {
			if(d != undefined)
				d.close().remove();
			var ret = $.parseJSON(data);
			if(ret.status) {
				var v = $.parseJSON(ret.v);
				if(v == 1) {
					window.parent.refreshTable();
					showDialogModalConfirm(
						'success',
						'保存成功！',
						ret.msg,
						'继续添加',
						'返回列表',
						function(){
							$("form")[0].reset();
						},
						function(){
							hideDialogModal();
						});
				} else {
					window.parent.topMessagePrompt('success',ret.msg);
					window.parent.refreshTable();
					hideDialogModal();
				}

			} else {
				window.parent.topMessagePrompt('error',ret.msg);
			}
		}
	});
}