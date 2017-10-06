<?php
    ob_start();
	session_start();
	if (!($_SESSION["access_status"] === "granted")) {
		$page = "client.php";
		header("location: login.php?Page=$page");
	}

?>

<?php
    include("connection.php");
	$conn = new mysqli($HOST, $USERNAME, $PASSWORD, $DATABASE);
    $query = "INSERT INTO client (client_fname,client_lname,client_street,client_suburb,client_state,client_pc,client_email,client_mobile,client_mailinglist) VALUES(?,?,?,?,?,?,?,?,?)";
    $pquery = mysqli_prepare($conn,$query) or die($conn->error);
    $pquery->bind_param('sssssssss',$fname,$lname,$street,$suburb,$state,$postcode,$email,$mobile,$mailinglist);
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $street = $_POST["addr"];
    $suburb = $_POST["suburb"];
    $state = $_POST["state"];
    $postcode = $_POST["pcode"];
    $email = $_POST["email"];
    $mobile = $_POST["phonenum"];
    if(empty($_POST["check"]))
    {
        $mailinglist = "N";
    }
    else
    {
        $mailinglist = "Y";
    }
    if ($pquery->execute()) {
        ?>
        <script language="JavaScript">
            alert("New client successfully added to database!");
        </script>
        <?php
        header("Location: client.php");
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