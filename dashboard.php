<?php
session_start();
$unm=$_SESSION['username'];
$con=mysql_connect("localhost","root","mysql");
mysql_select_db("LoginApp",$con);
$qry="select emailid from users where username='$unm'";
$result=mysql_query($qry);
$row=mysql_fetch_array($result);
$email=$row['emailid'];
$_SESSION['email']=$email;
mysql_close($con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dashboard</title>
</head>
<body>
<table width="787" height="760" border="1" align="center" bgcolor="#66FF66">
  <tr>
    <td width="777" height="37"><table width="772" border="1" align="center"  bgcolor="#FFFFFF">
      <tr>
        <td width="181" align="center"><a href="dashboard.php">Dashboard</a></td>
        <td width="181" align="center"><a href="update.php">Update Profile</a></td>
        <td width="181" align="center"><a href="view.php">View Profile</a></td>
        <td width="201" align="center"><a href="logout.php">Logout</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="687" valign="top">
      <div style = "text-align:left; float:right;">
      <a href="resetpass.php" align="right">Change Password</a>
      </div>
      <br>
      
	<?php 
  echo "<br>";
	echo "Welcome ".$unm;
	echo "<br>";
	echo "-----------------------------------User Info ---------------------------------------";
	echo "<br>";
	echo "Name -- ".$_SESSION['username'];
  echo "<br>";
	echo "Email Id -- ".$email; 
	?>
  


</td>
  </tr>
  
</table>

</body>
</html>
