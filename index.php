<?php
include_once 'Validator.php';
include_once 'Model.php';

$error = false;
$validationErrors = [];
$inputData = [];


if(isset($_POST) and !empty($_POST)){
	$validatorObj = new Validator();
	$inputData = $validatorObj->filteredData;
	try{
		if(!$validatorObj->isValid()){
			$validationErrors = $validatorObj->validationErrors;
		}else{
			$model = new Model();
			$model->insert($inputData);
			header("Location: /result.php");
			exit();
		}
	}catch(Exception $e){
		$error = $e->getMessage();
	}
}

?>
<html>
	<head>
		<title>Performance Technologies</title>
		<link href="index.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<h3>Fill the form</h3>
			<h3 class="error">
				<?php if($error){
					echo $error;
				}?>
			</h3>				
			<form method="POST" action="/">
			<div class="form-item">	
				<label>First Name</label>
				<input type="text" name="first_name" value="<?php echo (isset($inputData['first_name']))?$inputData['first_name']:''?>" />
				<?php if(isset($validationErrors['first_name'])){
					foreach($validationErrors['first_name'] as $err){
				?>
					<p class="error"><?php echo $err;?></p>
				<?php
					}
				}
				?>
				
			</div>
			
			<div class="form-item">	
				<label>Last Name</label>
				<input type="text" name="last_name" value="<?php echo (isset($inputData['last_name']))?$inputData['last_name']:''?>" />
				<?php if(isset($validationErrors['last_name'])){
					foreach($validationErrors['last_name'] as $err){
				?>
					<p class="error"><?php echo $err;?></p>
				<?php
					}
				}
				?>
			</div>
			
			<div class="form-item">	
				<label>Street/Number</label>
				<input type="text" name="street" value="<?php echo (isset($inputData['street']))?$inputData['street']:''?>" />
				<?php if(isset($validationErrors['street'])){
					foreach($validationErrors['street'] as $err){
				?>
					<p class="error"><?php echo $err;?></p>
				<?php
					}
				}
				?>
			</div>
				
			<div class="form-item">	
				<label>Postal Code</label>
				<input type="text" name="postal" value="<?php echo (isset($inputData['postal']))?$inputData['postal']:''?>" />
				<?php if(isset($validationErrors['postal'])){
					foreach($validationErrors['postal'] as $err){
				?>
					<p class="error"><?php echo $err;?></p>
				<?php
					}
				}
				?>
			</div>
				
			<div class="form-item">	
				<label>City</label>
				<input type="text" name="city" value="<?php echo (isset($inputData['city']))?$inputData['city']:''?>" />
				<?php if(isset($validationErrors['city'])){
					foreach($validationErrors['city'] as $err){
				?>
					<p class="error"><?php echo $err;?></p>
				<?php
					}
				}
				?>
			</div>
				
			<div class="form-item">	
				<label>Country</label>
				<select name="country">
					<option value="Germany">Germany</option>
				</select>
				<?php if(isset($validationErrors['country'])){
					foreach($validationErrors['country'] as $err){
				?>
					<p class="error"><?php echo $err;?></p>
				<?php
					}
				}
				?>
			</div>
			
			<div class="form-item">	
				<button type="submit">Send</button>
			</div>	
			</form>
		</div>
	</body>
</html>