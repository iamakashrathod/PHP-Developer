<?php
	include('connection.php'); 
	$output = '';
	if(isset($_POST["query"]))
	{
		$search = mysqli_real_escape_string($con,$_POST["query"]);
		$query = "
			SELECT * FROM student WHERE (studentFirstName LIKE '%".$search."%' OR studentLastName LIKE '%".$search."%' OR studentPhoneNumber LIKE '%".$search."%' OR studentEmailAddress LIKE '%".$search."%')
		";
	}
	else
	{
		$query = 
		"
			SELECT * FROM student WHERE studentId 
		";
	}
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0)
	{
		$output .= '
	  <div class="table-responsive" style="font-size:12px; id="customerData">
	   <table class="table table-bordered table-hover">
		<tr style="">
		 <th  style="width:10%;">Sr. No</th>
		 <th style="width:20%;">First Name</th>
		 <th style="width:20%;">Last Name</th>
		 <th style="width:20%;">Phone Number</th>
		 <th style="width:10%;">Email Address</th>
		 <th style="width:10%;">Address</th>
		 <th style="width:50%;">Action</th>
		</tr>
	 ';
	 $count=1;
	 while($row = mysqli_fetch_array($result))
	 {
		$output .= '
			<tr>
				<td style="color:#000000;">'.$count++.'</td>
				<td style="color:#000000;">'.$row[1].'</td>
				<td style="color:#000000;">'.$row[2].'</td>
				<td style="color:#000000;">'.$row[3].'</td>
				<td style="color:#000000;">'.$row[4].'</td>
				<td style="color:#000000;">'.$row[5].'</td>
				<td style="color:#000000;"><a href=ManageStudent.php?editId='.$row[0].'><i class="glyphicon glyphicon-pencil"></i> </a> |   <a onclick="myFunction('.$row[0].')"><i class="glyphicon glyphicon-trash"></i></a>
			</tr>
			  ';
	 }
	 echo $output;
	}
	else
	{
	 echo 'Data Not Found';
	}

?>


<script>
function myFunction(x) {

Notiflix.Confirm.Show( 'Remove Client', 'Do you want to remove client detail', 'Yes', 'No', function(){ window.location='ManageStudent.php?DeleteStudentId='+x; }, function(){  } );

}

</script>
