<?php
    ob_start();
	session_start();
	if (!($_SESSION["access_status"] === "granted")) {
		$page = "client.php";
		header("location: login.php?Page=$page");
	}

?>
<html>

<head><title></title></head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
<script language="JavaScript">
    function confirm_delete()
    {
        window.location= 'clientModify.php?pid=<?php echo $_GET["pid"]; ?>&Action=ConfirmDelete';

    }
</script>
<center><h3>Client Edit</h3></center>
<?php
include("connection.php");
$conn = mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);
$query = "SELECT * From client WHERE client_id=".$_GET["pid"];
$result = $conn->query($query);
$row = $result->fetch_assoc();

$strAction = $_GET["Action"];

switch ($strAction)
{
case "Update":
    ?>
    <form method="post" action="clientModify.php?pid=<?php echo $row["client_id"];?>&Action=ConfirmUpdate">
        <center>Client detail<br/></center>
        <p/>
        <table align="center" cellpadding="3">
            <tr>
                <td><b>Client ID</b></td>
                <td><?php echo $row["client_id"]; ?></td>
                <input name="clientId" type="hidden" value= <?php echo $row["client_id"]; ?>>
            </tr>
            <tr>
                <td><b>First Name</b></td>
                <td><input type="text" name="fname" size="30" value="<?php echo $row["client_fname"]; ?>" required></td>
            </tr>
            <tr>
                <td><b>Last Name</b></td>
                <td><input type="text" name="lname" size="30" value="<?php echo $row["client_lname"]; ?>" required></td>
            </tr>
            <tr>
                <td><b>Address</b></td>
                <td><input type="text" name="addr" size="30" value="<?php echo $row["client_street"]; ?>" required></td>
            </tr>
            <tr>
                <td><b>Suburbs</b></td>
                <td><input type="text" name="suburb" size="30" value="<?php echo $row["client_suburb"]; ?>" required></td>
            </tr>
            <tr>
                <td><b>State</b></td>
                <td><input type="text" name="state" size="30" value="<?php echo $row["client_state"]; ?>" required></td>
            </tr>
            <tr>
                <td><b>Postcode</b></td>
                <td><input type="text" name="pcode" size="30" value="<?php echo $row["client_pc"]; ?>" required></td>
            </tr>
            <tr>
                <td><b>Email</b></td>
                <td><input type="email" name="email" size="30" value="<?php echo $row["client_email"]; ?>" required></td>
            </tr>
            <tr>
                <td><b>Mobile Number</b></td>
                <td><input type="number" name="mobile" size="30" value="<?php echo $row["client_mobile"]; ?>" required></td>
            </tr>
            <tr>
                <td><b>Mailing List</b></td>
                <td><input type="checkbox" name="mail[]" size="30" <?php if ($row["client_mailinglist"]=="Y") echo 'checked';?>></td>
            </tr>
        </table>
        <br/>
        
        <table align="center">
            <br/>
            <tr>
                <td><input type="submit" value="Update product" class="btnSubmit"></td>
                <td><input type="button" value="Return to list" OnClick="window.location='client.php'"></td>
            </tr>
        </table>
    </form>
    <?php
    break;
    
case "ConfirmUpdate": {
    $update_q = "UPDATE client SET client_fname = ?, client_lname = ?, client_street = ?, client_suburb = ?, client_state = ?, client_pc = ?, client_email = ?, client_mobile = ?, client_mailinglist = ? WHERE client_id =".$_GET["pid"];
    $pquery = mysqli_prepare($conn,$update_q) or die ("Mysql Error: " . $conn->error);
    $pquery->bind_param('sssssssss',$fname,$lname,$addr,$suburb,$state,$pc,$email,$mobile,$mail);
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $addr = $_POST["addr"];
    $suburb = $_POST["suburb"];
    $state = $_POST["state"];
    $email = $_POST["email"];
    $pc = $_POST["pcode"];
    $mobile = $_POST["mobile"];
    if(empty($_POST["mail"]))
    {
        $mail = "N";
    }
    else
    {
        $mail = "Y";
    };
    if($pquery->execute())
    {
        echo "Update Successful";
    }
    else
    {
        echo "Client data update unsuccessful. Please contact System Administrator.";
    };
    header("Location: client.php");

    break;
}
case "Delete": {
    ?>

    <center>Confirm deletion of the following product record<br/></center><p/>
    <table align="center" cellpadding="3">
        <tr>
            <td><b>Client ID</b></td>
            <td><?php echo $row["client_id"]; ?></td>
        </tr>
        <tr>
            <td><b>Client Name</b></td>
            <td><?php echo $row["client_fname"]." ".$row["client_lname"]; ?> </td>
        </tr>
    </table>
    <table align="center">
        <br/>
        <tr>
            <td><input type="button" value="Confirm" OnClick="confirm_delete();"></td>
            <td><input type="button" value="Cancel" OnClick="window.location='client.php'"></td>
        </tr>
    </table>
    <br/>


    <?php
    break;
}
case "ConfirmDelete":
{
$query = "Delete from client 
                WHERE client_id=".$_GET["pid"];
if ($conn->query($query)) {

?>
<center>The following Client record has successfully deleted <p />
    <?php
    echo "Client ID: $row[client_id] ";
    echo "<br/>";
    echo "Name: $row[client_fname] $row[client_lname]";
    echo "</center><p />";
    }
    else {
        echo "<center>Error deleting product record<p/></center>";
    }

    echo "<center><input type='button' value='return to list' OnClick='window.location = \"client.php\"' ></center>";

        break;
    }
}
    $result -> free_result();
    $conn->close();
    ?>


</body>
</html>

