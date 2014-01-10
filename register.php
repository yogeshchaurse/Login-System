<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SignUp</title>
</head>
<body>
<?php
$cnt=0;
$usernameErr = $pwdErr = $cnfrmpwdErr = $emailErr = $acceptErr="";
$username= $pwd = $cnfrmpwd = $email = $accept="";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (empty($_POST["username"]))
    {
	 $usernameErr = "Username is required";
	}
  	else
    {
	 	$username = test_input($_POST["username"]);
	 	if (!preg_match("/(?=.*[a-z])(?=.*[^a-zA-Z\d])(?=.*\d)/",$username))
		{
			$usernameErr="username should be alphanumeric";
		}
		else
			if (check_availability($username)) 
			{
				$_SESSION['username']=$username;
				$cnt++;
			}

			else
			{
				$usernameErr = "Try with Different Username";
	    	}
	
	}
	
	
	if (empty($_POST["pwd"]))
    {
	$pwdErr = "Password is required";
	}
 	else
    {
	$pwd = test_input($_POST["pwd"]);
		if (!preg_match("/(?=.{10})(?=.*[A-Z])(?=.*[a-z])(?=.*[^a-zA-Z\d])(?=.*\d)/",$pwd))
		{
			$pwdErr="Password must contain atleast a Uppercase,lowercase,special Character,and one digit";
		}
		else
		{
			$_SESSION['pwd']=$pwd;
			$cnt++;
		}

    }
	
	if (empty($_POST["cnfrmpwd"]))
    {
	$cnfrmpwdErr = "Re Enter Password";
	}
 	else
	{
		if($_POST["pwd"]==$_POST["cnfrmpwd"])
		{
			$cnfrmpwd = test_input($_POST["pwd"]);
			$cnt++;
		}
		else
		{
		$cnfrmpwdErr = "Password Not matched" ;
		}
		
	}
	
	if (empty($_POST["email"]))
    {
	$emailErr = "Email is required";
	}
    else
    {
    	$email = test_input($_POST["email"]);
    	if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
  			{
  				$emailErr = "Invalid email ";
  			}
  			else
  			{
  				$_SESSION['email']=$email;
  				$cnt++;
  			}
	}
	
	if (empty($_POST["accept"]))
    {
	$acceptErr = "Accept terms & conditions";
	}
	else
	{
	 $cnt++;
	}
	if($cnt==5)
	{header('Location: http://localhost/LoginApp/success.php');}
	

}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function check_availability($unm)
{
	$con=mysql_connect("localhost","root","mysql");
	mysql_select_db("LoginApp",$con);
	$qry="select * from users where username='$unm'";
	$result=mysql_query($qry);
	$num=mysql_num_rows($result);
	if ($num==1)
	{
 		return false;
	}
	else
	{
 	 return true;
	}
	mysql_close($con);
}

?>
<form method="post" action="#">
<table width="737" height="249" border="0" align="center"bgcolor="#33FF66" style="border:3px solid #008040">
  <tr>
    <td colspan="3" align="center"><h2>Register Here</h2> </td>
  </tr>
  <tr>
    <td width="313" align="right">Username</td>
    <td width="184" align="center"><input type="text" name="username" value="<?php if(isset($_POST['email'])){echo $_POST["username"];}?>" /> </td>
    <td width="218"><span class="error">* <?php echo $usernameErr;?></span></td>
  </tr>
  <tr>
    <td align="right">Password</td>
    <td align="center"><input type="password" name="pwd"/></td>
    <td><span class="error">* <?php echo $pwdErr;?></span></td>
  </tr>
  <tr>
    <td align="right">Confirm Password </td>
    <td align="center"><input type="password" name="cnfrmpwd" /></td>
    <td><span class="error">* <?php echo $cnfrmpwdErr;?></span></td>
  </tr>
  <tr>
    <td align="right">Email ID </td>
    <td align="center"><input type="text" name="email" value="<?php if(isset($_POST['email'])){echo $_POST["email"];}?>" /></td>
    <td><span class="error">* <?php echo $emailErr;?></span></td>
  </tr>
  <tr>
    <td align="right">Terms &amp; Conditions </td>
    <td><input type="checkbox" name="accept" value="accept" />
      I Accept it </td>
    <td><span class="error">* <?php echo $acceptErr;?></span></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="center"><input type="submit" name="register" value=" Register "/></td>
    <td>&nbsp;</td>
  </tr>
  
</table>
</form>
</body>
</html>
