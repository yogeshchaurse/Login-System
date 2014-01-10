<?php
  session_start();
  $unm=$_SESSION['username'];
  $email=$_SESSION['email'];
  $msg="";
  $oldpwd=md5($_POST["oldpwd"]);
  $newpwd=md5($_POST["newpwd"]);
  $cnfrmpwd=md5($_POST["cnfrmpwd"]);

  $con=mysql_connect("localhost","root","mysql");
  mysql_select_db("LoginApp",$con);

  $qry="select * from users where password='$oldpwd'";
  $result=mysql_query($qry);
  $num=mysql_num_rows($result);
  if($num>0)
  {

    if($newpwd==$cnfrmpwd)
    {
      $qry1="update users set password='$newpwd' where username='$unm'";
      mysql_query($qry1);
      mysql_close($con);
      $msg="Password Reset   "."<a href='logout.php'> Login Again </a>";
      $to=$email;
      $subject="Password Changed";
      $message="Your Password is Changed ".$unm ."\n";
      $message.="your new Password is ".$_POST["newpwd"]." Click on the link to login" ."\n";
      $message.="http://localhost/LoginApp/index.php";
      mail($to, $subject, $message);
    }
    else
    {
      $msg="Password not matched";
    }
    
  }
  else
  {
    $msg=" Old password Incorrect ";
  }
?>

<html>
<head>
  <title>ResetPassword</title>
</head>
<body>
<form method="post" action="#">

<table width="447" border="0" align="center" bgcolor="#33FF66" style="border:3px solid #008040" >
  <tr>
    <td colspan="2" align="center"> <strong><h3>Change Password</h3></strong></td>
  </tr>
  <tr>
    <td width="209" height="29" align="center">old Password</td>
    <td width="222"><input type="password" name="oldpwd" /></td>
  </tr>
  <tr>
    <td height="25" align="center">New Password</td>
    <td><input type="password" name="newpwd"/></td>
  </tr>
  <tr>
    <td height="25" align="center">Confirm Password</td>
    <td><input type="password" name="cnfrmpwd"/></td>
  </tr>
  <tr>
    <td height="43" align="center"></td>
    <td><input type="submit" name="reset" value=" Reset "/></td>
  </tr>
  <tr>
    <td height="43" colspan="2" align="center">
  <?php
                if(!($msg==""))
                {
                  echo "<font color='red'>".$msg."</font>";  
                }
                
            
   ?>
  </td>
    </tr>
</table>
</form>
</body>
</html>
