$(function() {
	//初始化datatable

	$("#table").XRDataTable({
		ajaxUrl: "Admin/Salesman/getDatas",
		paramFunc: paramFunc,
		operation: {
			"edit": ["Admin/Salesman/edit/#id","查看/修改"],
			"icon-refresh": [changeStatus, "审核/反审核"],
			"icon-group":[createNewTab,"查看下级"]
		},
		hasCheckbox: false 
	});

	// exportEvent(); 
}); 
var createNewTab = function (idx,trData) {
	creatIframe("Admin/Salesman/children/"+trData.id,trData.nickname+"的下级驴妈妈");
};
/*创建iframe*/
function creatIframe(href,titleName){
	var topWindow=$(window.parent.document),
		show_nav=topWindow.find('#min_title_list'),
		iframe_box=topWindow.find('#iframe_box'),
		iframeBox=iframe_box.find('.show_iframe'),
		$tabNav = topWindow.find(".acrossTab"),
		$tabNavWp = topWindow.find(".Hui-tabNav-wp"),
		$tabNavmore =topWindow.find(".Hui-tabNav-more");
	var taballwidth=0;

	show_nav.find('li').removeClass("active");
	show_nav.append('<li class="active"><span data-href="'+href+'">'+titleName+'</span><i></i><em></em></li>');
	if('function'==typeof $('#min_title_list li').contextMenu){
		$("#min_title_list li").contextMenu('Huiadminmenu', {
			bindings: {
				'closethis': function(t) {
					var $t = $(t);
					if($t.find("i")){
						$t.find("i").trigger("click");
					}
				},
				'closeall': function(t) {
					$("#min_title_list li i").trigger("click");
				},
			}
		});
	}else {

	}
	var $tabNavitem = topWindow.find(".acrossTab li");
	if (!$tabNav[0]){return}
	$tabNavitem.each(function(index, element) {
		taballwidth+=Number(parseFloat($(this).width()+60))
	});
	$tabNav.width(taballwidth+25);
	var w = $tabNavWp.width();
	if(taballwidth+25>w){
		$tabNavmore.show()}
	else{
		$tabNavmore.hide();
		$tabNav.css({left:0})
	}
	iframeBox.hide();
	iframe_box.append('<div class="show_iframe"><div class="loading"></div><iframe frameborder="0" src='+href+'></iframe></div>');
	var showBox=iframe_box.find('.show_iframe:visible');
	showBox.find('iframe').load(function(){
		showBox.find('.loading').hide();
	});
}
var paramFunc = function() { 
	var data = getFormJson();
	return data; 
};
var changeStatus = function(idx, trData) {
	var msg = "是否确认反审核";
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
				url: "Admin/Salesman/changeStatus/"+trData.id+"/"+trData.is_check,
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