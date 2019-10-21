var d;
var demo;

$(function() {
	//开启验证
	demo = $("#editForm").Validform({
		tiptype: 3
	});
	addDialogButton("保存",save);

	//checkbox select效果
	$('input[name="module[]"]').change(function(){
		if($(this).attr('data-is-sub')==1)
		{
			if($(this).is(':checked')){
				$('.module-'+$(this).attr('data-pid')).prop('checked','checked');
			}
		}
		else{
			if(!$(this).is(':checked')){
				$(this).parent().next().find('input[type="checkbox"]').prop('checked',false);
			}
			else{
				$(this).parent().next().find('input[type="checkbox"]').prop('checked',true);
			}
		}
	});



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

	var datas = getFormJson();

	$.ajax({
		url: "Admin/Role/saveRoleModule",
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