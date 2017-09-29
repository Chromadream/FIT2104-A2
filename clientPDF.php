<?php ob_start();
require "vendor/autoload.php";
include("connection.php");
include("clientPDF.php");
?>

<html>
<head>
    <title>Famox Client Page</title>
</head>
<body>
<h1>Create PDF of Client List</h1>
<?php
$CONNECTION=new mysqli($HOST,$USERNAME,$PASSWORD,$DATABASE);
$QUERY = "SELECT * FROM CLIENT ORDER BY client_lname";
$RESULT = mysqli_query($CONNECTION,$QUERY);
$rows = mysqli_fetch_all($RESULT,MYSQLI_ASSOC);

$headers = array('Cust. ID','Name','Address','Email Address','Mobile Phone','Mailing List');
$headerwidth = array(150,250,350,200,150,100);

$PDF = new CreatePDF();

$table = $PDF->clientPDF($headers,$headerwidth,$rows);
echo $table;
echo "<br/>";
echo "<a href='PDFS/Clients.pdf'>Click here to see PDF</a>";
?>
</body>
</html>