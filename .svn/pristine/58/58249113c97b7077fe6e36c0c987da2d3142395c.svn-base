var isDataing = false;
var sessionPageCond;
$(function() {
	//数据初始化
	selectEvent();
	//滚动条刷新
	$(window).scroll(function() {
		if(isDataing) {
			return;
		}
		var scrollTop = $(this).scrollTop();　　
		var scrollHeight = $(document).height();　　
		var windowHeight = $(this).height();　
		if(scrollTop + windowHeight == scrollHeight) {　
			if($(".endRow span").css("display") != "none") {
				return;
			}
			getDatas();
		}
	});

	//如果存在session记录
	if(sessionStorage.pageCond) {
		//获取session值
		sessionPageCond = JSON.parse(sessionStorage.pageCond);
		//绑定排序值
		$(".poritem").removeClass("active");
		$(".poritem[data-val='" + sessionPageCond.porder + "']").addClass("active");
		//获取条件初始值
		$("#brand").val(sessionPageCond.brand);
		$("#brand").change();
		$("#btype").val(sessionPageCond.btype);
		$("#btype").change();
		$("#series").val(sessionPageCond.series);
		$("#series").val(sessionPageCond.series);
		$("#price").val(sessionPageCond.price);
		$("#year").val(sessionPageCond.year);
		checkConditionNum();
		//查询数据
		getDatas(true);
		//绑定初始页码
		$(".workshow").data("pageno", sessionPageCond.pageno);
		//回到当初位置
		$(window).scrollTop(sessionPageCond.srcolltop);
	} else {
		getDatas();
	}

});

//隐藏筛选框
var hideConditionDiv = function() {
	$(".conditionDiv .condition").animate({ marginRight: "-80%" }, 500);
	$(".conditionDiv").fadeOut();
}

//重新搜索
var refreashSearch = function() {
	isDataing = true;
	$(".workshow").empty();
	$(".workshow").data("pageno", 0);
	getDatas();
}

var getDatas = function(isInit) {
	if(isInit == undefined) {
		isInit = false;
	}
	$(".endRow span").hide();
	$(".loadingRow span").show();
	generDataWorkspace(isInit);
}

var generDataWorkspace = function(isInit) {
	var ajaxAsync = true;
	var data = getFormJson();
	data = blankObj(data);
	data.porder = $(".porder .active").data("val");
	if(isInit) {
		data.pageNo = 1;
		data.pageSize = sessionPageCond.count;
		ajaxAsync = false;
	} else {
		data.pageNo = Number($(".workshow").data("pageno") == undefined ? "0" : $(".workshow").data("pageno")) + 1;
		data.pageSize = 7;
	}
	$.ajax({
		type: "post",
		url: "car/getDatas",
		data: data,
		async: ajaxAsync,
		success: function(data) {
			var JSON_data = $.parseJSON(data);
			var ret = JSON_data.ret;
			$(".loadingRow span").hide();
			if(ret.length <= 0) {
				$(".workshow").data("pageno", JSON_data.pageNo - 1);
				$(".endRow span").show();
			} else {
				$(".workshow").data("pageno", JSON_data.pageNo);
				for(var i = 0; i < ret.length; i++) {
					$(".workshow").append($(".demo").html());
					$(".workshow .detailitem:last img").attr("src", ret[i]['headpic']);
					$(".workshow .detailitem:last .carname").html(ret[i]['name']);
					$(".workshow .detailitem:last .price span").html(ret[i]['shop_price']);
					$(".workshow .detailitem:last .carintroduce span").html(ret[i]['introduction']);
					$(".workshow .detailitem:last .kilometer span.kilo").html(ret[i]['mileage']);
					$(".workshow .detailitem:last .kilometer span.plateyear").html(new Date(ret[i]['plate_date']).Format("yyyy"));
					$(".workshow .detailitem:last").fadeIn(1000);
					clickEvent($(".workshow .detailitem:last"), ret[i]['id']);
				}
			}
			//关闭搜索
			isDataing = false;
		}
	});
}

var clickEvent = function(obj, id) {
	obj.click(function() {
		var cusPageCond = getFormJson();;
		cusPageCond.porder = $(".poritem.active").data("val");
		cusPageCond.pageno = Number($(".workshow").data("pageno"));
		cusPageCond.count = $(".workshow .carname").size();
		cusPageCond.srcolltop = $(window).scrollTop();
		sessionStorage.pageCond = JSON.stringify(cusPageCond);
		if($("#pageType").val() == 2){
			location.href = "car/edit/"+id;
		}else{
			location.href = "car/view/"+id;
		}
	});
}

var selectEvent = function() {
	$("#brand").bindCarBrand();
	$("#btype").bindCarBType($("#brand option:selected").data("v"));
	$("#series").bindCarSeries($("#btype option:selected").data("v"));
	$("#brand").change(function() {
		$("#btype").bindCarBType($("#brand option:selected").data("v"));
	});
	$("#btype").change(function() {
		$("#series").bindCarSeries($("#btype option:selected").data("v"));
	});
	var priceParams = {};
	priceParams.ajaxUrl = "Comm/DDLCon/getCateList/ser_price";
	priceParams.valueStr = "value";
	priceParams.captionStr = "name";
	priceParams.isNeedAll = true;
	$("#price").bindSelect(priceParams);
	$("#year").bindYear();

	//click事件

	//条件搜索
	$(".srBtn").click(function() {
		refreashSearch();
		checkConditionNum();
		hideConditionDiv();
	});
	//重置搜索
	$(".retBtn").click(function() {
		$("form")[0].reset();
		refreashSearch();
		$(".conditionBtn span").css("visibility", "hidden");
		hideConditionDiv();
	});
	//排序搜索
	$(".porder div.poritem").click(function() {
		if($(this).hasClass("active")) {
			return;
		}
		$(".porder div").removeClass("active");
		$(this).addClass("active");
		refreashSearch();
	});

	//显示搜索条件
	$(".porder .conditionBtn").click(function() {
		$(".conditionDiv").fadeIn();
		$(".conditionDiv .condition").animate({ marginRight: "0px" }, 500);
	});

	//隐藏搜索条件
	$(".conditionDiv .blank").click(function(event) {
		hideConditionDiv();
	});

}

var checkConditionNum = function() {
	var conditionRet = blankObj(getFormJson());
	var conditionNum = getJsonObjLength(conditionRet) - 1;
	if(conditionNum == 0) {
		$(".conditionBtn span").css("visibility", "hidden");
	} else {
		$(".conditionBtn span").css("visibility", "visible");
		$(".conditionBtn span").html(conditionNum);
	}
}