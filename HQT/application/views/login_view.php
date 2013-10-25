<!DOCTYPE html>
<html>
<head>
	<title>Quan ly sinh vien</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
	<link rel="stylesheet" href=<?php echo base_url()."login_style.css"; ?> type="text/css"/>
</head>

<body id='login'>
	<h1>WEBSITE QUẢN LÝ SINH VIÊN <br/>TRƯỜNG ĐẠI HỌC CÔNG NGHỆ - ĐHQGHN</h1>
	<?php echo validation_errors(); ?>
	<?php echo form_open('verifylogin');?>
		<label for="username"><h3 class="inline">Username:</h3></label>
		<input type="text" size="20" id="username" name="username"/>
		<br/>
		<label for="password"><h3 class="inline">Password:</h3></label>&nbsp
		<input type="password" size="20" id="password" name="password"/>
		<br/>
		<input class = 'login' type="submit" value="Đăng nhập"/>
		<?php echo '<p id="error">'.(isset($message) ? $message : '' ).'</p>'; ?>
	</form>
</body>
</html>