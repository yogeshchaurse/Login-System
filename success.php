<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Success</title>
</head>
<body>
<?php
$unm=$_SESSION['username'];
$pwd=md5($_SESSION['pwd']);
$email=$_SESSION['email'];

$con=mysql_connect("localhost","root","mysql");
if (mysqli_connect_errno())
	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}

mysql_select_db("LoginApp",$con);
$qry1="insert into users(username,password,emailid) values('$unm','$pwd','$email')";
mysql_query($qry1);
$qry2="insert into users_profile(username,emailid) values('$unm','$email')";
mysql_query($qry2);
mysql_close($con);
echo "You Have Registered Succesfully Check your mail and accept the confirmation to Continue";
session_destroy();

$to=$email;
$subject="Confirmation Link";
$message="Thanks For Registering ".$unm ."\n";
$message.="please activate your account to Login "."\n";
$message.="http://localhost/LoginApp/confirmation.php";
mail($to, $subject, $message);




?> 
</body>
</html>
