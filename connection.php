<?php
	error_reporting(E_PARSE);
	session_start();
	$con = mysqli_connect("127.0.0.1","root","","users") or die(mysqli_error($con));
	function displayError($error)
	{
		?>
			<div class="row">
				<div class="col-sm-12">
					<?php echo "<span style='color:red;border-style:dashed;border-width:1px;padding:10px;border-radius:4px;position:absolute;bottom:15;right:0;'> <b>Error Log :</b> ".$error."</span>"; ?>
				</div>
			</div>
		<?php
	}	
?>