$(function() {
	//初始化datatable
	$("#table").XRDataTable({
		ajaxUrl: "Admin/Course/getDatas",
		paramFunc: paramFunc,
		operation: {
			"edit": ["Admin/Course/edit/#id","查看/修改课程"],
			"icon-refresh": [changeStatus, "发布/隐藏"],
			"icon-thumbs-up":[setHot,"设为精品"],
			"icon-gift":[setJt,"设为精挑细选"]
		},
		hasCheckbox: false 
	});

	// exportEvent(); 
}); 

var paramFunc = function() { 
	var data = getFormJson();
	return data; 
};
var setHot = function (idx,trData) {
	var msg = "是否设为精品课程";
	if(trData.ishot == 1){
		msg = "是否取消精品课程";
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
				url: "Admin/Course/setHot/"+trData.id+"/"+trData.ishot,
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

var setJt = function (idx,trData) {
	var msg = "是否设为精挑细选";
	if(trData.ishot == 1){
		msg = "是否取消精挑细选";
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
				url: "Admin/Course/setJt/"+trData.id+"/"+trData.isjt,
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

var changeStatus = function(idx, trData) {
	var msg = "";
	if(trData.status == 1) {
		msg = "是否确认隐藏【" + trData.title + "】?";
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
				url: "Admin/Course/changeStatus/"+trData.id+"/"+trData.status,
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