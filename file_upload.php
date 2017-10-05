<?php
    ob_start();
	session_start();
	if (!($_SESSION["access_status"] === "granted")) {
		$page = "single_product.php";
		header("location: login.php?Page=$page");
	}


	include("connection.php");
	$conn = new mysqli($HOST, $USERNAME, $PASSWORD, $DATABASE);
    

?>   
<html> 
<head> 
    <title>PHP Upload File</title> 
</head> 
<body> 
    <h1>PHP File Upload</h1> 

<?php 
    if (!isset($_FILES["userfile"]["tmp_name"])) 
    { 
?> 
        <form method="post" enctype="multipart/form-data" action="file_upload.php"> 
            <table border="0"> 
            <tr> 
                <td><input name="productId" type="hidden" value= <?php echo $_GET["pid"]; ?>> <b>Select a file to upload:</b><br><input type="file" size="50" name="userfile"></td> 
            </tr> 
            <tr> 
                <td><input type="submit" value="Upload File"></td> 
            </tr> 
            </table> 
        </form> 
<?php 
    } 
    else 
    { 
	$query = "INSERT INTO product_image (product_id,image_name) VALUES(?,?)";
    $pquery = mysqli_prepare($conn,$query);
    $pquery->bind_param('is',$pid,$iname);
    $pid = $_POST["productId"];
    $iname = $_FILES["userfile"]["name"];
    if ($pquery->execute()) {
        ?>
        <script language="JavaScript">
            alert("New image successfully added to database");
        </script>
        <?php
    } else {
		echo "<script type='text/javascript'>alert('$pid' + '    ' +'$iname');</script>";
		//print "$pquery->error";
		//exit(1);
        ?>
        <script language="JavaScript">
            alert("Error adding record. Contact System Administrator");
        </script>
        
        <?php
		}
        $upfile = "product_images/".$_FILES["userfile"]["name"]; 

if($_FILES["userfile"]["type"] != "image/gif" && $_FILES["userfile"]["type"] != "image/pjpeg" && $_FILES["userfile"]["type"] != "image/jpeg") 
{ 
    echo "ERROR: You may only upload .jpg or .gif files"; 
} 
else 
{ 
     if(!move_uploaded_file($_FILES["userfile"]["tmp_name"],$upfile)) 
     { 
     echo "ERROR: Could Not Move File into Directory"; 
     } 
     else 
     { 
     echo "Temporary File Name: " .$_FILES["userfile"]["tmp_name"]."<br />"; 
     echo "File Name: " .$_FILES["userfile"]["name"]."<br />"; 
     echo "File Size: " .$_FILES["userfile"]["size"]."<br />"; 
     echo "File Type: " .$_FILES["userfile"]["type"]."<br />"; 
     } 
    } 

$currdir = dirname($_SERVER["SCRIPT_FILENAME"])."/product_images"; 

$dir = opendir($currdir); 

echo "<br /><br />"; 
echo "<h1>Contents of Uploads Directory</h1>"; 
while($file = readdir($dir)) 
{ 
if($file == "." || $file =="..") 
{ 
continue; 
} 
echo $file."<br />"; 
} 
closedir($dir); 
    } 
?> 
</body> 
</html>