<?php
 $connect = mysqli_connect("68.178.140.225","ZtrandedDatabase","Ztranded!1", "ZtrandedDatabase");
 if(!$connect)
 {
 die("Could not connect to Database!");
 }
 $DB = mysqli_select_db($connect, 'ZtrandedDatabase');
 if(!$DB)
 {
 die("Could not connect to Database!");
 }
 
$Username = $_POST['uname'];
 $Password = $_POST['pword'];
 $Re_Password = $_POST['pword2'];
 
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
 
$sql="INSERT INTO Users (username, password) VALUES ('$Username', '$Password')";
if(!mysqli_query($connect, $sql))
 {
 die("Error updating database");
 }
else
{
header("Location:login2.html");
}
 ?>