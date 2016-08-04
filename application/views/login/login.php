<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录</title>
	<link rel="stylesheet" href="">
	<link href="" rel="shortcut icon">
	<link rel="stylesheet" href="./assets/css/bui-min.css">
	<link rel="stylesheet" href="./assets/css/dpl-min.css">
	<style>
		body,ul,li,div{margin:0;padding: 0;list-style: none;}
		#wapper{width: 400px;height: 200px;position: absolute;top: 50%;left: 50%;border: 1px solid #414da7; border-radius: 5%;overflow: hidden;margin: -140px  0  0 -200px;}
		#wapper div {margin: 5px auto;}
		#wapper div div {display: inline-block;}
		#wapper #header {background-color: #414da7;color: #fff;font-size: 18px;text-align: center;padding: 8px 0;margin-top: 0;}
		#login {text-align: center;}
		#pwd {text-align: center;}
		#user-name {text-align: center;}
		#tip {min-height: 40px;}
		#other {text-align: right; padding-right: 100px}
	</style>
</head>
<!-- #e8e9ee 背景  -->
<!-- #414da7 深蓝 -->
<body bgcolor ="">
	<div id="wapper">
		<div id="header">小黑科技</div>
		<div id="user-name">
			<div>用户名：</div>
			<div id="tip"></div>
			<div><input id="username" type="text" placeholder="请输入你的用户名"></div>
		</div>
		<div id="pwd">
			<div>密&nbsp;&nbsp;&nbsp;&nbsp;码：</div>
			<div><input id="password" type="text" placeholder="请输入你的密码"></div>
		</div>
		<div id="other"><a href="">忘记密码？</a></div>
		<div id="login"><button class="button button-primary">登录</button></div>
	</div>

	<script src="./assets/js/jquery-1.8.1.min.js"></script>
	<script>
	</script>
</body>
</html>

