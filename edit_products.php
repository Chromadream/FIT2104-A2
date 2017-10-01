<?php
session_start();
if (!($_SESSION["access_status"] === "granted")) {
    $page = "edit_products.php";
    header("location: example0709.php?Page=$page");
}
?>
<?php
include("connection.php");
$conn = new mysqli($Host, $UName, $PWord, $DB);
if ($_POST["url"] !="list_products.php"){
	header("location: list_products.php");
}


if(isset($_POST["submit"]) && $_POST["submit"]!="") {
	$productsCount = count($_POST["productName"]);
	for($i=0;$i<$productsCount;$i++) {
	
	$query="UPDATE product set product_name='" . $_POST["productName"][$i] . "', product_purchase_price='" . $_POST["productPPrice"][$i] . "', product_sale_price='" . $_POST["productSPrice"][$i] . "', product_country_of_origin='" . $_POST["productCOO"][$i] . "' WHERE product_id='" . $_POST["productId"][$i] . "'";
	$status = $conn->query($query); 
	}
header("Location:list_products.php");
}
?>
<html>
<head>
<title>Edit Multiple Products</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<form name="frmProducts" method="post" action="">
<div style="width:500px;">
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center">
<tr class="tableheader">
<td>Edit Product</td>
</tr>
<?php
$rowCount = count($_POST["products"]);
for($i=0;$i<$rowCount;$i++) {
	$query1="SELECT * FROM product WHERE product_id='" . $_POST["products"][$i] . "'";
	$result = $conn -> query($query1);
	$row[$i]= $result->fetch_assoc();
	?>
    <tr>
    <td>
    <table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
    <tr>
    <td><label>Product Name</label></td>
    <td><input type="hidden" name="productId[]" class="txtField" value="<?php echo $row[$i]['product_id']; ?>"><input type="text" name="productName[]" class="txtField" value="<?php echo $row[$i]['product_name']; ?>"></td>
    </tr>
    <tr>
    <td><label>Purchase Price</label></td>
    <td><input type="text" name="productPPrice[]" class="txtField" value="<?php echo $row[$i]['product_purchase_price']; ?>"></td>
    </tr>
    <td><label>Sale Price</label></td>
    <td><input type="text" name="productSPrice[]" class="txtField" value="<?php echo $row[$i]['product_sale_price']; ?>"></td>
    </tr>
    <td><label>Origin</label></td>
    <td><input type="text" name="productCOO[]" class="txtField" value="<?php echo $row[$i]['product_country_of_origin']; ?>"></td>
    </tr>
    </table>
    </td>
    </tr>
    <?php
}
?>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
</tr>
</table>
</div>
</form>
</body></html>