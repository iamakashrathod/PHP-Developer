<?php include("connection.php"); ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
		<link rel="stylesheet" href="bootstrap/css/notiflix-2.0.0.css">
		<script src="bootstrap/js/bootstrap3-typeahead.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/jquery-ui.js" type="text/javascript"></script>
		<script src="bootstrap/js/jquery-ui.min.js" type="text/javascript"></script>
		<link href="bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css" /> 
		<link rel="stylesheet" href="bootstrap/flotting.css">
		<!--
		<link rel="stylesheet" href="bootstrap/style1.css">
		-->
		<script src="bootstrap/js/notiflix-2.0.0.js" type="text/javascript"></script> 
		<script src="bootstrap/js/shortcuts_v1.js" type="text/javascript"></script>
		<script src="bootstrap/js/shortcuts.js" type="text/javascript"></script> 
		<!-- Validation scripts -->
		<link href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css" rel="stylesheet" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js"></script>
		<script> history.pushState(null, null, document.title); window.addEventListener('popstate', function () { history.pushState(null, null, document.title); });</script> 	
			
		<style>
			.help-block 
			{
				display: block;
				margin-top: 5px;
				margin-bottom: 10px;
				color: #ff0000;
			}
			
			tr 
			{
				color: #FFFFFF;
			}
		</style>
			
		<script>
				
			/*function isNumberKey(evt)
			{
				var charCode = (evt.which) ? evt.which : event.keyCode
				if (charCode > 31 && (charCode < 46 || charCode > 57))
				return false;
				
				return true;
			}
			
			function isCharKey(evt)
			{
				var charCode = (evt.which) ? evt.which : event.keyCode
				if ((charCode > 64 && (charCode < 91)) || (charCode > 96 || charCode> 123))
				return true;
				
				return false;
			}*/
			
			$(document).ready(function()
			{  
				$( "#txtCustomerName").focus();
				$( "#txtCustomerName").keypress(function( event ) {
				if ( event.which == 13) {
					$( "#txtContact").focus();
					 return false;
				  }
				});
				$( "#txtContact").keypress(function( event ) {
				if ( event.which == 13) {
					$( "#txtCardNo").focus();
					 return false;
				  }
				});
					
				$( "#txtCardNo").keypress(function( event ) {
				if ( event.which == 13) {
					$( "#txtAddress").focus();
					 return false;
				  }
				});
				$( "#txtAddress").keypress(function( event ) {
				if ( event.which == 13) {
					$( "#txtDepositAmount").focus();
					 return false;
				  }
				});
				
				$( "#txtDepositAmount").keypress(function( event ) {
				if ( event.which == 13) {
					$( "#txtPlanName").focus();
					
					 return false;
				  }
				});
					
				$( "#txtPlanName").keypress(function( event ) {
				if ( event.which == 13) {
					$( "#txtVehicleNumber").focus();
					
					 return false;
				  }
				});
				
				$( "#txtVehicleNumber").keypress(function( event ) {
				if ( event.which == 13) {
					$( "#btnAddCustomer").focus();
					$( "#btnUpdateCustomer").focus();
					 return false;
				  }
				});
				
				$('#txtVehicleNumber').typeahead({
				source: function(query, result)
				{
					$.ajax({
					url:"fetchVehicleNor.php",
					method:"POST",
					data:{query:query},
					dataType:"json",
					success:function(data)
					{
						result($.map(data, function(item){
						return item;
						}));
					}
				  })
				}
				});
				 
				$('#txtPlanName').typeahead({
				source: function(query, result)
				{
					$.ajax({
					url:"fetchPlanName.php",
					method:"POST",
					data:{query:query},
					dataType:"json",
					success:function(data)
					{
						result($.map(data, function(item){
						return item;
						}));
					}
				  })
				}
				});	
			});
				
			$(document).ready(function(){

			 load_data();

			 function load_data(query)
			 {
			  $.ajax({
			   url:"fetchClientTable.php",
			   method:"POST",
			   data:{query:query},
			   success:function(data)
			   {
				$('#result').html(data);
			   }
			  });
			 }
			 $('#txtClientSearch').keyup(function(){
			  var search = $(this).val();
			  if(search != '')
			  {
			   load_data(search);
			  }
			  else
			  {
			   load_data();
			  }
			 });
			});	
					
		</script>
	</head>
	<body>
		<?php include('Menu.php'); ?>
		<div class="container-fluid">
			<form role="form" method="POST" enctype="multipart/form-data" name="frmGetInvoiceDetail" id="frmGetInvoiceDetail">
				<?php
					if(isset($_REQUEST['editId']))
					{
						$result=mysqli_query($con,"SELECT CM.name,CM.vehicle_id,CM.contact,CM.card_no,CM.address,CM.deposit_amount,PM.plan_name,PM.rate,CM.customer_id,CM.vehicle_id FROM customer_master CM,plan_master PM WHERE CM.plan_id=PM.plan_id AND customer_id='".$_REQUEST['editId']."'");
						while($row=mysqli_fetch_array($result))
						{
							$name=$row['name'];
							$contact=$row['contact'];
							$card_no=$row['card_no'];
							$address=$row['address'];
							$deposit_amount=$row['deposit_amount'];
							$plan_name=$row['plan_name'];
							$getvehicleName=mysqli_query($con,"SELECT vehicle_number FROM vehicle_master WHERE vehicle_id='$row[9]'");
							while($vehicleRow=mysqli_fetch_array($getvehicleName))
							{
								$vehicle_number=$vehicleRow[0];
							}				
						}
					}
				?>
				<div class="card">
					<div class="body">
						<div class="row">	
							<div class="col-sm-2">
								<div class="floating-label">      
								  <input class="floating-input" type="text" name="txtCustomerName"  id="txtCustomerName" value="<?php echo $name; ?>" required tabindex="1" placeholder=" ">
								  <span class="highlight"></span>
								  <label> Customer Name </label>
								</div>
							</div>	
							<div class="col-sm-2">
								<div class="floating-label">      
								  <input class="floating-input" type="text" name="txtContact"  id="txtContact" onkeypress="return isNumberKey(event)" value="<?php echo $contact;?>" required placeholder=" ">
								  <span class="highlight"></span>
								  <label> Contact </label>
								</div>
							</div>				
							<div class="col-sm-2">
								<div class="floating-label">      
									<input class="floating-input" type="text" name="txtCardNo"  id="txtCardNo" value="<?php echo $card_no;?>" required placeholder=" ">
									<span class="highlight"></span>
									<label> Card No  </label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="floating-label">      
									<input class="floating-input" type="text" name="txtAddress"  id="txtAddress" value="<?php echo $address;?>" required placeholder=" ">
									<span class="highlight"></span>
									<label> Address </label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="floating-label">      
									<input class="floating-input" type="text" name="txtDepositAmount"  id="txtDepositAmount" value="<?php echo $deposit_amount;?>" required placeholder=" ">
									<span class="highlight"></span>
									<label> Deposit Amount </label>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="floating-label">      
									<input class="floating-input" type="text" name="txtPlanName"  id="txtPlanName" value="<?php echo $plan_name;?>" required placeholder=" ">
									<span class="highlight"></span>
									<label> Plan Name </label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="floating-label">      
									<input class="floating-input" type="text" name="txtVehicleNumber"  id="txtVehicleNumber" value="<?php echo $vehicle_number;?>" required placeholder=" ">
									<span class="highlight"></span>
									<label> Vehicle Number </label>
								</div>
							</div>

							<div class="col-sm-1">
								<?php 
									if(isset($_REQUEST['editId']))
									{
										?>
										    <button class="btn btn-success" type="submit" name="btnUpdateCustomer" id="btnUpdateCustomer" value="Update" style="font-weight:bold"><span class="glyphicon glyphicon-upload"></span> Update</button>
										<?php
									}
									else
									{
										?>
											<button class="btn btn-primary" type="submit" name="btnAddCustomer" id="btnAddCustomer" value="Save"  style="font-weight:bold"><span class="glyphicon glyphicon-upload"></span> Submit</button>
										<?php
												
									}		
								?>	
									
								<?php 
									if(isset($_POST['btnAddCustomer']))
									{
										$getplanid=mysqli_query($con,"SELECT plan_id,rate FROM plan_master WHERE plan_name='".$_POST['txtPlanName']."'");
										while($planRow=mysqli_fetch_array($getplanid))
										{
											$plan=$planRow[0];
											$rate=$planRow[1];
										}
										$getvehicleId=mysqli_query($con,"SELECT vehicle_id FROM vehicle_master WHERE vehicle_number='".$_POST['txtVehicleNumber']."'");
										while($vehicleRow=mysqli_fetch_array($getvehicleId))
										{
											$vehicle=$vehicleRow[0];
										}
										$saveData=mysqli_query($con,"INSERT INTO customer_master(name,contact,card_no,address,deposit_amount,plan_id,plan_rate,vehicle_id) VALUES('".$_POST['txtCustomerName']."','".$_POST['txtContact']."','".$_POST['txtCardNo']."','".$_POST['txtAddress']."','".$_POST['txtDepositAmount']."','$plan','$rate','$vehicle')");
										if($saveData>0)
										{
											echo "<script> Notiflix.Notify.Success('Saved Successfully !...');</script>";
											
										}
										else
										{
											echo "<script> Notiflix.Notify.Failure('Error! Please try agian. '); </script>";
										}
										echo "<script>setTimeout(function(){ window.location='ManageCustomer.php'; }, 500);</script>";
									}
									if(isset($_POST['btnUpdateCustomer']))
									{
										//$result=mysqli_query($con,"UPDATE customer_master SET name='".$_POST['txtCustomerName']."',contact='".$_POST['txtContact']."',card_no='".$_POST['txtCardNo']."',address='".$_POST['txtAddress']."',deposit_amount='".$_POST['txtDepositAmount']."'WHERE customer_id='".$_REQUEST['editId']."'");
										$getplanid=mysqli_query($con,"SELECT plan_id,rate FROM plan_master WHERE plan_name='".$_POST['txtPlanName']."'");
										while($planRow=mysqli_fetch_array($getplanid))
										{
											$plan=$planRow[0];
											$rate=$planRow[1];
										}
										$getvehicleId=mysqli_query($con,"SELECT vehicle_id FROM vehicle_master WHERE vehicle_number='".$_POST['txtVehicleNumber']."'");
										while($vehicleRow=mysqli_fetch_array($getvehicleId))
										{
											$vehicle=$vehicleRow[0];
										}
										//$result=mysqli_query($con,"UPDATE customer_master SET name='".$_POST['txtCustomerName']."',contact='".$_POST['txtContact']."',card_no='".$_POST['txtCardNo']."',address='".$_POST['txtAddress']."',plan_id='$plan',vehicle_id='$vehicle',deposit_amount='".$_POST['txtDepositAmount']."' WHERE customer_id='".$_REQUEST['editId']."'");
										$result=mysqli_query($con,"UPDATE customer_master SET name='".$_POST['txtCustomerName']."',contact='".$_POST['txtContact']."',card_no='".$_POST['txtCardNo']."',address='".$_POST['txtAddress']."',deposit_amount='".$_POST['txtDepositAmount']."',plan_id='$plan',plan_rate='$rate',vehicle_id='$vehicle' WHERE customer_id='".$_REQUEST['editId']."'");
										if($result>0)
										{
											echo "<script> Notiflix.Notify.Success('Updated Successfully !...');</script>";
										}
										else
										{
											echo "<script> Notiflix.Notify.Failure('Error! Please try agian. '); </script>";
										}
										echo "<script>setTimeout(function(){ window.location='ManageCustomer.php'; }, 500);</script>";
										//header("location: ManageCustomer.php");
									}
								?>
							</div>
						</div>
					</div>
				</div>	
			</form>
			<br>
			<div class="row" id="result"></div>
			<div class="row">
				<div class="col-sm-12">
					<table class="table table-bordered table-hover">
						<div class="table-responsive" style="font-size:12px;">
							<tr style="background-color:rgb(0, 67, 105);">
								<th>Customer Name</th>
								<th>Vehicle Number</th>
								<th>Contact</th>
								<th>CardNo</th>
								<th>Address</th>
								<th>Deposit Amount</th>
								<th>Plan Rate</th>
								<th>Plan Name</th>
								<th colspan="2"><center>Action</center></th>
								
							</tr>
							<!--PHP -->
							<?php 
								$result=mysqli_query($con,"SELECT CM.name,CM.vehicle_id,CM.contact,CM.card_no,CM.address,CM.deposit_amount,PM.plan_name,PM.rate,CM.customer_id FROM customer_master CM,plan_master PM WHERE CM.plan_id=PM.plan_id");
								//$result=mysqli_query($con,"SELECT * FROM customer_master ");
								while($row=mysqli_fetch_array($result))
								{
									?>
										<tr style="color:#000000;">
											<td><?php echo $row['name']?></td>
											<td>
												<?php 
													$getVehicle=mysqli_query($con,"SELECT * FROM vehicle_master WHERE vehicle_id='$row[1]'");
													while($vehicleRow=mysqli_fetch_array($getVehicle))
													{
														echo $vehicleRow[1];
													}
												?>
											</td>
											<td><?php echo $row['contact']?></td>
											<td><?php echo $row['card_no']?></td>
											<td><?php echo $row['address']?></td>
											<td><?php echo $row['deposit_amount']?></td>
											<td><?php echo $row['rate']?></td>
											<td><?php echo $row['plan_name']?></td>
											<td><a href="?editId=<?php echo $row['customer_id']; ?>"><span><button type="button" class="btn btn-warning btn-sm glyphicon glyphicon-pencil"> EditClientInfo</button></span></a></td>
											<td><a href="?DeleteCustomerId=<?php echo $row['customer_id'];?>" onclick="return confirm('Are you sure Delete the data item?')"><span><button type="button" class="btn btn-danger btn-sm glyphicon glyphicon-trash"> DeleteClientInfo</button></span></a></td>
										</tr>
									<?php
								}
							?>
										
							<?php
								if(isset($_REQUEST['DeleteCustomerId']))
								{
									$removeCustomer=mysqli_query($con,"DELETE FROM customer_master WHERE customer_id='".$_REQUEST['DeleteCustomerId']."'");
									if($removeCustomer>0)
									{
										echo "<script> Notiflix.Notify.Success('Removed Successfully !...');</script>";
									}
									else
									{
										echo "<script> Notiflix.Notify.Failure('Error! Please try agian. '); </script>";
									}
									echo "<script>setTimeout(function(){ window.location='ManageCustomer.php'; }, 500);</script>";
									//header("location:ManageCustomer.php");
								}
							?>
						</div>	
					</table>
				</div>
			</div>	
		</div>
		<!-- Validation -->
		
		<script>
			$(document).ready(function() {
				$('#frmGetInvoiceDetail').bootstrapValidator({
					// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
					feedbackIcons: {
						valid: 'glyphicon glyphicon-ok',
						invalid: 'glyphicon glyphicon-remove',
						validating: 'glyphicon glyphicon-refresh'
					},
					fields: {
						txtCustomerName: {
							validators: {
									stringLength: {
									min: 2,
								},
								regexp: {
									regexp: /^[a-zA-Z ]+$/,
									message: 'Not used number'
								},
									notEmpty: {
									message: 'Please enter your first name'
								}
							}
						},
						txtContact: {
							validators: {
								notEmpty: {
									message: 'Please enter your phone number'
								},
								regexp: {
									regexp: /^[0-9]/,
									message: 'Please Enter vaild phone number'
								},
								phone: {
									country: 'IN',
									message: 'Please enter a vaild phone number with area code'
								}
							}
						},
						
						txtCardNo: {
							validators: {
								notEmpty: {
									message: 'Please enter card number'
								}
							}
						},
						
						txtAddress: {
							validators: {
								 stringLength: {
									min: 8,
								},
								notEmpty: {
									message: 'Please enter your address'
								}
							}
						},
						txtDepositAmount: {
							validators: {
								notEmpty: {
									message: 'Please enter amount'
								}
							}
						},
						txtPlanName: {
							validators: {
								notEmpty: {
									message: 'Please enter plan name'
								}
							}
						},
						txtVehicleNumber: {
							validators: {
								  
								notEmpty: {
									message: 'Please enter vehicle number'
								}
								}
							}
						}
					})
					.on('success.form.bv', function(e) {
						$('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
							$('#frmGetInvoiceDetail').data('bootstrapValidator').resetForm();

						// Prevent form submission
						e.preventDefault();

						// Get the form instance
						var $form = $(e.target);

						// Get the BootstrapValidator instance
						var bv = $form.data('bootstrapValidator');

						// Use Ajax to submit form data
						$.post($form.attr('action'), $form.serialize(), function(result) {
							console.log(result);
						}, 'json');
					});
			});

		</script>
		<!-- Validation -->
	</body>
</html> 