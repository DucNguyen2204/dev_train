<!DOCTYPE html>
<html>
<head>
	<base href="http://localhost/dev_train/"/>
	<style type="text/css">
		.ID{
			float: left;
			font-size: 75px;
		}
		.back-button{
			margin-top: 2%; 
			margin-right: 50px;
			padding-right: 20px;
			font-size: 30px;
			float: right;
			background-color: royalblue;
			color: white;
		}
		td{
			width: 50%;
		}
	</style>
	<title>SHOW POST</title>
</head>
<body>
	<div id = "container">
		<div class = "ID">
			<?php echo "<text>".$d['title']."</text>";?>
		</div>
		<button type = "button" class = "back-button" onclick="window.history.back();">Back</button>
	</div>

	<table style = "width: 100%; padding-top: 20px; border-top-width: small; border: 1px solid silver; ">
		<tr>
			<?php echo "<td><img src = 'Images/".$d['image']."'/></td>";?>
			<?php echo "<td>".$d['description']."</td>";?>
		</tr>

	</table>
</body>
</html>