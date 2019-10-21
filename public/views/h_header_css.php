<base href = "<?php echo base_url(); ?>"/>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!-- <meta http-equiv="x-ua-compatible" content="IE=8"> -->
<title>
	<?=getValInArr(getSess(SESS_DIC),array('webInfo','webtitle'))?>
</title>
<meta name="keywords" content="<?=getValInArr(getSess(SESS_DIC),array('webInfo','keywords'))?>" />
<meta name="description" content="<?=getValInArr(getSess(SESS_DIC),array('webInfo','description'))?>" />
<!--<meta name="viewport" content="width=device-width, initial-scale=1.0" />-->
<!--  JS  -->

<script src="public/assets/js/jquery-2.0.3.min.js"></script>
<script src="public/assets/js/jquery.form.js?_=1542683358976"></script>
<!--[if IE]>
<script src="public/assets/js/jquery-1.10.2.min.js" ></script>
<![endif]-->
<script src="public/assets/js/bootstrap.min.js"></script>

<!--[if lt IE 9]>
<script src="public/assets/js/html5shiv.js" ></script>
<script src="public/assets/js/respond.min.js" ></script>
<![endif]-->




<!-- h_ui -->
<link rel="Bookmark" href="public/h_ui/favicon.ico" >
<link rel="Shortcut Icon" href="public/h_ui/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="public/h_ui/lib/html5shiv.js"></script>
<script type="text/javascript" src="public/h_ui/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="public/h_ui/static/h-ui/css/H-ui.css" />
<link rel="stylesheet" type="text/css" href="public/h_ui/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="public/h_ui/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="public/h_ui/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="public/h_ui/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="public/h_ui/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->

<!-- <script type="text/javascript" src="public/h_ui/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="public/h_ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="public/h_ui/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="public/h_ui/static/h-ui.admin/js/H-ui.admin.js"></script>  -->
<!--/_footer 作为公共模版分离出去-->
<!-- <script type="text/javascript" src="public/h_ui/lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script> -->


<!-- <link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap.min.css"> -->



<!-- 字体 -->
<link rel="stylesheet" type="text/css" href="public/append/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="public/assets/css/font-awesome.min.css">
<!--[if IE 7]>
<link rel="stylesheet" href="public/assets/css/font-awesome-ie7.min.css" />
<![endif]-->
<!-- page specific plugin styles -->
<!-- fonts -->


<!--[if lte IE 8]>
<link rel="stylesheet" href="public/assets/css/ace-ie.min.css" />
<![endif]-->
<!-- inline styles related to this page -->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- 
<script src="public/assets/js/ace-extra.min.js"></script>

<script src="public/assets/js/chosen.jquery.min.js"></script>
<script src="public/assets/js/jquery.validate.min.js"></script>
<script src="public/assets/js/typeahead-bs2.min.js"></script> -->
<!-- page specific plugin scripts -->
<!-- <script src="public/assets/js/additional-methods.min.js"></script>
<script src="public/assets/js/bootbox.min.js"></script>
<script src="public/assets/js/jquery.maskedinput.min.js"></script>
<script src="public/assets/js/select2.min.js"></script> -->
























<!-- ace styles -->
<!-- <link rel="stylesheet" href="public/assets/css/chosen.css" />
<link rel="stylesheet" href="public/assets/css/ace.min.css" />
<link rel="stylesheet" href="public/assets/css/ace-rtl.min.css" />
<link rel="stylesheet" href="public/assets/css/ace-skins.min.css" /> -->
<!-- ace scripts -->
<!-- <script src="public/assets/js/ace-elements.min.js"></script>
<script src="public/assets/js/ace.min.js"></script> -->















<!--AutoComplete-->
<link rel="stylesheet" href="public/append/autocomplete/jquery-ui.min.css" />
<script src="public/append/autocomplete/jquery-ui.min.js"></script>
<!-- 弹出框-->
<link rel="stylesheet" href="public/append/artDialog/ui-dialog.css" />
<script src="public/append/artDialog/dialog-min.js"></script>
<!-- 表单验证-->
<script src="public/append/validForm/Validform_v5.3.2_min.js"></script>
<link rel="stylesheet" href="public/append/validForm/validform.css" />
<!--
	作者：fengpeiqi@126.com
	时间：2016-11-03
	描述：sweetalert
-->
<script src="public/append/swal/sweet-alert.min.js"></script>
<link rel="stylesheet" href="public/append/swal/sweet-alert.css">
<!--星冉工具 -->
<script src="public/js/util.js"></script>
<link rel="stylesheet" href="public/xr/xrDatatable.css" />
<script src="public/xr/xrDatatable.js"></script>
<!-- 自定义css-->
<link rel="stylesheet" href="public/css/common.css" />
<!-- 业务js-->
<script src="cust/js/append/business.js"></script>


<!-- zdialog -->
<script src="public/append/zDialog/zDrag.js"></script>
<script src="public/append/zDialog/zDialog.js"></script>

<script src="public/js/zdialog_modal.js"></script>


<!-- pc端的对错消息提示 -->
<!-- <script src="public/append/pcAlert/message.min.js"></script>
<link rel="stylesheet" href="public/append/pcAlert/message.css" /> -->
<link href="public/append/popAlert/dist/spop.css" rel="stylesheet">
<script src="public/append/popAlert/dist/spop.js"></script>


<!-- layer -->
<script src="public/append/layer/layer/layer.js"></script>


<!-- 消息提醒 win10风格 -->
<!-- <script src="public/append/messageRemind/js/d-toast.min.js" type="text/javascript" charset="UTF-8"></script> -->


