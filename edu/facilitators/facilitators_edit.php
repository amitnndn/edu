<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2)	{
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once('../head.php');?>
<title>
Edit Facilitator
</title>
<script type="text/javascript">
	$(document).ready(function(){
		$('#alertMe2').on('click',function(){
			x = document.foo.first_name.value;
			y = document.foo.last_name.value;
			z = document.foo.contact.value;
			a = document.foo.email.value;
			b = document.foo.address.value;
			if(x==null || x=="")	{
				alert("First Name Cannot be Empty");
				return false;
			}if(y==null || y=="")	{
				alert("Last Name Cannot be Empty");
				return false;
			}if(z==null || z=="")	{
				alert("Phone Number Cannot be Empty");
				return false;
			}if(a==null || a=="")	{
				alert("Email Cannot be Empty");
				return false;
			}if(b==null || b=="")	{
				alert("Address Cannot be Empty");
				return false;
			}if(!validaidateEmail(a))	{
				alert("Invalid Email Address");
				return false;
			}
		});
	});
 function validaidateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if( !emailReg.test( $email ) ) {
    return false;
  } else {
    return true;
  }
}
</script>
</head>
<body>
<?php 
	include_once('../header.php');
	include_once('../database.php');
	$id = $_GET['id'];
	$sql = mysql_query("select * from facilitators where id=$id;");
	while($info = mysql_fetch_array($sql))	{	
?>
<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 700px;">
<form name="foo" action="facilitators_update.php?id=<?php echo $id?>" method="post" style="margin-left: 25px; margin-right: 25px;">
<fieldset>
<legend>
Edit <?php echo $info['first_name']."'s Entry"?>
</legend>
<table>
<tr><td>First Name:</td><td><input type='text' name='first_name' value="<?php echo $info['first_name'];?>"></td></tr>
<tr><td>Last Name:</td><td><input type='text' name='last_name' value="<?php echo $info['last_name'];?>"></td></tr>
<tr><td>Contact Number:&nbsp</td><td><input type='text' name='contact' value="<?php echo $info['phone'];?>"></td></tr>
<tr><td>E Mail:</td><td><input type='text' name='email' value="<?php echo $info['email'];?>"></td></tr>
<tr><td>Address:</td><td><textarea name='address'><?php echo $info['address'];?></textarea></td></tr>
<tr><td><input type='submit' class='btn btn-primary' value='Update' id="alertMe2"></td></tr>
</table>
</fieldset>
</form>
</div>
<?php }?>
<?php include_once('../footer.php');?>
</body>
</html>
<?php 
			}
			else	{		
				echo "Access Denied. Redirecting in 3 seconds.";
				header("refresh:3;url=facilitators_list.php");	
			}
		}
		else 	{
			header('Location:../index.php');
		}
	}
	else	{
		header('Location:../index.php');
	}
?>