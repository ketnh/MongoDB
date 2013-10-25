<html>
<head>
	<title>Quản lý sinh viên</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <script src='<?php echo base_url('/javascript.js'); ?>'>
     </script>
	<link rel='stylesheet' href=<?php echo base_url().'home_style.css';?> type='text/css'>
</head>
<body>
	<div id="content">
		<div id='banner'>
		</div>
		<div class='bar'>
			<?php echo '<p class="right_align">Xin chào '.$username.'. <a href="'.base_url().'">Đăng xuất</a></p>';?>
		</div>
        
		<div id='menu'>
			<table>
				<tr><a class='menu_item' href=<?php echo base_url().'index.php/statistic/displaystafflist' ;?>>Danh sách cán bộ</a></tr>
				<tr><a class='menu_item' href=<?php echo base_url().'index.php/statistic/displaysubjectlist' ;?>>Danh sách môn học</a></tr>
				<tr><a class='menu_item' href=<?php echo base_url().'index.php/statistic/displaystudentlist' ;?>>Danh sách sinh viên</a></tr>
				<tr><a class='menu_item' href=<?php echo base_url().'index.php/statistic/displayclasslist' ;?>>Điểm tổng kết từng lớp</a></tr>
				<tr><a class='menu_item' href=<?php echo base_url().'index.php/statistic/displaycourselist' ;?>>Điểm tổng kết từng môn học</a></tr>
			</table>
		</div>
		<div id='display'>
			<?php echo (isset($content) ? $content : '');?>
		</div>
        <div id="footer">Copy right 2013 by HTQ CSDL</div>
	</div>
    
</body>
</html>