<?php 
session_start(); 
ob_start(); 
?> 
<html> 
<head> 
<title>Session Log In Example</title> 
</head> 
<link rel="stylesheet" type="text/css" href="style.css"> 
<body> 

<?php 

if (($_SESSION["access_status"] === "granted")) {
	echo "You aldready logged in!";
	
	?>
    <a href='end_session.php'>Log out</a>
    <?php
	exit(1);
}

if(empty($_POST["uname"])) 
{ 
?> 
<form method="post" action="login.php"> 
<input name="redirurl" type="hidden" value="<?php echo $_GET["Page"] ?>">

<table border="0" align="center" width="30%" cellpadding="2" cellspacing="5"> 
<!--<tr> 
<td colspan="3" class="msg">&nbsp;<?echo $Msg; ?></td> 
</tr>--> 
<tr> 
<td class="pref">Username</td> 
<td class="prefdisplaycentre"><input type="text" name="uname" size="12" maxlength="10"></td> 
</tr> 
<tr> 
<td class="pref">Password</td> 
<td class="prefdisplaycentre"><input type="password" name="pword" size="12" maxlength="10"></td> 
</tr> 
<tr> 
<td colspan="3" class="heading2" align="center"> 
<input type="submit" value="Login" name="Action">&nbsp;&nbsp; 
<input type="reset" value="Reset"> 
</td> 
</tr> 
</table> 
</form> 
<?php 
} 
else 
{ 
include("connection.php"); 
$conn = new mysqli($HOST, $USERNAME, $PASSWORD, $DATABASE) 
or die("Couldn't log on to database"); 

$query="SELECT admin_id FROM admin WHERE uname = ? AND passwd = ?"; 

$stmt = mysqli_prepare($conn, $query); 

$stmt->bind_param('ss', $uname,$pword); 
$uname= $_POST["uname"]; 
$pword = hash('sha256', $_POST["pword"]); 
$stmt->execute(); 
$stmt->bind_result($admin_id); 

	if(!empty($stmt->fetch())) 
	{ 
		echo "Welcome to our site $uname"; 
		$_SESSION["access_status"] = "granted";
		
		$page_address = $_POST["redirurl"];
		echo "$page_address";
		if ($page_address){
			header("location: $page_address");	
		}

	?>
	<a href='end_session.php'>Log out</a>
	<?php
} 
else 
{ 
echo "Sorry, login details incorrect"; 
} 
} 
?>
</body> 
</html>