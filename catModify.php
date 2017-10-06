<?php
    ob_start();
	session_start();
	if (!($_SESSION["access_status"] === "granted")) {
		$page = "category.php";
		header("location: login.php?Page=$page");
	}

?>
<html>

<head><title></title></head>
<link rel="stylesheet" type="text/css" href="styles.css">
<body>
<script language="JavaScript">
    function confirm_delete()
    {
        window.location= 'catModify.php?pid=<?php echo $_GET["pid"]; ?>&Action=ConfirmDelete';

    }
</script>
<center><h3>Category Edit</h3></center>
<?php
include("connection.php");
$conn = mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);
$query = "SELECT * From category WHERE category_id=".$_GET["pid"];
$result = $conn->query($query);
$row = $result->fetch_assoc();

$strAction = $_GET["Action"];

switch ($strAction)
{
case "Update":
    ?>
    <form method="post" action="catModify.php?pid=<?php echo $row["client_id"];?>&Action=ConfirmUpdate">
        <center>Client detail<br/>
        <p/>
        <table border="0" cellpadding="10" cellspacing="1" width="500" class="tblListForm">
            <tr class="listheader">
                <td><b>Category ID</b></td>
                <td><?php echo $row["category_id"]; ?></td>
                <input name="catID" type="hidden" value= <?php echo $row["category_id"]; ?>>
            </tr>
            <tr>
                <td><b>Category Name</b></td>
                <td><input type="text" name="catname" size="30" value="<?php echo $row["category_name"]; ?>" required></td>
            </tr>

        </table>
        </center>
        <br/>
        
        <table align="center">
            <br/>
            <tr>
                <td><input type="submit" value="Update category" ></td>
                <td><input type="button" value="Return to list" OnClick="window.location='category.php'"></td>
            </tr>
        </table>
    </form>
    <?php
    break;
    
case "ConfirmUpdate": {
    $update_q = "UPDATE category SET category_name = ? WHERE category_id =".$_GET["pid"];
    $pquery = mysqli_prepare($conn,$update_q) or die ("Mysql Error: " . $conn->error);
    $pquery->bind_param('s',$cname);
    $cname = $_POST["catname"];
    if($pquery->execute())
    { ?>
        <script>alert("Update Successful")</script>
         <?php
    }
    else
    {
        ?>
        <script>alert("Category data update unsuccessful. Please contact System Administrator.")</script><?php
    };
    header("Location: category.php");

    break;
}
case "Delete": {
    ?>

    <center>Confirm deletion of the following product record<br/></center><p/>
    <table align="center" cellpadding="3">
        <tr>
            <td><b>Category ID</b></td>
            <td><?php echo $row["category_id"]; ?></td>
        </tr>
        <tr>
            <td><b>Category Name</b></td>
            <td><?php echo $row["category_name"]; ?> </td>
        </tr>
    </table>
    <table align="center">
        <br/>
        <tr>
            <td><input type="button" value="Confirm" OnClick="confirm_delete();"></td>
            <td><input type="button" value="Cancel" OnClick="window.location='category.php'"></td>
        </tr>
    </table>
    <br/>


    <?php
    break;
}
case "ConfirmDelete":
{
$query = "Delete from category 
                WHERE category_id=".$_GET["pid"];
if ($conn->query($query)) {

?>
<center>The following Client record has successfully deleted <p />
    <?php
    echo "Category ID: $row[category_id] ";
    echo "<br/>";
    echo "Name: $row[category_name]";
    echo "</center><p />";
    }
    else {
        echo "<center>Error deleting product record<p/></center>";
    }

    echo "<center><input type='button' value='return to list' OnClick='window.location = \"category.php\"' ></center>";

        break;
    }
}
    $result -> free_result();
    $conn->close();
    ?>


</body>
</html>

