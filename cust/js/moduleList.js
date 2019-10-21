$(function() {
	//初始化datatable
	$("#table").XRDataTable({
		ajaxUrl: "Admin/Module/getDatas",
		paramFunc: paramFunc,
		operation: {
			"icon-plus-sign-alt": [function(index, trData,element) {
				// alert(index);
				if (element.parents("tr").next("tr").hasClass("XRappend" + index)) {
					$("#table tbody tr.XRappend" + index).each(function() {
						$(this).remove();
						$('.PIDappend'+index).remove();
					})
					element.parents("tr").find('.icon-plus-sign-alt').removeClass('icon-spin').removeClass('icon-large');
					return;
				}
				element.parents("tr").find('.icon-plus-sign-alt').addClass('icon-spin').addClass('icon-large');
				for (var i = 0; i < trData.sub.length; i++) {
					var insertRow = $("<tr class='XRappend" + index + "' style='background-color:#ccc;'></tr>");
					var url=getRootPath()+'/Admin/Module/edit/'+trData.sub[i].id;
					// var data_str=JSON.stringify(trData.sub[i].sub);
					var rowData=trData.sub[i].sub;
					insertRow.append("<td>" +"</td>");
					if(rowData.length>0){
						insertRow.append('<td><div><a title="" onclick="showLevel3('+JSON.stringify(rowData).replace(/\"/g,"'")+',this,'+index+')" data-id="'+trData.sub[i].id+'" class="icon-plus-sign-alt" href="javascript:void(0);" data-original-title="下级模块"></a><a class="ace-icon fa fa-edit" title="" onclick="showDialogModal(&quot;'+url+'&quot;)" data-original-title="编辑"></a><a title="" class="icon-trash" href="javascript:void(0);" data-original-title="删除角色" onclick="deleteModule2(&apos;'+trData.sub[i].id+'&apos;,&apos;'+trData.sub[i].cname+'&apos;);"></a><a title="" class="icon-refresh" href="javascript:void(0);" data-original-title="显示/隐藏" onclick="changeStatus2(&apos;'+trData.sub[i].id+'&apos;,&apos;'+trData.sub[i].is_show+'&apos;,&apos;'+trData.sub[i].cname+'&apos;);"></a></div></td>');
					}
					else{
						insertRow.append('<td><div><a class="ace-icon fa fa-edit" title="" onclick="showDialogModal(&quot;'+url+'&quot;)" data-original-title="编辑"></a><a title="" class="icon-trash" href="javascript:void(0);" data-original-title="删除角色" onclick="deleteModule2(&apos;'+trData.sub[i].id+'&apos;,&apos;'+trData.sub[i].cname+'&apos;);"></a><a title="" class="icon-refresh" href="javascript:void(0);" data-original-title="显示/隐藏" onclick="changeStatus2(&apos;'+trData.sub[i].id+'&apos;,&apos;'+trData.sub[i].is_show+'&apos;,&apos;'+trData.sub[i].cname+'&apos;);"></a></div></td>');
					}
					
					insertRow.append("<td>" + trData.sub[i].cname + "</td>");
					insertRow.append("<td>" + trData.sub[i].ename + "</td>");
					insertRow.append("<td>" + trData.sub[i].iconChar + "</td>");
					insertRow.append("<td>" + trData.sub[i].levelChar + "</td>");
					insertRow.append("<td>" + trData.sub[i].showChar + "</td>");
					insertRow.append("<td>" + trData.sub[i].order + "</td>");
					insertRow.append("<td>" + trData.sub[i].createdChar + "</td>");
					insertRow.append("<td>" + trData.sub[i].updatedChar + "</td>");
					element.parents("tr").after(insertRow);
					// $('.XRappend'+index+':first').delegate("click",'.icon-plus-sign-alt',showLevel3(trData.sub[i].sub,this));
				}
			}, "下级模块"],
			"edit": ["Admin/Module/edit/#id"],
			"icon-trash": [deleteModule, "删除模块"],
			"icon-refresh": [changeStatus, "显示/隐藏"]
			
		},
		hasCheckbox: false,
		afterFunc:afterFunc
	});

	// exportEvent();
});

var afterFunc = function(){
 $("#table tbody tr").each(function() {
     var data = $("#table").getOpts().datas[$(this).index()];
     // alert(data.sub.length);
     if(data.sub.length == 0){
        $(this).children("td:nth-child(2)").find(".icon-plus-sign-alt").hide();
     }
 });
}

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
var deleteModule=function(idx, trData){
	var msg = "是否确认删除模块【" + trData.cname + "】?";
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
				url: "Admin/Module/delete/"+trData.id,
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
   function deleteModule2(id,cname){
	var msg = "是否确认删除模块【" + cname + "】?";
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
				url: "Admin/Module/delete/"+id,
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

var changeStatus = function(idx, trData) {
	var msg = "";
	if(trData.is_show == 1) {
		msg = "是否确认隐藏模块【" + trData.cname + "】?";
	} else {
		msg = "是否确认显示模块【" + trData.cname + "】?";
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
				url: "Admin/Module/changeStatus/"+trData.id+"/"+trData.is_show,
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

   function changeStatus2(id,is_show,cname) {
	var msg = "";
	if(is_show == 1) {
		msg = "是否确认隐藏模块【" + cname + "】?";
	} else {
		msg = "是否确认显示模块【" + cname + "】?";
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
				url: "Admin/Module/changeStatus/"+id+"/"+is_show,
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


//打开第三级
function showLevel3(data,obj,index){
	// alert(JSON.stringify(data));
	// return;
	// var data=JSON.parse(data);
	var pid=$(obj).attr('data-id');
	if($(obj).attr('data-show')){
		$('.PIDappend'+pid).remove();
		$(obj).removeAttr('data-show');
		$(obj).parents("tr").find('.icon-plus-sign-alt').removeClass('icon-spin').removeClass('icon-large');
	}
	else{
		if(data.length>0){
			$(obj).parents("tr").find('.icon-plus-sign-alt').addClass('icon-spin').addClass('icon-large');
			$(obj).attr('data-show',1);
			// console.log(JSON.stringify(data));
			$.each(data,function(k,v){
				var insertRow = $("<tr class='PIDappend"+index+" PIDappend" + pid + "' style='background-color:#aaa;'></tr>");
				var url=getRootPath()+'/Admin/Module/edit/'+v.id;
				insertRow.append("<td>" +"</td>");
				insertRow.append('<td><div><a class="ace-icon fa fa-edit" title="" onclick="showDialogModal(&quot;'+url+'&quot;)" data-original-title="编辑"></a><a title="" class="icon-trash" href="javascript:void(0);" data-original-title="删除角色" onclick="deleteModule2(&apos;'+v.id+'&apos;,&apos;'+v.cname+'&apos;);"></a><a title="" class="icon-refresh" href="javascript:void(0);" data-original-title="显示/隐藏" onclick="changeStatus2(&apos;'+v.id+'&apos;,&apos;'+v.is_show+'&apos;,&apos;'+v.cname+'&apos;);"></a></div></td>');
				insertRow.append("<td>" + v.cname + "</td>");
				insertRow.append("<td>" + v.ename + "</td>");
				insertRow.append("<td>" + v.iconChar + "</td>");
				insertRow.append("<td>" + v.levelChar + "</td>");
				insertRow.append("<td>" + v.showChar + "</td>");
				insertRow.append("<td>" + v.order + "</td>");
				insertRow.append("<td>" + v.createdChar + "</td>");
				insertRow.append("<td>" + v.updatedChar + "</td>");
				$(obj).parents("tr").after(insertRow);
			})
		}
	}
}