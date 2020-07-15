<!DOCTYPE html>
<html>
<head>
	<title>USER</title>
	<base href="http://localhost/dev_train/"/>
	<style type="text/css">
		.limit-view{
				margin-bottom: 2%; 
				margin-right: 50px;
				padding-right: 20px;
				font-size: 30px;
				float: right;
				background-color: royalblue;
				color: white;
			}
		table,th,td{
			border: 1px solid black;
			text-align: center;
			}

		ul{
			list-style-type: none;
			margin:0;
			padding: 0;
			overflow: hidden;
		}
		li{	
			display: inline-block;
		}
		a{
			display: block;
			padding: 8px;
			background-color: transparent;
		}
	</style>
</head>
<body>
	<?php if ($page == 0){ ?>
		<button type = "button" class = "limit-view" onclick="window.location.href ='user'">Limit View</button>
	<?php }?>
	<table style = "width: 100%">
		<tr>
			<th>ID</th>
			<th>Thumb</th>
			<th>Title</th>
		</tr>
		<?php 
		foreach ($data as $d) {
			# code...
			if($d['status'] == 1){
			$id = $d['id'];
			echo "<tr>";
			echo "<td>".$id."</td>";
			echo "<td><img src = 'Images/".$d['image']."'/></td>";
			echo "<td><a href = ".$_GET['controller']."/show/$id>".$d['title']."</a></td>";
			?>
			<?php
			echo "</tr>";
			}
		}
		?>
	</table>
	<?php if($page != 0) {?>
	<form action="" method="POST">
	<div style= "margin-top: 5px" >
		<label>Page</label>
		<select id = "page_num" name="page_num" style="width: 73px" onchange="location=this.value">
			<option disabled="disabled" selected="selected">--Page--</option>
			<option value = "user/1">1</option>
			<option value = "user/5">5</option>
			<option value= "user/10">10</option>
			<option value = "user/50">50</option>
			<option value = "user/0">All</option>
			
		</select>
		<nav aria-label = "Page navigation">
			<ul class = "pagination">
				<li>
					<a href="user/<?= $previous; ?>">
						<span>&laquo; Previous</span>
					</a>
				</li>
				<?php

					for($i=1 ; $i <= $pages ; $i++){?>
				<li><a href="user/<?= $i; ?>"><?= $i ;?></a></li>
				<?php };?>
				<li>
					<a href="user/<?=$next; ?>">
						<span>Next</span>
					</a>
				</li>
			</ul>
		</nav>
	</div>
	</form>
	<?php }?>
</body>
</html>