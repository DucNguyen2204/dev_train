<?php

?>
<html>
	<head>
		<title>ADMIN</title>
		<base href="http://localhost/dev_train/"/>
		<style type="text/css">
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
			.manage{
				float: left;
				font-size: 75px;
				}

			.new-button{
				margin-top: 2%; 
				margin-right: 50px;
				padding-right: 20px;
				font-size: 30px;
				float: right;
				background-color: royalblue;
				color: white;
			}
			.limit-view{
				margin-top: 2%; 
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
		</style>
	</head>
	<body> 
		<div id = "container">
			<div class = "manage">
				<text>Manage</text>
			</div>
			<button type = "button" class = "new-button" onclick="window.location.href ='admin/add' ">New</button>
			<?php if ($page == 0){ ?>
			<button type = "button" class = "limit-view" onclick="window.location.href ='admin'">Limit View</button>
			<?php }?>
			<table style = "width: 100%">
				<tr>
					<th>ID</th>
					<th>Thumb</th>
					<th>Title</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
					<?php 

					foreach ($data as $d) {
						# code...
						$id = $d['id'];
						echo "<tr>";
						echo "<td>".$id."</td>";
						echo "<td><img src = 'Images/".$d['image']."'/></td>";
						echo "<td>".$d['title']."</td>";
						if($d['status'] == 0){
							echo "<td>Disabled</td>";
						}else{
							echo "<td>Enabled</td>";
						}
						
						?>
						<?php 
						echo "<td><a href='admin/show/$id'>Show|</a><a href='admin/edit/$id'>Edit|</a><a href='admin/delete/$id'>Delete</a></td>";
						?>
						<?php
						echo "</tr>";
					}
					?>
			</table>
			<?php if($page != 0 && $pages !=0) {?>
			<form action="" method="POST">
			<div style= "margin-top: 5px" >
				<label>Page</label>
				<select id = "page_num" name="page_num" style="width: 73px" onchange="location=this.value">
					<option disabled="disabled" selected="selected">--Page--</option>
					<option value = "admin/1">1</option>
					<option value = "admin/5">5</option>
					<option value= "admin/10">10</option>
					<option value = "admin/50">50</option>
					<option value = "admin/0">All</option>
					
				</select>
				<nav aria-label = "Page navigation">
					<ul class = "pagination">
						<li>
							<?php echo "<a href = 'admin/$previous'>";?>
								<span>&laquo; Previous</span>
							</a>
						</li>
						<?php

							for($i=1 ; $i <= $pages ; $i++){?>
						<li><a href="admin/<?= $i; ?>"><?= $i ;?></a></li>
						<?php };?>
						<li>
							<?php echo "<a href = 'admin/$next'>";?>
								<span>Next</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
			</form>
		<?php }?>
		</div>
	</body>
</html>