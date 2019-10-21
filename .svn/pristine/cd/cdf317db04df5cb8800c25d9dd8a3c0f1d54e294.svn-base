$(function() {
	//初始化datatable
	$("#table").XRDataTable({
		ajaxUrl: "Admin/User/getDatas",
		paramFunc: paramFunc,
		operation: {
			"icon-lock": [initPassword, "初始化密码"],
			"icon-refresh": [changeStatus, "启用/冻结"]
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
		msg = "是否确认冻结【" + trData.usercode + "】?";
	} else {
		msg = "是否确认启用【" + trData.usercode + "】?";
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
				url: "Admin/User/changeStatus/"+trData.id+"/"+trData.status,
				async: true,
				success: function(data) {
					var ret = $.parseJSON(data);
					if(ret.status) {
						$.message({
	                        message:ret.msg,
	                        type:'success',
	                        onClose:function(){
	                        	window.parent.refreshTable();
	                        }
	                    });
					} else {
						$.message({
		                    message:ret.msg,
		                    type:'error'
		                });
					}
				}
			});
		}
	});
};

var initPassword = function(idx, trData) {
	var msg = "是否确认初始化【" + trData.usercode + "】的登录密码?";
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
				url: "Admin/User/initPassword/"+trData.id,
				async: true,
				success: function(data) {
					var ret = $.parseJSON(data);
					if(ret.status) {
						$.message({
	                        message:ret.msg,
	                        type:'success',
	                        onClose:function(){
	                        	window.parent.refreshTable();
	                        }
	                    });
					} else {
						$.message({
		                    message:ret.msg,
		                    type:'error'
		                });
					}
				}
			});
		}
	});
};
