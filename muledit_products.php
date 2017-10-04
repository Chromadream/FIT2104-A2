<?php
ob_start();
session_start();
if (!($_SESSION["access_status"] === "granted")) {
    $page = "muledit_products.php";
    header("location: example0709.php?Page=$page");
}
include("connection.php");
$conn = new mysqli($Host, $UName, $PWord, $DB);
?>
<html>
<head>
<title>Products List</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
<script language="javascript" src="products.js" type="text/javascript"></script>
</head>

<?php
if(empty($_POST["products"]))
{
	$query = "SELECT * FROM product ORDER BY product_name";
	$result = $conn -> query($query);
?>
    <body>
    <form name="frmProducts" method="post" action="muledit_products.php">
    <div style="width:500px;">
    <table border="0" cellpadding="10" cellspacing="1" width="500" class="tblListForm">
    <tr class="listheader">
    <td>Product Name</td>
    <td>Purchase Price</td>
    <td>Sale Price</td>
    <td></td>
    </tr>
    <?php
    while ($row= $result->fetch_assoc()) {
        ?>
        <tr>
			<td><input type="hidden" name="productId[]" class="txtField" value="<?php echo $row['product_id']; ?>"> <?php echo $row['product_name']; ?></td>
    		<td><input type="text" name="productPPrice[]" class="txtField" value="<?php echo $row['product_purchase_price']; ?>"></td>
    		<td><input type="text" name="productSPrice[]" class="txtField" value="<?php echo $row['product_sale_price']; ?>"></td>
        	<td><input type="checkbox" name="products[]" value="<?php echo $row["product_id"]; ?>" ></td>
        </tr>
        <?php
    }
    ?>
    </table>

    <input type="submit" name="update" value="Update Multiple Rows" /> 
    </form>
    </div>
	</body>
<?php
}
else {
	$productsCount = count($_POST["products"]);

	for($i=0;$i<$productsCount;$i++) {
	
		$query="UPDATE product set product_purchase_price='" . $_POST["productPPrice"][$i] . "', product_sale_price='" . $_POST["productSPrice"][$i] . "' WHERE product_id='" . $_POST["productId"][$i] . "'";
		
		$status = $conn->query($query); 
	}
		header("Location: muledit_products.php"); 
	
}
mysqli_close($conn);
ob_end_flush();
	?>
</html>