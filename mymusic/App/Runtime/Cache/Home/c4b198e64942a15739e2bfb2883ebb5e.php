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
		<p class="title">
			BAND
			<?php if(isBandLogin()){ ?>
			
			<a class="fr ml10" href="<?php echo U('Band/quit');?>">[band quit]</a>
			<a class="fr ml10" href="<?php echo U('Band/addConcertPage');?>">[create concert]</a>
			<a class="fr ml10" href="<?php echo U('Band/bandConcert');?>">[post concert]</a>
			<span class="fr ">welcome <?php echo ($_SESSION['band_name']); ?></span>
			<?php }else{ ?>
			<a class="fr ml10" href="<?php echo U('Band/registPage');?>">[band regist]</a>
			<a class="fr" href="<?php echo U('Band/loginPage');?>">[band login]</a>
			<?php } ?>
		</p>

		<form action="" method="get" class="form-inline">
			<span class="fl"><span class="fl">name</span><input type="text" name="name"></span>
			<span class="fl">
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
		<div id="page"><?php echo ($page); ?></div>
	</div>
</div>


</body>
</html>