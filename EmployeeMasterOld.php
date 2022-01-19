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
		<script src="bootstrap/js/notiflix-2.0.0.js" type="text/javascript"></script> 
		<script src="bootstrap/js/shortcuts_v1.js" type="text/javascript"></script>
		<script src="bootstrap/js/shortcuts.js" type="text/javascript"></script> 
		<script src="bootstrap/js/shortcuts.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap3-typehead.min.js"></script>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
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
				$( "#txtEmployeeName").focus();
				$( "#txtEmployeeName").keypress(function( event ) {
				if ( event.which == 13) {
					$( "#txtContact").focus();
					 return false;
				  }
				});
				$( "#txtContact").keypress(function( event ) {
				if ( event.which == 13) {
					$( "#txtAddress").focus();
					 return false;
				  }
				});
				$( "#txtAddress").keypress(function( event ) {
				if ( event.which == 13) {
					$( "#txtSalarey").focus();
					 return false;
				  }
				});
				$( "#txtSalarey").keypress(function( event ) {
				if ( event.which == 13) {
					$( "#txtDesignation").focus();
					 return false;
				  }
				});
				$( "#txtDesignation").keypress(function( event ) {
				if ( event.which == 13) {
					$( "#btnAddEmployee").focus();
					$( "#btnUpdateEmployee").focus();
					 return false;
				  }
				});
				
				$('#txtEmployeeSearch').typeahead({
				  source: function(query, result)
				  {
				   $.ajax({
					url:"fetchEmployeeMaster.php",
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
			
		</script>
	</head>
	<body>
		<?php include('Menu.php'); ?>
		<div class="container-fluid">
			<form role="form" method="POST" enctype="multipart/form-data" name="frmGetInvoiceDetail" id="frmGetInvoiceDetail">
				<?php
					if(isset($_REQUEST['editId']))
					{
						$result=mysqli_query($con,"SELECT * FROM employee_master WHERE employee_id='".$_REQUEST['editId']."'");
						while($row=mysqli_fetch_array($result))
						{
							$name=$row['name'];
							$address=$row['address'];
							$contact=$row['contact'];
							$daily_sal=$row['daily_sal'];
							$designation=$row['designation'];
						}
					}
				?>
				<div class="card">
					<div class="body">
						<div class="row">	
							<div class="col-sm-2">
								<div class="floating-label">      
									<input class="floating-input" type="text" name="txtEmployeeName"  id="txtEmployeeName" value="<?php echo $name; ?>" required tabindex="1" placeholder=" ">
									<span class="highlight"></span>
									<label> Employee Name </label>
								</div>
							</div>	
							<div class="col-sm-2">
								<div class="floating-label">      
									<input class="floating-input" type="text" name="txtContact"  id="txtContact" onkeypress="return isNumberKey(event)" value="<?php echo $contact;?>"  required  placeholder=" ">
									<span class="highlight"></span>
									<label> Contact </label>
								</div>
							</div>				
							<div class="col-sm-3">
								<div class="floating-label">      
									<input class="floating-input" type="text" name="txtAddress"  id="txtAddress" value="<?php echo $address;?>"    placeholder=" ">
									<span class="highlight"></span>
									<label> Address </label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="floating-label">      
									<input class="floating-input" type="text" name="txtSalarey"  id="txtSalarey" value="<?php echo $daily_sal;?>" required onkeypress="return isNumberKey(event)"  placeholder=" ">
									<span class="highlight"></span>
									<label> Daily Salarey  </label>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="floating-label">      
									<input class="floating-input" type="text" name="txtDesignation"  id="txtDesignation" value="<?php echo $designation;?>"    placeholder=" ">
									<span class="highlight"></span>
									<label> Designation </label>
								</div>
							</div>				
							<div class="col-sm-1">
								<?php 
									if(isset($_REQUEST['editId']))
									{
										?>
										<button class="btn btn-success" type="submit" name="btnUpdateEmployee" id="btnUpdateEmployee" value="Update" style="font-weight:bold"><span class="glyphicon glyphicon-upload"></span> Update</button>					
											
										<?php
									}
									else
									{
										?>
										<button class="btn btn-primary" type="submit" name="btnAddEmployee" id="btnAddEmployee" value="Save"  style="font-weight:bold"><span class="glyphicon glyphicon-upload"></span> Submit</button>
										<?php
											
									}	
								?>
								
								<?php 
									if(isset($_POST['btnAddEmployee']))
									{
										$result=mysqli_query($con,"INSERT INTO employee_master(name,address,contact,daily_sal,designation) VALUES('".$_POST['txtEmployeeName']."','".$_POST['txtAddress']."','".$_POST['txtContact']."','".$_POST['txtSalarey']."','".$_POST['txtDesignation']."')");
										if($result>0)
										{
											echo "<script> Notiflix.Notify.Success('Saved Successfully !...');</script>";
											
										}
										else
										{
											echo "<script> Notiflix.Notify.Failure('Error! Please try agian. '); </script>";
										}
										echo "<script>setTimeout(function(){ window.location='EmployeeMaster.php'; }, 500);</script>";

									}
									if(isset($_POST['btnUpdateEmployee']))
									{
										$result=mysqli_query($con,"UPDATE employee_master SET name='".$_POST['txtEmployeeName']."',address='".$_POST['txtAddress']."',contact='".$_POST['txtContact']."',daily_sal='".$_POST['txtSalarey']."',designation='".$_POST['txtDesignation']."'WHERE employee_id='".$_REQUEST['editId']."'");
										if($result>0)
										{
											echo "<script> Notiflix.Notify.Success('Updated Successfully !...');</script>";
										}
										else
										{
											echo "<script> Notiflix.Notify.Failure('Error! Please try agian. '); </script>";
										}
										echo "<script>setTimeout(function(){ window.location='EmployeeMaster.php'; }, 500);</script>";
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
								<th>Employee Name</th>
								<th>Address</th>
								<th>Contact</th>
								<th>Salarey</th>
								<th>Designation</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
							<!--PHP -->
							<?php 
								$result=mysqli_query($con,"SELECT * FROM employee_master");
								while($row=mysqli_fetch_array($result))
								{
									?>
										<tr style="color:#000000;">
											<td class="AliceBlue"><?php echo $row['name']?></td>
											<td class="AliceBlue"><?php echo $row['address']?></td>
											<td class="AliceBlue"><?php echo $row['contact']?></td>
											<td class="AliceBlue"><?php echo $row['daily_sal']?></td>
											<td class="AliceBlue"><?php echo $row['designation']?></td>
											<td class="AliceBlue"><a href="?editId=<?php echo $row['employee_id'];?>"><span><button type="submit" class="btn btn-warning btn-sm glyphicon glyphicon-pencil"> EditEmployeeInfo</button></span></a></td>
											<td class="AliceBlue"><a href="?DeleteEmployeeId=<?php echo $row['employee_id'];?>" onclick="return confirm('Are you sure Delete the data item?')"><span><button type="submit" class="btn btn-danger btn-sm glyphicon glyphicon-trash"> DeleteEmployeeInfo</button></span></a></td>
										</tr>
									<?php
								}
							?>
											
							<?php
								if(isset($_REQUEST['DeleteEmployeeId']))
								{
									$removeEmployee=mysqli_query($con,"DELETE FROM employee_master WHERE employee_id='".$_REQUEST['DeleteEmployeeId']."'");
									if($removeEmployee>0)
									{
										echo "<script> Notiflix.Notify.Success('Removed Successfully !...');</script>";
									}
									else
									{
										echo "<script> Notiflix.Notify.Failure('Error! Please try agian. '); </script>";
									}
									echo "<script>setTimeout(function(){ window.location='EmployeeMaster.php'; }, 500);</script>";
									
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
						txtEmployeeName: {
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
						txtSalarey: {
							validators: {
								notEmpty: {
									message: 'Please enter amount'
								}
							}
						},
						txtDesignation: {
							validators: {
								notEmpty: {
									message: 'Please enter designation'
								}
							}
						},
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