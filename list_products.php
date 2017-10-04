<?php
session_start();
if (!($_SESSION["access_status"] === "granted")) {
    $page = "list_products.php";
    header("location: example0709.php?Page=$page");
}
?>

<?php
	//session_start();
	include("connection.php");
	$conn = new mysqli($Host, $UName, $PWord, $DB);
	$query = "SELECT * FROM product ORDER BY product_name";
	$result = $conn -> query($query);
?>
<html>
<head>
<title>Products List</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
<script language="javascript" src="products.js" type="text/javascript"></script>
</head>
<body>
<form name="frmProducts" method="post" action="">
<div style="width:500px;">
<table border="0" cellpadding="10" cellspacing="1" width="500" class="tblListForm">
<tr class="listheader">
<td>Product Name</td>
<td>Purchase Price</td>
<td>Sale Price</td>
<td>Origin</td>
<td></td>
</tr>
<?php

while ($row= $result->fetch_assoc()) {
	?>
	<tr>
	<td><?php echo $row["product_name"]; ?></td>
	<td><?php echo $row["product_purchase_price"]; ?></td>
	<td><?php echo $row["product_sale_price"]; ?></td>
    <td><?php echo $row["product_country_of_origin"]; ?></td>
    <td><input type="checkbox" name="products[]" value="<?php echo $row["product_id"]; ?>" ></td>
	</tr>
	<?php
}
?>
</table>
<input name="url" type="hidden" value="list_products.php">
<input type="button" name="update" value="Update" onClick="setUpdateAction();" /> 
<input type="button" name="delete" value="Delete"  onClick="setDeleteAction();" />


</form>
</div>
</body></html>