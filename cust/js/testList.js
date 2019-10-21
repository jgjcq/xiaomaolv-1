$(function() {
	//初始化datatable
	$("#table").XRDataTable({
		ajaxUrl: "Admin/Admin/getDatas",
		paramFunc: paramFunc,
		operation: {
			"edit": ["Admin/Admin/edit/#id"],
			"icon-lock": [initPassword, "初始化密码"],
			"icon-refresh": [changeStatus, "启用/冻结"],
		},
		hasCheckbox: false
	});

	// exportEvent();
});

var paramFunc = function() {
	var data = getFormJson();
	return data;
};

var changeStatus = function(idx, trData) {
	var msg = "";
	if(trData.status == 1) {
		msg = "是否确认冻结【" + trData.username + "】?";
	} else {
		msg = "是否确认启用【" + trData.username + "】?";
	}
	swal({
		title: "请确认",
		text: msg,
		type: "warning",
		showCancelButton: true,
		closeOnConfirm: false,
		confirmButtonText: "确定",
		cancelButtonText: '取消',
		confirmButtonColor: "#ec6c62"
	}, function(isConfirm) {
		if(isConfirm) {
			$.ajax({
				type: "post",
				url: "Admin/Admin/changeStatus/"+trData.id+"/"+trData.status,
				async: true,
				success: function(data) {
					var ret = $.parseJSON(data);
					if(ret.status) {
						swal({
							title: "操作成功!",
							text: ret.msg,
							type: "success"
						}, function() {
							window.parent.refreshTable();
						});
					} else {
						swal("操作失败!", ret.msg, "error");
					}
				}
			});
		}
	});
};

var initPassword = function(idx, trData) {
	var msg = "是否确认初始化【" + trData.username + "】的登录密码?";
	swal({
		title: "请确认",
		text: msg,
		type: "warning",
		showCancelButton: true,
		closeOnConfirm: false,
		confirmButtonText: "确定",
		cancelButtonText: '取消',
		confirmButtonColor: "#ec6c62"
	}, function(isConfirm) {
		if(isConfirm) {
			$.ajax({
				type: "post",
				url: "Admin/Admin/initPassword/"+trData.id,
				async: true,
				success: function(data) {
					var ret = $.parseJSON(data);
					if(ret.status) {
						swal({
							title: "操作成功!",
							text: ret.msg,
							type: "success"
						}, function() {
							window.parent.refreshTable();
						});
					} else {
						swal("操作失败!", ret.msg, "error");
					}
				}
			});
		}
	});
};

//导出数据
exportEvent = function() {
	$("input").keypress(function(event) {
		if(event.keyCode == "13") {
			$("#table").search();
		}
	})
	$("#export").click(function() {
		var ret = $("#table").getTableThInfo();
		ret.params = usefulArray(paramFunc());
		ret.title = "会员列表";
		locationPost("User/commonExport", {
			'json': JSON.stringify(ret)
		});
	});
};