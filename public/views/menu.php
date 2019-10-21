<aside class="Hui-aside" style="background-color: white;">
	<div class="menu_dropdown bk_2">
	<?php foreach ($module as $k => $v): ?>
		<dl id="menu-<?php echo $v['ename']; ?>" <?php if($v['is_show']==0) echo 'style="display:none;"'; ?> class="<?php echo $v['ename']; ?>Menu">
			<dt><i class="<?php echo $v['icon']; ?>" style="margin-right: 10px;"></i><?php echo $v['cname']; ?><i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<?php if(isset($v['_child'])): ?>
					<?php foreach ($v['_child'] as $k1 => $v1): ?>
					<li <?php if($v1['is_show']==0) echo 'style="display:none;"'; ?>><a data-href="<?=base_url()?>Admin/<?php echo $v1['ename']; ?>" data-title="<?php echo $v1['cname']; ?>" href="javascript:void(0)" ><?php echo $v1['cname']; ?></a></li>
					<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</dd>
		</dl>					
	<?php endforeach; ?>	
	</div>
	<?php foreach ($module as $k => $v): ?>
	<div class="menu_dropdown bk_2" style="display:none">
		<dl id="menu-<?php echo $v['ename'] ?>">
			<dt><i class="<?php echo $v['icon']; ?>" style="margin-right: 10px;"></i><?php echo $v['cname'] ?><i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<?php if(isset($v['_child'])): ?>
					<?php foreach ($v['_child'] as $k1 => $v1): ?>
					<li <?php if($v1['is_show']==0) echo 'style="display:none;"'; ?>><a data-href="<?=base_url()?>Admin/<?php echo $v1['ename']; ?>" data-title="<?php echo $v1['cname']; ?>" href="javascript:void(0)"><?php echo $v1['cname']; ?></a></li>
					<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</dd>
		</dl>
	</div>
	<?php endforeach; ?>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active">
					<span title="我的桌面" data-href="<?php echo base_url() ?>Admin/Index/desktop">我的桌面</span>
					<em></em></li>
		</ul>
	</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="<?php echo base_url() ?>Admin/Index/desktop"></iframe>
	</div>
</div>
</section>

<div class="contextMenu" id="Huiadminmenu">
	<ul>
		<li id="closethis">关闭当前 </li>
		<li id="closeall">关闭全部 </li>
</ul>
</div>

<script>
	$(function(){
		$("body").Huitab({
			tabBar:".navbar-wrapper .navbar-levelone",
			tabCon:".Hui-aside .menu_dropdown",
			className:"current",
			index:0,
		});
	})
</script>