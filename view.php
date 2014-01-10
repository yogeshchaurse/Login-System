<?php
session_start();
$unm=$_SESSION['username']; 
$con=mysql_connect("localhost","root","mysql");
  mysql_select_db("LoginApp",$con);
  $qry1="Select * from users_profile where username='$unm'";
  $result=mysql_query($qry1);
  $row=mysql_fetch_array($result);
  $unm=$row['username'];
  $firstname=$row['firstname'];
  $lastname=$row['lastname'];
  $dob=$row['birthdate'];
  
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>
<table width="787" height="760" border="1" align="center" bgcolor="#66FF66">
  <tr>
    <td width="777" height="37">
      <table width="772" border="1" align="center"  bgcolor="#FFFFFF">
      <tr>
        <td width="181" align="center"><a href="dashboard.php">Dashboard</a></td>
        <td width="181" align="center"><a href="update.php">Update Profile</a></td>
        <td width="181" align="center"><a href="view.php">View Profile</a></td>
        <td width="201" align="center"><a href="logout.php">Logout</a></td>
      </tr>
    </table>
  </td>
  </tr>
  <tr>
    <td valign="top">
      <table width="724" height="353" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td width="225" align="right">First Name </td>
    <td width="252" align="center"><?php echo $firstname; ?></td>
  </tr>

  <tr>
    <td width="225" align="right">Last Name </td>
    <td width="252" align="center"><?php echo $lastname; ?></td>
  </tr>

  <tr>
    <td width="225" align="right">User Name </td>
    <td width="252" align="center"><?php echo $unm; ?></td>
  </tr>

  <tr>
    <td width="225" align="right">Date Of Birth</td>
    <td width="252" align="center"><?php echo $dob; ?></td>
  </tr>

  <tr>
    <td width="225" align="right">Email ID</td>
    <td width="252" align="center"><?php echo $_SESSION['email']; ?></td>
  </tr>
</table>
</td>
</tr>
  
</table>

  <tr>
    <td height="687">&nbsp;</td>
  </tr>
  
</table>


    </td>
  </tr>
</table>
</body>
</html>
