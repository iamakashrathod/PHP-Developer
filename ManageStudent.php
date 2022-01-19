<?php include('connection.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="Assets/css/style.css"/>
  <link rel="stylesheet" href="Assets/css/bootstrapValidator.min.css"/>
  <script type="text/javascript" src="Assets/js/bootstrapValidator.min.js"></script>
  <link rel="stylesheet" href="Assets/css/notiflix-2.0.0.css"/>
  <script type="text/javascript" src="Assets/js/notiflix-2.0.0.js"></script>
</head>
<body>

  <script>
					
		
			
			$(document).ready(function()
			{  
				
				
			 load_data();

			 function load_data(query)
			 {
			  $.ajax({
			   url:"fetchStudentTable.php",
			   method:"POST",
			   data:{query:query},
			   success:function(data)
			   {
				$('#result').html(data);
			   }
			  });
			 }
			 
		});
					
		</script>

<?php
	//include('menu.php');
?>

<div class="container-fluid"><br>
	<?php
		if(isset($_REQUEST['editId']))
		{
			$getstudent=mysqli_query($con,"SELECT * FROM student WHERE studentId='".$_REQUEST['editId']."'");
			while($Row=mysqli_fetch_array($getstudent))
			{
				 $studentFirstName=$Row['studentFirstName'];
				 $studentLastName=$Row['studentLastName'];
				 $studentPhoneNumber=$Row['studentPhoneNumber'];
				 $studentEmailAddress=$Row['studentEmailAddress'];
				 $studentAddress=$Row['studentAddress'];
			}
		}
	?>
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Register Here</b></div>
				<div class="panel-body">
					<form id="defaultForm" method="post" class="form-horizontal">
						<div class="row">
							<div class="col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="col-sm-12 lab">First Name</label>
									<div class="col-xs-12">
										<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Enter First Name" value="<?php echo $studentFirstName; ?> "/>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="col-sm-12 lab">Last Name</label>
									<div class="col-xs-12">
										<input type="text" class="form-control" name="txtLastName" id="txtLastName" value="<?php echo $studentLastName; ?> "/>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="col-sm-12 lab">Phone Number</label>
									<div class="col-xs-12">
										<input type="text" class="form-control" name="txtPhoneNumber" id="txtPhoneNumber" value="<?php echo $studentPhoneNumber; ?>"/>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="col-sm-12 lab">Email Address</label>
									<div class="col-xs-12">
										<input type="text" class="form-control" name="txtEmailAddress" id="txtEmailAddress" value="<?php echo $studentEmailAddress; ?>"/>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="col-sm-12 lab">Address</label>
									<div class="col-xs-12">
										<input type="text" class="form-control" name="txtAddress" id="txtAddress" value="<?php echo $studentAddress; ?>"/>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12">
								<div class="form-group">
									<label class="col-sm-12">&nbsp;</label>
									<div class="col-xs-12">
									<?php
										if(isset($_REQUEST['editId']))
										{
											?>
												<center><button type="submit" name="btnUpdateDetail" id="btnUpdateDetail" style="width:100% !important" class="btn btn-success">Update</button></center>
											<?php
										}
										else
										{
											?>
												<center><button type="submit" name="btnSaveDetail" id="btnSaveDetail" style="width:100% !important" class="btn btn-primary">Sign up</button></center>

											<?php
										}
									?>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<?php
		if(isset($_POST['btnSaveDetail']))
		{
			if(!mysqli_query($con,"INSERT INTO student(studentFirstName,studentLastName,studentPhoneNumber,studentEmailAddress,studentAddress) VALUES('".$_POST['txtFirstName']."','".$_POST['txtLastName']."','".$_POST['txtPhoneNumber']."','".$_POST['txtEmailAddress']."','".$_POST['txtAddress']."')"))
			displayError(mysqli_error($con)); 
			{
				echo "<script> Notiflix.Notify.Success('Saved Successfully !...');</script>";
			}
			echo "<script>setTimeout(function(){ window.location='ManageStudent.php'; }, 500);</script>";
		}
		if(isset($_POST['btnUpdateDetail']))
		{
			if(!mysqli_query($con,"UPDATE student SET studentFirstName='".$_POST['txtFirstName']."',studentLastName='".$_POST['txtLastName']."',studentPhoneNumber='".$_POST['txtPhoneNumber']."',studentEmailAddress='".$_POST['txtEmailAddress']."',studentAddress='".$_POST['txtAddress']."' WHERE studentId ='".$_REQUEST['editId']."'"))
			displayError(mysqli_error($con)); 
			{
				echo "<script> Notiflix.Notify.Success('Update Successfully !...');</script>";	
			}
			echo "<script>setTimeout(function(){ window.location='ManageStudent.php'; }, 500);</script>";
		}
		if(isset($_REQUEST['DeleteStudentId']))
		{
			if(!mysqli_query($con,"DELETE FROM student WHERE studentId ='".$_REQUEST['DeleteStudentId']."'"))
			echo "<script>window.location='ManageStudent.php';</script>";
		}
		
	?>
</div>
<div class="row" id="result"></div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#defaultForm').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
			 txtFirstName: {
                message: 'First name is not valid',
                validators: {
                    notEmpty: {
                        message: 'First name is required'
                    }
                    
                }
            },
			txtLastName: {
                message: 'Last name is not valid',
                validators: {
                    notEmpty: {
                        message: 'Last name is required'
                    }
                    
                }
            },
			txtPhoneNumber: {
                message: 'Phone no is not valid',
                validators: {
                    notEmpty: {
                        message: 'Phone no is required'
                    },
                    stringLength: {
                        min: 10,
                        max: 10,
                        message: 'The phone no must be 10 characters long'
                    },
                    regexp: {
                        regexp: /^[7-9][0-9]+$/,
                        message: 'The phone no can only consist of number'
                    }
                }
            },
            txtEmailAddress: {
                validators: {
                    notEmpty: {
                        message: 'Email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
			txtAddress: {
                message: 'Student address is not valid',
                validators: {
                    notEmpty: {
                        message: 'Studnt address is required'
                    }
                    
                }
            }, 			
        }
    });
});
</script>
</body>
</html>
