<?php
    session_start();
	ob_start();
	
	if (!($_SESSION["access_status"] === "granted")) {
		$page = "project.php";
		header("location: login.php?Page=$page");
	}

?>

<?php
    include("connection.php");
	$conn = new mysqli($HOST, $USERNAME, $PASSWORD, $DATABASE);
    $query = "INSERT INTO project (project_desc,project_country,project_city) VALUES(?,?,?)";
    $pquery = mysqli_prepare($conn,$query);
    $pquery->bind_param('sss',$pdesc,$pcountry,$pcity);
    $pdesc = $_POST["pdesc"];
    $pcountry = $_POST["pcountry"];
    $pcity = $_POST["pcity"];

    if ($pquery->execute()) {
        ?>
        <script language="JavaScript">
            alert("New project successfully added to database!");
        </script>
        <?php
        header("Location: project.php");
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