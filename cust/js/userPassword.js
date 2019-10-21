var d;
var demo;
 
$(function() {
	//开启验证
	demo = $("#editForm").Validform({
		tiptype: 3
	});
	addDialogButton("保存",save);
});

var save = function() { 
	if(!demo.check()) {
		$('.Validform_error:first').focus();
		return;
	}
	
	if($("#newPwd").val()!=$("#newPwd2").val()){
		swal("修改失败!", '两次密码输入不一致', "error");
		return;
	}
	
	d = dialog({
		title: '',
		content: "数据保存中,请稍后...",
	});
	d.showModal();

	var datas = getFormJson();

	$.ajax({
		url: "Admin/Login/savePassword",
		type: "post",
		data: datas,
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