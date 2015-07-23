<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>music</title>

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

<div class="concert">
	<div class="container">
		<p class="title">CONCERT RECOMMEND</p>
		<table class="table table-bordered table-condensed">
			<tr align="center">
				<td>concert name</td>
				<td>band</td>
				<td>style</td>
				<td>when & where</td>
				<td>your choice</td>
			</tr>
		<?php if(is_array($concert)): foreach($concert as $key=>$v): ?><tr>
				<td width="300"><span><?php if(isV($v['id'])){echo "[V]  ";} echo ($v["concert_name"]); ?></span></td>
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
					<span><a href="http://www.google.com/" target="_blank">link</a></span>, 
					<span>
						<?php if(isAdded($v['id'])){ ?>
						is already added
						<?php }else{ ?>
						<a href="<?php echo U('User/listConcert',array('id'=>$v['id']));?>">add</a>
						<?php } ?>
					</span>, 
					<span>
						<?php if(isRated("concert",$v['id'])){ ?>
						is already rated
						<?php }else{ ?>
						<a href="<?php echo U('User/rateConcert',array('id'=>$v['id']));?>">rate</a>
						<?php } ?>
					</span>, 
					<span><a href="<?php echo U('User/reviewPage',array('id'=>$v['id']));?>">review</a></span> 
				</td>
			</tr><?php endforeach; endif; ?>
		</table>
	</div>
</div>


<div class="concert">
	<div class="container">
		<p class="title">BAND RECOMMEND</p>
		<table class="table table-bordered table-condensed">
			<tr align="center">
				<td>band name</td>
				<td>style</td>
				<td>your choice</td>
			</tr>
		<?php if(is_array($band)): foreach($band as $key=>$v): ?><tr>
				<td width="300"><span><a href="<?php echo U('band',array('id'=>$v['id']));?>"><?php echo ($v["band_name"]); ?></a></span></td>
				<td width="300">
					<span>
						<?php $style = getStyle($v['band_style_id']); foreach($style as $s){ ?>
						<a href="<?php echo U('band',array('style'=>$s['id']));?>"><?php echo ($s["style_name"]); ?></a> 
						<?php } ?>
						
					</span>
				</td>
				
				<td align="right">
					<span>
						<?php if(isFans($v['id'])){ ?>
						is already a fan
						<?php }else{ ?>
						<a href="<?php echo U('User/fanBand',array('id'=>$v['id']));?>">be a fan</a>
						<?php } ?>
					</span>, 
					<span>
						<?php if(isRated("band",$v['id'])){ ?>
						is already rated
						<?php }else{ ?>
						<a href="<?php echo U('User/rateBand',array('id'=>$v['id']));?>">rate</a>
						<?php } ?>
					</span>
				</td>
			</tr><?php endforeach; endif; ?>
		</table>
	</div>
</div>

<div class="concert">
	<div class="container">
		<p class="title">POPULAR USER</p>
		<table class="table table-bordered table-condensed">
			<tr align="center">
				<td>user name</td>
				
				<td>your choice</td>
			</tr>
		<?php if(is_array($popUser)): foreach($popUser as $key=>$v): ?><tr>
				<td>
					<?php $isFollowed = isFollowed($v['id']); if($isFollowed){ ?>
					<a href="<?php echo U('User/profile',array('name'=>$v['user_name']));?>"><?php echo ($v['user_name']); ?></a>
					<?php }else{ ?>
					<span><?php echo ($v["user_name"]); ?></span>
					<?php } ?>
					
				</td>
				<td>
					<?php $isFollowed = isFollowed($v['id']); if($isFollowed==false){ ?>
					<a href="<?php echo U('User/follow',array('id'=>$v['id']));?>">follow</a>
					<?php }else{ ?>
					<span>is already followed</span>
					<?php } ?>
				</td>
			</tr><?php endforeach; endif; ?>
		</table>
	</div>
</div>