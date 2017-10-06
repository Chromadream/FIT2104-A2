<?php
    ob_start();
	session_start();
	if (!($_SESSION["access_status"] === "granted")) {
		$page = "project.php";
		header("location: login.php?Page=$page");
	}

?>
<html>
<head><title></title></head>
<link rel="stylesheet" type="text/css" href="styles.css">
<title>Project Modify</title>
<body>
<script language="JavaScript">
    function confirm_delete()
    {
        window.location= 'projectModify.php?pid=<?php echo $_GET["pid"]; ?>&Action=ConfirmDelete';

    }
</script>
<center><h3>Project Edit</h3></center>
<?php
include("connection.php");
$conn = mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);
$query = "SELECT * From project WHERE project_id=".$_GET["pid"];
$result = $conn->query($query);
$row = $result->fetch_assoc();

$strAction = $_GET["Action"];

switch ($strAction)
{
case "Update":

    ?>
    <form method="post" action="projectModify.php?pid=<?php echo $row["project_id"];?>&Action=ConfirmUpdate">
        <center>Project detail<br/></center>
        <p/>
        <table align="center" border="0" cellpadding="10" cellspacing="1" width="500" class="tblListForm">
            <tr>
                <td class="listheader"><b>Project ID</b></td>
                <td><?php echo $row["project_id"]; ?></td>
                <input name="projectId" type="hidden" value= <?php echo $row["project_id"]; ?>>
            </tr>
            <tr>
                <td class="listheader"><b>Project Description</b></td>
                <td><input type="text" name="pdesc" size="30" value="<?php echo $row["project_desc"]; ?>" required></td>
            </tr>
            <tr>
                <td class="listheader"><b>Project Country</b></td>
                <td><input type="text" name="pcountry" size="30" value="<?php echo $row["project_country"]; ?>" required></td>
            </tr>
            <tr>
                <td class="listheader"><b>Project City</b></td>
                <td><input type="text" name="pcity" size="30" value="<?php echo $row["project_city"]; ?>" required></td>
            </tr>
        </table>
        <br/>
        
        <table align="center">
            <br/>
            <tr>
                <td><input type="submit" value="Update product"></td>
                <td><input type="button" value="Return to list" OnClick="window.location='project.php'"></td>
            </tr>
        </table>
    </form>
    <?php
    break;
    
case "ConfirmUpdate": {
    $update_q = "UPDATE project SET project_desc = ?, project_country = ?, project_city = ? WHERE project_id =".$_GET["pid"];
    $pquery = mysqli_prepare($conn,$update_q) or die ("Mysql Error: " . $conn->error);
    $pquery->bind_param('sss',$pdesc,$pcountry,$pcity);
    $pdesc = $_POST["pdesc"];
    $pcountry = $_POST["pcountry"];
    $pcity = $_POST["pcity"];
    

    if($pquery->execute())
    {
        echo "Update Successful";
    }
    else
    {
        echo "Project data update unsuccessful. Please contact System Administrator.";
    };
    header("Location: project.php");

    break;
}
case "Delete": {
    ?>

    <center>Confirm deletion of the following product record<br/></center><p/>
    <table align="center" border="0" cellpadding="10" cellspacing="1" width="500" class="tblListForm">
        <tr>
            <td class="listheader"><b>Project ID</b></td>
            <td><?php echo $row["project_id"]; ?></td>
        </tr>
        <tr>
            <td class="listheader"><b>Project Description</b></td>
            <td><?php echo $row["project_desc"]; ?> </td>
        </tr>
    </table>
    <table align="center">
        <br/>
        <tr>
            <td><input type="button" value="Confirm" OnClick="confirm_delete();"></td>
            <td><input type="button" value="Cancel" OnClick="window.location='project.php'"></td>
        </tr>
    </table>
    <br/>


    <?php
    break;
}
case "ConfirmDelete":
{
$query = "Delete from project 
                WHERE project_id=".$_GET["pid"];
if ($conn->query($query)) {

?>
<center>The following Project record has successfully deleted <p />
    <?php
    echo "Project ID: $row[project_id] ";
    echo "<br/>";
    echo "Description: $row[project_desc]";
    echo "</center><p />";
    }
    else {
        echo "<center>Error deleting product record<p/></center>";
    }

    echo "<center><input type='button' value='return to list' OnClick='window.location = \"project.php\"' ></center>";

        break;
    }
}
    $result -> free_result();
    $conn->close();
    ?>


</body>
</html>

