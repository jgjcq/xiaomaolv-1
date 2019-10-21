//初始化DataTable
// (function($) {
	$.fn.XRDataTable = function(options) {
		//当前第几页模块
		var pageNoModel;
		//总共多少页模块
		var totalPageModel;
		//页码按钮模块
		var pageButtonsModel;
		//当前元素
		var cur_dom = $(this);
		//配置对象
		var defaults = {
			//是否使用checkbox
			hasCheckbox: true,
			//当前页
			pageNo: 1,
			//总页数
			totalPage: 1,
			//总条数
			totalCount: 1,
			//每页条数
			pageSizes: [20, 30, 50],
			pageSize: 20,
			//是否需要滚动条
			isScroll: false,
			//ajax地址
			ajaxUrl: "",
			//操作路径
			operation: {
				//example:
				//				"view":["url#id"],
				//				"del":["function"],
				//				"icon":["function/url","title","是否新页面"]
			},
			//搜索表单方法
			paramFunc: function() {
				// example：
				//		var data = {};
				//		data.name=$("#name").val();
				//			data.isview = $('#isview').is(':checked') ? 1 : 0;
				//			return data;
				return {};
			},
			//加载后页面操作
			afterInitFunc: initFunc,
			afterFunc: function() {},
			//搜索按钮事件提前操作
			preFunc: function(){},
			//当前所有数据
			datas: {}

		}

		var opts = $.extend(defaults, options);

		return this.each(function() {
			generateTableWidth(cur_dom);
			//表格内容填充
			generateTable(cur_dom, opts);

			//搜索重置按钮
			generateSearchAndRetButtons(cur_dom,opts);
			
			//每页几条
			generatePageSizeModel(cur_dom, opts);

			//页码信息
			generatePageInfo(cur_dom);
			//分页按钮
			generatePageButtons(cur_dom);
			

			//对外部开放获取元素方法
			$.fn.getOpts = function() {
				return opts;
			};

			//对外部开放跳页方法
			$.fn.toPage = function(pageNo) {
				opts.pageNo = pageNo;
				toPage(cur_dom, opts);
			}

			//对外开放重新搜索
			$.fn.search = function() {
				$.fn.getOpts().pageNo = 1;
				$.fn.refresh();
			}

			//对外开放，当前页刷新
			$.fn.refresh = function() {
				$.fn.toPage($.fn.getOpts().pageNo);
			}

			//对外开放，获取表格head信息
			$.fn.getTableThInfo = function() {
				return getTableThs(cur_dom);
			}

            //获取选择的项目id
            // $.fn.getCheckIds = function() {
            // 	var ids = [];
            // 	$(".checkOne:checked").each(function() {
            // 		var selectedIndex = $(this).parents("tr").index();
            // 		ids.push($.fn.getOpts().datas[selectedIndex]['id']);
            // 	});
            // 	return ids;
            // }
            //获取选择的项目id
            $.fn.getCheckIds = function() {
                return $.fn.getCheckItems('id');
            }


            //获取选择的项目对象
            $.fn.getCheckItems = function(item) {
                var items = [];
                $(".checkOne:checked").each(function() {
                    var selectedIndex = $(this).parents("tr").index();
                    items.push($.fn.getOpts().datas[selectedIndex][item]);
                });
                return items;
            }

			$.fn.search();

		});
	}

	//设定表格宽度
	var generateTableWidth = function(dom) {
			var tableWidth = 0;
			var WIDTH_ = "width:";
			var isNormal = true;
			dom.find("th").each(function() {
				var s = $(this).attr("style");
				if(s == undefined || s.indexOf(WIDTH_) == -1) {
					isNormal = false;
					return false;
				}
				var s1 = s.substring(s.indexOf(WIDTH_) + WIDTH_.length);
				var s2 = s1.substring(0, s1.indexOf("px;"));
				tableWidth += Number(s2);
			});

			if(isNormal) {
				dom.width(tableWidth + "px");
			}
			//在表格后面生成一个用于存放page信息的div
			dom.after('<div class="row pageRowContent"></div>');
		}
		//制作搜索及充值按钮
	var generateSearchAndRetButtons = function(dom,opts) {


			// var searchButtonDiv = $("<div></div>");
			// searchButtonDiv.addClass("searchButton srBtn");
			// searchButtonDiv.css("display","inline-block");
			var searchButton = $("<button class='searchButton'></button>");
			// searchButton.addClass("btn btn-primary btn-sm")
			searchButton.html('<i class="icon-search searchForm-title-icon"></i>搜索');
			// searchButtonDiv.append(searchButton);
			$("#searchForm").append(searchButton);
//			dom.before(searchButtonDiv);

			//搜索事件
			searchButton.click(function() {
				opts.preFunc();
				$.fn.search();
			});


			// var retButtonDiv = $("<div></div>");
			// retButtonDiv.addClass("resetButton srBtn");
			// retButtonDiv.css("display","inline-block");
			var retButton = $("<button class='resetButton'></button>");
			// retButton.addClass("btn btn-default btn-sm")
			retButton.html('<i class="icon-time" style="font-size:16px; margin-right:7px;"></i>重置');
			// retButtonDiv.append(retButton);
			$("#searchForm").append(retButton);
//			dom.before(retButtonDiv);

			//重置事件
			retButton.click(function() {
				$("#searchForm")[0].reset();
				$.fn.search();
			});
			
			
		}
		//制作pageSize部分
	var generatePageSizeModel = function(dom, opts) {
		var pageSize = $("<div></div>");
		pageSize.addClass("col-xs-3");
		pageSize.addClass("pageSize");
		pageSize.addClass("pageRow");
		pageSize.append("每页 ");
		var selectModel = $("<select></select>");
		for(var i = 0; i < opts.pageSizes.length; i++) {
			if(opts.pageSizes[i] == opts.pageSize) {
				selectModel.append("<option value='" + opts.pageSizes[i] + "' selected>" + opts.pageSizes[i] + "</option>");
			} else
				selectModel.append("<option value='" + opts.pageSizes[i] + "'>" + opts.pageSizes[i] + "</option>");
		}
		pageSize.append(selectModel);
		pageSize.append("条");

		selectModel.change(function() {
			opts.pageSize = $(this).val();
			$.fn.search();
		});

		$('.pageRowContent').append(pageSize);
	}

	//制作第几页及共几页
	var generatePageInfo = function(dom) {
		var pageInfo = $("<div></div>");
		pageInfo.addClass("col-xs-3");
		pageInfo.addClass("pageInfo");
		pageInfo.addClass("pageRow");
		pageNoModel = $("<span></span>");
		pageNoModel.addClass("pageNo");
		totalPageModel = $("<span></span>");
		totalPageModel.addClass("totalPage");
		pageInfo.append("第 ").append(pageNoModel).append(" 页/");
		pageInfo.append(" 共 ").append(totalPageModel).append(" 页");

		$('.pageRowContent').append(pageInfo);
	}

	//制作页码按钮
	var generatePageButtons = function(dom) {
		pageButtonsModel = $("<div></div>");
		pageButtonsModel.addClass("col-xs-6");
		pageButtonsModel.addClass("pageButton");
		pageButtonsModel.addClass("pageRow");

		$('.pageRowContent').append(pageButtonsModel);
	}

	//制作表格
	var generateTable = function(dom, opts) {
		dom.addClass("xrTable");
		dom.wrap("<div class='tableProtect'></div>");
		dom.append("<tbody></tbody>");
	}

	//动态加载按钮
	var dymaticButtons = function(dom, opts) {
		pageButtonsModel.empty();
		//上一页
		var preButton = $("<a></a>");
		preButton.addClass("page_button");
		preButton.addClass("preButton");
		preButton.data("no", opts.pageNo - 1);
		preButton.html('<i class="icon-caret-left"></i>');
		if(opts.pageNo == 1) {
			preButton.addClass("disabled");
			preButton.attr("disabled","disabled");
		}
		//下一页
		var nextButton = $("<a></a>");
		nextButton.addClass("page_button");
		nextButton.addClass("nextButton");
		nextButton.data("no", opts.pageNo + 1);
		nextButton.html('<i class="icon-caret-right"></i>');
		if(opts.pageNo == opts.totalPage||opts.totalPage==0) {
			nextButton.addClass("disabled");
			nextButton.attr("disabled","disabled");
		}

		//页码按钮
		var visiblePageNos = [];
		var ELLIP = "…";
		if(opts.totalPage <= 4) {
			for(var i = 1; i <= opts.totalPage; i++) {
				visiblePageNos.push(i);
			}

		} else {
			switch(opts.pageNo) {
				case 1:
				case 2:
					visiblePageNos.push(1);
					visiblePageNos.push(2);
					visiblePageNos.push(3);
					visiblePageNos.push(ELLIP);
					visiblePageNos.push(opts.totalPage);
					break;
				case 3:
					visiblePageNos.push(1);
					visiblePageNos.push(2);
					visiblePageNos.push(3);
					visiblePageNos.push(4);
					visiblePageNos.push(ELLIP);
					visiblePageNos.push(opts.totalPage);
					break;
				case opts.totalPage - 2:
					visiblePageNos.push(1);
					visiblePageNos.push(ELLIP);
					visiblePageNos.push(opts.totalPage - 3);
					visiblePageNos.push(opts.totalPage - 2);
					visiblePageNos.push(opts.totalPage - 1);
					visiblePageNos.push(opts.totalPage);
					break;
				case opts.totalPage - 1:
				case opts.totalPage:
					visiblePageNos.push(1);
					visiblePageNos.push(ELLIP);
					visiblePageNos.push(opts.totalPage - 2);
					visiblePageNos.push(opts.totalPage - 1);
					visiblePageNos.push(opts.totalPage);
					break;
				default:
					visiblePageNos.push(1);
					visiblePageNos.push(ELLIP);
					visiblePageNos.push(opts.pageNo - 1);
					visiblePageNos.push(opts.pageNo);
					visiblePageNos.push(opts.pageNo + 1);
					visiblePageNos.push(ELLIP);
					visiblePageNos.push(opts.totalPage);
					break;
			}

		}

		//append按钮
		pageButtonsModel.append(preButton);
		for(var i = 0; i < visiblePageNos.length; i++) {
			var pageNoButton = $("<a></a>");
			if(visiblePageNos[i] != ELLIP) {
				pageNoButton.addClass("page_button");
				pageNoButton.data("no", visiblePageNos[i]);
			}
			if(visiblePageNos[i] == opts.pageNo) {
				pageNoButton.addClass("current");
			}
			pageNoButton.html(visiblePageNos[i]);
			pageButtonsModel.append(pageNoButton);
		}
		pageButtonsModel.append(nextButton);

		$(".page_button").click(function() {
			opts.pageNo = $(this).data("no");
			toPage(dom, opts);
		});
	}

	//页面跳转
	var toPage = function(dom, opts) {
		var postDatas = opts.paramFunc();
		postDatas.pageNo = opts.pageNo;
		postDatas.pageSize = opts.pageSize;
		//删除空的对象
		var nullArray = [];
		for(var i in postDatas) {
			if(IsNullOrEmpty(postDatas[i])) {
				nullArray.push(i);
			}
		}
		for(var i = 0; i < nullArray.length; i++) {
			delete postDatas[nullArray[i]];
		}

		$.ajax({
			url: opts.ajaxUrl,
			type: "post",
			data: postDatas,
			async: false,
			success: function(data) {
				var JSON_data = $.parseJSON(data);
				var ret = JSON_data.ret;
				opts.datas = ret;
				//数据绑定
				opts.totalCount = JSON_data.count;
				opts.totalPage = JSON_data.totalPage;
				opts.pageNo = Number(JSON_data.pageNo);
				//是否有checkbox
				if(opts.hasCheckbox) {
					if(dom.children("thead").children("tr").find('.checkAll').length <= 0) {
						dom.children("thead").children("tr").prepend("<th name='_checkbox'><input type='checkbox' class='checkAll'/></th>");
						checkAllEvent();
					}
				}

				var tdNames = [];
				var thead = dom.children("thead").children("tr");
				var tbody = dom.children("tbody");

				tbody.empty();
				thead.children("th").each(function() {
					var name = $(this).attr("name");
					if(IsNullOrEmpty(name)) {
						tdNames.push("");
						return true;
					}
					var key = name.substring(1);
					tdNames.push(key);
				});

				for(var i = 0; i < ret.length; i++) {
					var tr = $("<tr></tr>");
					for(var j = 0; j < tdNames.length; j++) {
						var td = $("<td></td>");
						if(tdNames[j] == 'checkbox') {
							td.html("<input type='checkbox' class='checkOne' value='"+ret[i].id+"' />");
						} else if(tdNames[j] == "xrno") {
							var num_index=(opts.pageNo - 1) * opts.pageSize + i + 1;
							td.html('<b style="border-radius:10px; height:16px;  padding:0px 5px 0px 5px; line-height:16px; display:inline-block;  color:white; background-color:#44C678; font-size:10px;">'+num_index+'</b>');
							td.addClass('xrNo');
						} else if(tdNames[j] == "oper") {
							td.append(viewOperateColumn(opts, ret[i]));
						} else
							td.html(ret[i][tdNames[j]]);
						tr.append(td);
					}
					tbody.append(tr);
				}
				tbody.appendTo(dom);

				//表格序号居中
				// $('.trNo-noDiv').width($('.trNo-noDiv div').width());
				//表格内容填充，后续操作
				pageNoModel.html(opts.pageNo);
				totalPageModel.html(opts.totalPage);
				dymaticButtons(dom, opts);

				//后续方法操作
				opts.afterInitFunc(dom);
				opts.afterFunc();

				//如果totalPage=0,表明完全没有数据，隐藏整个table
				if(opts.totalCount==0){
					$('.xrTableRow').hide(); 
					$('.noXrTableRow').remove();
					$('.listcontent').append('<div class="row noXrTableRow text-center"><img src="'+getRootPath()+'/cust/images/nodata.png" alt=""/></div>')
				}
				else{
					$('.noXrTableRow').remove();
					$('.xrTableRow').show(); 
				}
			}
		});
	}

	//操作列显示
	var viewOperateColumn = function(opts, trData) {
		var td = $("<div></div>");
		for(var key in opts.operation) {
			var icon = $("<a></a>");
			//设置title
			if(opts.operation[key].length >= 2) {
				icon.attr("title", opts.operation[key][1]);
			}
			//是否打开新页面
			var isNewblank = false;
			if(opts.operation[key].length >= 3) {
				isNewblank = opts.operation[key][2];
			}

			if(opts.operation[key].length >= 4) {
				var dialogWidth=opts.operation[key][3];
			}
			else{
				var dialogWidth=700;
			}

			if(opts.operation[key].length >= 5) {
				var dialogHeight=opts.operation[key][4];
			}
			else{
				var dialogHeight=400;
			}
			
			//设置icon
			switch(key) {
				case "view":
					icon.addClass("ace-icon fa fa-list-alt");
					icon.attr("title", "查看");
					break;
				case "edit":
					icon.addClass("ace-icon fa fa-edit");
					icon.attr("title", "编辑");
					break;
				case "del":
					icon.addClass("ace-icon fa fa-trash");
					icon.attr("title", "删除");
					break;
				default:
					icon.addClass(key);
			}
			//设置href
			if(!isFunction(opts.operation[key][0])) {
				// icon.attr("data-href", translateWords(opts.operation[key][0], trData));
				//				icon.addClass('xrmodal');
				if(!isNewblank){
					var zdialog_url=getRootPath()+'/'+translateWords(opts.operation[key][0], trData);
					icon.attr("onclick", "showDialogModal('"+zdialog_url+"',"+dialogWidth+","+dialogHeight+")");
					// icon.attr("data-toggle", "modal");
					// icon.attr("data-target", "#myModal");
				}else{
					icon.attr("href", translateWords(opts.operation[key][0], trData));
					icon.attr("target", "_blank");
				}
			} else {
				icon.attr("href", "javascript:void(0);");
				var b = opts.operation[key][0];
				bindIconClick(icon,b);
			}
			td.append(icon);
		}
		return td;
	}
	
	var bindIconClick = function(ele,func){
		ele.click(function() {
					var selectedIndex = ele.parents("tr").index();
					var XRappendNum = ele.parents("tr").prevAll("tr[class^='XRappend']").size();
					var PIDappendNum = ele.parents("tr").prevAll("tr[class^='PIDappend']").size();
					var realIndex = selectedIndex - XRappendNum-PIDappendNum;
					var trData = $.fn.getOpts().datas[realIndex];
					func(realIndex, trData,ele);
				});
	}

	//全选择，全取消
	var checkAllEvent = function() {
		$(".checkAll").click(function() {
			if($(this).is(":checked")) {
				$(".checkOne").prop("checked", true);
			} else {
				$(".checkOne").prop("checked", false);
			}
		});
	}

	//表格生成后，基本方法
	var initFunc = function(dom) {
		//IE特殊处理
		IEDeal();

		dom.children('tbody').find("td").click(function() {
			//存在表单的点击，都直接忽略
			if($(this).children("input").length >= 1 || $(this).find("a").length >= 1) {
				return;
			}
			var checkObj = $(this).parent().children("td:eq(0)").children();
			if(checkObj.is(":checked")) {
				checkObj.prop("checked", false);
			} else {
				checkObj.prop("checked", true);
			}

		});
		
		$("a").tooltip();
	}

	//插件外方法，获取当前标题行文字/标题行name
	var getTableThs = function(dom) {
		var ret = {};
		var headers = [];
		var keys = [];
		var params = {};
		dom.children("thead").children("tr").children("th").each(function() {
			if($(this).attr("name") == "_oper") {
				return true;
			}
			if($(this).attr("name") == "_checkbox") {
				return true;
			}
			headers.push($.trim($(this).html()));
			keys.push($(this).attr("name").substring(1));
		});
		ret.headers = headers;
		ret.keys = keys;
		ret.params = params;
		return ret;
	}

	//长字符串中特定标志替换
	var translateWords = function(str, values) {
		for(var key in values) {
			str = str.replace(new RegExp("#" + key, "gm"), values[key]);
		}
		return str;
	}

	//IE特殊处理
	var IEDeal = function() {
		var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
		var isOpera = userAgent.indexOf("Opera") > -1;
		if(userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1 && !isOpera) {
			$(".xrTable tbody tr:even").css("background-color", "#F9F9F9");
			$(".xrTable tbody tr:even").css("border-left", "solid thin #ddd");
			$(".xrTable tbody tr:odd").css("background-color", "white");
			$(".xrTable tbody tr:odd").css("border-left", "solid thin #ddd");
			$(".xrTable tbody tr:gt(0)").css("border-top", "solid thin #DDD");
			$(".xrTable tbody tr").hover(function() {
				$(this).css("background-color", "#D9E8F1");
			}, function() {
				if($(this).index() % 2 == 1) {
					$(this).css("background-color", "white");
				} else {
					$(this).css("background-color", "#F9F9F9");
				}
			});
		}
	}

	var getRootPath=function(){ 
		var strFullPath=window.document.location.href; 
		var strPath=window.document.location.pathname; 
		var pos=strFullPath.indexOf(strPath); 
		var prePath=strFullPath.substring(0,pos); 
		var postPath=strPath.substring(0,strPath.substr(1).indexOf('/')+1); 
		return(prePath+postPath); 
	} 

// })(jQuery);