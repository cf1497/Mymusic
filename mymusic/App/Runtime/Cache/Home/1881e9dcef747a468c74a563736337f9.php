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
		<p class="title">CONCERT</p>

		<form action="" method="get" class="form-inline">
			<span class="fl"><span class="fl">name</span><input type="text" name="name"></span>
			<span class="fl ml5"><span class="fl">city</span><input type="text" name="city"></span>
			<span class="fl ml5"><span class="fl">date</span><input type="text" name="date"></span>
			<span class="fl ml5">
				band
				<select name="band_id">
					<option value="0">all</option>
					<?php if(is_array($band)): foreach($band as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["band_name"]); ?></option><?php endforeach; endif; ?>
				</select>
			</span>
			<span class="fl ml5">
				style
				<select name="style">
					<option value="0">all</option>
					<?php if(is_array($style)): foreach($style as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["style_name"]); ?></option><?php endforeach; endif; ?>
				</select>
			</span>

			<span class="fl"><input type="submit" value="search"></span>
		</form>

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
					<span><a href="http://www.google.com/" target="_blank">RSVP</a></span>, 
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