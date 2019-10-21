<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="#"><i class="fa fa-credit-card-alt"></i>&nbsp;&nbsp;<?=getValInArr(getSess(SESS_DIC),array('webInfo','webtitle'))?></a>
		<nav class="nav navbar-nav">
				<ul class="cl">
					<li class="dropDown dropDown_hover">
						<a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<?php foreach ($module as $k => $v): ?>
								<?php if(isset($v['_child'])): ?>
								<?php foreach ($v['_child'] as $k1 => $v1): ?>
									<?php if(isset($v1['_child'])): ?>
									<?php foreach ($v1['_child'] as $k2 => $v2): ?>
										<?php if(explode('/',$v2['ename'])[1]=='edit'): ?>
											<li <?php if($v2['is_show']==0||$v1['is_show']==0||$v['is_show']==0) echo 'style="display:none;"'; ?>><a onclick="showDialogModal(<?php echo "'".base_url()."Admin/".$v2['ename']."/0'"; ?>)" data-title="<?php echo explode('/',$v2['cname'])[0]; ?>" href="javascript:void(0)"><i class="<?php echo $v2['icon']?$v2['icon']:($v1['icon']?$v1['icon']:$v['icon']); ?>" style="margin-right: 6px;"></i><?php echo explode('/',$v2['cname'])[0]; ?></a></li>
										<?php endif; ?>
									<?php endforeach; ?>
									<?php endif; ?>
								<?php endforeach; ?>
								<?php endif; ?>
							<?php endforeach; ?>
							
					</ul>
					</li>
					<li class="navbar-levelone current"><a href="javascript:;">总览</a></li>
					<?php foreach ($module as $k => $v): ?>
					<li class="navbar-levelone dropDown dropDown_hover"><a href="javascript:;" <?php if($v['is_show']==0) echo 'style="display:none;"'; ?>><?php echo $v['cname'] ?></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<?php if(isset($v['_child'])): ?>
							<?php foreach ($v['_child'] as $k1 => $v1): ?>
							<li <?php if($v1['is_show']==0) echo 'style="display:none;"'; ?>><a data-href="<?=base_url()?>Admin/<?php echo $v1['ename']; ?>" onclick="Hui_admin_tab(this);" data-title="<?php echo $v1['cname']; ?>" href="javascript:void(0)"><i class="<?php echo $v1['icon']?$v1['icon']:$v['icon']; ?>" style="margin-right: 6px;"></i><?php echo $v1['cname']; ?></a></li>
							<?php endforeach; ?>
							<?php endif; ?>
						</ul>
					</li>
					<?php endforeach; ?>
			<!-- 		<li class="navbar-levelone"><a href="javascript:;">财务</a></li>
					<li class="navbar-levelone"><a href="javascript:;">手机</a></li> -->
				</li>
			</ul>
		</nav>
		<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
			
				<ul class="cl">
				<li><img style="width:40px; height:40px; border-radius: 20px; margin-right: 5px; margin-bottom: 2px; cursor: pointer;" src="<?php echo base_url() ?><?php echo getSess(SESS_USER)['head_img']?getSess(SESS_USER)['head_img']:'public/home/images/head_img.jpg' ?>" alt="" onclick="showDialogModal('<?php echo base_url() ?>Admin/Login/changeHeadImg',300,300)"><?php echo getSess(SESS_USER)['username'] ?>&nbsp;&nbsp;</li>
				<li class="dropDown dropDown_hover">
					<a href="javascript:;" class="dropDown_A"><?php echo getSess(SESS_USER)['usercode'] ?> <i class="Hui-iconfont">&#xe6d5;</i></a>
					<ul class="dropDown-menu menu radius box-shadow">
						<li><a href="javascript:;" onclick="showDialogModal('<?php echo base_url(); ?>Admin/Login/password',270,300);"><i class="icon-lock"></i>&nbsp;&nbsp;密码修改</a></li>
						<li><a href="Admin/Login/logOut"><i class="icon-off"></i>&nbsp;&nbsp;注销</a></li>
				</ul>
			</li>
				<!-- <li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li> -->
				<li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
					<ul class="dropDown-menu menu radius box-shadow">
						<li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
						<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
						<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
						<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
						<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
						<li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</div>
</header>


