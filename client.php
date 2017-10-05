<?php
session_start();
if (!($_SESSION["access_status"] === "granted")) {
    $page = "client.php";
    header("location: login.php?Page=$page");
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>

<?php
	include("connection.php");
	$conn = new mysqli($HOST, $USERNAME, $PASSWORD, $DATABASE);
    $query = "SELECT * FROM CLIENT ORDER BY client_fname";
    $result = $conn->query($query);
	
?>
<table border= "1px solid black">
	<tr>
       <td><?php echo "Name" ?> </td>
       <td><?php echo "Address" ?> </td>
       <td><?php echo "Suburb" ?> </td>
       <td><?php echo "State" ?> </td>
       <td><?php echo "Postcode" ?> </td>
       <td><?php echo "Email address" ?> </td>
       <td><?php echo "Mobile Phone" ?> </td>
       <td><?php echo "Mailing List" ?> </td>
    </tr>

<?php
	while ($row = $result->fetch_assoc())
	{
?>
	<tr>
       <td><?php echo $row["client_fname"]." ".$row["client_lname"]; ?> </td>
       <td><?php echo $row["client_street"]; ?> </td>
       <td><?php echo $row["client_suburb"]; ?> </td>
       <td><?php echo $row["client_state"]; ?> </td>
       <td><?php echo $row["client_pc"]; ?> </td>
       <td><?php echo $row["client_email"]; ?> </td>
       <td><?php echo $row["client_mobile"]; ?> </td>
       <td><?php echo $row["client_mailinglist"]; ?> </td>
       <td>
       	<a href="clientModify.php?pid= <?php echo $row["client_id"]; ?> &Action=Delete">Delete</a>
        </td>
        <td>
			<a href="clientModify.php?pid= <?php echo $row["client_id"]; ?>
&Action=Update">Update</a>
		</td>
    </tr>

<?php
	}
?>
</table>

<a href="newClient.php" ><button>New Client</button></a>
<a href="email.php" ><button>New Email</button></a>
<a href="clientPDF.php"><button>Generate PDF</button></a>
</body>
</html>