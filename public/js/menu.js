$(function() {
	var sidebar = $("#_sidebarNo").val();
	var bars = sidebar.toString().split('-');
	var selector = ".sidebar";
	$(selector).addClass("active");
	for(var i = 0; i < bars.length; i++) {
		if(i == 0) {
			selector += ">ul>li." + bars[i] + "Menu";
			$(selector).addClass("active");
		} else {
			$(selector).addClass("open");
			$(selector).show();
			selector += ">ul>li." + bars[i] + "Menu";
			$(selector).addClass("active");
		}
		//增加面包屑
		var bar_Name = $(".sidebar li." + bars[i] + "Menu span").html();
		var li = $("<li></li>");
		li.html(bar_Name);
		if(i == bars.length - 1) {
			li.addClass("active");
		}
		$("ul.breadcrumb").append(li);
	}

	$(".sidebar ul li").click(function(e) {
		if(!$(this).data("href")) {
			return;
		}
		window.location.href = $(this).data("href");
	});

});