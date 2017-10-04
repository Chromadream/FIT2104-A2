<?php
session_start();
if (!($_SESSION["access_status"] === "granted")) {
    $page = "delete_products.php";
    header("location: login.php?Page=$page");
}
?>
<?php
include("connection.php");
$conn = new mysqli($Host, $UName, $PWord, $DB);
$rowCount = count($_POST["products"]);
for($i=0;$i<$rowCount;$i++) {
	$query="DELETE FROM product WHERE product_id='" . $_POST["products"][$i] . "'";
	$conn->query($query);
}
header("Location:list_products.php");
?>