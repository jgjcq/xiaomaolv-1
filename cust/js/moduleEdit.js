var d;
var demo;
$(function() {
	//开启验证
	demo = $("#editForm").Validform({
		tiptype: 3
	});
	// window.parent.addBtn("saveBtn", "保存", save);
	addDialogButton("保存",save);
	// alert(JSON.stringify(window.parent.diag));


	//点击icon，出现icon选择div
	$('#icon_button').click(function(e){
		$('.icon_click_div').toggle();
		e.stopPropagation();
	});

	//点击图标赋值
	$('.icon_font').click(function(e){
		$('#icon_check').show().attr('class',$(this).attr('data-class'));
		$('input[name="icon"]').val($(this).attr('data-class'));
		$('.icon_click_div').hide();
		e.stopPropagation();
	});
	//层级变动 获取pid列表
	$('#level').change(function(){
		getPidListByLevel($(this).val());
	});
	$(window).click(function(){
		$('.icon_click_div').hide();
	});
	$('.icon_click_div').click(function(e){
		e.stopPropagation();
	});
	// 初始化pid列表数据
	getPidListByLevel($('#level').val());
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
		url: "Admin/Module/save",
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
							getPidListByLevel($('#level').val());
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


//ajax根据层级获取pidselect数据
function getPidListByLevel(level){
	$.ajax({
		url: "DDLController/getPidListByLevel",
		type: "post",
		data: {
			level:level
		},
		dataType:'json',
		success: function(data) {
			if(data.status){
				var t=JSON.parse(data.v);
				if(t.length==0){
					if($('#pid_d').val()==0){
						$('#pid').html('<option value="0" selected="selected">无上级</option>');
					}
					else{
						$('#pid').html('<option value="0">无上级</option>');
					}
				}
				else{
					var html='';
					$.each(t,function(k,v){
						if($('#pid_d').val()==v.id){
							html+='<option value="'+v.id+'" selected="selected">'+v.cname+'</option>';
						}
						else{
							html+='<option value="'+v.id+'">'+v.cname+'</option>';
						}
					});
					$('#pid').html(html);
				}
			}
			else{
				window.parent.topMessagePrompt('error',data.msg);
			}
		}
	});
}