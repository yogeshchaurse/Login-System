<?php
  $msg="";
  $email=$_POST['email'];  

  $con=mysql_connect("localhost","root","mysql");
  mysql_select_db("LoginApp",$con);

  $qry="select * from users where emailid='$email'";
  $result=mysql_query($qry);
  $num=mysql_num_rows($result);
  if($num==1)
  {   $check=md5($email);
      $qry1="update users set flag='$check' where emailid='$email'";
      mysql_query($qry1);

      // Mail
      $msg="Check your email For Password reset link ";
      $to=$email;
      $subject="Password Reset Link";
      $message="Change you password by Clicking on  below link "."\n";
      $message.="http://localhost/LoginApp/forgetreset.php"."?check=".$check;
      mail($to, $subject, $message);
  }
  else
  {
    $msg="Enter Registered EmailId ";
  }
    
?>

<html>
<head>
  <title>Forget Password</title>
</head>
<body>
<form method="post" action="#">

<table width="447" border="0" align="center" bgcolor="#33FF66" style="border:3px solid #008040" >
  <tr>
    <td colspan="2" align="center"> <strong><h3>Reset Password</h3></strong></td>
  </tr>
  <tr>
    <td width="209" height="29" align="center">Enter EmailID</td>
    <td width="222"><input type="text" name="email" /></td>
  </tr>
  
  <tr>
    <td height="43" align="center"></td>
    <td><input type="submit" name="submit" value=" Submit "/></td>
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
