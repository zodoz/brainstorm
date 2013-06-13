<?php
 
$connect = mysqli_connect("localhost","brainstorm","br@inStorm!", "brainstorm");
 if(!$connect)
 {
 die("Could not connect to database!");
 }
 
$DB = mysqli_select_db($connect, 'brainstorm');
 if(!$DB)
 {
 die("MySQL could not select Database!");
 }
 

 $Name = $_POST['uname'];
 $Pass = $_POST['pword'];
 $sql ="SELECT * FROM Users WHERE Username='$Name' AND Password='$Pass'";
 $Query = mysqli_query($connect, $sql);
 $NumRows = mysqli_num_rows($Query);
 $_SESSION['uname'] = $Name;
 $_SESSION['pword'] = $Pass;
 

if(empty($_SESSION['uname']) || empty($_SESSION['pword']))
 {
 die("Login to view this page");
 }
 if($Name && $Pass == "")
 {
 die("Please enter in a Name and Password");
 }
 if($Name == "")
 {
 die("Please enter in a Username");
 }
 if($Pass == "")
 {
 die("Please enter in a Password");
 }
 

if($NumRows != 0)
 {
         while($Row = mysqli_fetch_assoc($Query))
         {
         $Database_Name = $Row['Username'];
         $Database_Pass = $Row['Password'];
         }


 }
 else
 {
 die("Incorrect Username or Password!");
 }
 
if($Name == $Database_Name && $Pass == $Database_Pass)
 {
         header("Location:story.html");
 }

 

 
