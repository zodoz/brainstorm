<?php
 $connect = mysqli_connect("localhost","brainstorm","br@inStorm!", "brainstorm");
 if(!$connect)
 {
 die("Could not connect to Database!");
 }
 $DB = mysqli_select_db($connect, 'brainstorm');
 if(!$DB)
 {
 die("Could not connect to Database!");
 }
 
 $Username = $_POST['uname'];
 $Password = $_POST['pword'];
 $Re_Password = $_POST['pword2'];

 $sqli ="SELECT * FROM Users WHERE Username ='$Username'";
 $Query = mysqli_query($connect, $sqli);
 $NumRows = mysqli_num_rows($Query);
 if($NumRows != 0)
	{
	while($Row = mysqli_fetch_assoc(Query))
		{
			$DB_Name = $Row['Username'];
		{
	}

 
if($Username == "")
 {
 die("Please enter a username!");
 }
 if($Password == "" || $Re_Password == "")
 {
 die("Please enter and re-enter a password");
 }
 if($Password != $Re_Password)
 {
 die("Your Passwords don't match, please try again!");
 }
 if($Username == $DB_Name)
 {
 die("Username already taken, please choose a different Username");
 }

$sql="INSERT INTO Users (Username, Password) VALUES ('$Username', '$Password')";
if(!mysqli_query($connect, $sql))
 {
 die("Error updating database");
 }
else
{
header("Location:login2.html");
}
 ?>
