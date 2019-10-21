//子页面来控制父页面
$(function() {
	//將子頁面的modal——title設爲子頁面標題
	$(window.parent.document).find("#myModalLabel").html($("#modal_title").val());
	//將子頁面的高度传递给父元素
	if($("#modal_height").val() != undefined){
		$(window.parent.document).find("#modalFrame").attr("height",$("#modal_height").val()+"px");
	}
});