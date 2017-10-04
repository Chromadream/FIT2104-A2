<?php
    ob_start();
	session_start();
	if (!($_SESSION["access_status"] === "granted")) {
		$page = "single_product.php";
		header("location: login.php?Page=$page");
	}

?>
<html>

<head><title></title></head>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript">
function validateForm1()
    {
		var check = true;
		var checkv = true;
		var message1 = "Field(s):  ";
		var name=document.getElementsByName('pname');
		var sprice=document.getElementsByName('sprice');
		var pprice=document.getElementsByName('pprice');
		//alert(name[0].value==="");
		if(name[0].value===""){
			
			message1 = message1+"name ";
			check =false;
		}
		
		if(sprice[0].value===""){
			message1 = message1+"saleprice ";
			check =false;
		}
		
		if(pprice[0].value===""){
			message1 = message1+"purchaseprice ";
			check =false;
		}
		
		
		if (!(sprice[0].value ==="") && !(pprice[0].value ==="") && sprice[0].value<pprice[0].value){
			message2="Sale price is less than purchase price";
			checkv=false;
		}
		else {
			message2="";	
		}
		
		message1 = message1 +"are empty";
		if (check ===false || checkv === false){
			if (check === false)
				alert(message1);
			if(checkv === false)
				alert(message2);
			return false;
		}
		else{
			return true;
		}
    }
</script>
<body>
<script language="JavaScript">
    function confirm_delete()
    {
        window.location= 'ProductModify.php?pid=<?php echo $_GET["pid"]; ?>&Action=ConfirmDelete';

    }
</script>
<center><h3>Product Modification</h3></center>
<?php
include("connection.php");
$conn = mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);
$query = "SELECT * From product WHERE product_id=".$_GET["pid"];
$result = $conn->query(($query));
$row = $result->fetch_assoc();

$strAction = $_GET["Action"];

switch ($strAction)
{
case "Update":

	$query1 = "SELECT * From category";
	$result1 = $conn->query(($query1));


    ?>
    <form method="post" action="ProductModify.php?pid=<?php echo $_GET["pid"]; ?>&Action=ConfirmUpdate">
        <center>Product detail<br/></center>
        <p/>
        <table align="center" cellpadding="3">
            <tr>
                <td><b>Product ID</b></td>
                <td><?php echo $row["product_id"]; ?></td>
                <input name="productId" type="hidden" value= <?php echo $row["product_id"]; ?>>
            </tr>
            <tr>
                <td><b>Product Name</b></td>
                <td><input type="text" name="pname" size="30" value="<?php echo $row["product_name"]; ?>"></td>
            </tr>
            <tr>
                <td><b>Purchase Price</b></td>
                <td><input type="text" name="pprice" size="30" value="<?php echo $row["product_purchase_price"]; ?>"></td>
            </tr>
            <tr>
                <td><b>Sale Price</b></td>
                <td><input type="text" name="sprice" size="40" value="<?php echo $row["product_sale_price"]; ?>"></td>
            </tr>
            <tr>
                <td><b>Origin</b></td>
                <td><input type="text" name="origin" size="10" value="<?php echo $row["product_country_of_origin"]; ?>"></td>
            </tr>
        </table>
        <br/>
        
        <center>
        <h5> Category </h5>
        <table>
        
        <?php
		 while ($row1= $result1->fetch_assoc()) {
			$query2 = "SELECT * From product_category WHERE product_id =".$row['product_id'];
			$result2 = $conn->query(($query2));
			 
		 ?>
        	<tr>
           	<td><?php echo $row1["category_name"]; ?></td>
           	<td><input type="checkbox" name="categories[]" value="<?php echo $row1["category_id"]; ?>"
            <?php
            while ($row2= $result2->fetch_assoc()){
				if ($row1["category_id"] === $row2["category_id"]){
					echo "checked";
				}
			 }
			 
			 ?>
            >
               </td>
               
               <td>
               
               </td>
               
           </tr>
        <?php
        }
        ?>
        </table>
        </center>
        
        <table align="center">
            <br/>
            <tr>
                <td><input onclick="return validateForm1();" type="submit" value="Update product" class="btnSubmit"></td>
                <td><input type="button" value="Return to list" OnClick="window.location='single_product.php'"></td>
                <td><button><a href="file_upload.php?pid= <?php echo $row["product_id"]; ?>">Upload File</a></button></td>
            </tr>
        </table>
    </form>
    
    
    <?php
    break;
    
case "ConfirmUpdate": {
    $query = "UPDATE product set product_name='$_POST[pname]', product_purchase_price='$_POST[pprice]', product_sale_price='$_POST[sprice]',product_country_of_origin='$_POST[origin]'
                WHERE product_id=" . $_GET["pid"];
    $result = $conn->query(($query));
	
	//Updating category
	$query1 = "SELECT * From product_category WHERE product_id =".$_GET["pid"];
	$result1 = $conn->query(($query1));
	$old_categories = array();
	$new_categories = $_POST["categories"];
	
	while ($row2= $result1->fetch_assoc()){
		$old_categories[]=$row2["category_id"];

	}
	
	//Delete old categories
	
	if (!empty($new_categories)) {
		$rowCount=count($old_categories);
		for($i=0;$i<$rowCount;$i++) {
			if (!in_array($old_categories[$i], $new_categories)){
				
					echo '<pre>';
					print_r($new_categories);
					echo '</pre>';
					
					echo '<pre>';
					print_r($old_categories);
					echo '</pre>';
				

	
				$query2 = $query="DELETE FROM product_category WHERE product_id='" .$_GET["pid"] . "'"  ."AND category_id='" .$old_categories[$i] . "'";
				$result = $conn->query(($query2));
				
			}
		}
	}
	else{
		$rowCount=count($old_categories);
		for($i=0;$i<$rowCount;$i++) {
			$query2 = $query="DELETE FROM product_category WHERE product_id='" .$_GET["pid"] . "'"  ."AND category_id='" .$old_categories[$i] . "'";
			$result = $conn->query(($query2));
		}
	}
	
	//Update new categories
	$rowCount=count($new_categories);
	for($i=0;$i<$rowCount;$i++) {
		if (!in_array($new_categories[$i], $old_categories)){
			$query2 = "INSERT INTO product_category (product_id, category_id) VALUES (".$_GET["pid"] ."," .$new_categories[$i] .");";
			$conn->query(($query2));
		}
	}

	
	
    header("Location: single_product.php");

    break;
}
case "Delete": {
    ?>

    <center>Confirm deletion of the following product record<br/></center><p/>
    <table align="center" cellpadding="3">
        <tr>
            <td><b>Product ID</b></td>
            <td><?php echo $row["product_id"]; ?></td>
        </tr>
        <tr>
            <td><b>Product Name</b></td>
            <td><?php echo $row["product_name"]; ?> </td>
        </tr>
    </table>
    <table align="center">
        <br/>
        <tr>
            <td><input type="button" value="Confirm" OnClick="confirm_delete();"></td>
            <td><input type="button" value="Cancel" OnClick="window.location='single_product.php'"></td>
        </tr>
    </table>
    <br/>


    <?php
    break;
}
case "ConfirmDelete":
{
$query = "Delete from product 
                WHERE product_id=".$_GET["pid"];
if ($conn->query($query)) {

?>
<center>The following product record has successfully deleted <p />
    <?php
    echo "Product ID $row[product_id] ";
    echo "<br/>";
    echo "Name: $row[product_name]";
    echo "</center><p />";
    }
    else {
        echo "<center>Error deleting product record<p/></center>";
    }

    echo "<center><input type='button' value='return to list' OnClick='window.location = \"single_product.php\"' ></center>";

        break;
    }
}
    $result -> free_result();

    $conn->close();

    ?>


</body>
</html>

