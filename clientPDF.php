<?php 
session_start();
if (!($_SESSION["access_status"] === "granted")) {
    $page = "clientPDF.php";
    header("location: login.php?Page=$page");
}
ob_start();
require "vendor/autoload.php";
include("connection.php");
include("createPDF.php");
?>

<html>
<head>
    <title>Famox Client Page</title>
</head>
<body>
<h1>Create PDF of Client List</h1>
<a href='PDFS/Clients.pdf'><button>Click here to see PDF</button></a>
<?php
$CONNECTION=new mysqli($HOST,$USERNAME,$PASSWORD,$DATABASE);
$QUERY = "SELECT * FROM CLIENT ORDER BY client_id";
$RESULT = mysqli_query($CONNECTION,$QUERY);
$rows = mysqli_fetch_all($RESULT,MYSQLI_ASSOC);

$headers = array('Cust. ID','Name','Address','Email Address','Mobile Phone','Mailing List');
$headerwidth = array(50,200,200,200,150,100);

$PDF = new CreatePDF();

$table = $PDF->clientPDF($headers,$headerwidth,$rows)?>
</body>
</html>