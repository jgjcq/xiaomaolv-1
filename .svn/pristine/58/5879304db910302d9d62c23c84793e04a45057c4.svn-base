<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html><html lang="en">
	<head>
		<?php
		include_once "public/views/header.php";
		?>
        <link rel="stylesheet" href="public/assets/css/ace.min.css" />
        <link rel="stylesheet" href="public/assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="public/assets/css/ace-skins.min.css" />
        <!--[if lte IE 8]>
        <link rel="stylesheet" href="public/assets/css/ace-ie.min.css" />
        <![endif]-->
		<script type="text/javascript" src="cust/js/login.js"></script>
        <!--<script type="text/javascript">
            <?php if(isset($_GET['back'])): ?>
            var back = 1;
            <?php else: ?>
            var back = 0;
            <?php endif; ?>
        </script>-->
	</head>
	<!--<body class="login-layout" style="background:lightgray;">-->
	<body class="login-layout" style="background:url(cust/images/bg_login.png);background-size: cover;">
		<div class="main-container">
			<div class="main-content" style="padding-top: 70px;min-height: 80% !important;">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container" style="margin-top: 65px;">
							<div class="center" style="width:460px;margin-left:-45px;">
								<h1>
									<i class="fa fa-credit-card-alt green">
									</i> <span class="red"><?=getValInArr(getSess(SESS_DIC),array('webInfo','webtitle'))?></span>
									<!--<span
									class="green"></span>-->
								</h1>
								<h4 class="blue">
								&copy; <?=getValInArr(getSess(SESS_DIC),array('webInfo','company'))?>
								</h4>
							</div>
							<div class="space-6">
							</div>
							<div class="position-relative">
								<div id="login-box"
								class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="icon-coffee green">
												</i> 请登录
											</h4>
											<div class="space-6">
											</div>
											<form id="login-form" name="login-form">
												<fieldset>
													<label class="block clearfix">
														<span
														class="block input-icon input-icon-right">
															<input
															id="usercode" name="usercode" type="text"
															class="form-control" placeholder="用户名" datatype="*"/>
															<i
															class="icon-user">
															</i>
														</span>
													</label>
													<label class="block clearfix">
														<span
														class="block input-icon input-icon-right">
															<input
															id="password" name="password" type="password"
															class="form-control" placeholder="密码" datatype="*">
															<i
															class="icon-lock">
															</i>
														</span>
													</label>
                                                    <!--<div style="text-align: right">
                                                        <a href="<?=base_url()?>web/about/register" class="btn btn-link">注册</a>
                                                    </div>-->
													<span id="myError" class="Validform_checktip Validform_wrong" style="display:none">
													</span>
													<div class="space">
													</div>
													<div class="clearfix">
														<!--<label class="inline">
															<input type="checkbox"
															class="ace" />
															<span class="lbl">
																记住我
															</span>
														</label>-->
														<button type="button" id="login"
														class="width-35 pull-right btn btn-sm btn-primary">
															<i class="icon-key">
															</i> 登录
														</button>
													</div>
													<div class="space-4">
													</div>
												</fieldset>
											</form>
										</div>
										<!-- /widget-main -->
									</div>
									<!-- /widget-body -->
								</div>
								<!-- /login-box -->
							</div>
							<!-- /position-relative -->
						</div>
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</div>
		</div>
	</body>
	<script>

	</script>
</html>