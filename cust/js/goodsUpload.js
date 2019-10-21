function doImage(obj){
		var img = $(obj).prev();
		var ret = toBase64(obj, function(data) {
			img.attr("src", data);
			$(obj).prev().prev().val(data);
		});
		if(!ret){
			$(obj).val("");
		}
}
