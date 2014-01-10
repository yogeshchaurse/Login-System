<?php
  $msg="";
  $check=$_GET['check'];
  $newpwd=md5($_POST["newpwd"]);
  $cnfrmpwd=md5($_POST["cnfrmpwd"]);

  $con=mysql_connect("localhost","root","mysql");
  mysql_select_db("LoginApp",$con);
  $qry="select * from users where flag='$check'";
  $result=mysql_query($qry);
  $num=mysql_num_rows($result);
  if($num==1)
  {

    if($newpwd==$cnfrmpwd)
    {
      $qry1="update users set password='$newpwd' where flag='$check'";
      mysql_query($qry1);
      $qry2="select emailid from users where flag='$check'";
      $res=mysql_query($qry2);
      $row=mysql_fetch_array($res);
      $email=$row['emailid'];
      $msg="Password Reset ";
      $to=$email;
      $subject="Password Changed";
      $message="Your Password is Changed "."\n";
      $message.="your new Password is ".$_POST["newpwd"]." Click on the link to login" ."\n";
      $message.="http://localhost/LoginApp/index.php";
      mail($to, $subject, $message);
      mysql_close($con);
    }
    else
    {
      $msg="Password not matched";
    }
    
  }
  else
  {
    $msg="not valid link";
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
    <td colspan="2" align="center"> <strong><h3>Reset Password</h3></strong></td>
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
