<?php
$unm=$_POST['username'];
$pwd=md5($_POST['pwd']);

$con=mysql_connect("localhost","root","mysql");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

mysql_select_db("LoginApp",$con);
$qry="select * from users where username='$unm' and password ='$pwd'";
$result=mysql_query($qry);
$num=mysql_num_rows($result);

if ($num>=1)
{
 session_start();
 $_SESSION['username']=$unm;
 header("location: dashboard.php");
}
else
{
 header("location: index.php?err=1");
}
mysql_close($con);
if(!empty($_POST["remember"]))
{
setcookie ("user",$unm, time()+3600);
}
mysql_close($con);
?>

