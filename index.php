<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Index</title>
</head>
<body>
<form method="post" action="authenticate.php">
<table width="447" border="0" align="center" bgcolor="#33FF66" style="border:3px solid #008040" >
  <tr>
    <td colspan="2" align="center"> <strong><h3>User Login</h3></strong></td>
  </tr>
  <tr>
    <td width="209" height="29" align="center">Username</td>
    <td width="222"><input type="text" name="username" /></td>
  </tr>
  <tr>
    <td height="25" align="center">Password</td>
    <td><input type="password" name="pwd"/></td>
  </tr>
  <tr>
    <td height="37" align="center">&nbsp;</td>
    <td><a href="forgetpass.php"> Forget Password</a></td>
  </tr>
  <tr>
    <td height="43" align="center"><input type="checkbox" name="remember" value="remember"/>
      Remember me </td>
    <td><input type="submit" name="login" value=" Login "/></td>
  </tr>
  <tr>
    <td height="43" colspan="2" align="center">
	<?php
        if (isset($_GET["err"]))
             {
                echo "<font color='red'> Invalid Login Detail! </font>";
             }
            
   ?>
	</td>
    </tr>
</table>
<a href="register.php"><h2 align="center">Click Here To SignUp</h2></a>


</form>
</body>
</html>
