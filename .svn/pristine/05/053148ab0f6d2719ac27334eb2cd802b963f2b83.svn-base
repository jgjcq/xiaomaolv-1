var d;
var demo;

$(function() {
	ue.addListener("ready", function () { 
	UE.getEditor('editor').setContent($('#content').val());
	});

	ue1.addListener("ready", function () {
		UE.getEditor('editorRemark').setContent($('#content').val());
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
	var tags=$('#tags').val();
	var article_image=$('#article_image').val();
	var article_image_big=$('#article_image_big').val();
	var content=UE.getEditor('editor').getContent();
	var price = $('#price').val();
	var old_price = $('#old_price').val();
	var p_price = $('#p_price').val();
	var max_coupon = $('#max_coupon').val();
	var fx_price = $('#fx_price').val();
	var type = $('#type').val();
	var file_ids = $("input[name='file_ids[]']").map(function(){return this.value;}).get().join(",");
	var file_titles = $("input[name='file_title[]']").map(function(){return this.value;}).get().join(",");
	var course_type = $('#course_type').val();
	var remark =UE.getEditor('editorRemark').getContent();
	var zs_video_big = $('#zs_video_big').val();

	var datas = {id:id,title:title,article_image:article_image,content:content,
		price:price,old_price:old_price,p_price:p_price,type:type,file_ids:file_ids,file_titles:file_titles,
		course_type:course_type,remark:remark,tags:tags,max_coupon:max_coupon,fx_price:fx_price,article_image_big:article_image_big,zs_video_big:zs_video_big}


	$.ajax({
		url: "Admin/Course/save",
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