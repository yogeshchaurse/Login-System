<?php
session_start();
$unm=$_SESSION['username'];
// define variables and set to empty values
$cnt=0;
$firstnameErr = $lastnameErr = $birthdateErr = $genderErr = $img =$msg="";
$firstname = $lastname = $birthdate  = $gender = $img = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

  if (empty($_POST["firstname"]))
    {$firstnameErr = "Name is required";}
  else
    {
      $firstname = test_input($_POST["firstname"]);
      $_SESSION['firstname']=$firstname;
    $cnt++;
    }
  
  if (empty($_POST["lastname"]))
    {$lastnameErr = "Lastname is required";}
  else
    {
      $lastname = test_input($_POST["lastname"]);
      $_SESSION['lastname']=$lastname;
      $cnt++;
    }

  if (empty($_POST["birthdate"]))
    {$birthdateErr = "Birthdate is required";}
  else
    {
      $birthdate = test_input($_POST["birthdate"]);
      $_SESSION['birthdate']=$birthdate;
      $cnt++;
    }
  

   if (empty($_POST["gender"]))
    {$genderErr = "Gender is required";}
  else
    {
      $gender = test_input($_POST["gender"]);
      $_SESSION['gender']=$gender;
      $cnt++;
    }

  if ($_FILES['img']['size']==0)
    {$imgErr = "Image is required";}
  else
    {
      $image=$_FILES['img'];
      $image_name=$image['name'];
      $image_size=$image['size'];
      $image_tem_location=$image['tmp_name'];
      $image_type=$image['type'];
      $valid_extension=array('image/jpg','image/jpeg','image/png','image/bmp','image/gif');
      if(!(in_array($image_type,$valid_extension)))
      {
        $imgErr="Not a Valid File Extension";
      } 
      else
      {
            $new_location= "uploads/".$image_name;

        if(file_exists($new_location))
        {
            $imgErr="File already exist";
        }

        else
        {
          $uploaded=move_uploaded_file($image_tem_location, $new_location);
              if($uploaded)
              {
                 $cnt++;
              }
            else
              {
               $imgErr="File not uploaded";
              }
         }

       $_SESSION['image_name']=$image_name;
       
      }
  }
  
if($cnt==5)
{
  $con=mysql_connect("localhost","root","mysql");
  mysql_select_db("LoginApp",$con);
  $qry1="update users_profile set firstname='$firstname',lastname='$lastname',birthdate='$birthdate',gender='$gender' where username='$unm'";
  mysql_query($qry1);
  mysql_close($con);
  $msg="Profile updated succefully";
}

}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>
  <form method="post" action="#" enctype="multipart/form-data">
    <table width="787" height="760" border="1" align="center" bgcolor="#66FF66">
  <tr>
    <td width="777" height="37" ><table width="772" border="1" align="center"  bgcolor="#FFFFFF" >
      <tr>
        <td width="181" align="center"><a href="dashboard.php">Dashboard</a></td>
        <td width="181" align="center"><a href="update.php">Update Profile</a></td>
        <td width="181" align="center"><a href="view.php">View Profile</a></td>
        <td width="201" align="center"><a href="logout.php">Logout</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="687" valign="top"><table width="724" height="353" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td width="225" align="right">First Name </td>
    <td width="252" align="center"><input type="text" name="firstname" value="<?php if(isset($_POST['firstname'])){echo $_POST["firstname"];}?>"/></td>
    <td width="225"><?php echo "<font color='red'>"."*".$firstnameErr."</font>";  ?></td>
  </tr>
  <tr>
    <td align="right">Last Name </td>
    <td align="center"><input type="text" name="lastname" value="<?php if(isset($_POST['lastname'])){echo $_POST["lastname"];}?>"/></td>
    <td><?php echo "<font color='red'>"."*".$lastnameErr."</font>";  ?></td>
  </tr>
  <tr>
    <td align="right">Profile Picture </td>
    <td align="center"><input type="file" name="img" id="img"/></td>
    <td><?php echo "<font color='red'>"."*".$imgErr."</font>";  ?></td>
  </tr>
  <tr>
    <td align="right">Date Of Birth </td>
    <td align="center"><input type="text" name="birthdate" value="<?php if(isset($_POST['birthdate'])){echo $_POST["birthdate"];}?>"/></td>
    <td><?php echo "<font color='red'>"."*".$birthdateErr."</font>";  ?></td>
  </tr>
  <tr>
    <td align="right">Gender</td>
    <td align="center"><input type="radio" name="gender" value="Male"/> 
    Male <input type="radio" name="gender" value="Female"/> Female</td>
    <td><?php echo "<font color='red'>"."*".$genderErr."</font>";  ?></td>
  </tr>
  <tr>
    <td height="60" colspan="3" align="center"><input type="submit" name="update" value=" Update "/></td>
  </tr>
  <tr>
    <td height="60" colspan="3" align="center"><?php echo "<font color='green'>".$msg."</font>";?></td>
  </tr>
</table>
</td>
</tr>
  
</table>
</form>

</body>
</html>
