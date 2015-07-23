<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>

<link rel="stylesheet" href="__PUBLIC__/css/base.css" />

<link rel="stylesheet" href="__PUBLIC__/css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/css/homeStyle.css" />

<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.min.js"></script>
</head>
<body>


<div class="head">
	<div class="container">
		<div class="logo"><p>MySpotify</p></div>
		<div class="login">
			<?php $isLogin = isLogin(); if($isLogin==false){ ?>
				<a href="<?php echo U('User/loginPage');?>">[Login]</a>
				<a href="<?php echo U('User/registPage');?>">[Regist]</a>
			<?php }else{ ?>
				<span class="fl mr10">welcome</span> <a href="<?php echo U('User/index');?>"><?php echo ($_SESSION["home"]['user_name']); ?></a>
				<a href="<?php echo U('User/quit');?>">[Logout]</a>
			<?php } ?>
		</div>
	</div>
</div>

<div class="nav">
	<div class="container">
		<ul class="tags">
			<li>
				<a href="<?php echo U('Index/index');?>" <?php if(($cate) == "index"): ?>class="active"<?php endif; ?> >INDEX</a>
				<a href="<?php echo U('index/concert');?>" <?php if(($cate) == "concert"): ?>class="active"<?php endif; ?> >CONCERT</a>
				<a href="<?php echo U('index/band');?>" <?php if(($cate) == "band"): ?>class="active"<?php endif; ?> >BAND</a>
				<a href="<?php echo U('User/index');?>" <?php if(($cate) == "ucenter"): ?>class="active"<?php endif; ?> >USER CENTER</a>
			</li>
		</ul>
		<p class="post"><a href="<?php echo U('User/postPage');?>">[POST]</a></p>
	</div>
</div>

<div class="sub_nav">
	<div class="container">
		
		<ul class="tags">
			
			<li>
				
				<a href=""></a>
			</li>
			
		</ul>

	

	</div>
</div>
<!--头文件结束-->

<div class="ucenter">
	<div class="container">
		<table class="table table-bordered table-condensed">
			<tr align="center">
				<td>concert name</td>
				<td>band</td>
				<td>style</td>
				<td>when & where</td>
				<td>your choice</td>
			</tr>
		<?php if(is_array($concert)): foreach($concert as $key=>$v): ?><tr>
				<td width="300"><span><?php echo ($v["concert_name"]); ?></span></td>
				<td >
					<span><a href="<?php echo U('band',array('id'=>$v['concert_band_id']));?>"><?php echo getBand($v['concert_band_id']);?></a></span>
				</td>
				<td width="300">
					<span>
						<?php $style = getStyle($v['concert_style_id']); foreach($style as $s){ ?>
						<a href="<?php echo U('concert',array('style'=>$s['id']));?>"><?php echo ($s["style_name"]); ?></a> 
						<?php } ?>
					</span>
				</td>
				<td>
					<span><a href="<?php echo U('concert',array('city'=>$v['concert_city']));?>"><?php echo ($v["concert_city"]); ?></a></span> 
					on
					<span><a href="<?php echo U('concert',array('date'=>$v['concert_play_date']));?>"><?php echo ($v["concert_play_date"]); ?></a></span> 
				</td>
				<td align="right">
					<?php if(isPosted($v['id'])){ ?>
					<span>is post</span>, 
					<span><a href="<?php echo U('User/reviewPage',array('id'=>$v['id']));?>">review</a></span> 
					<?php }else{ ?>
						<span><a href="<?php echo U('Band/post',array('id'=>$v['id']));?>">post</a></span>
					<?php } ?>
				</td>
			</tr><?php endforeach; endif; ?>
		</table>

		<a href="/" class="btn">back to INDEX</a>
		or
		<a href="<?php echo U('Index/band');?>" class="btn">back to BAND</a>
		
	</div>
</div>

<script>

</script>