<?php

include_once 'Model.php';

$model = new Model();

$result = $model->getAll();

?>

<html>
	<head>
		<title>Performance Technologies</title>
		<link href="index.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<table>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>City</th>
					<th>Postal</th>
					<th>Street/Number</th>
					<th>Country</th>
				</tr>
				<?php
				foreach ($result as $item){
				?>
				<tr>
					<td><?php echo $item['first_name']?></td>
					<td><?php echo $item['last_name']?></td>
					<td><?php echo $item['city']?></td>
					<td><?php echo $item['postal']?></td>
					<td><?php echo $item['street']?></td>
					<td><?php echo $item['country']?></td>
				</tr>
				
				<?php
				}
				?>
			</table>
		</div>
	</body>
</html>	

