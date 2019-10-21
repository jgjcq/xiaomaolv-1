$(function() {
	//初始化datatable
	$("#table").XRDataTable({
		ajaxUrl: "Admin/Article/getDatas",
		paramFunc: paramFunc,
		operation: {
			"edit": ["Admin/Article/edit/#id","查看/修改文章"],
			"icon-refresh": [changeStatus, "发布/隐藏"]
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
		msg = "是否确认影藏【" + trData.title + "】?";
	} else {
		msg = "是否确认发布【" + trData.title + "】?";
	}
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
				url: "Admin/Article/changeStatus/"+trData.id+"/"+trData.status,
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
};


// //导出数据
// exportEvent = function() {
// 	$("input").keypress(function(event) {
// 		if(event.keyCode == "13") {
// 			$("#table").search();
// 		}
// 	})
// 	$("#export").click(function() {
// 		var ret = $("#table").getTableThInfo();
// 		ret.params = usefulArray(paramFunc());
// 		ret.title = "会员列表";
// 		locationPost("User/commonExport", {
// 			'json': JSON.stringify(ret)
// 		});
// 	});
// };