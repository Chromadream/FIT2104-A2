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
    include("connection.php");
	$conn = new mysqli($HOST, $USERNAME, $PASSWORD, $DATABASE);
    $query = "INSERT INTO product (product_name,product_purchase_price,product_sale_price,product_country_of_origin) VALUES(?,?,?,?)";
    $pquery = mysqli_prepare($conn,$query);
    $pquery->bind_param('sdds',$p_name,$p_pur,$p_sale,$p_origin);
    $p_name = $_POST["pname"];
    $p_pur = $_POST["pprice"];
    $p_sale = $_POST["sprice"];
    $p_origin = $_POST["origin"];
    if ($pquery->execute()) {
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