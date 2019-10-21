//获取所有汽车品牌
$.fn.bindCarBrand = function() {
	var dom = $(this);
	$.ajax({
		url: "Comm/DDLCon/getCarBrands",
		type: "post",
		data: {},
		async: false,
		success: function(data_s) {
			var ret = $.parseJSON(data_s);
			var options = "";
			options += "<option value=''>请选择品牌</option>";
			if(ret.result) {
				var brandsCol = ret.result.branditems;
				for(var i = 0; i < brandsCol.length; i++) {
					options += "<option data-v='" + brandsCol[i]["id"] + "' value='" + brandsCol[i]["name"] + "' ";
					if(dom.data("val") == brandsCol[i]["name"]) {
						options += " selected ";
					}
					options += ">";
					options += brandsCol[i]["bfirstletter"] + " | " + brandsCol[i]["name"];
					options += "</option>";
				}
			}
			dom.empty();
			dom.append(options);
		}
	});
};

//绑定车辆型号
$.fn.bindCarBType = function(brand) {
	var dom = $(this);
	$.ajax({
		url: "Comm/DDLCon/getCarBType/" + brand,
		type: "post",
		data: {},
		async: false,
		success: function(data_s) {
			var ret = $.parseJSON(data_s);
			var options = "";
			options += "<option value=''>请选择车系</options>";
			if(ret.result) {
				var factoryitems = ret.result.factoryitems;
				for(var i = 0; i < factoryitems.length; i++) {
					var seriesitems = factoryitems[i].seriesitems;
					for(var j = 0; j < seriesitems.length; j++) {
						options += "<option data-v='" + seriesitems[j]["id"] + "' value='" + seriesitems[j]["name"] + "' ";
						if(dom.data("val") == seriesitems[j]["name"]) {
							options += " selected ";
						}
						options += ">";
						options += factoryitems[i]["name"] + " | " + seriesitems[j]["name"];
						options += "</option>";
					}
				}
			}
			dom.empty();
			dom.append(options);
		}
	});
};

//绑定车辆系列
$.fn.bindCarSeries = function(btype) {
	var dom = $(this);
	$.ajax({
		url: "Comm/DDLCon/getCarsSeries/" + btype,
		type: "post",
		data: {},
		async: true,
		success: function(data_s) {
			var ret = $.parseJSON(data_s);
			var options = "";
			options += "<option value=''>请选择车型</options>";
			if(ret.List) {
				var items = ret.List;
				for(var i = 0; i < items.length; i++) {
					var detailItems = items[i].List;
					for(var j = 0; j < detailItems.length; j++) {
						var　 appendStr = "";
						if(items[i].N == "停售车型") {
							appendStr = "【停售】";
						}
						options += "<option value='" + detailItems[j]["N"] + "'";
						if(dom.data("val") == (detailItems[j]["N"])) {
							options += " selected ";
						}
						options += ">";
						options += detailItems[j]["N"] + appendStr;
						options += "</option>";
					}
				}
			}
			dom.empty();
			dom.append(options);
		}
	});
};

//获取年份
$.fn.bindYear = function() {
	var dom = $(this);
	var now = new Date();
	var n_year = now.getYear();
	var options = "";
	options += "<option value=''>请选择年份</option>";
	for(var i = 0; i < 5; i++) {
		options += "<option value='" + (n_year - i + 1900) + "'>";
		options += (n_year - i + 1900) + "年";
		options += "</option>";
	}
	options += "<option value='-" + (n_year - 4 + 1900) + "'>" + (n_year - 4 + 1900) + "年之前</option>";
	dom.empty();
	dom.append(options);
};