<?php
session_start();
if (!($_SESSION["access_status"] === "granted")) {
    $page = "project.php";
    header("location: login.php?Page=$page");
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Project List</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body>

<?php
	include("connection.php");
	$conn = new mysqli($HOST, $USERNAME, $PASSWORD, $DATABASE);
    $query = "SELECT * FROM project ORDER BY project_id";
    $result = $conn->query($query);
	
?>
<center>
<h3>Projects</h3>
<br>
<table border="0" cellpadding="10" cellspacing="1" width="500" class="tblListForm">
	<tr class="listheader">
       <td><?php echo "Project ID" ?> </td>
       <td><?php echo "Project Description" ?> </td>
       <td><?php echo "Project Country" ?> </td>
       <td><?php echo "Project City" ?> </td>
    </tr>

<?php
	while ($row = $result->fetch_assoc())
	{
?>
	<tr>
       <td><?php echo $row["project_id"] ?> </td>
       <td><?php echo $row["project_desc"]; ?> </td>
       <td><?php echo $row["project_country"]; ?> </td>
       <td><?php echo $row["project_city"]; ?> </td>

       <td>
       	<a href="projectModify.php?pid=<?php echo $row["client_id"]; ?> &Action=Delete">Delete</a>
        </td>
        <td>
			<a href="projectModify.php?pid=<?php echo $row["client_id"]; ?>
&Action=Update">Update</a>
		</td>
    </tr>

<?php
	}
?>
</table>
<a href="newProject_form.php" ><button>New Project</button></a>
    <br/>
    <a href="multiView.php?page=project"><img src="images/Assignment2-Image-003.jpg"></a>
</center>



</body>
</html>