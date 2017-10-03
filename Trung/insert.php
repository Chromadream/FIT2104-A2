<?php
    ob_start();
	
	if (!($_SESSION["access_status"] === "granted")) {
		$page = "insert_it.php";
		header("location: login.php?Page=$page");
	}

?>

<?php

if (empty($_POST["pname"]))
{
		$message = "Product name can not be blank";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script>setTimeout(\"location.href = 'insert_it.php';\",500);</script>";
    	//header("Location: insert_it.php");

}
else {
    $conn = mysqli_connect("130.194.7.82","s27923517","punyamapunpun","s27923517");
    $query = "INSERT INTO product (product_name,product_purchase_price,product_sale_price,product_country_of_origin) VALUES('$_POST[pname]', '$_POST[pprice]','$_POST[sprice]','$_POST[origin]')";
    if ($conn->query($query)) {
        ?>
        <script language="JavaScript">
            alert("New product successfully added to database");
        </script>
        <?php
        header("Location: single_product.php");
    } else {
        ?>
        <script language="JavaScript">
            alert("Error adding record. Contact System Administrator");
        </script>
        <?php
        $result->free_result();
        $conn->close();
    }
}
    ?>