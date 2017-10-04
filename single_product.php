<?php
session_start();
if (!($_SESSION["access_status"] === "granted")) {
    $page = "single_product.php";
    header("location: login.php?Page=$page");
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>

<?php
	include("connection.php");
	//$conn = new mysqli($Host, $UName, $PWord, $DB);
	$conn = new PDO('mysql:host=130.194.7.82;dbname=s27923517','s27923517','punyamapunpun');
	$stmt = $conn->prepare("select * from product");
	$stmt->execute();
	
?>
<table border= "1px solid black">
	<tr>
    	<td><?php echo "Product Name" ?> </td>
       <td><?php echo "Purchase Price" ?> </td>
       <td><?php echo "Sale Price" ?> </td>
       <td><?php echo "Origin" ?> </td>
    </tr>

<?php
	while ($row = $stmt->fetch())
	{
?>
	<tr>
       <td><?php echo $row["product_name"]; ?> </td>
       <td><?php echo $row["product_purchase_price"]; ?> </td>
       <td><?php echo $row["product_sale_price"]; ?> </td>
       <td><?php echo $row["product_country_of_origin"]; ?> </td>
       <td>
       	<a href="ProductModify.php?pid= <?php echo $row["product_id"]; ?> &Action=Delete">Delete</a>
        </td>
        <td>
			<a href="ProductModify.php?pid= <?php echo $row["product_id"]; ?>
&Action=Update">Update</a>
		</td>
    </tr>

<?php
	}
?>
</table>

<a href="insert_it.php" ><button>Insert</button></a>

</body>
</html>