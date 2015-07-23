<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>regist</title>

<link rel="stylesheet" href="__PUBLIC__/css/base.css" />
<link rel="stylesheet" href="__PUBLIC__/css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/css/homeStyle.css" />

<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.min.js"></script>

</head>

<body>
<div class="login-head tc">
	<h3>REGIST!!<a href="<?php echo U('User/loginPage');?>" class="ml10 f12">or login</a></h3>
</div>
<hr>
<div class="login-zone">
	<div class="container">
		<form action="<?php echo U('regist');?>" method="post" class="login-form form-inline">
			<p><span>user name</span><input type="text" name="name"></p>
			<p><span>password</span><input type="password" name="password"></p>
			<p><span>password again</span><input type="password" name="r_pass"></p>
			<p><span>email</span><input type="text" name="mail"></p>
			<p><span>birthday</span><input type="text" name="birthday"></p>
			<p><span>city</span><input type="text" name="city"></p>
			<p><input type="submit" class="fl ml100" value="regist"></p>
		</form>
	</div>
</div>
<hr>
<a href="/" class="btn fl ml50">back to index</a>
</body>
</html>