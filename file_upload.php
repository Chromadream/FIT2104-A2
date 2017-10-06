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
    <title>Upload Image File</title> 
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head> 
<body> 
    <center><h3>Image File Upload</h3> </center>

<?php 
    if (!isset($_FILES["userfile"]["tmp_name"])) 
    { 
?> 
        <form method="post" enctype="multipart/form-data" action="file_upload.php"> 
        <center>
            <table border="0" cellpadding="10" cellspacing="1" width="500" class="tblListForm"> 
            <tr> 
                <td><input name="productId" type="hidden" value= <?php echo $_GET["pid"]; ?>> <b>Select a file to upload:</b><br><input type="file" size="50" name="userfile"></td> 
            </tr> 
            <tr> 
                <td><input type="submit" value="Upload File"></td> 
            </tr> 
            </table>
            </center>
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

        ?>
        <script language="JavaScript">
            alert("Error adding record. Contact System Administrator");
		 <?php
			 print "$pquery->error";
		 ?>
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
		echo ("<script language='JavaScript'>
		 window.location.href='ProductModify.php?pid=$pid&Action=Update';
		 window.alert('Redirecting to update page.')
		</script>");
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