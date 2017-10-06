<?php
    ob_start();
	session_start();
	if (!($_SESSION["access_status"] === "granted")) {
		$page = "category.php";
		header("location: login.php?Page=$page");
	}

?>

<?php
    include("connection.php");
	$conn = new mysqli($HOST, $USERNAME, $PASSWORD, $DATABASE);
    $query = "INSERT INTO category (category_name) VALUES(?)";
    $pquery = mysqli_prepare($conn,$query);
    $pquery->bind_param('s',$catname);
    $catname = $_POST["catname"];

    if ($pquery->execute()) {
        ?>
        <script language="JavaScript">
            alert("New category successfully added to database!");
        </script>
        <?php
        header("Location: category.php");
    } else {
        ?>
        <script language="JavaScript">
            alert("Error adding record. Contact System Administrator");
        </script>
        <?php
        $result->free_result();
        $conn->close();
}
    ?>