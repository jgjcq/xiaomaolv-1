var d;
var demo;

$(function() {

	
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
	var remark = $('#remark').val();
	var zk = $('#zk').val();
	var zk_type = $('#zk_type').val();
	var type = $('#type').val();
	var start_time = $('#start_time').val();
	var end_time = $('#end_time').val();
	var datas = {id:id,title:title,remark:remark,zk:zk,zk_type:zk_type,type:type,end_time:end_time,start_time:start_time}


	$.ajax({
		url: "Admin/Coupon/save",
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

function courseDetailDel(id,obj) {
	var	msg = "是否确认删除?";
	swal({
		title: "请确认",
		text: msg,
		type: "warning",
		showCancelButton: true,
		closeOnConfirm: true,
		confirmButtonText: "确定",
		cancelButtonText: '取消',
		confirmButtonColor: "#ec6c62"
	}, function(isConfirm) {
		if(isConfirm) {
			$.ajax({
				type: "post",
				url: "Admin/Course/del/"+id,
				async: true,
				success: function(data) {
					var ret = $.parseJSON(data);
					if(ret.status) {
						$(obj).parent().remove();
						swal("删除成功");
					}else{
						swal("删除失败");
					}
				}
			});
		}
	});
}