<?php
session_start();
if (!($_SESSION["access_status"] === "granted")) {
    $page = "category.php";
    header("location: login.php?Page=$page");
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Famox Category Page</title>
</head>

<body>

<?php
	include("connection.php");
	$conn = new mysqli($HOST, $USERNAME, $PASSWORD, $DATABASE);
    $query = "SELECT * FROM category ORDER BY category_name";
    $result = $conn->query($query);
	
?>
<table border= "1px solid black">
	<tr>
       <td><?php echo "Category ID" ?> </td>
        <td><?php echo "Category Name" ?> </td>
    </tr>

<?php
	while ($row = $result->fetch_assoc())
	{
?>
	<tr>
        <td><?php echo $row["category_id"]; ?> </td>
        <td><?php echo $row["category_name"]; ?> </td>
       <td>
       	<a href="catModify.php?pid=<?php echo $row["category_id"]; ?> &Action=Delete">Delete</a>
        </td>
        <td>
			<a href="catModify.php?pid=<?php echo $row["category_name"]; ?>
&Action=Update">Update</a>
		</td>
    </tr>

<?php
	}
?>
</table>

<a href="newCat.php" ><button>New Category</button></a>
<a href="index.html" ><button>Return to Main Page</button></a>
</body>
</html>