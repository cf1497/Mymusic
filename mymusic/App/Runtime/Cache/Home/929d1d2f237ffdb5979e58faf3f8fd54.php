<?php if (!defined('THINK_PATH')) exit();?>

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
		<div class="logo"><p>LOGO!!!</p></div>
		<div class="login">
			<a href="">[登录]</a>
			<a href="">[注册]</a>
		</div>
	</div>
</div>

<div class="nav">
	<div class="container">
		<ul class="tags">
			<li>
				<a href="/index.php" <?php if(($cate) == "index"): ?>class="active"<?php endif; ?> >首页</a>
				<a href="<?php echo U('index/city');?>" <?php if(($cate) == "concert"): ?>class="active"<?php endif; ?> >CONCERT</a>
				<a href="<?php echo U('recommend/index');?>" <?php if(($cate) == "recommend"): ?>class="active"<?php endif; ?> >RECOMMEND</a>
				<a href="" <?php if(($cate) == "ucenter"): ?>class="active"<?php endif; ?> >USER CENTER</a>
			</li>
			
		</ul>

		<p class="post"><a href="">[发布]</a></p>
	</div>
</div>

<div class="sub_nav">
	<div class="container">
		
		<ul class="tags">
			
			<li>
				
				<a href=""></a>
			</li>
			
		</ul>

		<!--搜索框-->
		<form class="search form-inline">
			<input type="text" name="search" value="" >
			<button type="submit" class="btn"><span class="icon-search"></span></button>
		</form>
		<!--搜索框-->
	</div>
</div>
<!--头文件结束-->

<div class="concert">
	<div class="container">
		<p class="title">CONCERT RECOMMEND</p>
		<table class="table table-bordered table-condensed">
		<?php if(is_array($concert)): foreach($concert as $key=>$v): ?><tr>
				<td width="300"><span><?php echo ($v["concert_name"]); ?></span></td>
				<td width="300"><span><?php echo ($v["concert_style_id"]); ?></span></td>
				<td><span><a href="<?php echo U('city',array('id'=>$v['concert_city']));?>"><?php echo ($v["concert_city"]); ?></a></span></td>
				<td><span><a href="javascript:;">rate</a></span></td>
			</tr><?php endforeach; endif; ?>
		</table>
		<div id="page"><?php echo ($page); ?></div>
	</div>
</div>



</div>