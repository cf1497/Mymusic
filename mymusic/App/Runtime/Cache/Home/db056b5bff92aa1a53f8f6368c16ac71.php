<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>concert_review</title>

<link rel="stylesheet" href="__PUBLIC__/css/base.css" />

<link rel="stylesheet" href="__PUBLIC__/css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/css/homeStyle.css" />

<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.min.js"></script>
</head>
<body>


<div class="head">
	<div class="container">
		<div class="logo"><p>LOGO!!!</p></div>
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
		<h3>CONCERT_REVIEW</h3>

		<div class="f20"><?php echo ($concert["concert_name"]); ?></div>

		<br>

		<div class="f16" style="border-bottom:1px solid orange">all revews:</div>

		<br>

		<?php if(is_array($review)): foreach($review as $key=>$v): ?><div style="margin-bottom:10px;border-bottom:1px solid blue;">
			<p><?php echo ($v["user_name"]); ?> says:</p>
			<p><?php echo ($v["content"]); ?></p>

		</div><?php endforeach; endif; ?>
		<form action="<?php echo U('User/review');?>" class="form-inline" method="post">
			<input type="hidden" name="concert_id" value="<?php echo ($concert["id"]); ?>">
			<input type="hidden" name="concert_name" value="<?php echo ($concert["concert_name"]); ?>">
			<textarea name="content"></textarea>
			<input type="submit" value="post review">
		</form>
	</div>
</div>