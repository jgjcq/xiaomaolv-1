var d;
$(function() {
	$("img").click(function() {
		$(this).next().click();
	});

	$("input[type='file']").change(function() {
		var img = $(this).prev();
		var ret = toBase64(this, function(data) {
			img.attr("src", data);
		});
		if(!ret){
			$(this).val("");
		}
	});

	//外链input
	$("input[name='cust_url']").focus(function(){
		if($(this).val()=='')
		{
			$(this).val('http://');
		}
	})
	$("input[name='cust_url']").blur(function(){
		if($(this).val()=='http://')
		{
			$(this).val('');
		}
	})
	
	$(".row>div>i").click(function(){
		$(this).parent().children("img").attr("src","cust/images/upload.png");
		$(this).parent().children("input").val("");
	});
 
	$("#saveBtn").click(function() {
		var images = "";
		var sorts = "";
		var cust_url = "";
		d = dialog({
			title: '',
			content: "数据保存中,请稍后...",
		});
		d.showModal();
		
		$("img.bannerImg").each(function() {
			if($(this).attr("src") == "cust/images/upload.png") {
				return true;
			}
			images += $(this).attr("src") +"-";
			sorts += $(this).next().next().val() +"-";
			cust_url += $(this).next().next().next().val() +"-";
		});
		// alert(subtitle);
		images = images.substring(0,images.length-1);

		sorts = sorts.substring(0,sorts.length-1);

		cust_url = cust_url.substring(0,cust_url.length-1);
		// alert(subtitle);
		var datas = {};
		datas.images = images;

		datas.sorts = sorts;
		datas.cust_url = cust_url;
		$.ajax({
			url: "Admin/AppContent/save",
			type: "post",
			data: datas,
			success: function(data) {
				var ret = JSON.parse(data);
				if(d != undefined)
					d.close().remove();
				if(ret.status) {
					window.parent.topMessagePrompt('success',ret.msg);
				} else {
					window.parent.topMessagePrompt('error',ret.msg);
				}
			}
		});
	});
});