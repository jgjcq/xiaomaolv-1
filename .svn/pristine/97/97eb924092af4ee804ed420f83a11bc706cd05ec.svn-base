$(function() {
	//初始化datatable
	$("#table").XRDataTable({
		ajaxUrl: "Admin/Role/getDatas",
		paramFunc: paramFunc,
		operation: {
			"icon-group": ["Admin/Role/roleModule/#id","设置角色权限",false,300,350],
			"edit": ["Admin/Role/edit/#id"],
			"icon-trash": [deleteRole, "删除角色"],
		},
		hasCheckbox: false
		// afterFunc:afterfunc
	});

	// exportEvent();
});

var paramFunc = function() {
	var data = getFormJson();
	return data;
};

// var afterfunc = function(){
// 	$("#table tbody tr").each(function() {
// 		var data = $("#table").getOpts().datas[$(this).index()];

// 		if(data.status != 0){
// 			$(this).children("td:nth-child(1)").find(".icon-ok-sign").hide();
// 			$(this).children("td:nth-child(1)").find(".icon-remove-sign").hide();
// 		}
// 	});
// 	PostbirdImgGlass.init({
//             domSelector:".example2",
//             animation:true
//         });
// }
// 
var deleteRole=function(idx, trData){
	var msg = "是否确认删除角色【" + trData.name + "】?";
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
				url: "Admin/Role/delete/"+trData.id,
				async: true,
				success: function(data) {
					var ret = $.parseJSON(data);
					if(ret.status) {
						window.parent.topMessagePrompt('success',ret.msg);
	                    window.parent.refreshTable();
					} else {
						window.parent.topMessagePrompt('error',ret.msg);
					}
				}
			});
		}
	});
}