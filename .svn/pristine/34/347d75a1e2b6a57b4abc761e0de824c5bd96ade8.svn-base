// /*******************************Modal相關 父页面控制子页面****************************************/
// $(function() {
// 	//每次清空模態框數據
// 	$("#myModal").on("hidden.bs.modal", function() {
// 		$(this).removeData("bs.modal");
// 		if(typeof parModal_refresh === 'function'){
// 			parModal_refresh();
// 		}
// 	});

// 	//初始化
// 	$("#myModal").on("show.bs.modal", function(e) {
// 		$("#myModalLabel").html();
// 		$("#loadSpan").show();
// 		$("#modalFrame").hide();
// 		$("#modalFrame").removeAttr("height");
// 		$("#modalFrame").removeAttr("src");
// 		//footer还原
// 		$(".modal-footer").empty();
// 		$(".modal-footer").append("<button type='button' class='btn btn-default' data-dismiss='modal'>关闭</button>");
// //		$(".modal-footer").append("<button type='button' class='btn btn-primary' id='saveBtn'>保存</button>");

// 		//保存按钮
// 		$("#saveBtn").click(function() {
// 			frames["modalFrame"].window.save();
// 		});

// 		//获取源头
// 		$("#myModal").data("href", $(e.relatedTarget).data("href"));
// 	});

// 	//modal打開完全后操作
// 	$("#myModal").on("shown.bs.modal", function(e) {
// 		$("#modalFrame").attr("src", $(this).data("href"));
// 		$("#modalFrame").one('load',function() {
// 			$("#loadSpan").hide();
// 			$("#modalFrame").show();
// 			//将frame高度确定
// 			//			$("#modalFrame").attr("height", $(window.frames["modalFrame"].document).height());
// 			//固定高度
// 			if($("#modalFrame").attr("height") == undefined){
// 				$("#modalFrame").attr("height", ($(window).height()-250)+"px");
// 			}
// 			//后续操作
// 			if(typeof frames["modalFrame"].window.cusModal_init === 'function') {
// 				frames["modalFrame"].window.cusModal_init();
// 			}
// 		});
// 	});

// });

// //关闭modal
// var hideModal = function() {
// 	$("#myModal").modal("hide");
// }

// //新增按钮
// var addBtn = function(id, name, dofunc) {
// 	$(".modal-footer").append("<button type='button' class='btn btn-primary cusBtn' id='" + id + "'>" + name + "</button>");
// 	$("#" + id).click(function() {
// 		dofunc();
// 	});
// }

// //具体业务：更新表格
// var refreshTable = function() {
// 	$("#table").search();
// }