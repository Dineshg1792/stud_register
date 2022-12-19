<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("connection.php");

if(isset($_POST['Submit'])) {	
	$name = $_POST['name'];
	$subject = $_POST['subject'];
	$mark = $_POST['mark'];
	$loginId = $_SESSION['id'];
		
	// checking empty fields
	if(empty($name) || empty($subject) || empty($mark)) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($subject)) {
			echo "<font color='red'>Subject field is empty.</font><br/>";
		}
		
		if(empty($mark)) {
			echo "<font color='red'>Mark field is empty.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO stud_details(name, subject, mark, login_id) VALUES('$name','$subject','$mark', '$loginId')");
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='view.php'>View Result</a>";
	}
}
?>
</body>
</html>
