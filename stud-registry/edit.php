<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
// including the database connection file
include_once("connection.php");

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	
	$name = $_POST['name'];
	$subject = $_POST['subject'];
	$mark = $_POST['mark'];	
	
	// checking empty fields
	if(empty($name) || empty($subject) || empty($mark)) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($subject)) {
			echo "<font color='red'>Quantity field is empty.</font><br/>";
		}
		
		if(empty($mark)) {
			echo "<font color='red'>mark field is empty.</font><br/>";
		}		
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE stud_details SET name='$name', subject='$subject', mark='$mark' WHERE id=$id");
		
		//redirectig to the display page. In our case, it is view.php
		header("Location: view.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM stud_details WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$name = $res['name'];
	$subject = $res['subject'];
	$mark = $res['mark'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a> | <a href="view.php">View details</a> | <a href="logout.php">Logout</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo $name;?>"></td>
			</tr>
			<tr> 
				<td>Subject</td>
				<td><input type="text" name="subject" value="<?php echo $subject;?>"></td>
			</tr>
			<tr> 
				<td>Marks</td>
				<td><input type="text" name="mark" value="<?php echo $mark;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
