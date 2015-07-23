<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>user center</title>

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
		<table class="table table-condensed table-bordered">
			<tr>
				<td width="200"><span>user name</span></td>
				<td><span><?php echo ($user["user_name"]); ?></span></td>
			</tr>
			<tr>
				<td width="200"><span>email</span></td>
				<td><span><?php echo ($user["user_mail"]); ?></span></td>
			</tr>
			<tr>
				<td width="200"><span>city</span></td>
				<td><span><?php echo ($user["user_city"]); ?></span></td>
			</tr>
			<tr>
				<td width="200"><span>birthday</span></td>
				<td><span><?php echo ($user["user_birthday"]); ?></span></td>
			</tr>
			<tr>
				<td width="200"><span>trust</span></td>
				<td><span><?php echo ($user["user_trust"]); ?></span></td>
			</tr>
		</table>

		<a href="<?php echo U('User/followPage');?>" class="btn">see follow</a>
		<a href="<?php echo U('User/myBand');?>" class="btn">my band</a>
		<a href="<?php echo U('User/editProfilePage');?>" class="btn">edit profile</a>
		<a href="<?php echo U('User/addConcertPage');?>" class="btn">add concert</a>
		<a href="<?php echo U('User/concertList');?>" class="btn">my concert list</a>

		<hr>

		<h3>POST</h3>
			
		<?php if(is_array($content)): foreach($content as $key=>$v): ?><div style="width:100%;border:1px solid silver;float:left;margin-bottom:20px;">
			<div style="width:300px;min-height:100px;border:1px solid red;float:left;"><?php echo ($v["content"]); ?></div>

			<div style="width:100%;float:left;">					
				<?php if(isLiked($v['id'])){ ?>
				is liked
				<?php }else{ ?>
				<a href="<?php echo U('User/like',array('id'=>$v['id']));?>">like</a>
				<?php } ?>
			
				(<?php echo ($v["like_num"]); ?>)

			</div>
			
			<div style="width:100%;border:0px solid pink;float:left;">COMMENTS:<br>
				<?php $comment = getComment($v['id']); foreach($comment as $c){ ?>
				<div style="width:100%;border:0px solid red;float:left;"><?php echo ($c["comment_user"]); ?> : <?php echo ($c["comment"]); ?></div>
				<?php } ?>
			</div>
		</div><?php endforeach; endif; ?>
	</div>
</div>