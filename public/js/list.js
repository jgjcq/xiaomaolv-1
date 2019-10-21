$(function() {
	//显示隐藏条件
	$("#shiftCondition").click(function() {
		if($(this).data("isShow") == undefined || $(this).data("isShow") == -1) {
			$(this).data("isShow", 1);
			$("#searchForm").slideDown(800);
			$("#searchForm").next().children(".srBtn").slideDown(800);
			$(this).html("隐藏条件");
		} else {
			$(this).data("isShow", -1);
			$("#searchForm").slideUp(800);
			$("#searchForm").next().children(".srBtn").slideUp(800);
			$(this).html("显示条件");
		}
	});
	// $('.nav-list').height($(window).height()-170).css('overflow-y','scroll').css('overflow-x','hidden');
	// $('.page-content').height($(window).height()-170).css('overflow-y','scroll').css('overflow-x','hidden');
	// $('.pageRow').css('position','fixed').css('bottom','0px');
	// 
	$('.searchFormTitleIcon').click(function(){
		$('.searchForm-main').slideToggle();
		if(!$(this).attr('data-hidden')){
			$(this).removeClass('icon-double-angle-up');
			$(this).addClass('icon-double-angle-down');
			$(this).attr('data-hidden',1);
			// $('.searchForm-title').css('border-radius','6px');
		}
		else{
			$(this).removeAttr('data-hidden');
			$(this).removeClass('icon-double-angle-down');
			$(this).addClass('icon-double-angle-up');
			// $('.searchForm-title').css('border-radius','6px 6px 0px 0px');
		}
	});
});