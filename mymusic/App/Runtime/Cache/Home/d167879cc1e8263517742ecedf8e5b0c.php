<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>login</title>

<link rel="stylesheet" href="__PUBLIC__/css/base.css" />
<link rel="stylesheet" href="__PUBLIC__/css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/css/homeStyle.css" />

<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.min.js"></script>

</head>

<body>
<div class="login-head tc">
	<h3>LOGIN!!<a href="<?php echo U('User/registPage');?>" class="ml10 f12">or regist</a></h3>
</div>
<hr>
<div class="login-zone">
	<div class="container">
		<form action="<?php echo U('login');?>" method="post" class="login-form form-inline">
			<p><span>user name</span><input type="text" name="name"></p>
			<p><span>password</span><input type="password" name="password"></p>

			<p><input type="submit" class="fl ml100" value="login"></p>
		</form>
	</div>
</div>
<hr>
<a href="/" class="btn fl ml50">back to index</a>
</body>
</html>